<?php
/*
Holy Child Montessori
2017

Edit User
*/

// Start Session
session_start();
	
// Declare Permission Level
$perm = 5;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB 
include("../_require/db.php");

// Handle Post Data 		
$user_id = $_POST['user_id'];
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

// Get ID
$user_id_array = $db_account->where(array(), "user_id", "$user_id");
foreach($user_id_array as $user){
	$student_id = $user['student_id'];
	$parent_id = $user['parent_id'];
	$teacher_id = $user['teacher_id'];
	$admin_id = $user['admin_id'];
	$staff_id = $user['staff_id'];
	$developer_id = $user['developer_id'];
}

// Switch along account type	
switch($account_type){

	case("student"):

		// Rewrite Data
		$first_name = $db_student->to("first_name", "$first_name", "student_id", "$student_id");
		$middle_name = $db_student->to("middle_name", "$middle_name", "student_id", "$student_id");
		$last_name = $db_student->to("last_name", "$last_name", "student_id", "$student_id");
		$suffix_name = $db_student->to("suffix_name", "$suffix_name", "student_id", "$student_id");
		$gender = $db_student->to("gender", "$gender", "student_id", "$student_id");
		$birth_month = $db_student->to("birth_month", "$birth_month", "student_id", "$student_id");
		$birth_day = $db_student->to("birth_day", "$birth_day", "student_id", "$student_id");
		$birth_year = $db_student->to("birth_year", "$birth_year", "student_id", "$student_id");
		$birth_place = $db_student->to("birth_place", "$birth_place", "student_id", "$student_id");
		$address = $db_student->to("address", "$address", "student_id", "$student_id");
		$city = $db_student->to("city", "$city", "student_id", "$student_id");
		$country = $db_student->to("country", "$country", "student_id", "$student_id");
		$mobile_number = $db_student->to("mobile_number", "$mobile_number", "student_id", "$student_id");
		$telephone_number = $db_student->to("telephone_number", "$telephone_number", "student_id", "$student_id");
		$email = $db_student->to("email", "$email", "student_id", "$student_id");
		$username = $db_account->to("username", "$username", "student_id", "$student_id");

		break;
			
	case("parent"):

		// Rewrite Data
		$first_name = $db_parent->to("first_name", "$first_name", "parent_id", "$parent_id");
		$middle_name = $db_parent->to("middle_name", "$middle_name", "parent_id", "$parent_id");
		$last_name = $db_parent->to("last_name", "$last_name", "parent_id", "$parent_id");
		$suffix_name = $db_parent->to("suffix_name", "$suffix_name", "parent_id", "$parent_id");
		$gender = $db_parent->to("gender", "$gender", "parent_id", "$parent_id");
		$birth_month = $db_parent->to("birth_month", "$birth_month", "parent_id", "$parent_id");
		$birth_day = $db_parent->to("birth_day", "$birth_day", "parent_id", "$parent_id");
		$birth_year = $db_parent->to("birth_year", "$birth_year", "parent_id", "$parent_id");
		$birth_place = $db_parent->to("birth_place", "$birth_place", "parent_id", "$parent_id");
		$address = $db_parent->to("address", "$address", "parent_id", "$parent_id");
		$city = $db_parent->to("city", "$city", "parent_id", "$parent_id");
		$country = $db_parent->to("country", "$country", "parent_id", "$parent_id");
		$mobile_number = $db_parent->to("mobile_number", "$mobile_number", "parent_id", "$parent_id");
		$telephone_number = $db_parent->to("telephone_number", "$telephone_number", "parent_id", "$parent_id");
		$email = $db_parent->to("email", "$email", "parent_id", "$parent_id");
		$username = $db_account->to("username", "$username", "parent_id", "$parent_id");

		break;
		
	case("teacher"):

		// Rewrite Data
		$first_name = $db_teacher->to("first_name", "$first_name", "teacher_id", "$teacher_id");
		$middle_name = $db_teacher->to("middle_name", "$middle_name", "teacher_id", "$teacher_id");
		$last_name = $db_teacher->to("last_name", "$last_name", "teacher_id", "$teacher_id");
		$suffix_name = $db_teacher->to("suffix_name", "$suffix_name", "teacher_id", "$teacher_id");
		$gender = $db_teacher->to("gender", "$gender", "teacher_id", "$teacher_id");
		$birth_month = $db_teacher->to("birth_month", "$birth_month", "teacher_id", "$teacher_id");
		$birth_day = $db_teacher->to("birth_day", "$birth_day", "teacher_id", "$teacher_id");
		$birth_year = $db_teacher->to("birth_year", "$birth_year", "teacher_id", "$teacher_id");
		$birth_place = $db_teacher->to("birth_place", "$birth_place", "teacher_id", "$teacher_id");
		$address = $db_teacher->to("address", "$address", "teacher_id", "$teacher_id");
		$city = $db_teacher->to("city", "$city", "teacher_id", "$teacher_id");
		$country = $db_teacher->to("country", "$country", "teacher_id", "$teacher_id");
		$mobile_number = $db_teacher->to("mobile_number", "$mobile_number", "teacher_id", "$teacher_id");
		$telephone_number = $db_teacher->to("telephone_number", "$telephone_number", "teacher_id", "$teacher_id");
		$email = $db_teacher->to("email", "$email", "teacher_id", "$teacher_id");
		$username = $db_account->to("username", "$username", "teacher_id", "$teacher_id");

		break;
			
	case("admin"):

		// Rewrite Data
		$first_name = $db_admin->to("first_name", "$first_name", "admin_id", "$admin_id");
		$middle_name = $db_admin->to("middle_name", "$middle_name", "admin_id", "$admin_id");
		$last_name = $db_admin->to("last_name", "$first_name", "admin_id", "$admin_id");
		$suffix_name = $db_admin->to("suffix_name", "$first_name", "admin_id", "$admin_id");
		$gender = $db_admin->to("gender", "$gender", "admin_id", "$admin_id");
		$birth_month = $db_admin->to("birth_month", "$birth_month", "admin_id", "$admin_id");
		$birth_day = $db_admin->to("birth_day", "$birth_day", "admin_id", "$admin_id");
		$birth_year = $db_admin->to("birth_year", "$birth_year", "admin_id", "$admin_id");
		$birth_place = $db_admin->to("birth_place", "$birth_place", "admin_id", "$admin_id");
		$address = $db_admin->to("address", "$address", "admin_id", "$admin_id");
		$city = $db_admin->to("city", "$city", "admin_id", "$admin_id");
		$country = $db_admin->to("country", "$country", "admin_id", "$admin_id");
		$mobile_number = $db_admin->to("mobile_number", "$mobile_number", "admin_id", "$admin_id");
		$telephone_number = $db_admin->to("telephone_number", "$telephone_number", "admin_id", "$admin_id");
		$email = $db_admin->to("email", "$email", "admin_id", "$admin_id");
		$username = $db_account->to("username", "$username", "admin_id", "$admin_id");

		break;
			
	case("staff"):

		// Rewrite Data
		$first_name = $db_staff->to("first_name", "$first_name", "staff_id", "$staff_id");
		$middle_name = $db_staff->to("middle_name", "$middle_name", "staff_id", "$staff_id");
		$last_name = $db_staff->to("last_name", "$first_name", "staff_id", "$staff_id");
		$suffix_name = $db_staff->to("suffix_name", "$first_name", "staff_id", "$staff_id");
		$gender = $db_staff->to("gender", "$gender", "staff_id", "$staff_id");
		$birth_month = $db_staff->to("birth_month", "$birth_month", "staff_id", "$staff_id");
		$birth_day = $db_staff->to("birth_day", "$birth_day", "staff_id", "$staff_id");
		$birth_year = $db_staff->to("birth_year", "$birth_year", "staff_id", "$staff_id");
		$birth_place = $db_staff->to("birth_place", "$birth_place", "staff_id", "$staff_id");
		$address = $db_staff->to("address", "$address", "staff_id", "$staff_id");
		$city = $db_staff->to("city", "$city", "staff_id", "$staff_id");
		$country = $db_staff->to("country", "$country", "staff_id", "$staff_id");
		$mobile_number = $db_staff->to("mobile_number", "$mobile_number", "staff_id", "$staff_id");
		$telephone_number = $db_staff->to("telephone_number", "$telephone_number", "staff_id", "$staff_id");
		$email = $db_staff->to("email", "$email", "staff_id", "$staff_id");
		$username = $db_account->to("username", "$username", "staff_id", "$staff_id");

		break;	
		
	case("developer"):

		// Rewrite Data
		$first_name = $db_developer->to("first_name", "$first_name", "developer_id", "$developer_id");
		$middle_name = $db_developer->to("middle_name", "$middle_name", "developer_id", "$developer_id");
		$last_name = $db_developer->to("last_name", "$first_name", "developer_id", "$developer_id");
		$suffix_name = $db_developer->to("suffix_name", "$first_name", "developer_id", "$developer_id");
		$gender = $db_developer->to("gender", "$gender", "developer_id", "$developer_id");
		$birth_month = $db_developer->to("birth_month", "$birth_month", "developer_id", "$developer_id");
		$birth_day = $db_developer->to("birth_day", "$birth_day", "developer_id", "developer_id");
		$birth_year = $db_developer->to("birth_year", "$birth_year", "developer_id", "$developer_id");
		$birth_place = $db_developer->to("birth_place", "$birth_place", "developer_id", "$developer_id");
		$address = $db_developer->to("address", "$address", "developer_id", "$developer_id");
		$city = $db_developer->to("city", "$city", "developer_id", "$developer_id");
		$country = $db_developer->to("country", "$country", "developer_id", "$developer_id");
		$mobile_number = $db_developer->to("mobile_number", "$mobile_number", "developer_id", "$developer_id");
		$telephone_number = $db_developer->to("telephone_number", "$telephone_number", "developer_id", "$developer_id");
		$email = $db_developer->to("email", "$email", "developer_id", "$developer_id");
		$username = $db_account->to("username", "$username", "developer_id", "$developer_id");

		break;	
		
	}

	// Echo msg	
	echo "User information edited successfully!";

?>