<?php
/*
Holy Child Montessori
2017

Delete Enroll
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 5;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Get From
$from = $_SERVER['HTTP_REFERER'];

// Check for enroll_id
if(empty($_REQUEST['enroll_id'])){

    header("Location: $from");

} else {

    $enroll_id = $_REQUEST['enroll_id'];

}

// Query if exists
$check = $db_studentclass->get("enroll_id", "enroll_id", "$enroll_id");

// Check if exists
if(empty($check)){

    header("Location: $from");

} else {

    // Get Index
    $index = $db_studentclass->index("enroll_id", "$enroll_id");

    // Remove from DB
    $db_studentclass->rm($index);

    // Redirect Back
    header("Location: $from");

}

?>