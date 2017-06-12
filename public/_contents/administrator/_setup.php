<?php
session_start();
include("../../_system/config.php");
include("../../_system/database/db.php");
$account_type = $_SESSION['account_type'];
$user_id = $_SESSION['user_id'];
$db_account = new DBase("account","../../_store");
$db_student = new DBase("student","../../_store");
$db_teacher = new DBase("teacher","../../_store");
$db_class = new DBase("class","../../_store");
$db_enroll = new DBase("student_class", "../../_store");
$db_schooldata = new DBase("school_data", "../../_store");
$db_hold = new DBase("student_hold", "../../_store");
$admin_id = $db_account->get("admin_id", "user_id", "$user_id");
?>