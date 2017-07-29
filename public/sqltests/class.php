<?php
require('_connect.php');
require("../_system/database/db.php");

$db = new DBase("class","../_store");
$classes = $db->select(array());

foreach($classes as $class){
    $class_id = $class['class_id'];
    $subject_id = $class['subject_id'];
    $school_year = $class['school_year'];
    $section = $class['section'];
    $class_code = $class['class_code'];
    $class_room = $class['class_room'];
    $access_code = $class['access_code'];
    $teacher_id = $class['teacher_id'];
    $start_time = $class['start_time'];
    $end_time = $class['end_time'];
    $schedule = $class['schedule'];
    $max_students = $class['max_students'];

    $query = "INSERT INTO `class` (class_id,subject_id,school_year,section,class_code,class_room,access_code,teacher_id,start_time,end_time,schedule,max_students) VALUES ('$class_id','$subject_id','$school_year','$section','$class_code','$class_room','$access_code','$teacher_id','$start_time','$end_time','$schedule','$max_students')";
    if($mysqli->query($query)){
        echo "$class_id added successfully!<br>";
    } else {
        echo $mysqli->error . "<br>";
    }
}
echo "abc<br><br>";

$r = $mysqli->query("SELECT * FROM class");
while($entry = $r->fetch_assoc()){
    echo $entry['class_id'] . "<br>";
}
?>