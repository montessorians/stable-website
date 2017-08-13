<?php
session_start();
include("../_require/db.php");

$transaction_id = uniqid();
$student_id = $_POST['student_id'];
$transaction_title = $_POST['transaction_title'];
if(empty($transaction_title)){
	$transaction_title = "School Transaction";
}
$transaction_action = $_POST['transaction_action'];
if(empty($transaction_action)){
	$transaction_action = "subtract";
}
$transaction_merchant = $_POST['transaction_merchant'];
if(empty($transaction_merchant)){
	$transaction_merchant = "Administration";
}
$transaction_amount = $_POST['transaction_amount'];
$transaction_month = date("M");
$transaction_day = date("d");
$transaction_year = date("Y");
$transaction_time = date("H:i");

$user_id = $db_account->get("user_id", "student_id", "$student_id");
if(empty($user_id)){
	echo "User does not exist";
} else {
	$allow_ecash = $db_ecash->get("allow_ecash","user_id", "$user_id");
	
	if($allow_ecash == "yes"){
	
		$current_balance = $db_ecash->get("current_balance", "user_id", "$user_id");
	
	switch($transaction_action){
		case("add"):
				$new_balance = $transaction_amount + $current_balance;
				$new_balance = round($new_balance, 2);
				
				$db_ecash->to("current_balance","$new_balance","user_id", "$user_id");
				$db_ecash->to("previous_balance", "$current_balance", "user_id", "$user_id");
				$db_ecash->to("previous_transaction", "$transaction_title", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_merchant", "$transaction_merchant", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_amount", "$transaction_amount", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_month", "$transaction_month", "user_id","$user_id");
				$db_ecash->to("previous_transaction_day", "$transaction_day", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_year", "$transaction_year", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_time", "$transaction_time", "user_id", "$user_id");
				
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
			$db_transaction->add($t_array);
			
			echo "Amount added successfully. New balance PHP $new_balance";	
				
			break;
		case("subtract"):
		
			if($current_balance < $transaction_amount){
				echo "Insufficient Balance.";
			} else {
				
				$new_balance = $current_balance - $transaction_amount;
				$new_balance = round($new_balance, 2);
				
				$db_ecash->to("current_balance","$new_balance","user_id", "$user_id");
				$db_ecash->to("previous_balance", "$current_balance", "user_id", "$user_id");
				$db_ecash->to("previous_transaction", "$transaction_title", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_merchant", "$transaction_merchant", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_amount", "$transaction_amount", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_month", "$transaction_month", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_day", "$transaction_day", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_year", "$transaction_year", "user_id", "$user_id");
				$db_ecash->to("previous_transaction_time", "$transaction_time", "user_id", "$user_id");
				
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
			$db_transaction->add($t_array);
			
			echo "Amount charged successfully. PHP $new_balance remaining.";
			
			}
		
			break;
	}

				$notif_id = uniqid();
				$create_month = date("M");
				$create_day = date("d");
				$create_year = date("Y");
				$create_time = date("h:i a");
	
	$n_a = array(
					"notification_id" => "$notif_id",
					"notification_title" => "A transaction happened on your E-Cash",
					"notification_content" => "$transaction_merchant's \"$transaction_title\" went through  with an amount of PHP $transaction_amount. If it is an unauthorized transaction please report to the administrators immediately.",
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
		
	} else {
		echo "Cannot Proceed. User is not allowed to use E-Cash";	
	}
	
	
	
		
}
?>