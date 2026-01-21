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
 * View archived certificate history for a user.
 *
 * @copyright 2026 Catalyst IT
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @package local_recompletion
 */

require_once('../../config.php');
require_once($CFG->dirroot.'/user/lib.php');

$courseid = required_param('id', PARAM_INT);
$userid   = required_param('user', PARAM_INT);

$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
$user = $DB->get_record('user', array('id' => $userid), '*', MUST_EXIST);

require_login($course);

$context = context_course::instance($course->id);
require_capability('local/recompletion:manage', $context);

$PAGE->set_url('/local/recompletion/certhistory.php', array('id' => $course->id, 'user' => $userid));
$PAGE->set_title(get_string('certificatehistory', 'local_recompletion'));
$PAGE->set_heading($course->fullname);

// Get archived certificates for this user in this course.
$sql = "SELECT rc.*, c.name as certname
        FROM {local_recompletion_cert} rc
        LEFT JOIN {customcert} c ON c.id = rc.customcertid
        WHERE rc.userid = :userid AND rc.course = :courseid
        ORDER BY rc.timearchived DESC";

$certificates = $DB->get_records_sql($sql, array('userid' => $userid, 'courseid' => $courseid));

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('certificatehistory', 'local_recompletion'));
echo $OUTPUT->box(get_string('certificatehistory_desc', 'local_recompletion', fullname($user)));

if (empty($certificates)) {
    echo $OUTPUT->notification(get_string('nocertificatehistory', 'local_recompletion'), 'info');
} else {
    $table = new html_table();
    $table->head = array(
        get_string('certificatename', 'local_recompletion'),
        get_string('originalissuedate', 'local_recompletion'),
        get_string('archiveddate', 'local_recompletion')
    );
    $table->data = array();

    foreach ($certificates as $cert) {
        $certname = !empty($cert->certname) ? $cert->certname : get_string('deletedcertificate', 'local_recompletion');
        $issuedate = userdate($cert->timecreated, get_string('strftimedatetimeshort', 'langconfig'));
        $archivedate = userdate($cert->timearchived, get_string('strftimedatetimeshort', 'langconfig'));

        $table->data[] = array($certname, $issuedate, $archivedate);
    }

    echo html_writer::table($table);
}

// Back button.
$backurl = new moodle_url('/local/recompletion/participants.php', array('id' => $course->id));
echo $OUTPUT->single_button($backurl, get_string('back'), 'get');

echo $OUTPUT->footer();
