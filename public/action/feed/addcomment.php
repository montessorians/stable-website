<?php
/*
Holy Child Montessori
2017

Add Comment
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 3;

// Require Secure File
require_once("../../_system/secure.php");

// Include Database File
include("../_require/db.php");

// Set Sender
$user_id = $_SESSION['user_id'];

// Handle Post Data
$post_id = $_REQUEST['post_id'];
$comment_body = strip_tags($_REQUEST['comment_body']);

// Check if Post ID is null
if(empty($post_id)) die("Empty Post ID");

// Query if post id exists
$check_post_existence = $db_post->get("post_id", "post_id", "$post_id");
if(empty($check_post_existence)) die("Cannot add comment. Post doesn't exist.");

// Check if Comment Body is null
if(empty($comment_body)) die("You cannot post an empty comment");

// Generate random Comment ID
$comment_id = uniqid();

// Get Time
$date = date("M d, Y");
$time = date("h:i a");

// Create Array
$array = array(
    "comment_id" => "$comment_id",
    "post_id" => "$post_id",
    "user_id" => "$user_id",
    "comment_body" => "$comment_body",
    "date" => "$date",
    "time" => "$time"
);

// Add Array to Database
$db_comment->add($array);

echo "Comment has been added!";
?>