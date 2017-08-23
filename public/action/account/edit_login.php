<?php
/*
Holy Child Montessori
2017

Edit Login
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 3;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Get User ID from Session
$user_id = $_SESSION['user_id'];

// Handle Post Data
$username = $_POST['username'];
$password = $_POST['password'];

// Check if empty username
if(empty($username)){

	// echo msg
	echo "Username cannot be empty";

} else {

	// Check if empty password
	if(empty($password)){

		// echo msg
		echo "Password cannot be empty";

	} else {

		// Sanitize username input
		$username = strip_tags($username);
		$username = str_replace(" ","", $username);

		// Check for pw length
		if(strlen($password) < 8){

			// echo msg
			echo "Password too short";

		} else {
	
			// Hash and Salt Password
			$password = password_hash("$password", PASSWORD_DEFAULT);
			
			// Query for username
			$username_check = $db_account->get("username", "username", "$username");
			
			// Check if empty username queried to prevent duplicate
			if(!$username_check){
			
				// Rewrite username and pw
				$db_account->to("username", "$username", "user_id", "$user_id");
				$db_account->to("password", "$password", "user_id", "$user_id");

				// Set session to new username
				$_SESSION['username'] = $username;
				
				// Set Notif Data
				$notif_title = "Account Settings were changed";
				$notif_content = "Your account username and/or password was changed. If it wasn't you, change your password or contact us to change it for you.";
				$notif_url = "/settings/account";
				$notif_icon = "security";
				$notif_user_id = "$user_id";
				$notif_sender_alternative = "Montessori Accounts";

				// Send Notif
				include("../_require/notif.php");
				
				// Echo msg
				echo "<span class='green-text'>Account Settings Updated Successfully!</span>";
				
			} else {

				/*
				Do when username unchanged
				*/

				// Check if Username is the same from queried username
				if($username_check === $username){
					
					// Rewrite Password
					$db_account->to("password", "$password", "user_id", "$user_id");
					
					// Set Notif Data
					$notif_title = "Password was changed";
					$notif_content = "Your password was changed. If it wasn't you, change your password or contact us to change it for you.";
					$notif_url = "/settings/account";
					$notif_icon = "security";
					$notif_user_id = "$user_id";
					$notif_sender_alternative = "Montessori Accounts";

					// Send Notif
					include("../_require/notif.php");

					// echo msg
					echo "<span class='green-text'>Password Updated Successfully!</span>";
					
				} else {
				
					// echo msg
					echo "Username already taken";
						
				}
				
				
			}
						
		}
		
	}
}

?>