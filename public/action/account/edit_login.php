<?php
session_start();

// Declare Permission Level
$perm = 3;
require_once("../../_system/secure.php");

include("../_require/db.php");

$user_id = $_SESSION['user_id'];
$username = $_POST['username'];
$password = $_POST['password'];

$notif_id = uniqid();
$create_month = date("M");
$create_day = date("d");
$create_year = date("Y");
$create_time = date("h:i a");


if(empty($username)){
	echo "Username cannot be empty";
} else {
	if(empty($password)){
		echo "Password cannot be empty";
	} else {

		$username = strip_tags($username);

		if(strlen($password) < 8){
			echo "Password too short";
		} else {
	
			$password = password_hash("$password", PASSWORD_DEFAULT);
			
			$username_check = $db_account->get("username", "username", "$username");
			
			if(empty($username_check)){
			
				$db_account->to("username", "$username", "user_id", "$user_id");
				$db_account->to("password", "$password", "user_id", "$user_id");
				$_SESSION['username'] = $username;
				
				$n_a = array(
					"notification_id" => "$notif_id",
					"notification_title" => "Account Settings were changed",
					"notification_content" => "Your account username and/or password was changed. If it wasn't you, change your password or contact us to change it for you.",
					"photo_url" => "",
					"notification_url" => "settings/account",
					"notification_icon" => "security",
					"user_id" => "$user_id",
					"sender_alternative" => "Montessori Accounts",
					"sender_id" => "",
					"create_month" => "$create_month",
					"create_day" => "$create_day",
					"create_year" => "$create_year",
					"create_time" => "$create_time"
				);
				$db_notification->add($n_a);
				
				echo "<span class='green-text'>Account Settings Updated Successfully!</span>";
				
			} else {
			
				if($username_check === $username){
					
					$db_account->to("password", "$password", "user_id", "$user_id");
					
					$n_a = array(
					"notification_id" => "$notif_id",
					"notification_title" => "Password was changed",
					"notification_content" => "Your password was changed. If it wasn't you, change your password or contact us to change it for you.",
					"photo_url" => "",
					"notification_url" => "settings/account",
					"notification_icon" => "security",
					"user_id" => "$user_id",
					"sender_alternative" => "Montessori Accounts",
					"sender_id" => "",
					"create_month" => "$create_month",
					"create_day" => "$create_day",
					"create_year" => "$create_year",
					"create_time" => "$create_time"
				);
				$db_notification->add($n_a);
					
				echo "<span class='green-text'>Password Updated Successfully!</span>";
					
				} else {
				
					echo "Username already taken";
						
				}
				
				
			}
			
			
		}
		
	}
}

?>