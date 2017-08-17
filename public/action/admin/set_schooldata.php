<?php
/*
Holy Child Montessori
2017

Set School Data
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
$school_year = $_POST['school_year'];
$quarter = $_POST['quarter'];
$exam_week = $_POST['exam_week'];
$grade_encode = $_POST['grade_encode'];
$enrollment = $_POST['enrollment'];
$print_grades = $_POST['print_grades'];

// Construct Array
$array = array(
	"school_id" => "1",
	"school_year" => "$school_year",
	"quarter" => "$quarter",
	"exam_week" => "$exam_week",
	"grade_encode" => "$grade_encode",
	"enrollment" => "$enrollment",
	"print_grades" => "$print_grades"
);

// Query for School ID
$school_id = $db_schooldata->get("school_id", "school_id", "1");

// Check if empty school id
if(empty($school_id)){

	// Add to School Data
	$db_schooldata->add($array);

	echo "School data added successfully";

} else {

	// Get Index
	$index = $db_schooldata->index("school_id", "1");

	// Update
	$db_schooldata->update($index, $array);

	echo "School data updated successfully";
	
}
?>