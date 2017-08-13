<?php
session_start();
include("../_require/db.php");

$student_id = $_POST['student_id'];

$student_id = $db_student->get("student_id", "student_id", "$student_id");

if(empty($student_id)){

	echo "
	<br>
	<center>
		<h5 class='red-text'>Student Not Found!</h5>
		<br>
	</center>
	";
	
} else {

$user_id = $db_account->get("user_id", "student_id", "$student_id");
$photo_url = $db_account->get("photo_url", "student_id", "$student_id");
$first_name = $db_student->get("first_name", "student_id", "$student_id");
$last_name = $db_student->get("last_name", "student_id", "$student_id");
$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
$grade = $db_student->get("grade", "student_id", "$student_id");
$section = $db_student->get("section", "student_id", "$student_id");
$time = date("H:i:s");
$date = date("M-d-Y");
$dump_id = uniqid();

$check = $db_dump->get("student_id", "date", "$date");
if(empty($check)){
$ar = array(
"dump_id" => "$dump_id",
"student_id" => "$student_id",
"date" => "$date",
"time" => "$time"
);

$db_dump->add($ar);	
$time = date("h:i a", strtotime($time));
$msg = "Student attendance recorded successfully! $date - $time";

} else {
	$msg = "Student attendance already recorded.";	
}


if(empty($photo_url)){
	$img = "<center>No Image Available</center>";
}else{
	$img = "<br><img src='../$photo_url' class='responsive-img' width='300px'>";
}

echo "

	<div class='row'>
	
		<div class='col s6'>
				<h5><strong>$first_name $last_name $suffix_name</strong></h5>
				<p>
					<font size='4pt'>$grade - $section<br>
						$student_id<br>
						<br>
						<br>
					</font>
					<p><b>$msg</b></p>
				</p>
		</div>
		<div class='col s6'>
			$img
		</div>
	
	</div>
<br>
";


	
}						


?>