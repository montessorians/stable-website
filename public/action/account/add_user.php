<?php
	session_start();
	include("../../_system/secure.php");
	include("../../_system/database/db.php");
	if(empty($_GET['from'])){
		if(empty($_SERVER['HTTP_REFERER'])){
			$from = "../../";
		} else {
			$from = $_SERVER['HTTP_REFERER'];
		}} else {
		$from = $_GET['from'];
	}
	if($_SESSION['account_type'] == "admin"){} else {
		if($_SESSION['account_type'] == "developer"){} else {
				header("Location: $from");
		}
	}
	
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
	$password = $_POST['password'];
	if(strlen($password) < 8){
		echo "Password too short";
	} else {
	
	$password = password_hash("$password", PASSWORD_DEFAULT);
	
	$create_month = date("M");
	$create_day = date("d");
	$create_year = date("Y");
	$create_hour = date("H");
	$create_minute = date("i");

	$db_account = new DBase("account","../../_store");
	$db_ecash = new DBase("ecash","../../_store");
	$db_student = new DBase("student","../../_store");
	$db_admin = new DBase("admin","../../_store");
	$db_teacher = new DBase("teacher","../../_store");
	$db_parent = new DBase("parent","../../_store");
	$db_staff = new DBase("staff","../../_store");
	$db_developer = new DBase("developer","../../_store");
	
	$username_check = $db_account->get("username", "username", "$username");
	if(empty($username_check)){
		if(empty($account_type)){
			echo "Account type required";
		} else {
		
			$user_id = uniqid();

			
			$staff_id = rand(1000000000,9999999999);
			$developer_id = rand(1000000000,9999999999);
			
			switch($account_type){
				case("student"):
					$student_id = date("Y") . rand(100000,999999);
					$stdid_check = $db_student->get("student_id", "student_id", "$student_id");
					if(empty($stdid_check)){} else {
						$student_id = date("Y") . rand(100000,999999);
					}
					$array1 = array(
						"student_id" => "$student_id",
						"student_lrn" => "",
						"first_name" => "$first_name",
						"middle_name" => "$middle_name",
						"last_name" => "$last_name",
						"suffix_name" => "$suffix_name",
						"gender" => "$gender",
						"birth_month" => "$birth_month",
						"birth_day" => "$birth_day",
						"birth_year" => "$birth_year",
						"birth_place" => "$birth_place",
						"address" => "$address",
						"city" => "$city",
						"country" => "$country",
						"mobile_number" => "$mobile_number",
						"telephone_number" => "$telephone_number",
						"email" => "$email",
						"grade" => "",
						"school_year" => "",
						"section" => ""
					);
					$db_student->add($array1);
					
					$array2 = array(
					"user_id" => "$user_id",
					"account_type" => "student",
					"student_id" => "$student_id",
					"admin_id" => "",
					"parent_id" => "",
					"teacher_id" => "",
					"staff_id" => "",
					"developer_id" => "",
					"username" => "$username",
					"password" => "$password",
					"photo_url" => "",
					"create_month" => "$create_month",
					"create_day" => "$create_day",
					"create_year" => "$create_year",
					"create_hour" => "$create_hour",
					"create_minute" => "$create_minute"
					);
					
					$db_account->add($array2);
					
					$ecash_id = uniqid();
					$array3 = array(
						"ecash_id" => "$ecash_id",
						"user_id" => "$user_id",
						"allow_ecash" => "no",
						"daily_limit" => "500.00",
						"current_balance" => "0",
						"previous_balance" => "0",
						"previous_transaction" => "",
						"previous_transaction_merchant" => "",
						"previous_transaction_month" => "",
						"previous_transaction_day" => "",
						"previous_transaction_year" => "",
						"previous_transaction_time" => ""
					);
					$db_ecash->add($array3);
					
					echo "Student Added Successfully. Student ID no. is $student_id";
					break;
				
				case("admin"):

					$admin_id = rand(1000000000,9999999999);
					$array1 = array(
						"admin_id" => "$admin_id",
						"admin_office" => "",
						"admin_position" => "",
						"first_name" => "$first_name",
						"middle_name" => "$middle_name",
						"last_name" => "$last_name",
						"suffix_name" => "$suffix_name",
						"gender" => "$gender",
						"birth_month" => "$birth_month",
						"birth_day" => "$birth_day",
						"birth_year" => "$birth_year",
						"birth_place" => "$birth_place",
						"address" => "$address",
						"city" => "$city",
						"country" => "$country",
						"mobile_number" => "$mobile_number",
						"telephone_number" => "$telephone_number",
						"email" => "$email"							
					);
					$db_admin->add($array1);
					
					$array2 = array(
					"user_id" => "$user_id",
					"account_type" => "admin",
					"student_id" => "",
					"admin_id" => "$admin_id",
					"parent_id" => "",
					"teacher_id" => "",
					"staff_id" => "",
					"developer_id" => "",
					"username" => "$username",
					"password" => "$password",
					"photo_url" => "",
					"create_month" => "$create_month",
					"create_day" => "$create_day",
					"create_year" => "$create_year",
					"create_hour" => "$create_hour",
					"create_minute" => "$create_minute"
					);
					
					$db_account->add($array2);
					echo "Administrator Added Successfully. Admin ID no. is $admin_id";
					break;
					
				case("parent"):
				
					$parent_id = rand(1000000000,9999999999);
					$array1 = array(
						"parent_id" => "$parent_id",
						"first_name" => "$first_name",
						"middle_name" => "$middle_name",
						"last_name" => "$last_name",
						"suffix_name" => "$suffix_name",
						"gender" => "$gender",
						"birth_month" => "$birth_month",
						"birth_day" => "$birth_day",
						"birth_year" => "$birth_year",
						"birth_place" => "$birth_place",
						"address" => "$address",
						"city" => "$city",
						"country" => "$country",
						"mobile_number" => "$mobile_number",
						"telephone_number" => "$telephone_number",
						"email" => "$email"							
					);
					$db_parent->add($array1);
					
					$array2 = array(
					"user_id" => "$user_id",
					"account_type" => "parent",
					"student_id" => "",
					"admin_id" => "",
					"parent_id" => "$parent_id",
					"teacher_id" => "",
					"staff_id" => "",
					"developer_id" => "",
					"username" => "$username",
					"password" => "$password",
					"photo_url" => "",
					"create_month" => "$create_month",
					"create_day" => "$create_day",
					"create_year" => "$create_year",
					"create_hour" => "$create_hour",
					"create_minute" => "$create_minute"
					);
					
					$db_account->add($array2);
					echo "Parent Added Successfully. Parent ID no. is $parent_id";
					break;
					
				case("teacher"):
				
					$teacher_id = rand(1000000000,9999999999);
					$array1 = array(
						"teacher_id" => "$teacher_id",
						"first_name" => "$first_name",
						"middle_name" => "$middle_name",
						"last_name" => "$last_name",
						"suffix_name" => "$suffix_name",
						"gender" => "$gender",
						"birth_month" => "$birth_month",
						"birth_day" => "$birth_day",
						"birth_year" => "$birth_year",
						"birth_place" => "$birth_place",
						"address" => "$address",
						"city" => "$city",
						"country" => "$country",
						"mobile_number" => "$mobile_number",
						"telephone_number" => "$telephone_number",
						"email" => "$email"							
					);
					$db_teacher->add($array1);
					
					$array2 = array(
					"user_id" => "$user_id",
					"account_type" => "teacher",
					"student_id" => "",
					"admin_id" => "",
					"parent_id" => "",
					"teacher_id" => "$teacher_id",
					"staff_id" => "",
					"developer_id" => "",
					"username" => "$username",
					"password" => "$password",
					"photo_url" => "",
					"create_month" => "$create_month",
					"create_day" => "$create_day",
					"create_year" => "$create_year",
					"create_hour" => "$create_hour",
					"create_minute" => "$create_minute"
					);
					
					$db_account->add($array2);
					echo "Teacher Added Successfully. Teacher ID no. is $teacher_id";
					break;	
				
				case("staff"):
					$staff_id = rand(1000000000,9999999999);
					$array1 = array(
						"staff_id" => "$staff_id",
						"staff_office" => "",
						"staff_position" => "",
						"first_name" => "$first_name",
						"middle_name" => "$middle_name",
						"last_name" => "$last_name",
						"suffix_name" => "$suffix_name",
						"gender" => "$gender",
						"birth_month" => "$birth_month",
						"birth_day" => "$birth_day",
						"birth_year" => "$birth_year",
						"birth_place" => "$birth_place",
						"address" => "$address",
						"city" => "$city",
						"country" => "$country",
						"mobile_number" => "$mobile_number",
						"telephone_number" => "$telephone_number",
						"email" => "$email"							
					);
					$db_staff->add($array1);
					
					$array2 = array(
					"user_id" => "$user_id",
					"account_type" => "staff",
					"student_id" => "",
					"admin_id" => "",
					"parent_id" => "",
					"teacher_id" => "",
					"staff_id" => "$staff_id",
					"developer_id" => "",
					"username" => "$username",
					"password" => "$password",
					"photo_url" => "",
					"create_month" => "$create_month",
					"create_day" => "$create_day",
					"create_year" => "$create_year",
					"create_hour" => "$create_hour",
					"create_minute" => "$create_minute"
					);
					
					$db_account->add($array2);
					echo "Staff Added Successfully. Staff ID no. is $staff_id";
					break;
			
				case("developer"):
					$developer_id = rand(1000000000,9999999999);
					$array1 = array(
						"developer_id" => "$developer_id",
						"first_name" => "$first_name",
						"middle_name" => "$middle_name",
						"last_name" => "$last_name",
						"suffix_name" => "$suffix_name",
						"gender" => "$gender",
						"birth_month" => "$birth_month",
						"birth_day" => "$birth_day",
						"birth_year" => "$birth_year",
						"birth_place" => "$birth_place",
						"address" => "$address",
						"city" => "$city",
						"country" => "$country",
						"mobile_number" => "$mobile_number",
						"telephone_number" => "$telephone_number",
						"email" => "$email"							
					);
					$db_developer->add($array1);
					
					$array2 = array(
					"user_id" => "$user_id",
					"account_type" => "developer",
					"student_id" => "",
					"admin_id" => "",
					"parent_id" => "",
					"teacher_id" => "",
					"staff_id" => "",
					"developer_id" => "$developer_id",
					"username" => "$username",
					"password" => "$password",
					"photo_url" => "",
					"create_month" => "$create_month",
					"create_day" => "$create_day",
					"create_year" => "$create_year",
					"create_hour" => "$create_hour",
					"create_minute" => "$create_minute"
					);
					
					$db_account->add($array2);
					echo "Developer Added Successfully. Developer ID no. is $developer_id";
					break;
			}
			
		}
	} else {
		echo "Username is already registered.";
	}
}
?>