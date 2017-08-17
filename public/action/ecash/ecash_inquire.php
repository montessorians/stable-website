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

// Check if empty data sent
if(empty($_REQUEST['user_id'])){

    echo "0";

} else {
    
    // Handle Data
    $user_id = $_REQUEST['user_id'];

    // Query
    $current_balance = $db_ecash->get("current_balance","user_id", "$user_id");

    // Print
    if(!$current_balance) $current_balance = "0.00";

    echo $current_balance;

}
?>