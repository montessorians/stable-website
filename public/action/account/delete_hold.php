<?php
/*
Holy Child Montessori
2017

Delete Hold
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 5;

// Include Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Handle Hold ID data sent
$hold_id = $_REQUEST['hold_id'];

// Get Index
$index = $db_hold->index("hold_id", "$hold_id");

// Remove from DB using index
$db_hold->rm($index);

?>