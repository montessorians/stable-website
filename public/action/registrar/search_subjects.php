<?php
session_start();
include("../../_system/database/db.php");
$db_subject = new DBase("subject","../../_store");

$query = $_POST['query'];
$searchBy = $_POST['searchBy'];

if(!$query){
    $r = $db_subject->select(array());
} else {
    $r = $db_subject->like(array(), "$searchBy", "/.*$query/");
}

if(!$r){
    echo "
	<div class='card'>
		<div class='card-content'>
		    <center>No results found for $query</center>
		</div>
	</div>";
} else {
    foreach($r as $subject){
        $subject_id = $subject['subject_id'];
        $subject_title = $subject['subject_title'];
        $subject_description = $subject['subject_description'];
        $grade = $subject['grade'];
        $subject_code = $subject['subject_code'];
        $units = $subject['units'];

        echo "
        <div class='card'>
            <div class='card-content'>
                <b>$subject_title </b> $subject_code<br>
                <p>
                Description: $subject_description<br>
                Grade: $grade<br>
                Subject Code: $subject_code<br>
                Units: $units
                </p>
            </div>
            <div class='card-action'>
                <a class='green-text' href='../../forms/registrar/create_subject.php?subject_id=$subject_id'>Edit Subject</a>
                <a class='green-text' href='../../forms/registrar/create_class.php?subject_id=$subject_id'>Create Class</a>
            </div>
        </div>
        ";

    }
}

?>