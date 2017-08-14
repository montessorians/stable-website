<?php
// Start Session
session_start();

// Declare Permission Level
$perm = 3;
require_once("../../_system/secure.php");

// Include Database File
include("../_require/db.php");

$do = False;

if(empty($_SESSION['user_id'])){
    $do = False;
} else {
    $user_id = $_SESSION['user_id'];
    $do = True;
}

if(empty($_REQUEST['post_id'])){
    $do = False;
} else {
    $post_id = $_REQUEST['post_id'];
    $do = True;
}

if($do === True){
    $check_post_exists = $db_post->get("post_id","post_id", "$post_id");
    if(empty($check_post_exists)){
    } else {

     $check_exists = $db_postlikes->where(array(), "post_id", "$post_id");
     $count = 0;
     if(empty($check_exists)){
         $count = 0;
     } else {
         foreach($check_exists as $like){
             $postlike_id = $like['postlike_id'];
             $user_id_now = $like['user_id'];
             if($user_id == $user_id_now){
                 $count = $count++;
                 $index = $db_postlikes->index("postlike_id", "$postlike_id");
                 $db_postlikes->rm($index);
             }
         }
     }

    }


    if(empty($count)){
        // Add
        $postlike_id = uniqid();
        $date = date("M d Y");
        $time = date("h:i a");
        $array = array(
            "postlike_id" => "$postlike_id",
            "user_id" => "$user_id",
            "post_id" => "$post_id",
            "date" => "$date",
            "time" => "$time"
        );
        $db_postlikes->add($array);
     }

}

?>