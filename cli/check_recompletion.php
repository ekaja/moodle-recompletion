<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * CLI script to check and reset users who need recompletion.
 *
 * This script can be run via cron independently of Moodle's task scheduler.
 *
 * Usage:
 *   php check_recompletion.php [options]
 *
 * Options:
 *   --dry-run       Show what would be reset without actually resetting
 *   --course=ID     Only check specific course ID
 *   --user=ID       Only check specific user ID
 *   --verbose       Show detailed output
 *   --help          Show this help
 *
 * Example crontab entry (run daily at 2am):
 *   0 2 * * * /usr/bin/php /path/to/moodle/local/recompletion/cli/check_recompletion.php
 *
 * @package    local_recompletion
 * @copyright  2026 Catalyst IT
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

define('CLI_SCRIPT', true);

require(__DIR__ . '/../../../config.php');
require_once($CFG->libdir . '/clilib.php');
require_once($CFG->dirroot . '/course/lib.php');
require_once($CFG->dirroot . '/local/recompletion/locallib.php');
require_once($CFG->libdir . '/completionlib.php');
require_once($CFG->libdir . '/gradelib.php');
require_once($CFG->dirroot . '/mod/assign/locallib.php');
require_once($CFG->dirroot . '/mod/quiz/lib.php');

// CLI options.
list($options, $unrecognized) = cli_get_params(
    array(
        'dry-run'  => false,
        'course'   => null,
        'user'     => null,
        'verbose'  => false,
        'help'     => false,
    ),
    array(
        'd' => 'dry-run',
        'c' => 'course',
        'u' => 'user',
        'v' => 'verbose',
        'h' => 'help',
    )
);

if ($unrecognized) {
    $unrecognized = implode("\n  ", $unrecognized);
    cli_error(get_string('cliunknowoption', 'admin', $unrecognized));
}

if ($options['help']) {
    $help = <<<EOT
CLI script to check and reset users who need recompletion based on certificate expiry.

Usage:
  php check_recompletion.php [options]

Options:
  -d, --dry-run       Show what would be reset without actually resetting
  -c, --course=ID     Only check specific course ID
  -u, --user=ID       Only check specific user ID
  -v, --verbose       Show detailed output
  -h, --help          Show this help

Examples:
  # Dry run to see who would be reset
  php check_recompletion.php --dry-run --verbose

  # Reset all expired users
  php check_recompletion.php

  # Check specific course only
  php check_recompletion.php --course=245

  # Check specific user in all courses
  php check_recompletion.php --user=123

  # Dry run for specific course with verbose output
  php check_recompletion.php --dry-run --verbose --course=245

Crontab example (run daily at 2am):
  0 2 * * * /usr/bin/php /path/to/moodle/local/recompletion/cli/check_recompletion.php

EOT;

    cli_writeln($help);
    exit(0);
}

$dryrun = $options['dry-run'];
$courseid = $options['course'];
$userid = $options['user'];
$verbose = $options['verbose'];

// Start output.
cli_writeln('');
cli_writeln('===========================================');
cli_writeln('Recompletion Check Script');
cli_writeln('Started at: ' . date('Y-m-d H:i:s'));
if ($dryrun) {
    cli_writeln('MODE: DRY RUN (no changes will be made)');
}
cli_writeln('===========================================');
cli_writeln('');

// Check if completion is enabled for site.
if (!completion_info::is_enabled_for_site()) {
    cli_error('Completion is not enabled for this site.');
}

// Build the SQL query.
$params = array(time());
$additionalwhere = '';

if ($courseid) {
    $additionalwhere .= ' AND sub.course = ?';
    $params[] = $courseid;
}

if ($userid) {
    $additionalwhere .= ' AND sub.userid = ?';
    $params[] = $userid;
}

// Query to find users who need recompletion based on certificate issue date.
$sql = "SELECT sub.userid, sub.course, sub.latest_cert,
               u.firstname, u.lastname, u.email,
               c.fullname as coursename,
               r2.value as duration
        FROM (
            SELECT ci.userid, cert.course, MAX(ci.timecreated) as latest_cert
            FROM {customcert_issues} ci
            JOIN {customcert} cert ON cert.id = ci.customcertid
            GROUP BY ci.userid, cert.course
        ) sub
        JOIN {local_recompletion_config} r ON r.course = sub.course AND r.name = 'enable' AND r.value = '1'
        JOIN {local_recompletion_config} r2 ON r2.course = sub.course AND r2.name = 'recompletionduration'
        JOIN {course} c ON c.id = sub.course
        JOIN {user} u ON u.id = sub.userid
        WHERE c.enablecompletion = " . COMPLETION_ENABLED . "
        AND sub.latest_cert > 0
        AND (sub.latest_cert + " . $DB->sql_cast_char2int('r2.value') . ") < ?
        $additionalwhere
        ORDER BY c.fullname, u.lastname, u.firstname";

$users = $DB->get_recordset_sql($sql, $params);

$courses = array();
$configs = array();
$resetcount = 0;
$errorcount = 0;

foreach ($users as $user) {
    $resetcount++;

    // Calculate days expired.
    $expireddays = floor((time() - ($user->latest_cert + $user->duration)) / 86400);
    $certdate = date('Y-m-d H:i:s', $user->latest_cert);
    $expirydate = date('Y-m-d H:i:s', $user->latest_cert + $user->duration);

    if ($verbose || $dryrun) {
        cli_writeln("[$resetcount] User: {$user->firstname} {$user->lastname} ({$user->email})");
        cli_writeln("    Course: {$user->coursename} (ID: {$user->course})");
        cli_writeln("    Certificate issued: {$certdate}");
        cli_writeln("    Expired on: {$expirydate} ({$expireddays} days ago)");
    }

    if (!$dryrun) {
        // Get course record.
        if (!isset($courses[$user->course])) {
            $course = get_course($user->course);
            $courses[$user->course] = $course;
        } else {
            $course = $courses[$user->course];
        }

        // Get recompletion config.
        if (!isset($configs[$user->course])) {
            $config = $DB->get_records_menu('local_recompletion_config',
                array('course' => $course->id), '', 'name, value');
            $config = (object) $config;
            $configs[$user->course] = $config;
        } else {
            $config = $configs[$user->course];
        }

        // Reset the user.
        try {
            $task = new \local_recompletion\task\check_recompletion();
            $errors = $task->reset_user($user->userid, $course, $config);

            if ($verbose) {
                cli_writeln("    Status: RESET COMPLETED");
                if (!empty($errors)) {
                    cli_writeln("    Warnings: {$errors}");
                }
            }
        } catch (Exception $e) {
            $errorcount++;
            cli_writeln("    Status: ERROR - " . $e->getMessage());
        }
    } else {
        if ($verbose) {
            cli_writeln("    Status: WOULD BE RESET (dry-run)");
        }
    }

    if ($verbose || $dryrun) {
        cli_writeln('');
    }
}

$users->close();

// Summary.
cli_writeln('===========================================');
cli_writeln('Summary');
cli_writeln('===========================================');
cli_writeln("Total users found: {$resetcount}");

if ($dryrun) {
    cli_writeln("Mode: DRY RUN - No changes were made");
    cli_writeln("Users that would be reset: {$resetcount}");
} else {
    cli_writeln("Users reset: " . ($resetcount - $errorcount));
    if ($errorcount > 0) {
        cli_writeln("Errors: {$errorcount}");
    }
}

cli_writeln('');
cli_writeln('Completed at: ' . date('Y-m-d H:i:s'));
cli_writeln('===========================================');

exit(0);
