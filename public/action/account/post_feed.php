<?php
session_start();
if(empty($_SESSION['logged_in'])){
	header("Location: ../../");
}
include("../../_system/database/db.php");

$db_post = new DBase("post", "../../_store");

$post_id = uniqid();
$user_id = $_SESSION['user_id'];
$post_title = $_POST['post_title'];
$post_content = $_POST['post_content'];
$photo_url = $_POST['photo_url'];
$create_month = date("M");
$create_day = date("d");
$create_year = date("Y");
$create_time = date("h:i a");

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
$db_post->add($array);
echo "Post added successfully!";

?>