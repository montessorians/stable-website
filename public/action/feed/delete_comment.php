<?php
/*
Holy Child Montessori
2017

Delete Comment
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 3;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Comment ID
$comment_id = $_POST['comment_id'];

// Get Index
$index = $db_comment->index("comment_id", "$comment_id");

// Remove
$db_comment->rm($index);

echo "Comment Successfully Deleted";

?>