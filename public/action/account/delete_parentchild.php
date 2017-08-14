<?php
session_start();

// Declare Permission Level
$perm = 5;
require_once("../../_system/secure.php");

include("../_require/db.php");
$parentchild_id = $_REQUEST['parentchild_id'];
$index = $db_parentchild->index("parentchild_id", "$parentchild_id");
$db_parentchild->rm($index);
$ref = $_SERVER['HTTP_REFERER'];
header("Location: $ref");
?>