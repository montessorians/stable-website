<?php
/*
Holy Child Montessori
2017

Hold User
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
$hold_id = uniqid();

// Handle Post Data
$student_id = $_POST['student_id'];
$department = $_POST['department'];
$hold_content = $_POST['hold_content'];

// Get date and time
$hold_month = date("M");
$hold_day = date("d");
$hold_year = date("Y");
$hold_hour = date("H");
$hold_minute = date("i");

// Query ID
$check_sid = $db_student->get("student_id", "student_id", "$student_id");

// Check if user doesn't exist
if(!$check_sid){

	// Echo msg	
	echo "Student does not exist";

} else {
	
	// Construct array
	$array = array(
		"hold_id" => "$hold_id",
		"student_id" => "$student_id",
		"department" => "$department",
		"hold_content" => "$hold_content",
		"hold_month" => "$hold_month",
		"hold_day" => "$hold_day",
		"hold_year" => "$hold_year",
		"hold_hour" => "$hold_hour",
		"hold_minute" => "$hold_minute"
	);

	// Add to DB
	$db_hold->add($array);

	// Query user ID	
	$user_id = $db_account->get("user_id", "student_id", "$student_id");
	
	// Prepare Notif
	$notif_title = "A hold was added to your account";
	$notif_content = "$hold_content";
	$notif_icon = "mood_bad";
	$notif_user_id = "$user_id";
	$notif_sender_alternative = "$department";
	
	// Send Notification
	include("../_require/notif.php");

	// Echo msg
	echo "Hold added successfully!";
	
}

?>