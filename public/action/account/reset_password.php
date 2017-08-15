<?php
/*
Holy Child Montessori
2017

Reset Password
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 3;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB File
include("../_require/db.php");

// Handle Post Data
$user_id = $_POST['user_id'];
$password = $_POST['password'];

// Check for Empty User ID
if(empty($user_id)){

	// echo msg
	echo "User ID cannot be empty";

} else {

	// Check for empty password
	if(empty($password)){

		// echo msg
		echo "Password cannot be empty";

	} else {
		
		// Check for password length
		if(strlen($password) < 8){

			// echo msg
			echo "Password too short";

		} else {
	
			// Hash and Salt Password
			$password = password_hash("$password", PASSWORD_DEFAULT);

			// Query User ID			
			$userid_check = $db_account->get("user_id", "user_id", "$user_id");

			// Check if User ID in DB			
			if(empty($userid_check)){
			
				// echo msg
				echo "User ID doesn't exist";	
				
			} else {
			
				// Check if user ID matches
				if($userid_check === $user_id){
					
					// Rewrite Password
					$db_account->to("password", "$password", "user_id", "$user_id");

					$notif_title = "Password was reset";
					$notif_content = "Your password was reset. Please immediately change your password.";
					$notif_url = "/settings/account";
					$notif_icon = "security";
					$notif_user_id = "$user_id";
					$notif_sender_alternative = "Montessori Accounts";

					// Send Notification
					include("../_require/notif.php");

					// Echo msg
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