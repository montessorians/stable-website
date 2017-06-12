<?php
session_start();
include("../_system/database/db.php");
$db_account = new DBase("account", "../_store");

$username = $_POST['username'];
$password = $_POST['password'];

$username_check = $db_account->get("username", "username", "$username");
if(empty($username_check)){
	echo "Wrong Sign-In Details";
} else {
	$password_check = $db_account->get("password", "username", "$username");
	if(password_verify($password,$password_check)){
		$user_id = $db_account->get("user_id", "username", "$username");
		$_SESSION['username'] = $username;
		$_SESSION['user_id'] = $user_id;
		$_SESSION['account_type'] = $db_account->get("account_type", "user_id", "$user_id");
		$_SESSION['logged_in'] = True;
		$_SESSION['student_id'] = $db_account->get("student_id", "user_id", "$user_id");
		$_SESSION['parent_id'] = $db_account->get("parent_id", "user_id", "$user_id");
		$_SESSION['teacher_id'] = $db_account->get("teacher_id", "user_id", "$user_id");
		$_SESSION['staff_id'] = $db_account->get("staff_id", "user_id", "$user_id");
		$_SESSION['admin_id'] = $db_account->get("admin_id", "user_id", "$user_id");
		$_SESSION['developer_id'] = $db_account->get("developer_id", "user_id", "$user_id");
		echo "Ok";
		
	} else {
		echo "Wrong Sign-In Details";
	}
}
?>