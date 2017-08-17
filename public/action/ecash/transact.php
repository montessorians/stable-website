<?php
/*
Holy Child Montessori
2017

Transact
*/
// Start Session
session_start();

// Declare Permission Level
$perm = 5;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB 
include("../_require/db.php");

// Generate ID
$transaction_id = uniqid();

// Handle Post Data
$student_id = $_POST['student_id'];
$transaction_title = $_POST['transaction_title'];
$transaction_action = $_POST['transaction_action'];
$transaction_merchant = $_POST['transaction_merchant'];
$transaction_amount = $_POST['transaction_amount'];

// Check for empty vars
if(empty($transaction_title)) $transaction_title = "School Transaction";
if(empty($transaction_action)) $transaction_action = "subtract";
if(empty($transaction_merchant)) $transaction_merchant = "Administration";

// Get Date and Time
$transaction_month = date("M");
$transaction_day = date("d");
$transaction_year = date("Y");
$transaction_time = date("H:i");

// Query for User ID
$user_id = $db_account->get("user_id", "student_id", "$student_id");

// Check for empty User ID
if(empty($user_id)){

	echo "User does not exist";

} 

if(!empty($user_id)){

	// Query for e-cash permission
	$allow_ecash = $db_ecash->get("allow_ecash","user_id", "$user_id");

	// Check if not yes
	if($allow_ecash !== "yes"){
		echo "Cannot Proceed. User is not allowed to use E-Cash";
	}

	// if allowed
	if($allow_ecash == "yes"){

		// Query for current balance
		$current_balance = $db_ecash->get("current_balance", "user_id", "$user_id");

		switch($transaction_action){

			case("add"):
				// Add Balance and Round off to 2 decimal places
				$new_balance = $transaction_amount + $current_balance;
				$new_balance = round($new_balance, 2);

				// Rewrite DB with new data
				$db_ecash->to("current_balance","$new_balance","user_id", "$user_id");
				$db_ecash->to("previous_balance", "$current_balance", "user_id", "$user_id");
				$db_ecash->to("previous_transaction", "$transaction_title", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_merchant", "$transaction_merchant", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_amount", "$transaction_amount", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_month", "$transaction_month", "user_id","$user_id");
				$db_ecash->to("previous_transaction_day", "$transaction_day", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_year", "$transaction_year", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_time", "$transaction_time", "user_id", "$user_id");

				// Prepare array			
				$t_array = array(
					"transaction_id" => "$transaction_id",
					"user_id" => "$user_id",
					"transaction_action" => "$transaction_action",
					"transaction_title" => "$transaction_title",
					"transaction_merchant" => "$transaction_merchant",
					"transaction_amount" => "$transaction_amount",
					"transaction_month" => "$transaction_month",
					"transaction_day" => "$transaction_day",
					"transaction_year" => "$transaction_year",
					"transaction_time" => "$transaction_time"
				);

				// Add to DB
				$db_transaction->add($t_array);

				// Echo msg	
				echo "Amount added successfully. New balance PHP $new_balance";	

				break;

			case("subtract"):
				
				// Check if amount greater than bal
				if($current_balance < $transaction_amount){

					echo "Insufficient Balance."; 

				}
				if(!($current_balance<$transaction_amount)){

					// Subrtract amount
					$new_balance = $current_balance - $transaction_amount;

					// Round off 2 decimal places
					$new_balance = round($new_balance, 2);

					// Rewrite DB
					$db_ecash->to("current_balance","$new_balance","user_id", "$user_id");
					$db_ecash->to("previous_balance", "$current_balance", "user_id", "$user_id");
					$db_ecash->to("previous_transaction", "$transaction_title", "user_id", "$user_id");
					$db_ecash->to("previous_transaction_merchant", "$transaction_merchant", "user_id", "$user_id");
					$db_ecash->to("previous_transaction_amount", "$transaction_amount", "user_id", "$user_id");
					$db_ecash->to("previous_transaction_month", "$transaction_month", "user_id", "$user_id");
					$db_ecash->to("previous_transaction_day", "$transaction_day", "user_id", "$user_id");
					$db_ecash->to("previous_transaction_year", "$transaction_year", "user_id", "$user_id");
					$db_ecash->to("previous_transaction_time", "$transaction_time", "user_id", "$user_id");	

					// Prepare Array
					$t_array = array(
						"transaction_id" => "$transaction_id",
						"user_id" => "$user_id",
						"transaction_action" => "$transaction_action",
						"transaction_title" => "$transaction_title",
						"transaction_merchant" => "$transaction_merchant",
						"transaction_amount" => "$transaction_amount",
						"transaction_month" => "$transaction_month",
						"transaction_day" => "$transaction_day",
						"transaction_year" => "$transaction_year",
						"transaction_time" => "$transaction_time"
					);

					// Add to DB
					$db_transaction->add($t_array);

					// Echo msg		
					echo "Amount charged successfully. PHP $new_balance remaining.";

				}
				break;

		} // End of switch

		// Notif
		$notif_title = "A transaction happened on your E-Cash";
		$notif_content = "$transaction_merchant's \"$transaction_title\" went through  with an amount of PHP $transaction_amount. If it is an unauthorized transaction please report to the administrators immediately.";
		$notif_icon = "account_balance_wallet";
		$notif_user_id = "$user_id";
		$notif_sender_alternative = "E-Cash";

		// Send Notification
		include("../_require/notif.php");

	} // End of if allow ecash

} // End of not empty user_id	

?>