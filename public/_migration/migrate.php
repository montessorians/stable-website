<?php
session_start();
include("../_system/database/db.php");
$db_class = new DBase('class','../_store');
$db_class_migrate = new DBase('class_migrate','../_store');
$db_subject = new DBase('subject','../_store');
$classes = $db_class->select(array());

foreach($classes as $class){
    $class_id = $class['class_id'];
    $class_title = $class['class_title'];
    $class_description = $class['class_description'];
	$school_year = $class['school_year'];
    $grade = $class['grade'];
	$section = $class['section'];
	$class_code = $class['class_code'];
	$class_room = $class['class_room'];
	$access_code = $class['access_code'];
	$teacher_id = $class['teacher_id'];
	$start_time = $class['start_time'];
    $end_time = $class['end_time'];
	$schedule = $class['schedule'];
    $units = $class['units'];

    $subject_id = mt_rand(10000,99999);

    $a_class = array(
    "class_id" => "$class_id",
	"subject_id" => "$subject_id",
	"school_year" => "$school_year",
	"section" => "$section",
	"class_code" => "$class_code",
	"class_room" => "$class_room",
	"access_code" => "$access_code",
	"teacher_id" => "$teacher_id",
	"start_time" => "$start_time",
	"end_time" => "$end_time",
	"schedule" => "$schedule",
	"max_students" => ""
    );
    $a_subject = array(
        "subject_id"=>"$subject_id",
        "subject_title"=>"$class_title",
        "subject_description"=>"$class_description",
        "grade"=>"$grade",
        "subject_code"=>"",
        "units"=>"$units"
    ); 
    $db_class_migrate->add($a_class);
    $db_subject->add($a_subject);
    echo "Migrated $class_title ($class_id)<br>";
}

?>