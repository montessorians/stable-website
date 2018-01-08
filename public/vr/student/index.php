<?php
session_start();
// Check if user is logged in
if(empty($_SESSION['logged_in'])){
    header("Location: ../../");
}

// Get Account Type
$account_type = $_SESSION['account_type'];

if($account_type !== "student") die("Unauthorized access");

include('../../action/_require/db.php');
/*
//  Get Student Info
$student_info_array = $db_student->where(array(),"student_id", "$student_id");

// Loop through student info
foreach($student_info_array as $student){

    $first_name = $student['first_name'];
    $middle_name = $student['middle_name'];
    $last_name = $student['last_name'];
    $suffix_name = $student['suffix_name'];

    $school_year = $student['school_year'];
    $student_lrn = $student['student_lrn'];
    $grade = $student['grade'];
    $section = $student['section'];

}

// Get grades (Array)
$grade_array = $db_enroll->where(array(),"student_id", "$student_id"); 

// Get attendance (Array)
$attendance_array = $db_attendance->where(array(),  "student_id", "$student_id");
*/
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>HCM Student VR</title>

    <script src="/assets/js/aframe.min.js" type="text/javascript"></script>
	<script src="https://rawgit.com/feiss/aframe-environment-component/master/dist/aframe-environment-component.min.js"></script>
	<script src="https://unpkg.com/aframe-animation-component/dist/aframe-animation-component.min.js"></script>
	<script src="https://unpkg.com/aframe-html-shader@0.2.0/dist/aframe-html-shader.min.js"></script>


</head>
<body>

    <a-scene>
		<a-assets>
			<img id="hcmlogo" src="/assets/imgs/logo.jpg">
		</a-assets>
		<a-entity environment="lighting:point; preset:forest"></a-entity>
		
		<a-text value="Hello, World!" position="5 2 3" rotation="3 0 0" scale="2 2 2" color="seagreen"></a-text>

		<!-- Logo -->
		<a-box
			src="#hcmlogo"
			position="0 2 -5"
			scale="2 2 2">
			    <a-animation attribute="position" to="0 2.2 -5" direction="alternate" dur="2000"
      repeat="indefinite"></a-animation>
		</a-box>

		<!-- Grade Box -->
		<a-box
			color="white"
			position="3 0 0"
			rotation="0 0 0"
			scale="1 8 5">
        </a-box>
        <a-text
            value="Hello World"
            position="0 2 -5"
            width="3">
        </a-text>

	</a-scene>

</body>
</html>