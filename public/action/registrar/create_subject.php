<?php
/*
Holy Child Montessori
2017

Create Subject
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
$subject_id = mt_rand(10000,99999);

// Handle Post Data
$subject_title = $_POST['subject_title'];
$subject_description = $_POST['subject_description'];
$grade = $_POST['grade'];
$subject_code = $_POST['subject_code'];
$units = $_POST['units'];

// Init var
$proceed = 0;

// Empty Checking
if(!$subject_title){

    echo "Empty Subject Title";

} else {

    // Check if empty grade
    if(!$grade){

        echo "Empty Grade";

    } else {

        $proceed = 1;

    }

}

// Finally
if($proceed==1){

    // Construct Array
    $array = array(
        "subject_id"=>"$subject_id",
        "subject_title"=>"$subject_title",
        "subject_description"=>"$subject_description",
        "grade"=>"$grade",
        "subject_code"=>"$subject_code",
        "units"=>"$units"
    ); 

    // Add to DB
    $db_subject->add($array);

    echo "$subject_title added Successfully with Subject ID: $subject_id";

}

?>