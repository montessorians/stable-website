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

$absent_jan = $_POST['absent_jan'];
$absent_feb = $_POST['absent_feb'];
$absent_mar = $_POST['absent_mar'];
$absent_apr = $_POST['absent_apr'];
$absent_may = $_POST['absent_may'];
$absent_jun = $_POST['absent_jun'];
$absent_jul = $_POST['absent_jul'];
$absent_aug = $_POST['absent_aug'];
$absent_sep = $_POST['absent_sep'];
$absent_oct = $_POST['absent_oct'];
$absent_nov = $_POST['absent_nov'];
$absent_dec = $_POST['absent_dec'];

$late_jan = $_POST['late_jan'];
$late_feb = $_POST['late_feb'];
$late_mar = $_POST['late_mar'];
$late_apr = $_POST['late_apr'];
$late_may = $_POST['late_may'];
$late_jun = $_POST['late_jun'];
$late_jul = $_POST['late_jul'];
$late_aug = $_POST['late_aug'];
$late_sep = $_POST['late_sep'];
$late_oct = $_POST['late_oct'];
$late_nov = $_POST['late_nov'];
$late_dec = $_POST['late_dec'];

// Rewrite 
$db_attendance->to("absent_jan", "$absent_jan", "attendance_id", "$attendance_id");
$db_attendance->to("absent_feb", "$absent_feb", "attendance_id", "$attendance_id");
$db_attendance->to("absent_mar", "$absent_mar", "attendance_id", "$attendance_id");
$db_attendance->to("absent_apr", "$absent_apr", "attendance_id", "$attendance_id");
$db_attendance->to("absent_may", "$absent_may", "attendance_id", "$attendance_id");
$db_attendance->to("absent_jun", "$absent_jun", "attendance_id", "$attendance_id");
$db_attendance->to("absent_jul", "$absent_jul", "attendance_id", "$attendance_id");
$db_attendance->to("absent_aug", "$absent_aug", "attendance_id", "$attendance_id");
$db_attendance->to("absent_sep", "$absent_sep", "attendance_id", "$attendance_id");
$db_attendance->to("absent_oct", "$absent_oct", "attendance_id", "$attendance_id");
$db_attendance->to("absent_nov", "$absent_nov", "attendance_id", "$attendance_id");
$db_attendance->to("absent_dec", "$absent_dec", "attendance_id", "$attendance_id");

$db_attendance->to("late_jan", "$late_jan", "attendance_id", "$attendance_id");
$db_attendance->to("late_feb", "$late_feb", "attendance_id", "$attendance_id");
$db_attendance->to("late_mar", "$late_mar", "attendance_id", "$attendance_id");
$db_attendance->to("late_apr", "$late_apr", "attendance_id", "$attendance_id");
$db_attendance->to("late_may", "$late_may", "attendance_id", "$attendance_id");
$db_attendance->to("late_jun", "$late_jun", "attendance_id", "$attendance_id");
$db_attendance->to("late_jul", "$late_jul", "attendance_id", "$attendance_id");
$db_attendance->to("late_aug", "$late_aug", "attendance_id", "$attendance_id");
$db_attendance->to("late_sep", "$late_sep", "attendance_id", "$attendance_id");
$db_attendance->to("late_oct", "$late_oct", "attendance_id", "$attendance_id");
$db_attendance->to("late_nov", "$late_nov", "attendance_id", "$attendance_id");
$db_attendance->to("late_dec", "$late_dec", "attendance_id", "$attendance_id");

// Get Student Info
$student_id = $db_attendance->get("student_id", "attendance_id", "$attendance_id");
$first_name = $db_student->get("first_name", "student_id", "$student_id");
$last_name = $db_student->get("last_name", "student_id", "$student_id");
$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
$user_id = $db_account->get("user_id", "student_id", "$student_id");

echo "Attendance of $first_name $last_name $suffix_name has been encoded successfully!";

?>