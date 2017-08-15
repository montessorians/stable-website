<?php
/*
Holy Child Montessori
2017

Delete Notification
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 3;

// Include Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Handle sent Notification ID
$notification_id = $_REQUEST['notification_id'];

// Query Index using Notification ID
$index = $db_notification->index("notification_id", "$notification_id");

// Remove from DB
$db_notification->rm($index);

// Echo OK after execution of script
echo "ok";

?>