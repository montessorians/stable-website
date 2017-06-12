<?php
session_start();
if(empty($_SESSION['logged_in'])){
	header("Location: ../../");
}

include("../../_system/database/db.php");

$hold_id = rand(1000000000,9999999999);
$student_id = $_POST['student_id'];
$department = $_POST['department'];
$hold_content = $_POST['hold_content'];
$hold_month = date("M");
$hold_day = date("d");
$hold_year = date("Y");
$hold_hour = date("H");
$hold_minute = date("i");

$db_student = new DBase("student", "../../_store");
$db_account = new DBase("account", "../../_store");
$db_hold = new DBase("student_hold", "../../_store");

$check_sid = $db_student->get("student_id", "student_id", "$student_id");
if(empty($check_sid)){
	echo "Student does not exist";
} else {
	
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
	$db_hold->add($array);
	
	$user_id = $db_account->get("user_id", "student_id", "$student_id");
	
	$db_notification = new DBase("notification", "../../_store");
				$notif_id = rand(1000000000,9999999999);
				$create_month = date("M");
				$create_day = date("d");
				$create_year = date("Y");
				$create_time = date("h:i a");
	
	$n_a = array(
					"notification_id" => "$notif_id",
					"notification_title" => "A hold was added to your account",
					"notification_content" => "$hold_content",
					"photo_url" => "",
					"notification_url" => "",
					"notification_icon" => "mood_bad",
					"user_id" => "$user_id",
					"sender_alternative" => "$department",
					"sender_id" => "",
					"create_month" => "$create_month",
					"create_day" => "$create_day",
					"create_year" => "$create_year",
					"create_time" => "$create_time"
				);
				$db_notification->add($n_a);
				
	echo "Hold added successfully!";
	
}

?>