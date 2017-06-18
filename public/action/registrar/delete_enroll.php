<?php
session_start();

include("../../_system/database/db.php");
$db_studentclass = new DBase("student_class", "../../_store");

if(empty($_SERVER[HTTP_REFERER])){
    $from = "../../";
} else {
    $from = $_SERVER['HTTP_REFERER'];
}

if(empty($_SESSION['logged_in'])){
    header("Location: $from");
}
if($_SESSION['account_type']==="admin"){
} else {
    header("Location: $from");
}
if(empty($_REQUEST['enroll_id'])){
    header("Location: $from");
} else {
    $enroll_id = $_REQUEST['enroll_id'];
}

$check = $db_studentclass->get("enroll_id", "enroll_id", "$enroll_id");
if(empty($check)){
    header("Location: $from");
} else {
    $index = $db_studentclass->index("enroll_id", "$enroll_id");
    $db_studentclass->rm($index);
    header("Location: $from");
}

?>