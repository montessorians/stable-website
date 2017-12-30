<?php
/*
Holy Child Montessori
2017

Sign-In
Check Username
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 1;

// Include Secure File
require_once("../../_system/secure.php");

// Database
include("../_require/db.php");

// Handle Data
$username = $_REQUEST['username'];

// Get Account Type
$account_type = $db_account->get("account_type", "username", "$username");

// Create ID Construct to ease query
$id_const = $account_type."_id";

// Query for ID
$id = $db_account->get("$id_const", "username","$username");

// Create DB connection using account type
$db = new DBase("$account_type","$loc");

// Query needed data
$first_name = $db->get("first_name", "$id_const", "$id");
$username = $db_account->get("username", "username", "$username");
$photo_url = $db_account->get("photo_url", "username", "$username");

// Construct Array of Data to be sent
$array = array(
    "first_name"=>"$first_name",
    "username"=>"$username",
    "photo_url"=>"$photo_url"
);

// Echo JSON Encoded array
echo json_encode($array);

?>