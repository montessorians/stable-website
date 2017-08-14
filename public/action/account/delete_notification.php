<?php
session_start();

// Declare Permission Level
$perm = 3;
require_once("../../_system/secure.php");

include("../_require/db.php");

$notification_id = $_REQUEST['notification_id'];
$index = $db_notification->index("notification_id", "$notification_id");
$db_notification->rm($index);
echo "ok";
?>