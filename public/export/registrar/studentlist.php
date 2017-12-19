<?php
/*
Holy Child Montessori
Student List for Current School Year
2017
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 5;

// Require Secure File
require_once("../../_system/secure.php");

// Include Required Files
require_once('../../action/_require/db.php');
require_once("../_lib/xlsxwriter.class.php");

// Get Current SY
$current_sy = $db_schooldata->get("school_year","school_id","1");

// Set file name
$date = date("M-d-Y");
$file_name = "StudentList-SY$current_sy($date).xlsx";

// Get Students Array
$student_array = $db_student->where(array(),"school_year","$current_sy");

// Create Writer Object
$writer = new XLSXWriter();

// Prepare Header
$writer->writeSheetHeader("$current_sy", array(
    "student_id" => "string",
    "student_lrn" => "string",
    "first_name" => "string",
    "middle_name" => "string",
    "last_name" => "string",
    "suffix_name" => "string",
    "gender" => "string",
    "birth_month" => "string",
    "birth_day" => "string",
    "birth_year" => "string",
    "birth_place" => "string",
    "address" => "string",
    "city" => "string",
    "country" => "string",
    "mobile_number" => "string",
    "telephone_number" => "string",
    "email" => "string",
    "grade" => "string",
    "school_year" => "string",
    "section" => "string"
));


// Loop Along Data
foreach($student_array as $student){
    $writer->writeSheetRow("$current_sy",$student);
}


// Set Header
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=$file_name");
header('Access-Control-Allow-Methods: GET');
header('Access-Control-Allow-Origin: *');


// Output File
echo $writer->writeToString();

?>