<?php
/*
Holy Child Montessori
2017
*/
// Start Session
session_start();

// Declare Permission Level
$perm = 3;

// Require Secure File
require_once("../../_system/secure.php");

// Include Database File
include("../_require/db.php");

// Set initial value
$do = False;

// Check if session not empty
if(!empty($_SESSION['user_id'])){

    $user_id = $_SESSION['user_id'];
    $do = True;

}

// Check if empty post id
if(empty($_REQUEST['post_id'])){

    $do = False;

} else {

    $post_id = $_REQUEST['post_id'];
    $do = True;

}

// Finally
if($do === True){

    //  Check if post exists by query
    $check_post_exists = $db_post->get("post_id","post_id", "$post_id");

    // Check if not empty
    if(!empty($check_post_exists)){

        // Get array
        $check_exists = $db_postlikes->where(array(), "post_id", "$post_id");

        // Set initial value
        $count = 0;

        // Check if empty 
        if(!empty($check_exists)){

            // Loop along array
            foreach($check_exists as $like){

                // Set val
                $postlike_id = $like['postlike_id'];
                $user_id_now = $like['user_id'];
                
                // Check if match w/ user ID
                if($user_id == $user_id_now){

                    // Increment if found
                    $count = $count++;

                    // Get ID
                    $index = $db_postlikes->index("postlike_id", "$postlike_id");

                    // Remove from DB
                    $db_postlikes->rm($index);
                
                }

            }

        }

    }


    // check if empty count
    if(empty($count)){

        // Generate a Unique ID
        $postlike_id = uniqid();

        // Get date and time
        $date = date("M d Y");
        $time = date("h:i a");

        // Construct Array
        $array = array(
            "postlike_id" => "$postlike_id",
            "user_id" => "$user_id",
            "post_id" => "$post_id",
            "date" => "$date",
            "time" => "$time"
        );

        // Add to DB
        $db_postlikes->add($array);

    }

}

?>