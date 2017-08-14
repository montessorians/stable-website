<?php
// Start Session
session_start();

// Declare Permission Level
$perm = 3;
require_once("../../_system/secure.php");

// Include Database File
include("../_require/db.php");

// Set Sender
    $user_id = $_SESSION['user_id'];

// Handle Post Data
$post_id = $_REQUEST['post_id'];
$comment_body = strip_tags($_REQUEST['comment_body']);

// Check if Post ID is null
if(empty(post_id)){
    echo "Empty Post ID";
    $do = False;
} else {
    $check_post_existence = $db_post->get("post_id", "post_id", "$post_id");
    if(!check_post_existence){
        echo "Cannot add comment. Post doesn't exist.";
        $do = False;
    } else {
        $do = True;
    }
}

// Check if Comment Body is null
if(empty($comment_body)){
    echo "You cannot post an empty comment";
    $do = False;
} else {
    $do = True;
}

// Check if we can proceed
if($do == True){

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

} else {
    echo "An error occured";
}
?>