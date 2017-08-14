<?php
session_start();

// Declare Permission Level
$perm = 5;
require_once("../../_system/secure.php");

include("../_require/db.php");

$post_id = $_REQUEST['post_id'];

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