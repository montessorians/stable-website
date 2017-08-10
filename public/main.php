<?php
//Include Required Files
include("_system/config.php");
include("_system/database/db.php");
?>
<!Doctype html>
<html>
<!--
Holy Child Montessori
Website
2017
-->
<head>
	<title><?=$site_title?></title>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico"/>
	<?php
	// Include Style Files
	include("_system/styles.php");
	?>
	<meta property="og:title" content="Holy Child Montessori">
	<meta property="og:description" content="Providing quality education since 1992">
	<meta propert="og:image" content="http://hcmontessori.likesyou.org/assets/login.jpg">
	<meta property="og:url" content="http://hcmontessori.likesyou.org">
	<meta property="og:site_name" content="Holy Child Montessori">
	<meta property="og:type" content="website">
</head>
<body>
<?php
if(empty($_SESSION['logged_in'])){
	include("_interface/public/common.php");
}
if(isset($_SESSION['account_type'])){
	$account_type = $_SESSION['account_type'];
	$user_id = $_SESSION['user_id'];

	$db_account = new DBase("account","_store");
	$db_student = new DBase("student","_store");
	$db_admin = new DBase("admin","_store");
	$db_teacher = new DBase("teacher","_store");
	$db_parent = new DBase("parent","_store");
	$db_staff = new DBase("staff","_store");
	$db_developer = new DBase("developer","_store");
		
	$student_id = False;
	$admin_id = False;
	$teacher_id = False;
	$parent_id = False;
	$staff_id = False;
	$developer_id = False;
		
	switch($account_type){
		case("student"):
			$student_id = $db_account->get("student_id", "user_id", "$user_id");
			include_once("_interface/student/common.php");
			break;
		case("admin"):
			include_once("_interface/admin/common.php");
			$admin_id = $db_account->get("admin_id", "user_id", "$user_id");
			break;
		case("teacher"):
			include_once("_interface/teacher/common.php");
			$teacher_id = $db_account->get("teacher_id", "user_id", "$user_id");
			break;
		case("parent"):
			include_once("_interface/parent/common.php");
			$parent_id = $db_account->get("parent_id", "user_id", "$user_id");
			break;
		case("staff"):
			include_once("_interface/staff/common.php");
			$staff_id = $db_account->get("staff_id", "user_id", "$user_id");
			break;
		case("developer"):
			include_once("_interface/developer/common.php");
			$developer_id = $db_account->get("developer_id", "user_id", "$user_id");
			break;
		default:	
			include_once("_interface/public/common.php");
			break;
	}
}
?>
</body>
</html>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">