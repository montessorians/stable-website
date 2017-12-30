<?php
/*
Holy Child Montessori
2017

Encode Attendance
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 4;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Handle Post Data
$attendance_id = $_POST['attendance_id'];

$pres_jan = $_POST['pres_jan'];
$pres_feb = $_POST['pres_feb'];
$pres_mar = $_POST['pres_mar'];
$pres_apr = $_POST['pres_apr'];
$pres_may = $_POST['pres_may'];
$pres_jun = $_POST['pres_jun'];
$pres_jul = $_POST['pres_jul'];
$pres_aug = $_POST['pres_aug'];
$pres_sep = $_POST['pres_sep'];
$pres_oct = $_POST['pres_oct'];
$pres_nov = $_POST['pres_nov'];
$pres_dec = $_POST['pres_dec'];

$sch_jan = $_POST['sch_jan'];
$sch_feb = $_POST['sch_feb'];
$sch_mar = $_POST['sch_mar'];
$sch_apr = $_POST['sch_apr'];
$sch_may = $_POST['sch_may'];
$sch_jun = $_POST['sch_jun'];
$sch_jul = $_POST['sch_jul'];
$sch_aug = $_POST['sch_aug'];
$sch_sep = $_POST['sch_sep'];
$sch_oct = $_POST['sch_oct'];
$sch_nov = $_POST['sch_nov'];
$sch_dec = $_POST['sch_dec'];

// Rewrite 
$db_attendance->to("pres_jan", "$pres_jan", "attendance_id", "$attendance_id");
$db_attendance->to("pres_feb", "$pres_feb", "attendance_id", "$attendance_id");
$db_attendance->to("pres_mar", "$pres_mar", "attendance_id", "$attendance_id");
$db_attendance->to("pres_apr", "$pres_apr", "attendance_id", "$attendance_id");
$db_attendance->to("pres_may", "$pres_may", "attendance_id", "$attendance_id");
$db_attendance->to("pres_jun", "$pres_jun", "attendance_id", "$attendance_id");
$db_attendance->to("pres_jul", "$pres_jul", "attendance_id", "$attendance_id");
$db_attendance->to("pres_aug", "$pres_aug", "attendance_id", "$attendance_id");
$db_attendance->to("pres_sep", "$pres_sep", "attendance_id", "$attendance_id");
$db_attendance->to("pres_oct", "$pres_oct", "attendance_id", "$attendance_id");
$db_attendance->to("pres_nov", "$pres_nov", "attendance_id", "$attendance_id");
$db_attendance->to("pres_dec", "$pres_dec", "attendance_id", "$attendance_id");

$db_attendance->to("sch_jan", "$sch_jan", "attendance_id", "$attendance_id");
$db_attendance->to("sch_feb", "$sch_feb", "attendance_id", "$attendance_id");
$db_attendance->to("sch_mar", "$sch_mar", "attendance_id", "$attendance_id");
$db_attendance->to("sch_apr", "$sch_apr", "attendance_id", "$attendance_id");
$db_attendance->to("sch_may", "$sch_may", "attendance_id", "$attendance_id");
$db_attendance->to("sch_jun", "$sch_jun", "attendance_id", "$attendance_id");
$db_attendance->to("sch_jul", "$sch_jul", "attendance_id", "$attendance_id");
$db_attendance->to("sch_aug", "$sch_aug", "attendance_id", "$attendance_id");
$db_attendance->to("sch_sep", "$sch_sep", "attendance_id", "$attendance_id");
$db_attendance->to("sch_oct", "$sch_oct", "attendance_id", "$attendance_id");
$db_attendance->to("sch_nov", "$sch_nov", "attendance_id", "$attendance_id");
$db_attendance->to("sch_dec", "$sch_dec", "attendance_id", "$attendance_id");

// Get Student Info
$student_id = $db_attendance->get("student_id", "attendance_id", "$attendance_id");
$first_name = $db_student->get("first_name", "student_id", "$student_id");
$last_name = $db_student->get("last_name", "student_id", "$student_id");
$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
$user_id = $db_account->get("user_id", "student_id", "$student_id");

echo "Attendance of $first_name $last_name $suffix_name has been encoded successfully!";

?>