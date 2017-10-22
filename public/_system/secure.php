<?php
/*
Holy Child Montessori
2017

Secure (For Logged-In State)

LEGEND:
empty - admin only (auto)
1 - for not logged in users
2 - allow all 
3 - allow logged in only
4 - allow teachers and admin only
5 - allow admin only
*/

if(empty($perm)) $perm = 3;

switch($perm){
	case(1):
		//Redirect if User is Logged-In
		if(@$_SESSION['logged_in']) header("Location: /error/unauthorized.php");
		break;
	case(2):
		// Do Something
		$abc = "abc";
		break;
	case(3):
		// Redirect if User is not Logged-In
		if(!$_SESSION['logged_in']) header("Location: /error/unauthorized.php");
		break;
	case(4):
		// Redirect if User is not Logged-In
		if(!$_SESSION['logged_in']) header("Location: /error/unauthorized.php");
		// Create var for account type
		$perm_account_type = $_SESSION['account_type'];
		// Do Account Type Checking
		if($perm_account_type === "admin"){}
		else { if($perm_account_type === "teacher"){}
			else { header("Location: /error/unauthorized.php"); }
		}
		break;
	case(5):
		// Redirect if User is not Logged-In
		if(!$_SESSION['logged_in']) header("Location: /error/unauthorized.php");
		// Create var for account type
		$perm_account_type = $_SESSION['account_type'];
		// Do Account Type Checking
		if($perm_account_type === "admin"){}
		else {
			header("Location: /error/unauthorized.php");
		}
		break;
	default:
		// Redirect if Else
		header("Location: /error/unauthorized.php");
		break;
}

?>