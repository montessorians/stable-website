<?php
session_start();
if(empty($_SESSION['logged_in'])){
	header("Location: ../../");
}

include("../../_system/database/db.php");

$hold_id = $_REQUEST['hold_id'];

$db_hold = new DBase("student_hold", "../../_store");

	$index = $db_hold->index("hold_id", "$hold_id");
	$db_hold->rm($index);
?>