<?php
session_start();

// Declare Permission Level
$perm = 5;
require_once("../../_system/secure.php");

include("../_require/db.php");

$continue = 0;

if(empty($_REQUEST['parent_id'])){
} else {
    $parent_id = $_REQUEST['parent_id'];
    $parent_id_c = $db_parent->get("parent_id", "parent_id", "$parent_id");
    if(empty($parent_id_c)){
    } else {
        $continue = 1;
    }
}

if(empty($_REQUEST['student_id'])){
} else {
    $student_id = $_REQUEST['student_id'];
    $student_id_c = $db_student->get("student_id", "student_id", "$student_id");
    if(empty($student_id_c)){
    } else {
        $continue = 1;
    }
}

if(empty($_REQUEST['relation'])){
	$relation = '';
} else {
	$relation = $_REQUEST['relation'];
}

if($continue == 1){

$parentchild_id = uniqid();
$date = date("M-d-Y");
$time = date("H:i:s");

$array = array(
    "parentchild_id"=>"$parentchild_id",
    "parent_id" => "$parent_id",
    "student_id" => "$student_id",
	"relation" => "$relation",
    "date" => "$date",
    "time" => "$time"
   );
$db_parentchild->add($array);

// GET VALUES
$p_first_name = $db_parent->get("first_name", "parent_id", "$parent_id");
$p_last_name = $db_parent->get("last_name", "parent_id", "$parent_id");

$s_first_name = $db_student->get("first_name", "student_id", "$student_id");
$s_last_name = $db_student->get("last_name", "student_id", "$student_id");

// Student Notif
$user_id = $db_account->get("user_id", "student_id", "$student_id");
$notif_id = uniqid();
				$create_month = date("M");
				$create_day = date("d");
				$create_year = date("Y");
				$create_time = date("h:i a");
$n_a = array(
					"notification_id" => "$notif_id",
					"notification_title" => "A parent has been connected to your account",
					"notification_content" => "$p_first_name $p_last_name can now see all of your progress and manage your account!",
					"photo_url" => "",
					"notification_url" => "",
					"notification_icon" => "group",
					"user_id" => "$user_id",
					"sender_alternative" => "HCM Accounts",
					"sender_id" => "",
					"create_month" => "$create_month",
					"create_day" => "$create_day",
					"create_year" => "$create_year",
					"create_time" => "$create_time"
				);
				$db_notification->add($n_a);

$user_id = $db_account->get("user_id", "parent_id", "$parent_id");
$notif_id = uniqid();
				$create_month = date("M");
				$create_day = date("d");
				$create_year = date("Y");
				$create_time = date("h:i a");
$n_a = array(
					"notification_id" => "$notif_id",
					"notification_title" => "Your child has been connected to your account",
					"notification_content" => "$s_first_name's grades & attendance can now be accessed from your account!",
					"photo_url" => "",
					"notification_url" => "",
					"notification_icon" => "group",
					"user_id" => "$user_id",
					"sender_alternative" => "HCM Accounts",
					"sender_id" => "",
					"create_month" => "$create_month",
					"create_day" => "$create_day",
					"create_year" => "$create_year",
					"create_time" => "$create_time"
				);
				$db_notification->add($n_a);
    
    echo "Parent and Student Added Successfully! ($p_first_name $p_last_name with $s_first_name $s_last_name)";

} else {
 echo "An error occured";
}


?>