<?php
/*
Holy Child Montessori
2017

Search Parent
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 5;

// Require Secure File
require_once("../../_system/secure.php");

// Require DB
include("../_require/db.php");

// Handle Post Data
$query = $_POST['query'];
$searchBy = $_POST['searchBy'];

// Check if empty query
if(empty($query)){

	$r = $db_account->select(array("parent_id"));

} else {
	
	switch($searchBy){
		
		case("username"):
		
			$r = $db_account->like(array("parent_id"), "username", "/.*$query/");
			break;
		
		case("user_id"):
		
			$r = $db_account->like(array("parent_id"), "user_id", "/.*$query/");
			break;
		
		case("parent_id"):
		
			$r = $db_parent->like(array("parent_id"), "parent_id", "/.*$query/");
			break;
		
		case("first_name"):
		
			$r = $db_parent->like(array("parent_id"), "first_name", "/.*$query/");
			break;
		
		case("last_name"):
		
			$r = $db_parent->like(array("parent_id"), "last_name", "/.*$query/");
			break;			
		
	} // end of switch
										
}
	
// Check if empty result
if(empty($r)){

	echo "
	<div class='card'>
		<div class='card-content'>
			<center>No results found for $query</center>
		</div>
	</div>";

} 

if(!empty($r)){

	foreach($r as $parentResult){

		$parent_id = $parentResult['parent_id'];

		$parent_info = $db_parent->where(array(),"parent_id",$parent_id);

		foreach($parent_info as $parent){
			$first_name = $parent['first_name'];
			$last_name = $parent['last_name'];
			$suffix_name = $parent['suffix_name'];
		}

		$account_info = $db_account->where(array(),"parent_id",$parent_id);

		foreach($account_info as $account){
			$user_id = $account['user_id'];
			$photo_url = $account['photo_url'];
			$username = $account['username'];
		}

		echo "
		<div class='card'>
			<div class='card-content'>";

		// Check if img available
		if(!empty($photo_url)) echo "<img class='right' src='../../$photo_url' width='150px'>";
							
		echo "
		<p class='seagreen-text'><b>$first_name $last_name $suffix_name</b></p>
		<p class='grey-text'>@$username</p><br>
		<p><font size='4'>$parent_id</font></p>
		</div>";

		// Check if admin							
		if($_SESSION['account_type'] == "admin"){
								
			echo "
			<div class='card-action'>
				<a class='black-text' href='../../profile/?parent_id=$parent_id'>View Profile</a>
				<a class='black-text' href='../../forms/account/add_user.php?parent_id=$parent_id'>Edit Profile</a>
				<a class='black-text' href='../../forms/account/connect_parent.php?parent_id=$parent_id'>Connect to Student</a>
				<a class='black-text' href='../../query/account/connect_parent.php?parent_id=$parent_id'>View Connected Children</a>										
				<a class='black-text' href='../../forms/account/reset_password.php?user_id=$user_id'>Reset Password</a>
				<a class='black-text' href='../../forms/account/upload_img.php?user_id=$user_id'>Upload Picture</a>
			</div></div>";
								
		}
						
		echo "</div>";

	}

}

?>