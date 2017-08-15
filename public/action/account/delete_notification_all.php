<?php
/*
Holy Child Montessori
2017

Delete All Notifications
- Deletes all Notification from the Logged In User
*/

// Start Session 
session_start();

// Declare Permission Level
$perm = 3;

// Include Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Get User ID from current session
$user_id = $_SESSION['user_id'];

// Query for notifications of current user
$notif_array = $db_notification->where(array(), "user_id", "$user_id");

// Loop each notification_id
foreach($notif_array as $notif){

	// Create var
	$notification_id = $notif['notification_id'];

	// Get index of current notification_id
	$index = $db_notification->index("notification_id", "$notification_id");

	// Remove notification from DB using index
	$db_notification->rm($index);

}

// Echo ok after script execution
echo "ok";
?>