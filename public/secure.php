<?php
/*
Holy Child Montessori
2017

security.php
*/

// Logout User if they don't contain required security vars
if(!$_SESSION['user_ip']) header("Location: /account/logout/");
if(!$_SESSION['user_ua']) header("Location: /account/logout/");

// Get current IP and UA
$current_ip = $_SERVER['REMOTE_ADDR'];
$current_ua = $_SERVER['HTTP_USER_AGENT'];

// Check if security vars !== the current ip and ua
if($_SESSION['user_ip'] !== $current_ip){

    // Redirects user if registered ip and current ip doesn't match
    header("Location: /account/logout/");

} else {

    if($_SESSION['user_ua'] !== $current_ua){

        // Redirects user if registered ua and current ua doesn't match
        header("Location: /account/logout/");

    }

}

?>