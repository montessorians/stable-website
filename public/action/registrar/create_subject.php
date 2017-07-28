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

$db_subject = new DBase("subject", "../../_store");

$subject_id = mt_rand(10000,99999);
$subject_title = $_POST['subject_title'];
$subject_description = $_POST['subject_description'];
$grade = $_POST['grade'];
$subject_code = $_POST['subject_code'];
$units = $_POST['units'];

$proceed = 0;

// Empty Checking
if(!$subject_title){
    echo "Empty Subject Title";
} else {
    if(!$grade){
        echo "Empty Grade";
    } else {
        $proceed = 1;
    }
}

if($proceed==1){
    $array = array(
        "subject_id"=>"$subject_id",
        "subject_title"=>"$subject_title",
        "subject_description"=>"$subject_description",
        "grade"=>"$grade",
        "subject_code"=>"$subject_code",
        "units"=>"$units"
    ); 
    $db_subject->add($array);
    echo "$subject_title added Successfully with Subject ID: $subject_id";
}
?>