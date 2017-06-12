<?php
session_start();
	include("../../_system/secure.php");
	include("../../_system/database/db.php");
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
	
	
	$db_class = new DBase("class","../../_store");
	
	$class_id = $_POST['class_id'];
	$class_title = $_POST['class_title'];
	$class_description = $_POST['class_description'];
	$school_year = $_POST['school_year'];
	$grade = $_POST['grade'];
	$section = $_POST['section'];
	$class_code = $_POST['class_code'];
	$class_room = $_POST['class_room'];
	$access_code = $_POST['access_code'];
	$teacher_id = $_POST['teacher_id'];
	$start_time = $_POST['start_time'];
	$end_time = $_POST['end_time'];
	$schedule = $_POST['schedule'];
	$units = $_POST['units'];
	
	if(empty($class_title)){
		echo "Class Title cannot be empty"; 
	} else {
		if(empty($grade)){
			echo "Grade is required";
		} else {
			if(empty($school_year)){
				echo "School Year is required";
			} else {
				
				$array = array(
				"class_id" => "$class_id",
				"class_title" => "$class_title",
				"class_description" => "$class_description",
				"school_year" => "$school_year",
				"grade" => "$grade",
				"section" => "$section",
				"class_code" => "$class_code",
				"class_room" => "$class_room",
				"access_code" => "$access_code",
				"teacher_id" => "$teacher_id",
				"start_time" => "$start_time",
				"end_time" => "$end_time",
				"schedule" => "$schedule",
				"units" => "$units"
				);
				
				$index = $db_class->index("class_id", "$class_id");
				$db_class->update($index, $array);
				
				echo "<span class='green-text text-darken-2'>$class_title has been edited successfully. Class ID is $class_id</span>";
				
			}
		}
	}
	
?>