<?php
/*
Holy Child Montessori
2017

Notification Count
Counts how many notification current user has.
*/

// Starts Session
session_start();

// Declarations
include("../../_system/database/db.php");
$db_notification = new DBase("notification", "../../_store");

// Checks for User ID
if(empty($_REQUEST['user_id'])){
    if(empty($_SESSION['logged_in'])){
        header("Location: ../../");
        $user_id = 0;
    } else {
        $user_id = $_SESSION['user_id'];
    }
} else {
    $user_id = $_REQUEST['user_id'];
}

// Get Array
$notification_array = $db_notification->where(array("notification_id"), "user_id", "$user_id");

// Count Notifications
$notification_count = count($notification_array);

// Echo Count
echo $notification_count;
?>