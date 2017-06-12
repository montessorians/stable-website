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
	
	$db_schooldata = new DBase("school_data", "../../_store");
	
	$school_year = $_POST['school_year'];
	$quarter = $_POST['quarter'];
	$exam_week = $_POST['exam_week'];
	$grade_encode = $_POST['grade_encode'];
	$enrollment = $_POST['enrollment'];
	
	$school_id = $db_schooldata->get("school_id", "school_id", "1");
	if(empty($school_id)){
		
		$array = array(
			"school_id" => "1",
			"school_year" => "$school_year",
			"quarter" => "$quarter",
			"exam_week" => "$exam_week",
			"grade_encode" => "$grade_encode",
			"enrollment" => "$enrollment"
		);
		$db_schooldata->add($array);
		echo "School data added successfully";
	} else {
		
		$index = $db_schooldata->index("school_id", "1");
		$array = array(
			"school_id" => "1",
			"school_year" => "$school_year",
			"quarter" => "$quarter",
			"exam_week" => "$exam_week",
			"grade_encode" => "$grade_encode",
			"enrollment" => "$enrollment"
		);
		$db_schooldata->update($index, $array);
		echo "School data updated successfully";
		
	}
?>