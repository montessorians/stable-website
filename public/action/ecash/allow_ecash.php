<?php
/*
Holy Child Montessori
2017

Allow E-Cash
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 5;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Handle Post Data
$student_id = $_POST['student_id'];
$allow_ecash = $_POST['allow_ecash'];

// Query User ID
$user_id = $db_account->get("user_id", "student_id", "$student_id");

// Update 
$db_ecash->to("allow_ecash", "$allow_ecash", "user_id", "$user_id");


switch($allow_ecash){

	case("yes"):
		$notification_title = "Your E-Cash has been activated";
		$notification_content = "You may now use your ID or your phone to purchase at the canteen and more as long as you have money in your e-cash account.";
		break;

	case("no"):
		$notification_title = "Your E-Cash has been deactivated";
		$notification_content = "You may not be able to purchase using your ID or phone. You may still purchase in the canteen if you have money.";
		break;

}

// Prepare Notif
$notif_title = "$notification_title";
$notif_content = "$notification_content";
$notif_icon = "account_balance_wallet";
$notif_user_id = "$user_id";
$notif_sender_alternative = "E-Cash";

// Send Notification
include("../_require/notif.php");

	
echo "Allow E-Cash has been changed successfully to $allow_ecash";

?>