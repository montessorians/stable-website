<?php
session_start();
if(empty($_SESSION['logged_in'])){
	header("Location: ../../");
}

include("../../_system/database/db.php");

$post_id = $_REQUEST['post_id'];

$db_post = new DBase("post", "../../_store");

	$index = $db_post->index("post_id", "$post_id");
	$db_post->rm($index);
	$ref = $_SERVER['HTTP_REFERER'];
	header("Location: $ref");
?>