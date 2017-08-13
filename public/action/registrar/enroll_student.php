<?php
session_start();

include("../../_system/secure.php");
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
	$grade = $_POST['grade'];
	$school_year = $_POST['school_year'];
	$section = $_POST['section'];
	if(empty($section)){
		$section = 1;
	}
	
	$check_student = $db_student->get("student_id", "student_id", "$student_id");
	$check_hold = $db_hold->where(array("hold_id"),"student_id","$student_id");
	
	if(empty($check_student)){
		echo  "Student does not exist";
	} else {
		if(empty($check_hold)){
			
			$first_name = $db_student->get("first_name", "student_id", "$student_id");
			$last_name = $db_student->get("last_name", "student_id", "$student_id");
			$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
			
			$db_student->to("grade","$grade","student_id", "$student_id");
			$db_student->to("school_year","$school_year","student_id", "$student_id");
			$db_student->to("section","$section","student_id", "$student_id");
			
			$user_id = $db_account->get("user_id", "student_id", "$student_id");
			
			$attendance_id = uniqid();
			$a_a = array(			
				"attendance_id" => "$attendance_id",
				"student_id" => "$student_id",
				"school_year" => "$school_year",
				"grade" => "$grade",
				"section" => "$section",
				"absent_jan" => "",
				"absent_feb" => "",
				"absent_mar" => "",
				"absent_apr" => "",
				"absent_may" => "",
				"absent_jun" => "",
				"absent_jul" => "",
				"absent_aug" => "",
				"absent_sep" => "",
				"absent_oct" => "",
				"absent_nov" => "",
				"absent_dec" => "",
				"late_jan" => "",
				"late_feb" => "",
				"late_mar" => "",
				"late_apr" => "",
				"late_may" => "",
				"late_jun" => "",
				"late_jul" => "",
				"late_aug" => "",
				"late_sep" => "",
				"late_oct" => "",
				"late_nov" => "",
				"late_dec" => ""				
			);
			$db_attendance->add($a_a);
			
	$n_a = array(
					"notification_id" => "$notif_id",
					"notification_title" => "Congratulations $first_name!",
					"notification_content" => "You are now enrolled as $grade - $section this School Year $school_year!",
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
			
			echo "$first_name $last_name $suffix_name has been enrolled as $grade - $section this SY $school_year";
			
		} else {
			echo "Student on hold";
		}
	}
		
?>