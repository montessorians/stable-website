<?php
/*
Holy Child Montessori
2017

Enroll Class Manual
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 5;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Generate ID
$enroll_id = uniqid();

// Handle Post Data
$student_id = $_POST['student_id'];
$class_id = $_POST['class_id'];

// Get Date and Time
$enroll_month = date("M");
$enroll_day = date("d");
$enroll_year = date("Y");
$enroll_hour = date("H");
$enroll_minute = date("i");

// Query
$check_student = $db_student->get("student_id", "student_id", "$student_id");
$check_hold = $db_hold->get("student_id","student_id","$student_id");
$check_id = $db_class->get("class_id", "class_id", "$class_id");

// Check if student exists
if(empty($check_student)){

	echo  "Student does not exist";

} else {

	// Check if hold exists
	if(empty($check_hold)){

		if(empty($check_id)){

			echo "Class Not Found";

		} else {

			// Get Info
			$first_name = $db_student->get("first_name", "student_id", "$student_id");
			$last_name = $db_student->get("last_name",  "student_id", "$student_id");
			$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
			$subject_id = $db_class->get("subject_id","class_id","$class_id");
			$subject_title = $db_subject->get("subject_title", "subject_id", "$subject_id");
			$school_year = $db_class->get("school_year", "class_id", "$class_id");

			// Prepare array
			$array = array(
			"enroll_id" => "$enroll_id",
			"school_year" => "$school_year",
			"student_id" => "$student_id",
			"class_id" => "$class_id",
			"enroll_month" => "$enroll_month",
			"enroll_day" => "$enroll_day",
			"enroll_year" => "$enroll_year",
			"enroll_hour" => "$enroll_hour",
			"enroll_minute" => "$enroll_minute",
			"first_quarter_grade" => "",
			"second_quarter_grade" => "",
			"third_quarter_grade" => "",
			"fourth_quarter_grade" => "",
			"final_grade" => "",
			"enroll_notes" => ""
			);

			// Add to DB
			$db_enroll->add($array);

			// Get User ID
			$user_id = $db_account->get("user_id", "student_id", "$student_id");

			// Prepare Notif
			$notif_title = "You are now enrolled in $subject_title ";
			$notif_content = "Congratulations! You are now enrolled in your subject $subject_title for SY $school_year.";
			$notif_icon = "assignment_turned_in";
			$notif_user_id = "$user_id";
			$notif_sender_alternative = "Registrar";
			
			// Send Notification
			include("../_require/notif.php");
			
			echo "<span class='green-text'> $first_name $last_name $suffix_name enrolled in $subject_title </span>";
			
		}

	} else {

		echo "Student on hold";

	}

}
	
?>