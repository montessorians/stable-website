<?php
/*
Holy Child Montessori
2017

Toggle Allow Montessori Pay
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 3;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Check if empty data sent
if(empty($_REQUEST['user_id'])){

    echo "Unknown User";

} else {

	// Handle data
    $user_id = $_REQUEST['user_id'];

	// Query
    $allow_ecash = $db_ecash->get("allow_ecash","user_id", "$user_id");
    
	switch($allow_ecash){
 
        case("yes"):

			// Declare state to no
            $change_to = "no";

			// Rewrite
            $db_ecash->to("allow_ecash", "$change_to", "user_id", "$user_id");

            break;
 
        case("no"):

			// Declare state to yes
            $change_to = "yes";

			// Rewrite
            $db_ecash->to("allow_ecash", "$change_to", "user_id", "$user_id");

            break;
    }

    echo "Successfully Changed to " . $change_to;

	switch($change_to){

		case("yes"):
			$notification_title = "Your Montessori Pay has been activated";
			$notification_content = "You may now use your ID or your phone to purchase at the canteen and more as long as you have money in your Montessori Pay account.";
			break;

		case("no"):
			$notification_title = "Your Montessori Pay has been deactivated";
			$notification_content = "You may not be able to purchase using your ID or phone. You may still purchase in the canteen if you have money.";
			break;

	}

	// Prepare Notif
	$notif_title = "$notification_title";
	$notif_content = "$notification_content";
	$notif_icon = "account_balance_wallet";
	$notif_user_id = "$user_id";
	$notif_sender_alternative = "Montessori Pay";

	// Send Notification
	include("../_require/notif.php");

}
?>