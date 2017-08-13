<?php
session_start();
if(empty($_SESSION['logged_in'])){
	header("Location: ../../");
}

include("../_require/db.php");

$user_id = $_POST['user_id'];
$password = $_POST['password'];

$notif_id = uniqid();
$create_month = date("M");
$create_day = date("d");
$create_year = date("Y");
$create_time = date("h:i a");


if(empty($user_id)){
	echo "User ID cannot be empty";
} else {
	if(empty($password)){
		echo "Password cannot be empty";
	} else {

		
		if(strlen($password) < 8){
			echo "Password too short";
		} else {
	
			$password = password_hash("$password", PASSWORD_DEFAULT);
			
			$userid_check = $db_account->get("user_id", "user_id", "$user_id");
			
			if(empty($userid_check)){
			
			echo "User ID doesn't exist";	
				
			} else {
			
				if($userid_check === $user_id){
					
					$db_account->to("password", "$password", "user_id", "$user_id");
					
					$n_a = array(
					"notification_id" => "$notif_id",
					"notification_title" => "Password was reset",
					"notification_content" => "Your password was reset. Please immediately change your password.",
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