<?php
/*
Holy Child Montessori
2017

Notification Count
Counts how many notification current user has.
*/

// Starts Session
session_start();

// Declare Permission Level
$perm = 3;

// Require secure file
require_once("../../_system/secure.php");

// Declarations
include("../_require/db.php");

// Checks for User ID
if(empty($_REQUEST['user_id'])){

    // Check if user is not logged in
    if(empty($_SESSION['logged_in'])){

        // Redirect if user is unauthorized
        header("Location: /error/unauthorized.php");

        // Set user_id to 0
        $user_id = 0;

    } else {

        // Set user id
        $user_id = $_SESSION['user_id'];

    }

} else {

    // Handle Data
    $user_id = $_REQUEST['user_id'];

}

// Get Array
$notification_array = $db_notification->where(array("notification_id"), "user_id", "$user_id");

// Count Notifications
$notification_count = count($notification_array);

// Echo Count
echo $notification_count;
?>