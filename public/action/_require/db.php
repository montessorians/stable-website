<?php
// Include Required Files
include("../../_system/database/db.php");

$loc = "../../_store";


// Set all Databases
$db_schooldata = new DBase("school_data","$loc");

// General
$db_account = new DBase("account","$loc");
$db_notification = new DBase("notification","$loc");
$db_post = new DBase("post","$loc");
$db_postlikes = new DBase("post_likes","$loc");
$db_comment = new DBase("post_comment", "$loc");

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
$db_studentclass = new DBase("student_class", "$loc");
$db_attendance = new DBase("student_attendance","$loc");
$db_dump = new DBase("attendance_dump", "$loc");

?>