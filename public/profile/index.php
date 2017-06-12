<?php
	session_start();
	include("../_system/config.php");
	include("../_system/database/db.php");
	
	
	
	$activity_title = "Profile";
	
	$db_account = new DBase("account", "../_store");
	$db_student = new DBase("student", "../_store");
	$db_admin = new DBase("admin", "../_store");
	$db_parent = new DBase("parent", "../_store");
	$db_teacher = new DBase("teacher", "../_store");
	$db_staff = new DBase("staff", "../_store");
	$db_developer = new DBase("developer", "../_store");
	
	if(empty($_GET['user_id'])){
		if(empty($_GET['student_id'])){
			if(empty($_GET['admin_id'])){
				if(empty($_GET['parent_id'])){
					if(empty($_GET['teacher_id'])){
						if(empty($_GET['staff_id'])){
							if(empty($_GET['developer_id'])){
								header("Location: ../");
							} else {
								$developer_id = $_GET['developer_id'];
								$user_id = $db_account->get("user_id", "developer_id", "$developer_id");
							} 
						} else {
							$staff_id = $_GET['staff_id'];
							$user_id = $db_account->get("user_id", "staff_id", "$staff_id");
						}
					} else {
						$teacher_id = $_GET['teacher_id'];
						$user_id = $db_account->get("user_id", "teacher_id", "$teacher_id");
					}
				} else {
					$parent_id = $_GET['parent_id'];
					$user_id = $db_account->get("user_id", "parent_id", "$parent_id");
				}
			} else {
				$admin_id = $_GET['admin_id'];
				$user_id = $db_account->get("user_id", "admin_id", "$admin_id");
			}
		} else {
			$student_id = $_GET['student_id'];
			$user_id = $db_account->get("user_id", "student_id", "$student_id");
		}
	} else {
		$user_id = $_GET['user_id'];
		$user_id = $db_account->get("user_id", "user_id", "$user_id");
	}
	
	// Redirect if not found/empty
	if(empty($user_id)){
		header("Location: ../");
	}
	
	$account_type = $db_account->get("account_type", "user_id", "$user_id");
	
	$student_lrn = "";
	$grade = "";
	$section = "";
	$school_year = "";
	
	switch($account_type){
		case("student"):
			$student_id = $db_account->get("student_id", "user_id", "$user_id");
			$student_lrn = $db_student->get("student_lrn", "student_id", "$student_id");
			$first_name = $db_student->get("first_name", "student_id", "$student_id");
			$middle_name = $db_student->get("middle_name", "student_id", "$student_id");
			$last_name = $db_student->get("last_name", "student_id", "$student_id");
			$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
			$gender = $db_student->get("gender", "student_id", "$student_id");
			$birth_month = $db_student->get("birth_month", "student_id", "$student_id");
			$birth_day = $db_student->get("birth_day", "student_id", "$student_id");
			$birth_year = $db_student->get("birth_year", "student_id", "$student_id");
			$birth_place = $db_student->get("birth_place", "student_id", "$student_id");
			$address = $db_student->get("address", "student_id", "$student_id");
			$city = $db_student->get("city", "student_id", "$student_id");
			$country = $db_student->get("country", "student_id", "$student_id");
			$mobile_number = $db_student->get("mobile_number", "student_id", "$student_id");
			$telephone_number = $db_student->get("telephone_number", "student_id", "$student_id");
			$email = $db_student->get("email", "student_id", "$student_id");
			$grade = $db_student->get("grade", "student_id", "$student_id");
			$school_year = $db_student->get("school_year", "student_id", "$student_id");
			$section = $db_student->get("section", "student_id", "$student_id");
			break;
			
		case("parent"):
			$parent_id = $db_account->get("parent_id", "user_id", "$user_id");
			$first_name = $db_parent->get("first_name", "parent_id", "$parent_id");
			$middle_name = $db_parent->get("middle_name", "parent_id", "$parent_id");
			$last_name = $db_parent->get("last_name", "parent_id", "$parent_id");
			$suffix_name = $db_parent->get("suffix_name", "parent_id", "$parent_id");
			$gender = $db_parent->get("gender", "parent_id", "$parent_id");
			$birth_month = $db_parent->get("birth_month", "parent_id", "$parent_id");
			$birth_day = $db_parent->get("birth_day", "parent_id", "$parent_id");
			$birth_year = $db_parent->get("birth_year", "parent_id", "$parent_id");
			$birth_place = $db_parent->get("birth_place", "parent_id", "$parent_id");
			$address = $db_parent->get("address", "parent_id", "$parent_id");
			$city = $db_parent->get("city", "parent_id", "$parent_id");
			$country = $db_parent->get("country", "parent_id", "$parent_id");
			$mobile_number = $db_parent->get("mobile_number", "parent_id", "$parent_id");
			$telephone_number = $db_parent->get("telephone_number", "parent_id", "$parent_id");
			$email = $db_parent->get("email", "parent_id", "$parent_id");
			break;
			
		case("teacher"):
			$teacher_id = $db_account->get("teacher_id", "user_id", "$user_id");
			$first_name = $db_teacher->get("first_name", "teacher_id", "$teacher_id");
			$middle_name = $db_teacher->get("middle_name", "teacher_id", "$teacher_id");
			$last_name = $db_teacher->get("last_name", "teacher_id", "$teacher_id");
			$suffix_name = $db_teacher->get("suffix_name", "teacher_id", "$teacher_id");
			$gender = $db_teacher->get("gender", "teacher_id", "$teacher_id");
			$birth_month = $db_teacher->get("birth_month", "teacher_id", "$teacher_id");
			$birth_day = $db_teacher->get("birth_day", "teacher_id", "$teacher_id");
			$birth_year = $db_teacher->get("birth_year", "teacher_id", "$teacher_id");
			$birth_place = $db_teacher->get("birth_place", "teacher_id", "$teacher_id");
			$address = $db_teacher->get("address", "teacher_id", "$teacher_id");
			$city = $db_teacher->get("city", "teacher_id", "$teacher_id");
			$country = $db_teacher->get("country", "teacher_id", "$teacher_id");
			$mobile_number = $db_teacher->get("mobile_number", "teacher_id", "$teacher_id");
			$telephone_number = $db_teacher->get("telephone_number", "teacher_id", "$teacher_id");
			$email = $db_teacher->get("email", "teacher_id", "$teacher_id");
			break;
			
		case("admin"):
			$admin_id = $db_account->get("admin_id", "user_id", "$user_id");
			$first_name = $db_admin->get("first_name", "admin_id", "$admin_id");
			$middle_name = $db_admin->get("middle_name", "admin_id", "$admin_id");
			$last_name = $db_admin->get("last_name", "admin_id", "$admin_id");
			$suffix_name = $db_admin->get("suffix_name", "admin_id", "$admin_id");
			$gender = $db_admin->get("gender", "admin_id", "$admin_id");
			$birth_month = $db_admin->get("birth_month", "admin_id", "$admin_id");
			$birth_day = $db_admin->get("birth_day", "admin_id", "$admin_id");
			$birth_year = $db_admin->get("birth_year", "admin_id", "$admin_id");
			$birth_place = $db_admin->get("birth_place", "admin_id", "$admin_id");
			$address = $db_admin->get("address", "admin_id", "$admin_id");
			$city = $db_admin->get("city", "admin_id", "$admin_id");
			$country = $db_admin->get("country", "admin_id", "$admin_id");
			$mobile_number = $db_admin->get("mobile_number", "admin_id", "$admin_id");
			$telephone_number = $db_admin->get("telephone_number", "admin_id", "$admin_id");
			$email = $db_admin->get("email", "admin_id", "$admin_id");
			break;

		case("staff"):
			$staff_id = $db_account->get("staff_id", "user_id", "$user_id");
			$first_name = $db_staff->get("first_name", "staff_id", "$staff_id");
			$middle_name = $db_staff->get("middle_name", "staff_id", "$staff_id");
			$last_name = $db_staff->get("last_name", "staff_id", "$staff_id");
			$suffix_name = $db_staff->get("suffix_name", "staff_id", "$staff_id");
			$gender = $db_staff->get("gender", "staff_id", "$staff_id");
			$birth_month = $db_staff->get("birth_month", "staff_id", "$staff_id");
			$birth_day = $db_staff->get("birth_day", "staff_id", "$staff_id");
			$birth_year = $db_staff->get("birth_year", "staff_id", "$staff_id");
			$birth_place = $db_staff->get("birth_place", "staff_id", "$staff_id");
			$address = $db_staff->get("address", "staff_id", "$staff_id");
			$city = $db_developer->get("city", "staff_id", "$staff_id");
			$country = $db_staff->get("country", "staff_id", "$staff_id");
			$mobile_number = $db_staff->get("mobile_number", "staff_id", "$staff_id");
			$telephone_number = $db_staff->get("telephone_number", "staff_id", "$staff_id");
			$email = $db_staff->get("email", "staff_id", "$staff_id");
			break;
			
		case("developer"):
			$developer_id = $db_account->get("developer_id", "user_id", "$user_id");
			$first_name = $db_developer->get("first_name", "developer_id", "$developer_id");
			$middle_name = $db_developer->get("middle_name", "developer_id", "$developer_id");
			$last_name = $db_developer->get("last_name", "developer_id", "$developer_id");
			$suffix_name = $db_developer->get("suffix_name", "developer_id", "$developer_id");
			$gender = $db_developer->get("gender", "developer_id", "$developer_id");
			$birth_month = $db_developer->get("birth_month", "developer_id", "$developer_id");
			$birth_day = $db_developer->get("birth_day", "developer_id", "$developer_id");
			$birth_year = $db_developer->get("birth_year", "developer_id", "$developer_id");
			$birth_place = $db_developer->get("birth_place", "developer_id", "$developer_id");
			$address = $db_developer->get("address", "developer_id", "$developer_id");
			$city = $db_developer->get("city", "developer_id", "$developer_id");
			$country = $db_developer->get("country", "developer_id", "$developer_id");
			$mobile_number = $db_developer->get("mobile_number", "developer_id", "$developer_id");
			$telephone_number = $db_developer->get("telephone_number", "developer_id", "$developer_id");
			$email = $db_developer->get("email", "developer_id", "$developer_id");
			break;
	}//
	
	switch($gender){
		case("male"):
			$gender = "Male";
			break;
		case("female"):
			$gender = "Female";
			break;
	}
	
	if(empty($_SESSION['logged_in'])){
		header("Location: ../account/?from=../profile/?user_id=$user_id");
	}
	
	if($_SESSION['account_type'] == "student"){
		if($user_id == $_SESSION['user_id']){			
		} else {
			header("Location: ../");
		}
	}
	if($_SESSION['account_type'] == "parent"){
		if($user_id == $_SESSION['user_id']){			
		} else {
			header("Location: ../");
		}
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