<?php
// Start Session
session_start();

// Include Required Files
include("../../_system/config.php");
include("../../_system/database/db.php");

$loc = "../../_store";

// Set Account Type and User ID
$account_type = $_SESSION['account_type'];
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];


// Set all Databases
$db_schooldata = new DBase("school_data","$loc");

// General
$db_account = new DBase("account","$loc");
$db_notification = new DBase("notification","$loc");

// Accounts
$db_admin = new DBase("admin","$loc");
$db_student = new DBase("student","$loc");
$db_parent = new DBase("parent","$loc");
$db_teacher = new DBase("teacher","$loc");
$db_developer = new DBase("developer","$loc");
$db_staff = new DBase("staff","$loc");

// User
$db_hold = new DBase("student_hold","$loc");
$db_parentchild = new DBase("parentchild","$loc");
$db_ecash = new DBase("ecash","$loc");
$db_transaction = new DBase("ecash_transaction", "$loc");

// Class
$db_class = new DBase("class","$loc");
$db_subject = new DBase("subject",$loc);
$db_enroll = new DBase("student_class","$loc");
$db_attendance = new DBase("student_attendance","$loc");

// Create Switch for Account Type
switch($account_type){
    case("admin"):
        $admin_id = $db_account->get("admin_id", "user_id", "$user_id");
        break;
    case("student"):
        $student_id = $db_account->get("student_id", "user_id", "$user_id");
        break;
    case("teacher"):
        $teacher_id = $db_account->get("teacher_id", "user_id", "$user_id");
        break;
    case("parent"):
        $parent_id = $db_account->get("parent_id", "user_id", "$user_id");
        break;
    case("staff"):
        $staff_id = $db_account->get("staff_id", "user_id", "$user_id");
        break;
    case("developer"):
        $developer_id = $db_account->get("developer_id", "user_id", "$user_id");
}

// School Data
$current_sy = $db_schooldata->get("school_year", "school_id", "1");
$print_grades = $db_schooldata->get("print_grades", "school_id", "1");
$exam_week = $db_schooldata->get("exam_week", "school_id", "1");
$grade_encode = $db_schooldata->get("grade_encode", "school_id", "1");
$quarter = $db_schooldata->get("quarter", "school_id", "1");
?>