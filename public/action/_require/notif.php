<?php
/*
Holy Child Montessori
2017

Notification

General Template:
$notif_title = ;
$notif_content = ;
$notif_photo_url = ;
$notif_url = ;
$notif_icon = ;
$notif_user_id = ;
$notif_sender_alternative = ;
$notif_sender_id = ;

// Send Notification
include("../_require/notif.php");

*/

// Generate a Notification ID
$notif_id = uniqid();

// Get Current Date and Time
$notif_create_month = date("M");
$notif_create_day = date("d");
$notif_create_year = date("Y");
$notif_create_time = date("h:i a");

// Handle empty vars
if(!@$notif_title) $notif_title = "Untitled Notification";
if(!@$notif_content) $notif_content = "";
if(!@$notif_photo_url) $notif_photo_url = "";
if(!@$notif_url) $notif_url = "";
if(!@$notif_icon) $notif_icon = "";
if(!@$notif_user_id) $notif_user_id = "";
if(!@$notif_sender_alternative) $notif_sender_alternative = "";
if(!@$notif_sender_id) $notif_sender_id = "";

// Prepare Array
$notif_array = array(
    "notification_id" => "$notif_id",
	"notification_title" => "$notif_title",
	"notification_content" => "$notif_content",
	"photo_url" => "$notif_photo_url",
	"notification_url" => "$notif_url",
	"notification_icon" => "$notif_icon",
	"user_id" => "$notif_user_id",
	"sender_alternative" => "$notif_sender_alternative",
	"sender_id" => "$notif_sender_id",
	"create_month" => "$notif_create_month",
	"create_day" => "$notif_create_day",
	"create_year" => "$notif_create_year",
	"create_time" => "$notif_create_time"
);

// Add to Database
$db_notification->add($notif_array);
?>