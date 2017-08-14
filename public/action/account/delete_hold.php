<?php
session_start();

// Declare Permission Level
$perm = 5;
require_once("../../_system/secure.php");

include("../_require/db.php");

$hold_id = $_REQUEST['hold_id'];
$index = $db_hold->index("hold_id", "$hold_id");
$db_hold->rm($index);
?>