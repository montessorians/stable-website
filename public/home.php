<?php
//Include Required Files
include("_system/config.php");
include("_system/database/db.php");

$db_loc = "/_store";
?>
<!--
Holy Child Montessori
Website
2017
All Rights Reserved
-->
<!Doctype html>
<html lang="en">
<head>

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
	<meta propert="og:image" content="http://hcmontessori.likesyou.org/assets/login.jpg">
	<meta property="og:url" content="http://hcmontessori.likesyou.org">
	<meta property="og:site_name" content="Holy Child Montessori">
	<meta property="og:type" content="website">

</head>

<body>
<?php
include("_interface/public/common.php");
?>
</body>

</html>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">