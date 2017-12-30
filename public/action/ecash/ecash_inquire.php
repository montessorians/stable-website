<?php
/*
Holy Child Montessori
2017

Returns the Current Balance of a user
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 3;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

$user_id = "";
$student_id = "";
if(!empty($_REQUEST['user_id'])) $user_id = $_REQUEST['user_id'];
if(!empty($_REQUEST['student_id'])){
    $student_id = $_REQUEST['student_id'];
    $user_id = $db_account->get("user_id","student_id",$student_id);
    if(empty($user_id)) die("Student Not Found");
}

// Check if empty data sent
if(empty($user_id)){

    echo "0";

} else {
    
    // Query
    $current_balance = $db_ecash->get("current_balance","user_id", "$user_id");

    // Print
    if(!$current_balance) $current_balance = "0.00";

    echo $current_balance;

}
?>