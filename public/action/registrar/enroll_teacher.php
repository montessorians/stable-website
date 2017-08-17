<?php
/*
Holy Child Montessori
2017

Enroll Teacher
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
$teacher_id = $_POST['teacher_id'];
$class_id = $_POST['class_id'];

// Query
$check_teacher = $db_teacher->get("teacher_id", "teacher_id", "$teacher_id");
$check_id = $db_class->get("class_id", "class_id", "$class_id");

// Check if Teacher Exists
if(empty($check_teacher)){

	echo  "Teacher does not exist";

} else {

	// Check if class exists
	if(empty($check_id)){

		echo "Class does not exist";

	} else {

		// Get Teacher Info
		$first_name = $db_teacher->get("first_name", "teacher_id", "$teacher_id");
		$last_name = $db_teacher->get("last_name", "teacher_id", "$teacher_id");
		$suffix_name = $db_teacher->get("suffix_name", "teacher_id", "$teacher_id");
		$class_title = $db_class->get("class_title", "class_id", "$class_id");

		// Rewrite DB
		$db_class->to("teacher_id", "$teacher_id", "class_id", "$class_id");

		echo "$first_name $last_name $suffix_name has been assigned to $class_title";

	}

}	
	
?>