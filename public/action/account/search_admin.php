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
	
} else {

	// loop along results
	foreach($r as $key){
		foreach($key as $admin_id){

			// Get Info
			$user_id = $db_account->get("user_id", "admin_id", "$admin_id");
			$photo_url = $db_account->get("photo_url", "user_id", "$user_id");
			$first_name = $db_admin->get("first_name", "admin_id", "$admin_id");
			$last_name = $db_admin->get("last_name", "admin_id", "$admin_id");
			$suffix_name = $db_admin->get("suffix_name", "admin_id", "$admin_id");						

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
							
						
						
		} // end of inner fe
				
	} // end of outer fe
	
} // end of non empty result

?>