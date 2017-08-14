<?php
/*
Checks if user has enabled e-cash
Returns String yes or no
*/
session_start();

// Declare Permission Level
$perm = 3;
require_once("../../_system/secure.php");

include("../_require/db.php");

if(empty($_REQUEST['user_id'])){
    echo "no";
} else {
    $user_id = $_REQUEST['user_id'];
    $allow_ecash = $db_ecash->get("allow_ecash","user_id", "$user_id");
    echo $allow_ecash;
}
?>