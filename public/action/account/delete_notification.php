<?php
session_start();
if(empty($_SESSION['logged_in'])){
	header("Location: ../../");
}

include("../../_system/database/db.php");

$notification_id = $_REQUEST['notification_id'];

$db_notification = new DBase("notification", "../../_store");

	$index = $db_notification->index("notification_id", "$notification_id");
	$db_notification->rm($index);
	echo "ok";
?>