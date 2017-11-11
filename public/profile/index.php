<?php
/*
Holy Child Montessori
Profile
*/

// Start Session
session_start();

// Config
include("../_system/config.php");

// DB
include("../_system/database/db.php");

$activity_title = "Profile";

$db_account = new DBase("account", "../_store");
$db_student = new DBase("student", "../_store");
$db_admin = new DBase("admin", "../_store");
$db_parent = new DBase("parent", "../_store");
$db_teacher = new DBase("teacher", "../_store");
$db_staff = new DBase("staff", "../_store");
$db_developer = new DBase("developer", "../_store");

if(!empty($_REQUEST['user_id'])){
	$user_id = $_REQUEST['user_id'];
	$user_id = $db_account->get("user_id", "user_id", "$user_id");	
}

if(!empty($_REQUEST['student_id'])){
	$student_id = $_REQUEST['student_id'];
	$user_id = $db_account->get("user_id", "student_id", "$student_id");
}

if(!empty($_REQUEST['admin_id'])){
	$admin_id = $_REQUEST['admin_id'];
	$user_id = $db_account->get("user_id", "admin_id", "$admin_id");
}

if(!empty($_REQUEST['parent_id'])){
	$parent_id = $_REQUEST['parent_id'];
	$user_id = $db_account->get("user_id", "parent_id", "$parent_id");
}

if(!empty($_REQUEST['teacher_id'])){
	$teacher_id = $_REQUEST['teacher_id'];
	$user_id = $db_account->get("user_id", "teacher_id", "$teacher_id");
}

if(!empty($_REQUEST['staff_id'])){
	$staff_id = $_REQUEST['staff_id'];
	$user_id = $db_account->get("user_id", "staff_id", "$staff_id");
}

if(!empty($_REQUEST['developer_id'])){
	$developer_id = $_REQUEST['developer_id'];
	$user_id = $db_account->get("user_id", "developer_id", "$developer_id");
}

	
// Redirect if not found/empty
if(empty($user_id)) header("Location: ../");

$account_type = $db_account->get("account_type", "user_id", "$user_id");

$student_lrn = "";
$grade = "";
$section = "";
$school_year = "";
	
switch($account_type){
	case("student"):
		$student_id = $db_account->get("student_id", "user_id", "$user_id");
		$person  = $db_student->where(array(),"student_id","$student_id");

		$student_lrn = $person[0]['student_lrn'];
		$grade = $person[0]['grade'];
		$school_year = $person[0]['school_year'];
		$section = $person[0]['section'];
		break;

	case("parent"):
		$parent_id = $db_account->get("parent_id", "user_id", "$user_id");
		$person = $db_parent->where(array(), "parent_id", "$parent_id");
		break;
		
	case("teacher"):
		$teacher_id = $db_account->get("teacher_id", "user_id", "$user_id");
		$person = $db_teacher->where(array(),"teacher_id","$teacher_id");
		break;
		
	case("admin"):
		$admin_id = $db_account->get("admin_id", "user_id", "$user_id");
		$person = $db_admin->where(array(),"admin_id","$admin_id");
		break;

	case("staff"):
		$staff_id = $db_account->get("staff_id", "user_id", "$user_id");
		$person = $db_staff->where(array(),"staff_id","$staff_id");
		break;
		
	case("developer"):
		$developer_id = $db_account->get("developer_id", "user_id", "$user_id");
		$person = $db_developer->where(array(),"developer_id","$developer_id");
		break;
}//

$first_name = $person[0]['first_name'];
$middle_name = $person[0]['middle_name'];
$last_name = $person[0]['last_name'];
$suffix_name = $person[0]['suffix_name'];
$gender = $person[0]['gender'];
$birth_month = $person[0]['birth_month'];
$birth_day = $person[0]['birth_day'];
$birth_year = $person[0]['birth_year'];
$birth_place = $person[0]['birth_place'];
$address = $person[0]['address'];
$city = $person[0]['city'];
$country = $person[0]['country'];
$mobile_number = $person[0]['mobile_number'];
$telephone_number = $person[0]['telephone_number'];
$email = $person[0]['email'];
	
switch($gender){
	case("male"):
		$gender = "Male";
		break;
	case("female"):
		$gender = "Female";
		break;
	default:
		$gender ="";
		break;
}

if(empty($_SESSION['logged_in'])) header("Location: ../account/?from=../profile/?user_id=$user_id");

if($_SESSION['account_type'] == "student"){
	if(!($user_id == $_SESSION['user_id'])) header("Location: ../");
}

if($_SESSION['account_type'] == "parent"){
	if(!($user_id == $_SESSION['user_id'])) header("Location: ../");
}
	
?>
<!Doctype html>
<html>
	<head>
		<title><?=$activity_title?> - <?=$site_title?></title>
		<?php
			include("../_system/styles.php");
		?>
		<style>
		nav{
			background-color: seagreen;
		}
		</style>
	</head>
	<body>
		<nav class="nav-extended">
    <div class="nav-wrapper">
      <a class="title"><?=$activity_title?></a>
      <a href="../" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
    </div>
    <div class="nav-content">
    	<span class="nav-title">
    		<?=$first_name . " " .$middle_name." ".$last_name." ".$suffix_name?>
    	</span>
    </div>
  </nav>
  
  <ul class="collection">
  	<?php
  		if($account_type == "student"){
  		echo "
  			<li class='collection-item'>
  				LRN: $student_lrn
  			</li>
  			<li class='collection-item'>
  				Grade: $grade
  			</li>
  			<li class='collection-item'>
  				Section: $section
  			</li>
  			<li class='collection-item'>
  				School Year Enrolled: $school_year
  			</li>	
  		";
  		}
  	?>
  		<li class="collection-item">
  			Gender: <?=$gender?>
  		</li>
  		<li class="collection-item">
  			Birthday: <?="$birth_month $birth_day, $birth_year"?>
  		</li>
  		<li class="collection-item">
  			Birthplace: <?="$birth_place"?>
  		</li>
  		<li class="collection-item">
  			Address: <?="$address"?>
  		</li>
  		<li class="collection-item">
  			City: <?="$city"?>
  		</li>
  		<li class="collection-item">
  			Country: <?="$country"?>
  		</li>
  		<li class="collection-item">
  			Mobile Number: <?="$mobile_number"?>
  		</li>
  		<li class="collection-item">
  			Telephone Number: <?="$telephone_number"?>
  		</li>
  		<li class="collection-item">
  			E-Mail: <?="$email"?>
  		</li>
  </ul>
  
	</body>
</html>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">