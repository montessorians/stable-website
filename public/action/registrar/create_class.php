<?php
/*
Holy Child Montessori
2017

Create Class
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
$class_id = mt_rand(10000,99999);

// Handle Post Data
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

// Query if Subject ID Exists
if($db_subject->exists("subject_id","$subject_id")){

	// Check if school year is entered
	if(!$school_year){
	
		echo "School Year is Required";

	} else {

		// Construct Array
		$array = array(
		"class_id" => "$class_id",
		"subject_id" => "$subject_id",
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

} else {

	echo "Subject Doesn't Exist";

}


// Check if school year is sent
if(empty($school_year)){

	echo "School Year is required";

} else {
	
	// Add to DB
	$db_class->add($array);

	echo "<span class='green-text text-darken-2'>Class added successfully. Class ID is $class_id</span>";
	
}
	
?>