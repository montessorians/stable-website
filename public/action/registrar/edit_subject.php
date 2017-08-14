<?php
session_start();

// Declare Permission Level
$perm = 5;
require_once("../../_system/secure.php");

include("../_require/db.php");

$db_subject = new DBase("subject", "../../_store");

$subject_id = $_POST['subject_id'];
$subject_title = $_POST['subject_title'];
$subject_description = $_POST['subject_description'];
$grade = $_POST['grade'];
$subject_code = $_POST['subject_code'];
$units = $_POST['units'];

$proceed = 0;
if(!$subject_id){
    echo "Empty Subject ID";
} else {
    if(!$subject_title){
        echo "Empty Subject Title";
    } else {
        if(!$grade){
            echo "Empty Grade";
        } else {
            $proceed = 1;
        }
    }
}

if($proceed===1){
    $array = array(
        "subject_id"=>"$subject_id",
        "subject_title"=>"$subject_title",
        "subject_description"=>"$subject_description",
        "grade"=>"$grade",
        "subject_code"=>"$subject_code",
        "units"=>"$units"
    ); 
    $index = $db_subject->index("subject_id","$subject_id");
    $db_subject->update($index,$array);
    echo "$subject_title ($subject_id) has been edited successfully!";
}
?>