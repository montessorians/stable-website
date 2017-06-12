<?php
session_start();
include("../../_system/database/db.php");

$db_account = new DBase("account", "../../_store");
$db_notification = new DBase("notification", "../../_store");

$user_id = $_REQUEST['user_id'];

if(empty($user_id)){
	$msg = "User ID required";
} else {
	$check_uid = $db_account->get("user_id", "user_id", "$user_id");
	if(empty($check_uid)){
		$msg = "User ID not Found";
	} else {
		
		
$target_dir = "../../imgs/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$save = "imgs/" . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $msg = "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $msg = "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    $msg = "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    $msg = "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $msg = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    			
    	$db_account->to("photo_url", "$save", "user_id", "$user_id");
    				
    	$notif_id = rand(1000000000,9999999999);
				$create_month = date("M");
				$create_day = date("d");
				$create_year = date("Y");
				$create_time = date("h:i a");
	
	$n_a = array(
					"notification_id" => "$notif_id",
					"notification_title" => "Your Display Photo has been uploaded",
					"notification_content" => "Congratulations! You have a new display photo.",
					"photo_url" => "",
					"notification_url" => "",
					"notification_icon" => "image",
					"user_id" => "$user_id",
					"sender_alternative" => "Montessori Accounts",
					"sender_id" => "",
					"create_month" => "$create_month",
					"create_day" => "$create_day",
					"create_year" => "$create_year",
					"create_time" => "$create_time"
				);
				$db_notification->add($n_a);
    				
        $msg = "The image has been uploaded";
    } else {
        $msg = "Sorry, there was an error uploading your file.";
    }
}
				
		
	}//
}

header("Location: " . $_SERVER['HTTP_REFERER'] . "?msg=$msg");

?>