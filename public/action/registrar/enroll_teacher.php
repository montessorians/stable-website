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

	$user_id = $db_account->get("user_id","teacher_id",$teacher_id);

	// Check if class exists
	if(empty($check_id)){

		echo "Class does not exist";

	} else {

		// Get Teacher Info
		$first_name = $db_teacher->get("first_name", "teacher_id", "$teacher_id");
		$last_name = $db_teacher->get("last_name", "teacher_id", "$teacher_id");
		$suffix_name = $db_teacher->get("suffix_name", "teacher_id", "$teacher_id");
		$subject_id = $db_class->get("subject_id","class_id",$class_id);
		$subject_title = $db_subject->get("subject_title", "subject_id",$subject_id);
		$grade = $db_subject->get("grade","subject_id","$subject_id");
		$section = $db_class->get("section","class_id","$class_id");

		// Rewrite DB
		$db_class->to("teacher_id", "$teacher_id", "class_id", "$class_id");

		$notif_title = "Congratulations! You have been assigned as a teacher in $subject_title ($grade-$section)";
		$notif_content = "You may now check it in your classes list in the assessment tab.";
		$notif_icon = "assessment";
		$notif_sender_alternative = "Registrar";
		include("../_require/notif.php");

		echo "$first_name $last_name $suffix_name has been assigned to $class_title";

	}

}	
	
?>