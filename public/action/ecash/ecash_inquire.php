<?php
/*
Returns the Current Balance of a user
*/
session_start();
include("../_require/db.php");
if(empty($_REQUEST['user_id'])){
    echo "0";
} else {
    $user_id = $_REQUEST['user_id'];
    $current_balance = $db_ecash->get("current_balance","user_id", "$user_id");
    echo $current_balance;
}
?>