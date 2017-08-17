<?php
/*
Holy Child Montessori
2017

Check Liked
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 3;

// Require Secure File
require_once("../../_system/secure.php");

// Include Database File
include("../_require/db.php");

// Initialize var
$do = False;

// Check if empty data sent
if(empty($_REQUEST['post_id'])){

    echo "no";
    $do = False;

} else {

    // Handle data
    $post_id = $_REQUEST['post_id'];
    $do = True;

}

// Check for Uid
if(empty($_REQUEST['user_id'])){

    echo "no";
    $do = False;

} else {

    $user_id = $_REQUEST['user_id'];
    $do = True;

}

if($do === True){

    // Query for likes
    $check_liked = $db_postlikes->where(array("user_id"),"post_id", "$post_id");

    if(empty($check_liked)){

        echo "no";

    } else {

        $count = 0;

        // Loop along
        foreach($check_liked as $user){

            // Get uid
            $user_id_now = $user['user_id'];

            // Check if match
            if($user_id === $user_id_now){
                
                // Add to count
                $count = $count+1;

            }

        }

        if($count === 0){

            echo "no";

        } else {

            echo "yes";

        }

    }
}

?>