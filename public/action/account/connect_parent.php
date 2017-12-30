<?php
/*
Holy Child Montessori
2017

Check Username
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 5;

// Include Secure File
require_once("../../_system/secure.php");

// Include Database
include("../_require/db.php");

// Set inital values
$continue = 0;


// Do something if Parent ID is not empty
if(!empty($_REQUEST['parent_id'])){

	// Get Data
    $parent_id = $_REQUEST['parent_id'];
	// Query Parent ID in DB
    $parent_id_c = $db_parent->get("parent_id", "parent_id", "$parent_id");
	// Check if Parent ID exists
    if(!empty($parent_id_c)) $continue = 1;

}

// Do something if Student ID is not empty
if(!empty($_REQUEST['student_id'])){
	
	// Get Data
    $student_id = $_REQUEST['student_id'];
	// Query Student ID in DB
    $student_id_c = $db_student->get("student_id", "student_id", "$student_id");
	// Check if Student ID exists
    if(!empty($student_id_c)) $continue = 1;

}

// Declare Relation Var
$relation = "";
// Check if Relation Data exists
if(!empty($_REQUEST['relation'])) $relation = $_REQUEST['relation'];

// Do something if continue is set to 1
if($continue == 1){

// Generate Unique ID for ParentChild 
$parentchild_id = uniqid();

// Get Date and Time
$date = date("M-d-Y");
$time = date("H:i:s");

// Prepare Array
$array = array(
    "parentchild_id"=>"$parentchild_id",
    "parent_id" => "$parent_id",
    "student_id" => "$student_id",
	"relation" => "$relation",
    "date" => "$date",
    "time" => "$time"
   );

// Add Connection to DB
$db_parentchild->add($array);

// Query Name of Parent
$p_first_name = $db_parent->get("first_name", "parent_id", "$parent_id");
$p_last_name = $db_parent->get("last_name", "parent_id", "$parent_id");

// Query Name of Student
$s_first_name = $db_student->get("first_name", "student_id", "$student_id");
$s_last_name = $db_student->get("last_name", "student_id", "$student_id");

/*
Student Notif
*/

// Get Student ID
$user_id = $db_account->get("user_id", "student_id", "$student_id");

// Set Content
$notif_title = "A parent has been connected to your account";
$notif_content = "$p_first_name $p_last_name can now see all of your progress and manage your account!";
$notif_icon = "group";
$notif_user_id = "$user_id";
$notif_sender_alternative = "HCM Accounts";

// Send Notif
include("../_require/notif.php");

/*
Parent Notif
*/

// Get Parent ID
$user_id = $db_account->get("user_id", "parent_id", "$parent_id");

// Set Content
$notif_title = "Your child has been connected to your account";
$notif_content = "$s_first_name's grades & attendance can now be accessed from your account!";
$notif_icon = "group";
$notif_user_id = "$user_id";
$notif_sender_alternative = "HCM Accounts";

// Send Notif
include("../_require/notif.php");

echo "Parent and Student Added Successfully! ($p_first_name $p_last_name with $s_first_name $s_last_name)";

} else {

 echo "An error occured";

}


?>