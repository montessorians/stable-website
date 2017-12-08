<?php
/*
session_start();

$api_secret = "samplecode";

if(empty($_REQUEST['api_secret'])){
    $array = array(
        "code"=>"404",
        "message"=>"Access Denied"
    );
    header('Content-Type:application/json');
    die(json_encode($array));    
}

if($_REQUEST['api_secret']!=$api_secret){
    $array = array(
        "code"=>"404",
        "message"=>"Access Denied"
    );
    header('Content-Type:application/json');
    die(json_encode($array));
}

if(empty($_REQUEST['db'])){
    $array = array(
        "code"=>"501",
        "message"=>"Unknown DB"
    );
    header('Content-Type:application/json');
    die(json_encode($array));
}

include("../../_system/database/db.php");

$db_selected = $_REQUEST['db'];

$db = new DBase("$db_selected","../../_store");
$result = $db->select();
if(empty($result)) $result = array("");

header('Content-Type:application/json');
echo(json_encode($result));
*/
?>