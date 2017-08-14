<?php
session_start();

// Declare Permission Level
$perm = 5;
require_once("../../_system/secure.php");

include("../_require/db.php");

	if(empty($_GET['from'])){
		if(empty($_SERVER['HTTP_REFERER'])){
			$from = "../../";
		} else {
			$from = $_SERVER['HTTP_REFERER'];
		}} else {
		$from = $_GET['from'];
	}
	if($_SESSION['account_type'] == "admin"){} else {
		if($_SESSION['account_type'] == "developer"){} else {
				header("Location: $from");
		}
	}
	
	
	$notif_id = uniqid();
	$create_month = date("M");
	$create_day = date("d");
	$create_year = date("Y");
	$create_time = date("h:i a");

	
	$student_id = $_POST['student_id'];
	$student_lrn = $_POST['student_lrn'];
	
	$check_student = $db_student->get("student_id", "student_id", "$student_id");
	
	if(empty($check_student)){
		echo  "Student does not exist";
	} else {
				
				$first_name = $db_student->get("first_name", "student_id", "$student_id");
				$last_name = $db_student->get("last_name",  "student_id", "$student_id");
				$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
				
				$db_student->to("student_lrn", "$student_lrn","student_id", "$student_id");
				
				$user_id = $db_account->get("user_id", "student_id", "$student_id");
	$n_a = array(
					"notification_id" => "$notif_id",
					"notification_title" => "You have been assigned with your LRN",
					"notification_content" => "It is a government-issued number that serves as your identification throughout your basic education.",
					"photo_url" => "",
					"notification_url" => "",
					"notification_icon" => "assessment",
					"user_id" => "$user_id",
					"sender_alternative" => "Registrar",
					"sender_id" => "",
					"create_month" => "$create_month",
					"create_day" => "$create_day",
					"create_year" => "$create_year",
					"create_time" => "$create_time"
				);
				$db_notification->add($n_a);

				echo "<span class='green-text'> $first_name $last_name $suffix_name assigned to LRN $student_lrn</span>";
				
			}
		 
		
?>