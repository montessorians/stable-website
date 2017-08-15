<?php
/*
Holy Child Montessori
2017

Edit User Information
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 3;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Get Data From Session
$user_id = $_SESSION['user_id'];
$account_type = $_SESSION['account_type'];

// Create obj for account type	
$db = new DBase("$account_type","$loc");

// Construct ID
$id_const = $account_type."_id";

// Query for ID using using acct type
$id = $db_account->get("$id_const", "user_id", "$user_id");

// Do something if not student
if(!$account_type == "student"){

	// Handle Post Data 
	$first_name = $_POST['first_name'];
	$middle_name = $_POST['middle_name'];
	$last_name = $_POST['last_name'];
	$suffix_name = $_POST['suffix_name'];

}

// Handle Post Data
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

// Check if acct type is not student
if(!$account_type=="student"){

	// Rewrite in DB
    $db->to("first_name", "$first_name", "$id_const", "$id");
    $db->to("middle_name", "$middle_name", "$id_const", "$id");
    $db->to("last_name", "$last_name", "$id_const", "$id");
    $db->to("suffix_name", "$suffix_name", "$id_const", "$id");

}

// Rewrite in DB
$db->to("gender", "gender", "$id_const", "$id");
$db->to("birth_month", "$birth_month", "$id_const", "$id");
$db->to("birth_day", "$birth_day", "$id_const", "$id");
$db->to("birth_year", "$birth_year", "$id_const", "$id");
$db->to("birth_place", "$birth_place", "$id_const", "$id");

$db->to("address", "$address", "$id_const", "$id");
$db->to("city", "$city", "$id_const", "$id");
$db->to("country", "$country", "$id_const", "$id");

$db->to("mobile_number", "$mobile_number", "$id_const", "$id");
$db->to("telephone_number", "$telephone_number", "$id_const", "$id");
$db->to("email", "$email", "$id_const", "$id");

// Echo ok
echo "ok";
?>