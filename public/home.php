<?php
/*
Holy Child Montessori
2017

Home
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
https://github.com/hcmedutech/website. 

This web application is being continuously being developed.
For version details, please log-in using your account
and in the Me tab, scroll to the bottom-most part or
visit https://hcmontessori.000webhostapp.com/version.php.

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
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>

	<?php
	// Include Style Files
	include("_system/styles.php");
	?>

	<!-- OpenGraph Tags -->
	<meta property="og:title" content="Holy Child Montessori">
	<meta property="og:description" content="Providing quality education since 1992">
	<meta propert="og:image" content="https://hcmontessori.000webhostapp.com/assets/login.jpg">
	<meta property="og:url" content="https://hcmontessori.000webhostapp.com">
	<meta property="og:site_name" content="Holy Child Montessori">
	<meta property="og:type" content="website">

</head>

	<body>
	<?php
		include("_interface/public/common.php");
	?>
	</body>

</html>



