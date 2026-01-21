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
 * Thai strings for local_recompletion
 *
 * @package    local_recompletion
 * @copyright  2017 Dan Marsden
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'การเรียนซ้ำ';
$string['recompletion'] = 'การเรียนซ้ำ';
$string['editrecompletion'] = 'แก้ไขการตั้งค่าการเรียนซ้ำ';
$string['enablerecompletion'] = 'เปิดใช้งานการเรียนซ้ำ';
$string['enablerecompletion_help'] = 'ปลั๊กอินการเรียนซ้ำช่วยให้สามารถรีเซ็ตข้อมูลการเรียนจบหลังจากช่วงเวลาที่กำหนด';
$string['recompletionrange'] = 'ระยะเวลาก่อนเรียนซ้ำ';
$string['recompletionrange_help'] = 'กำหนดระยะเวลาก่อนที่ข้อมูลการเรียนจบของผู้เรียนจะถูกรีเซ็ต';
$string['recompletionsettingssaved'] = 'บันทึกการตั้งค่าการเรียนซ้ำแล้ว';
$string['recompletion:manage'] = 'อนุญาตให้เปลี่ยนการตั้งค่าการเรียนซ้ำ';
$string['recompletion:resetmycompletion'] = 'รีเซ็ตการเรียนจบของตนเอง';
$string['resetmycompletion'] = 'รีเซ็ตการเรียนจบกิจกรรมของฉัน';
$string['recompletiontask'] = 'ตรวจสอบผู้ใช้ที่ต้องเรียนซ้ำ';
$string['completionnotenabled'] = 'ไม่ได้เปิดใช้งานการติดตามความสำเร็จในรายวิชานี้';
$string['recompletionnotenabled'] = 'ไม่ได้เปิดใช้งานการเรียนซ้ำในรายวิชานี้';
$string['recompletionemailenable'] = 'ส่งข้อความแจ้งเตือนการเรียนซ้ำ';
$string['recompletionemailenable_help'] = 'เปิดใช้งานการส่งอีเมลแจ้งเตือนผู้ใช้ว่าต้องเรียนซ้ำ';
$string['recompletionemailsubject'] = 'หัวข้อข้อความแจ้งเตือน';
$string['recompletionemailsubject_help'] = 'หัวข้ออีเมลแจ้งเตือนการเรียนซ้ำแบบกำหนดเอง

สามารถใช้ตัวแปรต่อไปนี้:

* ชื่อรายวิชา {$a->coursename}
* ชื่อผู้ใช้ {$a->fullname}';
$string['recompletionemaildefaultsubject'] = 'รายวิชา {$a->coursename} ต้องเรียนซ้ำ';
$string['recompletionemailbody'] = 'เนื้อหาข้อความแจ้งเตือน';
$string['recompletionemailbody_help'] = 'เนื้อหาอีเมลแจ้งเตือนการเรียนซ้ำแบบกำหนดเอง

สามารถใช้ตัวแปรต่อไปนี้:

* ชื่อรายวิชา {$a->coursename}
* ลิงก์ไปยังรายวิชา {$a->link}
* ลิงก์ไปยังหน้าโปรไฟล์ {$a->profileurl}
* อีเมลผู้ใช้ {$a->email}
* ชื่อผู้ใช้ {$a->fullname}';
$string['recompletionemaildefaultbody'] = 'สวัสดี กรุณาเรียนซ้ำรายวิชา {$a->coursename} {$a->link}';
$string['advancedrecompletiontitle'] = 'ขั้นสูง';
$string['deletegradedata'] = 'ลบคะแนนทั้งหมดของผู้ใช้';
$string['deletegradedata_help'] = 'ลบข้อมูลคะแนนจากตาราง grade_grades ข้อมูลจะถูกลบถาวรแต่ยังคงอยู่ในตารางประวัติคะแนน';
$string['archivecompletiondata'] = 'เก็บข้อมูลการเรียนจบ';
$string['archivecompletiondata_help'] = 'บันทึกข้อมูลการเรียนจบไว้ในตาราง archive ข้อมูลจะถูกลบถาวรหากไม่เลือกตัวเลือกนี้';
$string['emailrecompletiontitle'] = 'การตั้งค่าข้อความแจ้งเตือนการเรียนซ้ำ';
$string['eventrecompletion'] = 'การเรียนซ้ำรายวิชา';
$string['assignattempts'] = 'การส่งงาน';
$string['assignattempts_help'] = 'วิธีจัดการกับการส่งงานในรายวิชา';
$string['extraattempt'] = 'ให้นักเรียนส่งงานเพิ่ม';
$string['quizattempts'] = 'การทำแบบทดสอบ';
$string['quizattempts_help'] = 'วิธีจัดการกับการทำแบบทดสอบที่มีอยู่';
$string['scormattempts'] = 'การทำ SCORM';
$string['scormattempts_help'] = 'วิธีจัดการกับการทำ SCORM ที่มีอยู่';
$string['archive'] = 'เก็บข้อมูลเก่า';
$string['delete'] = 'ลบข้อมูลที่มีอยู่';
$string['donothing'] = 'ไม่ทำอะไร';
$string['resetcompletionconfirm'] = 'คุณแน่ใจหรือไม่ว่าต้องการรีเซ็ตข้อมูลการเรียนจบทั้งหมดในรายวิชานี้สำหรับ {$a}? คำเตือน - การดำเนินการนี้อาจลบเนื้อหาที่ส่งไว้อย่างถาวร';
$string['privacy:metadata:local_recompletion_cc'] = 'ข้อมูลการเรียนจบรายวิชาที่เก็บไว้';
$string['privacy:metadata:local_recompletion_cmc'] = 'ข้อมูลการเรียนจบกิจกรรมที่เก็บไว้';
$string['privacy:metadata:local_recompletion_cc_cc'] = 'ข้อมูลเกณฑ์การเรียนจบที่เก็บไว้';
$string['privacy:metadata:userid'] = 'รหัสผู้ใช้';
$string['privacy:metadata:course'] = 'รหัสรายวิชา';
$string['privacy:metadata:timecompleted'] = 'เวลาที่เรียนจบ';
$string['privacy:metadata:timeenrolled'] = 'เวลาที่ลงทะเบียน';
$string['privacy:metadata:timemodified'] = 'เวลาที่แก้ไข';
$string['privacy:metadata:timestarted'] = 'เวลาที่เริ่มเรียน';
$string['privacy:metadata:coursesummary'] = 'ข้อมูลสรุปการเรียนจบรายวิชา';
$string['privacy:metadata:gradefinal'] = 'คะแนนสุดท้าย';
$string['privacy:metadata:overrideby'] = 'รหัสผู้ที่ override';
$string['privacy:metadata:reaggregate'] = 'การคำนวณใหม่';
$string['privacy:metadata:unenroled'] = 'ถูกถอนออกจากรายวิชา';
$string['privacy:metadata:quiz_attempts'] = 'ข้อมูลการทำแบบทดสอบที่เก็บไว้';
$string['privacy:metadata:quiz_attempts:attempt'] = 'ครั้งที่ทำ';
$string['privacy:metadata:quiz_attempts:currentpage'] = 'หน้าปัจจุบัน';
$string['privacy:metadata:quiz_attempts:preview'] = 'เป็นการดูตัวอย่าง';
$string['privacy:metadata:quiz_attempts:state'] = 'สถานะ';
$string['privacy:metadata:quiz_attempts:sumgrades'] = 'คะแนนรวม';
$string['privacy:metadata:quiz_attempts:timecheckstate'] = 'เวลาตรวจสอบสถานะ';
$string['privacy:metadata:quiz_attempts:timefinish'] = 'เวลาเสร็จสิ้น';
$string['privacy:metadata:quiz_attempts:timemodified'] = 'เวลาแก้ไข';
$string['privacy:metadata:quiz_attempts:timemodifiedoffline'] = 'เวลาแก้ไขออฟไลน์';
$string['privacy:metadata:quiz_attempts:timestart'] = 'เวลาเริ่มต้น';
$string['privacy:metadata:quiz_grades'] = 'ข้อมูลคะแนนแบบทดสอบที่เก็บไว้';
$string['privacy:metadata:quiz_grades:grade'] = 'คะแนน';
$string['privacy:metadata:quiz_grades:quiz'] = 'แบบทดสอบ';
$string['privacy:metadata:quiz_grades:timemodified'] = 'เวลาแก้ไข';
$string['privacy:metadata:quiz_grades:userid'] = 'รหัสผู้ใช้';
$string['privacy:metadata:scoes_track:element'] = 'ชื่อ element';
$string['privacy:metadata:scoes_track:value'] = 'ค่า';
$string['privacy:metadata:coursemoduleid'] = 'รหัสกิจกรรม';
$string['privacy:metadata:completionstate'] = 'สถานะการเรียนจบ';
$string['privacy:metadata:viewed'] = 'ดูแล้ว';
$string['privacy:metadata:attempt'] = 'ครั้งที่';
$string['privacy:metadata:scorm_scoes_track'] = 'ข้อมูล SCORM ที่เก็บไว้';
$string['noassigngradepermission'] = 'การเรียนจบของคุณถูกรีเซ็ตแล้ว แต่รายวิชานี้มีงานที่ไม่สามารถรีเซ็ตได้ กรุณาติดต่อผู้สอน';
$string['editcompletion'] = 'แก้ไขวันที่เรียนจบ';
$string['editcompletion_desc'] = 'แก้ไขวันที่เรียนจบสำหรับผู้ใช้ต่อไปนี้:';
$string['coursecompletiondate'] = 'วันที่เรียนจบใหม่';
$string['completionupdated'] = 'อัปเดตวันที่เรียนจบแล้ว';
$string['bulkchangedate'] = 'เปลี่ยนวันที่เรียนจบสำหรับผู้ใช้ที่เลือก';
$string['nousersselected'] = 'ไม่ได้เลือกผู้ใช้';
$string['resetallcompletion'] = 'รีเซ็ตการเรียนจบทั้งหมด';
$string['resetcompletionfor'] = 'รีเซ็ตการเรียนจบสำหรับ {$a}';
$string['completionresetuser'] = 'การเรียนจบของ {$a} ในรายวิชานี้ถูกรีเซ็ตแล้ว';
$string['modifycompletiondates'] = 'แก้ไขวันที่เรียนจบรายวิชา';
$string['assignevent'] = 'อัปเดตวันที่เรียนจบเมื่อมีการให้คะแนน';
$string['defaultsettings'] = 'การตั้งค่าเริ่มต้นการเรียนซ้ำ';
$string['archivequizdata'] = 'เก็บข้อมูลแบบทดสอบเก่า';
$string['archivescormdata'] = 'เก็บข้อมูล SCORM เก่า';
$string['certificateissued'] = 'ออก Certificate เมื่อ';
$string['daysuntilreset'] = 'จะถูก Reset อีก';
$string['days'] = 'วัน';
$string['alreadyexpired'] = 'ครบกำหนดแล้ว';
