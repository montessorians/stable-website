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
	
	
	$teacher_id = $_POST['teacher_id'];
	$class_id = $_POST['class_id'];
	
	$check_teacher = $db_teacher->get("teacher_id", "teacher_id", "$teacher_id");
	$check_id = $db_class->get("class_id", "class_id", "$class_id");
	
	if(empty($check_teacher)){
		echo  "Teacher does not exist";
	} else {
			if(empty($check_id)){
				echo "Class does not exist";
			} else {
				$first_name = $db_teacher->get("first_name", "teacher_id", "$teacher_id");
				$last_name = $db_teacher->get("last_name", "teacher_id", "$teacher_id");
				$suffix_name = $db_teacher->get("suffix_name", "teacher_id", "$teacher_id");
				$class_title = $db_class->get("class_title", "class_id", "$class_id");
				$db_class->to("teacher_id", "$teacher_id", "class_id", "$class_id");
				echo "$first_name $last_name $suffix_name has been assigned to $class_title";
			}
		}	
		
?>