<?php
/*
Holy Child Montessori
2017

Post Feed
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 5;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Generate ID
$post_id = uniqid();

// Get User ID from Current Session
$user_id = $_SESSION['user_id'];

// Get Post Data
$post_title = $_POST['post_title'];
$post_content = $_POST['post_content'];
$photo_url = $_POST['photo_url'];

// Get Date and Time
$create_month = date("M");
$create_day = date("d");
$create_year = date("Y");
$create_time = date("h:i a");

// Construct Array
$array = array(

	"post_id" => "$post_id",
	"user_id" => "$user_id",
	"post_title" => "$post_title",
	"post_content" => "$post_content",
	"photo_url" => "$photo_url",
	"create_month" => "$create_month",
	"create_day" => "$create_day",
	"create_year" => "$create_year",
	"create_time" => "$create_time"
);

// Add to DB
$db_post->add($array);

// Echo  msg
echo "Post added successfully!";

?>