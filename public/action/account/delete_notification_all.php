<?php
// Deletes all Notification from the Logged In User
session_start();
if(empty($_SESSION['logged_in'])){
	header("Location: ../../");
}

include("../../_system/database/db.php");
$db_notification = new DBase("notification", "../../_store");
$user_id = $_SESSION['user_id'];
$notif_array = $db_notification->where(array("notification_id"), "user_id", "$user_id");

foreach($notif_array as $key){
	foreach($key as $notification_id){
			$index = $db_notification->index("notification_id", "$notification_id");
			$db_notification->rm($index);
	}
}
echo "ok";
?>