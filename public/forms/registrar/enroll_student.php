<?php
session_start();
include("../../_system/secure.php");
	if(empty($_GET['from'])){
		if(empty($_SERVER['HTTP_REFERER'])){
			$from = "../../";
		} else {
			$from = $_SERVER['HTTP_REFERER'];
		}} else {
		$from = $_GET['from'];
	}
	if($_SESSION['account_type'] == "admin"){} else {
		if($_SESSION['account_type'] == "developer"){} else {
				header("Location: $from");
		}
	}
	
	include("../../_system/config.php");
	$activity_title = "Enroll a Student";
	include("../../_system/database/db.php");

$db_schooldata = new DBase("school_data", "../../_store");
$school_year = $db_schooldata->get("school_year", "school_id", "1");
$sy1 = (date("Y")-1)."-".date("Y"); 
$sy2 = date("Y")."-".(date("Y")+1);
if(empty($school_year)){
	$sy1_s = "";
	$sy2_s = "";
} else {
	switch($school_year){
		case($sy1):
			$sy1_s = "selected";
			$sy2_s = "";
			break;
		case($sy2):
			$sy1_s = "";
			$sy2_s = "selected";
			break;
	}
}


if(empty($_REQUEST['student_id'])){
	$student_id = "";
} else {
	$student_id = $_REQUEST['student_id'];
}
?>
<!Doctype html>
<html>
	<head>
		<title><?=$activity_title?> - <?=$site_title?></title>
		<?php
			include("../../_system/styles.php");
		?>
	</head>
	<body class="grey lighten-4">
		<nav class="<?=$primary_color?>">
		<a class="title"><?=$activity_title?></a>
		<a href="<?=$from?>" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
		</nav>
		<div class="container">
			<br><br>
			
			<div class="input-field">
				<input type="text" id="student_id" value="<?=$student_id?>">
				<label for="student_id">Student ID</label>
			</div>
			
			<div class="row">
			<div class="input-field col s6">
				<select id="grade" class="browser-default">
					<option disabled selected>Grade/Class Type</option>
					<?php
						$grade_array = array("Nursery 1", "Nursery 2", "Kindergarten 1", "Kindergarten 2", "Preparatory", "Grade 1", "Grade 2", "Grade 3", "Grade 4", "Grade 5", "Grade 6", "Grade 7", "Grade 8", "Grade 9", "Grade 10", "Grade 11", "Grade 12", "Tutorial", "Free Class", "Online Class", "Multilevel", "Training", "Seminar");
						foreach($grade_array as $grade){
							echo "
								<option value='$grade'>$grade</option>
							";
						}
					?>
				</select>
			</div>
			
			<div class="input-field col s6">
				<select class="browser-default" id="school_year">
					<option selected disabled>Current School Year</option>
					<option value="<?=$sy1?>" <?=$sy1_s?>><?=$sy1?></option>
					<option value="<?=$sy2?>" <?=$sy2_s?>><?=$sy2?></option>
				</select>	
			</div>
			<div class="input-field col s6">
				<input type="text" id="section">
				<label for="section">Section</label>
			</div>
			</div>
						
			<br><br>
			<button id="enrollButton" class="btn btn-large waves-effect waves-light <?=$accent_color?>">Enroll</button>
  		<span id="response" class="red-text"></span>
			
			<br><br><br><br><br>
		</div>
	</body>
</html>
<script type="text/javascript">
	
	$(document).ready().keypress(function(e){
		var key = e.which;
		if(key == 13){
			enroll();
		}
	});

	$("#enrollButton").click(function(){
		enroll();
	});
	
	function enroll(){
		var s_i = $("#student_id").val();
		var g = $("#grade").val();
		var s_y = $("#school_year").val();
		var s = $("#section").val();

		if(!s_i){
			$("#response").html("Student ID Required");
		} else {
			if(!g){
				$("#response").html("Grade Required");
			}else{
			if(!s_y){
				$("#response").html("School Year is Required");
			} else {
				
				$.ajax({
					type: 'POST',
					url: '../../action/registrar/enroll_student.php',
					data: {
						student_id: s_i,
						grade: g,
						school_year: s_y,
						section: s
					},
					cache: false,
					success: function(result){
						$("#response").html(result);
						$("#class_id").val("");
					}
				}).fail(function(){
					$("#response").html("Error connecting to server");
				});
				
			}
		}
		}
	}
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">