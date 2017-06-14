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
	
	$db_account = new DBase("account", "../../_store");
	$db_student = new DBase("student", "../../_store");
	$db_enroll = new DBase("student_class", "../../_store");
	$db_class = new DBase("class", "../../_store");
	$db_notification = new DBase("notification", "../../_store");
				$notif_id = uniqid();
				$create_month = date("M");
				$create_day = date("d");
				$create_year = date("Y");
				$create_time = date("h:i a");

	
	$enroll_id = $_POST['enroll_id'];
	$first_quarter_grade = $_POST['first_quarter_grade'];
	$second_quarter_grade = $_POST['second_quarter_grade'];
	$third_quarter_grade = $_POST['third_quarter_grade'];
	$fourth_quarter_grade = $_POST['fourth_quarter_grade'];
	$final_grade = $_POST['final_grade'];
	
	$db_enroll->to("first_quarter_grade", "$first_quarter_grade", "enroll_id", "$enroll_id");
	$db_enroll->to("second_quarter_grade", "$second_quarter_grade", "enroll_id", "$enroll_id");
	$db_enroll->to("third_quarter_grade", "$third_quarter_grade", "enroll_id", "$enroll_id");
	$db_enroll->to("fourth_quarter_grade", "$fourth_quarter_grade", "enroll_id", "$enroll_id");
	$db_enroll->to("final_grade", "$final_grade", "enroll_id", "$enroll_id");

	$student_id = $db_enroll->get("student_id", "enroll_id", "$enroll_id");	
	$first_name = $db_student->get("first_name", "student_id", "$student_id");
	$last_name = $db_student->get("last_name", "student_id", "$student_id");
	$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");


	$class_id = $db_enroll->get("class_id", "enroll_id", "$enroll_id");
	$class_title = $db_class->get("class_title", "class_id", "$class_id");	
	$user_id = $db_account->get("user_id", "student_id", "$student_id");
	$n_a = array(
					"notification_id" => "$notif_id",
					"notification_title" => "$class_title grade has been encoded",
					"notification_content" => "Your grade for $class_title is ready to be viewed.",
					"photo_url" => "",
					"notification_url" => "",
					"notification_icon" => "assessment",
					"user_id" => "$user_id",
					"sender_alternative" => "Registrar",
					"sender_id" => "",
					"create_month" => "$create_month",
					"create_day" => "$create_day",
					"create_year" => "$create_year",
					"create_time" => "$create_time"
				);
				$db_notification->add($n_a);
	
	echo "Grades of $first_name $last_name $suffix_name has been encoded successfully!";
?>