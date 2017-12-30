<?php
/*
Holy Child Montessori
2017

Search Admin
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 5;

/// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Handle Post Request
$query = $_POST['query'];
$searchBy = $_POST['searchBy'];


// Check if Empty Query
if(empty($query)){

	$r = $db_account->select(array("admin_id"));

} else {
	
	switch($searchBy){

		case("username"):

			$r = $db_account->like(array("admin_id"), "username", "/.*$query/");
			break;

		case("user_id"):

			$r = $db_account->like(array("admin_id"), "user_id", "/.*$query/");
			break;

		case("admin_id"):

			$r = $db_admin->like(array("admin_id"), "admin_id", "/.*$query/");
			break;

		case("first_name"):

			$r = $db_admin->like(array("admin_id"), "first_name", "/.*$query/");
			break;

		case("last_name"):

			$r = $db_admin->like(array("admin_id"), "last_name", "/.*$query/");
			break;			

	} // End of Switch					
					
} // End of Else
	
// Check if Empty result	
if(empty($r)){

	// echo msg	
	echo "
		<div class='card'>
			<div class='card-content'>
				<center>No results found for $query</center>
			</div>
		</div>";
	
}

if(!empty($r)){

	foreach($r as $adminResult){
		if($adminResult['admin_id'] !== ""){

			$admin_id = $adminResult['admin_id'];

			$admin_info = $db_admin->where(array(),"admin_id",$admin_id);
	
			foreach($admin_info as $admin){
				$first_name = $admin['first_name'];
				$last_name = $admin['last_name'];
				$suffix_name = $admin['suffix_name'];	
			}
	
			$account_info = $db_account->where(array(),"admin_id",$admin_id);
	
			foreach($account_info as $account){
				$user_id = $account['user_id'];
				$photo_url = $account['photo_url'];
			}
	
			// Echo initial card html 
			echo "
			<div class='card'>
				<div class='card-content'>";				
	
			// Echo img if not empty
			if(!empty($photo_url)) echo "<img class='right' src='../../$photo_url' width='150px'>";
			
			// echo main card
			echo "
					<strong>$first_name $last_name $suffix_name</strong>
					<p><font size='4'>$admin_id</font></p>
				</div>";
							
			// show options if admin
			if($_SESSION['account_type'] == "admin"){
									
				echo "
					<div class='card-action'>
						<a class='black-text' href='../../profile/?admin_id=$admin_id'>View Profile</a>
						<a class='black-text' href='../../forms/account/add_user.php?admin_id=$admin_id'>Edit Profile</a>
						<a class='black-text' href='../../forms/account/reset_password.php?user_id=$user_id'>Reset Password</a>
						<a class='black-text' href='../../forms/account/upload_img.php?user_id=$user_id'>Upload Picture</a>
					</div>
				</div>";
	
			} else {	
				// echo card close
				echo	"</div>";
			}
	
		}

	}
}
?>