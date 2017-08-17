<?php
/*
Holy Child Montessori
2017

Edit Subject
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
$subject_id = $_POST['subject_id'];
$subject_title = $_POST['subject_title'];
$subject_description = $_POST['subject_description'];
$grade = $_POST['grade'];
$subject_code = $_POST['subject_code'];
$units = $_POST['units'];

// Set initial value
$proceed = 0;

// Check subject id
if(!$subject_id){

    echo "Empty Subject ID";

} else {

    // Check if subject title sent
    if(!$subject_title){

        echo "Empty Subject Title";

    } else {

        // Check if grade sent
        if(!$grade){

            echo "Empty Grade";

        } else {

            $proceed = 1;

        }

    }

}

// Finally
if($proceed===1){

    // Construct Array
    $array = array(
        "subject_id"=>"$subject_id",
        "subject_title"=>"$subject_title",
        "subject_description"=>"$subject_description",
        "grade"=>"$grade",
        "subject_code"=>"$subject_code",
        "units"=>"$units"
    ); 

    // Get Index
    $index = $db_subject->index("subject_id","$subject_id");

    // Update
    $db_subject->update($index,$array);

    echo "$subject_title ($subject_id) has been edited successfully!";

}

?>