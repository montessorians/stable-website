<?php
// Start Session
session_start();
// Include Database File
include("../_require/db.php");

$do = False;

if(empty($_REQUEST['post_id'])){
    echo "no";
    $do = False;
} else {
    $post_id = $_REQUEST['post_id'];
    $do = True;
}

if(empty($_REQUEST['user_id'])){
    echo "no";
    $do = False;
} else {
    $user_id = $_REQUEST['user_id'];
    $do = True;
}

if($do === True){
    $check_liked = $db_postlikes->where(array("user_id"),"post_id", "$post_id");
    if(empty($check_liked)){
        echo "no";
    } else {

        $count = 0;

        foreach($check_liked as $user){
            $user_id_now = $user['user_id'];
            if($user_id === $user_id_now){
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