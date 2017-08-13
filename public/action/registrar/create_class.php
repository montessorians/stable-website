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
		
	$class_id = mt_rand(10000,99999);
	$subject_id = $_POST['subject_id'];
	$school_year = $_POST['school_year'];
	$section = $_POST['section'];
	$class_code = $_POST['class_code'];
	$class_room = $_POST['class_room'];
	$access_code = $_POST['access_code'];
	$teacher_id = $_POST['teacher_id'];
	$start_time = $_POST['start_time'];
	$end_time = $_POST['end_time'];
	$schedule = $_POST['schedule'];
	$max_students = $_POST['max_students'];

	if($db_subject->exists("subject_id","$subject_id")){

		if(!$grade){
			echo "Grade is Required";
		} else {
			if(!$school_year){
				echo "School Year is Required";
			} else {
				$array = array(
				"class_id" => "$class_id",
				"class_title" => "$class_title",
				"school_year" => "$school_year",
				"section" => "$section",
				"class_code" => "$class_code",
				"class_room" => "$class_room",
				"access_code" => "$access_code",
				"teacher_id" => "$teacher_id",
				"start_time" => "$start_time",
				"end_time" => "$end_time",
				"schedule" => "$schedule",
				"max_students" => "$max_students"
				);
			}
		}

	} else {
		echo "Subject Doesn't Exist";
	}

	if(empty($class_title)){
		echo "Class Title cannot be empty"; 
	} else {
		if(empty($grade)){
			echo "Grade is required";
		} else {
			if(empty($school_year)){
				echo "School Year is required";
			} else {
				
				
				
				$db_class->add($array);
				echo "<span class='green-text text-darken-2'>$class_title added successfully. Class ID is $class_id</span>";
				
			}
		}
	}
	
?>