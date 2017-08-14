<?php
session_start();

// Declare Permission Level
$perm = 5;
require_once("../../_system/secure.php");

include("../_require/db.php");

$student_id = $_POST['student_id'];
$allow_ecash = $_POST['allow_ecash'];

$user_id = $db_account->get("user_id", "student_id", "$student_id");

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

$notif_id = uniqid();
$create_month = date("M");
$create_day = date("d");
$create_year = date("Y");
$create_time = date("h:i a");
	
$n_a = array(
	"notification_id" => "$notif_id",
	"notification_title" => "$notification_title",
	"notification_content" => "$notification_content",
	"photo_url" => "",
	"notification_url" => "",
	"notification_icon" => "account_balance_wallet",
	"user_id" => "$user_id",
	"sender_alternative" => "E-Cash",
	"sender_id" => "",
	"create_month" => "$create_month",
	"create_day" => "$create_day",
	"create_year" => "$create_year",
	"create_time" => "$create_time"
	);
$db_notification->add($n_a);

echo "Allow E-Cash has been changed successfully to $allow_ecash";

?>