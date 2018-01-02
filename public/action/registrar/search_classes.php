<?php
/*
Holy Child Montessori
2017

Search Classes
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 4;

// Require Secure File
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Request Post Data
$query = $_POST['query'];
$searchBy = $_POST['searchBy'];

// Check if query is empty
if(empty($query)){

	$r = $db_class->select(array());

} else {

	switch($searchBy){

		case("subject_title"):
			$query = $db_subject->get("subject_id","$searchBy","$query");
			$searchBy = "subject_title";
			$r = $db_class->like(array(), "$searchBy", "/.*$query/");
			break;

		case("grade"):
			$query = $db_subject->get("subject_id","$searchBy","$query");
			$searchBy = "subject_title";
			$r = $db_class->like(array(), "$searchBy", "/.*$query/");
			break;
		
		default:
			$r = $db_class->like(array(), "$searchBy", "/.*$query/");
			break;
	}

}

// Check if empty result
if(empty($r)){

	echo "
	<div class='card'>
		<div class='card-content'>
			<center>No results found for $query</center>
		</div>
	</div>";

} else {

	// loop along data
	foreach($r as $class){
		
		$class_id = $class['class_id'];
		$subject_id = $class['subject_id'];
		$school_year = $class['school_year'];
		$section = $class['section'];
		$class_code = $class['class_code'];
		$class_room = $class['class_room'];
		$access_code = $class['access_code'];
		$teacher_id = $class['teacher_id'];
		$start_time = $class['start_time'];
		$schedule = $class['schedule'];
		$end_time = $class['end_time'];
		$max_students = $class['max_students'];

		$subject_info = $db_subject->where(array(),"subject_id",$subject_id);
		foreach($subject_info as $subject){
			$subject_title = $subject['subject_title'];
			$subject_description = $subject['subject_description'];
			$grade = $subject['grade'];
			$units = $subject['units'];
			$subject_code = $subject['subject_code'];
		}

		$teacher_info = $db_teacher->where(array(),"subject_id",$subject_id);
		foreach($teacher_info as $teacher){
			$first_name = $teacher['first_name'];
			$last_name = $teacher['last_name'];
			$suffix_name = $teacher['suffix_name'];
		}

		echo "			
		<div class='card'>
			<div class='card-content'>
				<b>$subject_title</b> $subject_code<br>
				<p>
					$subject_description<br>
					School Year: $school_year<br>
					Grade/Section: $grade - $section<br>
					Classroom: $class_room<br>
					Access Code: $access_code<br>
					Teacher: $first_name $last_name $suffix_name ($teacher_id)<br>
					Schedule: $start_time - $end_time ($schedule)<br>
					Units: $units<br>
					Max. Students: $max_students
				</p>
				<p><font size='4'>$class_id</font></p>
			</div>
			<div class='card-action'>
				<a class='green-text' href='/query/registrar/class.php?class_id=$class_id'>View Class & Enrollees</a>
				<a class='green-text' href='/forms/registrar/encode_grades.php?class_id=$class_id'>Encode/View Grades</a>
				<a class='green-text' href='/forms/registrar/enroll_class.php?class_id=$class_id'>Enroll Student</a>
				<a class='green-text' href='/forms/registrar/enroll_teacher.php?class_id=$class_id'>Assign Teacher</a>
				<a class='green-text' href='/forms/registrar/create_class.php?class_id=$class_id'>Edit Class</a>
			</div>
		</div>";

	}
				
}

?>