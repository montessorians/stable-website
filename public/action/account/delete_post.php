<?php
session_start();
if(empty($_SESSION['logged_in'])){
	header("Location: ../../");
}

include("../../_system/database/db.php");

$post_id = $_REQUEST['post_id'];

$db_post = new DBase("post", "../../_store");
$db_comment = new DBase("post_comment", "../../_store");

	$index = $db_post->index("post_id", "$post_id");
	$db_post->rm($index);

	$comment_array = $db_comment->where(array("comment_id"),"post_id","$post_id");
	if(empty($comment_array)){}else {
		foreach($comment_array as $comment){
			$comment_id = $comment['comment_id'];
			$index = $db_comment->index("comment_id", "$comment_id");
			$db_comment->rm($index);
		}
	}

	$ref = $_SERVER['HTTP_REFERER'];
	header("Location: $ref");
?>