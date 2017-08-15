<?php
/*
Returns the Current Balance of a user
*/
session_start();

// Declare Permission Level
$perm = 3;
require_once("../../_system/secure.php");

include("../_require/db.php");
if(empty($_REQUEST['user_id'])){
    echo "0";
} else {
    $user_id = $_REQUEST['user_id'];
    $current_balance = $db_ecash->get("current_balance","user_id", "$user_id");
    if(!$current_balance) $current_balance = "0.00";
    echo $current_balance;
}
?>