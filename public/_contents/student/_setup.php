<?php
session_start();
include("../../_system/config.php");
include("../../_system/database/db.php");
$account_type = $_SESSION['account_type'];
$user_id = $_SESSION['user_id'];
$db_account = new DBase("account","../../_store");
$db_student = new DBase("student","../../_store");
$db_admin = new DBase("admin","../../_store");
$db_schooldata = new DBase("school_data","../../_store");
$db_ecash = new DBase("ecash", "../../_store");
$db_transaction = new DBase("ecash_transaction", "../../_store");
$db_teacher = new DBase("teacher","../../_store");
$db_parent = new DBase("parent","../../_store");
$db_parentchild = new DBase("parentchild","../../_store");
$db_class = new DBase("class","../../_store");
$db_enroll = new DBase("student_class", "../../_store");
$db_attendance = new DBase("student_attendance", "../../_store");
$db_schooldata = new DBase("school_data", "../../_store");
$db_hold = new DBase("student_hold", "../../_store");
$student_id = $db_account->get("student_id", "user_id", "$user_id");
$current_sy = $db_schooldata->get("school_year", "school_id", "1");
?>