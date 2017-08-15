<?php
/*
Holy Child Montessori
2017

Delete ParentChild Connection
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 5;

// Include Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Handle sent data
$parentchild_id = $_REQUEST['parentchild_id'];

// Get Index from DB using ID
$index = $db_parentchild->index("parentchild_id", "$parentchild_id");

// Remove from DB
$db_parentchild->rm($index);

// Get referer url
$ref = $_SERVER['HTTP_REFERER'];

// Redirect to referer
header("Location: $ref");

?>