<?php
// Generate ID
$user_id = uniqid();

// Get date and time
$create_month = date("M");
$create_day = date("d");
$create_year = date("Y");
$create_hour = date("H");
$create_minute = date("i");

// Check for empty vars
if(!isset($account_type)) $account_type = "student";
if(!isset($student_id)) $student_id = "";
if(!isset($admin_id)) $admin_id = "";
if(!isset($parent_id)) $parent_id = "";
if(!isset($teacher_id)) $teacher_id = "";
if(!isset($staff_id)) $staff_id = "";
if(!isset($developer_id)) $developer_id = "";

// Construct Array
$add_user_array = array(
    "user_id" => "$user_id",
    "account_type" => "$account_type",
    "student_id" => "$student_id",
    "admin_id" => "$admin_id",
    "parent_id" => "$parent_id",
    "teacher_id" => "$teacher_id",
    "staff_id" => "$staff_id",
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

// Add to DB
$db_account->add($add_user_array);

?>