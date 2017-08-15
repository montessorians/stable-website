<?php
/*
Holy Child Montessori
2017

Delete Post
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 5;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Handle sent data
$post_id = $_REQUEST['post_id'];

// Get index
$index = $db_post->index("post_id", "$post_id");

// Remove from DB
$db_post->rm($index);

// Query for comments 
$comment_array = $db_comment->where(array("comment_id"),"post_id","$post_id");

// Do something if array not empty
if(!empty($comment_array)){

	// Loop along 
	foreach($comment_array as $comment){

		// Handle Comment ID
		$comment_id = $comment['comment_id'];

		// Get Index
		$index = $db_comment->index("comment_id", "$comment_id");

		// Remove from DB
		$db_comment->rm($index);

	}

}

// Get referer
$ref = $_SERVER['HTTP_REFERER'];

// Redirect
header("Location: $ref");

?>