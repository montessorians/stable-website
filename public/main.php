<?php
/*
Holy Child Montessori
2017

Main
*/

//Include Required Files
include("_system/config.php");
include("_system/database/db.php");

$db_loc = "/_store";
?>
<!--

Holy Child Montessori
Website
Created 2017
All Rights Reserved

Created by Holy Child Montessori Educational Technologies.
This system has been made open-source and is available at
http://github.com/hcmedutech/website. 

This web application is being continuously being developed.
For version details, please log-in using your account
and in the Me tab, scroll to the bottom-most part or
visit http://hcmontessor.likesyou.org/version.php.

For bugs and other issues, please visit the GitHub repository
and open a bug report. Vulnerability and other security issues
may be e-mailed to us at hcmontessori@gmail.com.

-->

<!Doctype html>
<html lang="en">
<head>

	<!-- Encoding -->
	<meta charset="UTF-8">

	<!-- Site Title -->
	<title><?=$site_title?></title>

	<!-- Favicon -->
	<!--link rel="shortcut icon" type="image/x-icon" href="/favicon.ico"/-->
	<link rel="shortcut icon" type="image/x-icon" href="/assets/logo-144px.png"/>

	<?php
	// Include Style Files
	include("_system/styles.php");
	?>

	<!-- OpenGraph Tags -->
	<meta property="og:title" content="Holy Child Montessori">
	<meta property="og:description" content="Providing quality education since 1992">
	<meta propert="og:image" content="http://hcmontessori.likesyou.org/assets/login.jpg">
	<meta property="og:url" content="http://hcmontessori.likesyou.org">
	<meta property="og:site_name" content="Holy Child Montessori">
	<meta property="og:type" content="website">

</head>

	<body>
	<?php
	// Include Public Interface if not logged-in
	if(empty($_SESSION['logged_in'])) include("_interface/public/common.php");

	// For Logged-In Users
	if(isset($_SESSION['account_type'])){

		// Require Security Checking for Logged-In users
		require_once("secure.php");

		// Set Vars
		$account_type = $_SESSION['account_type'];
		$user_id = $_SESSION['user_id'];

		// Create obj for database (Required by _interface)
		$db_account = new DBase("account",$db_loc);
		$db_student = new DBase("student",$db_loc);
		$db_admin = new DBase("admin",$db_loc);
		$db_teacher = new DBase("teacher",$db_loc);
		$db_parent = new DBase("parent",$db_loc);
		$db_staff = new DBase("staff",$db_loc);
		$db_developer = new DBase("developer",$db_loc);
			
		// Include the required interface for each user account type
		switch($account_type){
			case("student"):
				include_once("_interface/student/common.php");
				break;
			case("admin"):
				include_once("_interface/admin/common.php");
				break;
			case("teacher"):
				include_once("_interface/teacher/common.php");
				break;
			case("parent"):
				include_once("_interface/parent/common.php");
				break;
			case("staff"):
				include_once("_interface/staff/common.php");
				break;
			case("developer"):
				include_once("_interface/developer/common.php");
				break;
			default:	
				include_once("_interface/public/common.php");
				break;
		}
	}
	?>
	</body>

</html>

<!-- Fonts -->
<!--link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"-->