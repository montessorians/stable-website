<?php
session_start();
include("../../_system/database/db.php");
$db_class = new DBase("class", "../../_store");
$db_teacher = new DBase("teacher", "../../_store");

$query = $_POST['query'];
$searchBy = $_POST['searchBy'];

if(empty($query)){
	$r = $db_class->select(array("class_id"));
} else {	
	$r = $db_class->like(array("class_id"), "$searchBy", "/.*$query/");
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
				
				foreach($r as $key){
					foreach($key as $class_id){
						$class_title = $db_class->get("class_title", "class_id", "$class_id");
						$class_description = $db_class->get("class_description", "class_id", "$class_id");
						$school_year = $db_class->get("school_year", "class_id", "$class_id");
						$grade = $db_class->get("grade", "class_id", "$class_id");
						$section = $db_class->get("section", "class_id", "$class_id");
						$class_code = $db_class->get("class_code", "class_id", "$class_id");
						$class_room = $db_class->get("class_room", "class_id", "$class_id");
						$access_code = $db_class->get("access_code", "class_id", "$class_id");
						$teacher_id = $db_class->get("teacher_id", "class_id", "$class_id");
						$first_name = $db_teacher->get("first_name", "teacher_id", "$teacher_id");
						$last_name = $db_teacher->get("last_name", "teacher_id", "$teacher_id");
						$suffix_name = $db_teacher->get("suffix_name", "teacher_id", "$teacher_id");
						$start_time = $db_class->get("start_time", "class_id", "$class_id");
						$end_time = $db_class->get("end_time", "class_id", "$class_id");
						$schedule = $db_class->get("schedule", "class_id", "$class_id");
						$units = $db_class->get("units", "class_id", "$class_id");
						
						echo "
						
						<div class='card'>
							<div class='card-content'>
								<b>$class_title</b> $class_code<br>
								<p>
								$class_description<br>
								School Year: $school_year<br>
								Grade/Section: $grade - $section<br>
								Classroom: $class_room<br>
								Access Code: $access_code<br>
								Teacher: $first_name $last_name $suffix_name ($teacher_id)<br>
								Schedule: $start_time - $end_time ($schedule)<br>
								Units: $units
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
				
			}

?>