<?php
/*
Holy Child Montessori
2017

Checks if user has enabled e-cash
Returns String yes or no
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 3;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Check if user_id is empty
if(empty($_REQUEST['user_id'])){

    echo "no";

} else {

    // Handle Data
    $user_id = $_REQUEST['user_id'];

    // Query
    $allow_ecash = $db_ecash->get("allow_ecash","user_id", "$user_id");

    // Print result
    echo $allow_ecash;

}
?>