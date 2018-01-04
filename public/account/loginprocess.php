<?php
/*
Holy Child Montessori
2017

Login Process
*/

// Start Session
session_start();

// Include DB
include("../_system/database/db.php");

// Create obj for Account DB
$db_account = new DBase("account", "../_store");

// Handle POST requests of Username && Password
$username = $_POST['username'];
$password = $_POST['password'];

// Query username if it exists in the database
$username_check = $db_account->get("username", "username", "$username");


// Check if username check query eariler is empty or null
if(!$username_check){

	// Return an error message if username is not found
	echo "Wrong Sign-In Details";

} else {

	// Query stored password
	$password_check = $db_account->get("password", "username", "$username");

	// User password verify function to check if similar
	if(password_verify($password,$password_check)){

		// Get the user ID
		$user_array = $db_account->where(array(),"username","$username");

		// Sets log-in status to True
		$_SESSION['logged_in'] = True;

		// For Security Checking, Cookie Injection Prevention
		$_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
		$_SESSION['user_ua'] = $_SERVER['HTTP_USER_AGENT'];

		// Sets necessary user vars into session
		foreach($user_array as $user){

			$_SESSION['username'] = $user['username'];
			$_SESSION['user_id'] = $user['user_id'];
			$_SESSION['account_type'] = $user['account_type'];
			$_SESSION['student_id'] = $user['student_id'];
			$_SESSION['parent_id'] = $user['parent_id'];
			$_SESSION['teacher_id'] = $user['teacher_id'];
			$_SESSION['staff_id'] = $user['staff_id'];
			$_SESSION['admin_id'] = $user['admin_id'];
			$_SESSION['developer_id'] = $user['developer_id'];

		}
		
		$array = array(
		"code"=>"200",
		"message"=>"User successfully signed-in"
		);
		echo json_encode($array);
		
	} else {
		
		$array = array(
			"code"=>"500",
			"message"=>"Wrong Sign-In Details"
		);
		echo json_encode($array);
		
	}
}
?>