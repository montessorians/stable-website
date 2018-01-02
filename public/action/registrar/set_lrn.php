<?php
/*
Holy Child Montessori
2017

Set LRN
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
$student_lrn = $_POST['student_lrn'];

// Query
$check_student = $db_student->get("student_id", "student_id", "$student_id");

// Check if student exists
if(empty($check_student)){

	echo  "Student does not exist";

} else {
	
	// Get Details
	$student_info = $db_student->where(array(),"student_id",$student_id);
	foreach($student_info as $student){
		$first_name = $student['first_name'];
		$last_name = $student['last_name'];
		$suffix_name = $student['suffix_name'];
	}

	// Rewrite DB
	$db_student->to("student_lrn", "$student_lrn","student_id", "$student_id");
	
	// Get User ID
	$user_id = $db_account->get("user_id", "student_id", "$student_id");

	$notif_title = "You have been assigned with your LRN";
	$notif_content = "It is a government-issued number that serves as your identification throughout your basic education.";
	$notif_icon = "assessment";
	$notif_user_id = "$user_id";
	$notif_sender_alternative = "Registrar";
	
	// Send Notification
	include("../_require/notif.php");
	
	echo "<span class='green-text'> $first_name $last_name $suffix_name assigned to LRN $student_lrn</span>";
			
}
				
?>