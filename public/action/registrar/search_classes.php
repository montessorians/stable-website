<?php
session_start();
include("../../_system/database/db.php");
$db_class = new DBase("class", "../../_store");
$db_subject = new DBase("subject","../../_store");
$db_teacher = new DBase("teacher", "../../_store");

$query = $_POST['query'];
$searchBy = $_POST['searchBy'];

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

			if(empty($r)){
				echo "
					<div class='card'>
						<div class='card-content'>
							<center>No results found for $query</center>
						</div>
					</div>
				";
			} else {

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

					$subject_title = $db_subject->get("subject_title","subject_id","$subject_id");
					$subject_description = $db_subject->get("subject_description","subject_id","$subject_id");
					$grade = $db_subject->get("grade","subject_id","$subject_id");
					$units = $db_subject->get("units","subject_id","$subject_id");
					$subject_code = $db_subject->get("subject_code","subject_id","$subject_id");

					$first_name = $db_teacher->get("first_name", "teacher_id", "$teacher_id");
					$last_name = $db_teacher->get("last_name", "teacher_id", "$teacher_id");
					$suffix_name = $db_teacher->get("suffix_name", "teacher_id", "$teacher_id");

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
								<a class='green-text' href='../../query/registrar/class.php?class_id=$class_id'>View Class & Enrollees</a>
								<a class='green-text' href='../../forms/registrar/encode_grades.php?class_id=$class_id'>Encode/View Grades</a>
								<a class='green-text' href='../../forms/registrar/enroll_class.php?class_id=$class_id'>Enroll Student</a>
								<a class='green-text' href='../../forms/registrar/enroll_teacher.php?class_id=$class_id'>Assign Teacher</a>
								<a class='green-text' href='../../forms/registrar/create_class.php?class_id=$class_id'>Edit Class</a>
							</div>
						</div>
						
						";

				}
				
			}

?>