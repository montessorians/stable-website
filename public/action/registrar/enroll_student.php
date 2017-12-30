<?php
/*
Holy Child Montessori
2017

Enroll Student
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 5;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Handle Post Data
$student_id = $_POST['student_id'];
$grade = $_POST['grade'];
$school_year = $_POST['school_year'];
$section = $_POST['section'];

// Check if empty section
if(empty($section)) $section = 1;

// Query
$check_student = $db_student->get("student_id", "student_id", "$student_id");
$check_hold = $db_hold->where(array("hold_id"),"student_id","$student_id");

// Check if student exists
if(empty($check_student)){

	echo  "Student does not exist";

} else {

	// Check if student not hold
	if(empty($check_hold)){

		// Get Student Data
		$first_name = $db_student->get("first_name", "student_id", "$student_id");
		$last_name = $db_student->get("last_name", "student_id", "$student_id");
		$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
		
		$db_student->to("grade","$grade","student_id", "$student_id");
		$db_student->to("school_year","$school_year","student_id", "$student_id");
		$db_student->to("section","$section","student_id", "$student_id");

		// Get User ID
		$user_id = $db_account->get("user_id", "student_id", "$student_id");

		// Generate ID
		$attendance_id = uniqid();

		// Construct Array
		$a_a = array(			
			"attendance_id" => "$attendance_id",
			"student_id" => "$student_id",
			"school_year" => "$school_year",
			"grade" => "$grade",
			"section" => "$section",
			"pres_jan" => "",
			"pres_feb" => "",
			"pres_mar" => "",
			"pres_apr" => "",
			"pres_may" => "",
			"pres_jun" => "",
			"pres_jul" => "",
			"pres_aug" => "",
			"pres_sep" => "",
			"pres_oct" => "",
			"pres_nov" => "",
			"pres_dec" => "",
			"sch_jan" => "",
			"sch_feb" => "",
			"sch_mar" => "",
			"sch_apr" => "",
			"sch_may" => "",
			"sch_jun" => "",
			"sch_jul" => "",
			"sch_aug" => "",
			"sch_sep" => "",
			"sch_oct" => "",
			"sch_nov" => "",
			"sch_dec" => ""				
		);

		// Write to DB
		$db_attendance->add($a_a);

		// Prepare Notif
		$notif_title = "Congratulations $first_name!";
		$notif_content = "You are now enrolled as $grade - $section this School Year $school_year!";
		$notif_icon = "assessment";
		$notif_user_id = "$user_id";
		$notif_sender_alternative = "Registrar";
		
		// Send Notification
		include("../_require/notif.php");

		echo "$first_name $last_name $suffix_name has been enrolled as $grade - $section this SY $school_year";
		
	} else {

		echo "Student on hold";

	}

}
	
?>