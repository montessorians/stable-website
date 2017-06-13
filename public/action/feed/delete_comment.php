<?php
// Start Session
session_start();

// Object
include("../../_system/database/db.php");

// Create Object for Database
$db_comment = new DBase("post_comment", "../../_store");

// Comment ID
$comment_id = $_POST['comment_id'];

$index = $db_comment->index("comment_id", "$comment_id");
$db_comment->rm($index);
echo "Comment Successfully Deleted";
?>