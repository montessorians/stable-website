<?php
// Start Session
session_start();

// Declare Permission Level
$perm = 3;
require_once("../../_system/secure.php");

// Object
include("../_require/db.php");

// Comment ID
$comment_id = $_POST['comment_id'];

$index = $db_comment->index("comment_id", "$comment_id");
$db_comment->rm($index);
echo "Comment Successfully Deleted";
?>