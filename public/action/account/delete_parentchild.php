<?php
session_start();
if(empty($_SESSION['logged_in'])){
	header("Location: ../../");
}

include("../../_system/database/db.php");

$parentchild_id = $_REQUEST['parentchild_id'];

$db_parentchild = new DBase("parentchild", "../../_store");

	$index = $db_parentchild->index("parentchild_id", "$parentchild_id");
	$db_parentchild->rm($index);
	$ref = $_SERVER['HTTP_REFERER'];
	header("Location: $ref");
?>