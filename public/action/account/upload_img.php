<?php
/*
Holy Child Montessori
2017

Upload Image

*/

/*
Temporarily disabled filetype checking. Recheck statement
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 3;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Handle Data
$user_id = $_REQUEST['user_id'];

// Check if Empty data sent
if(empty($user_id)){

	$msg = "User ID required";

} else {

	$check_uid = $db_account->get("user_id", "user_id", "$user_id");

	if(empty($check_uid)){

		$msg = "User ID not Found";

	} else {

		// Set vars
		$target_dir = "../../imgs/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$save = "imgs/" . basename($_FILES["fileToUpload"]["name"]);

		// Set init value
		$uploadOk = 1;

		// Get File Type
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
    		
			// Get File Size
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    		
			// Check if file has data
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

		// Check if $uploadOk is set to 0 by an error
		if (!$uploadOk == 0) {

			// Try to move uploaded file to target dir
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {

				// Query if old img exists
				$old_img = $db_account->get("photo_url","user_id","$user_id");

				// Remove old image if it exists
				if(!empty($old_img)) unlink("../../".$old_img);

				// Rewrite DB of new image
				$db_account->to("photo_url", "$save", "user_id", "$user_id");

				// Construct Notif
				$notif_title = "Your Display Photo has been uploaded";
				$notif_content = "Congratulations! You have a new display photo.";
				$notif_icon = "image";
				$notif_user_id = "$user_id";
				$notif_sender_alternative = "Montessori Accounts";

				// Send Notification
				include("../_require/notif.php");
	
		        $msg = "The image has been uploaded";

    		} else {

        		$msg = "Sorry, there was an error uploading your file.";

		    }
		}
					
	} // end of else

} // end of else (has data)

// Redirect User
header("Location: " . $_SERVER['HTTP_REFERER'] . "&?msg=$msg");

?>