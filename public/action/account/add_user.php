<?php
/*
Holy Child Montessori
2017

Add User
*/

// Start Session
session_start();
	
// Declare Permission Level
$perm = 5;

// Require Secure File
require_once("../../_system/secure.php");

// Include Database
include("../_require/db.php");

// Handle all data sent (POST)
$account_type = $_POST['account_type'];

$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$suffix_name = $_POST['suffix_name'];

$gender = $_POST['gender'];

$birth_month = $_POST['birth_month'];
$birth_day = $_POST['birth_day'];
$birth_year = $_POST['birth_year'];
$birth_place = $_POST['birth_place'];

$address = $_POST['address'];
$city = $_POST['city'];
$country = $_POST['country'];

$mobile_number = $_POST['mobile_number'];
$telephone_number = $_POST['telephone_number'];
$email = $_POST['email'];

$username = $_POST['username'];
$password = $_POST['password'];

// Password Check
if(strlen($password) < 8){

	echo "Password too short";

} else {
	
	// Hash Password
	$password = password_hash("$password", PASSWORD_DEFAULT);
	
	// Check for username
	$username_check = $db_account->get("username", "username", "$username");

	if(empty($username_check)){

		if(empty($account_type)){

			echo "Account type required";

		} else {
					
			switch($account_type){
		
				case("student"):
					include("add_user/student.php");
					break;
				
				case("admin"):
					include("add_user/admin.php");
					break;
					
				case("parent"):
					include("add_user/parent.php");
					break;

				case("teacher"):
					include("add_user/teacher.php");
					break;	
				
				case("staff"):
					include("add_user/staff.php");
					break;
			
				case("developer"):
					include("add_user/developer.php");
					break;
			}

			include_once("add_user/_user.php");

		}
	
	} else {
	
		echo "Username is already registered.";
	
	}

}
?>