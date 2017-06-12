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
	include("../../_system/database/db.php");
	include("../../_system/config.php");
	$activity_title = "Set School Data";
$db_schooldata = new DBase("school_data", "../../_store");
$school_year = $db_schooldata->get("school_year", "school_id", "1");
$quarter = $db_schooldata->get("quarter", "school_id", "1");
$exam_week = $db_schooldata->get("exam_week", "school_id", "1");
$grade_encode = $db_schooldata->get("grade_encode", "school_id", "1");
$enrollment = $db_schooldata->get("enrollment", "school_id", "1");

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

if(empty($quarter)){
	$q1_s = "";
	$q2_s = "";
	$q3_s = "";
	$q4_s = "";
	$qs_s = "";
	$qe_s = "";
} else {
	$q1_s = "";
	$q2_s = "";
	$q3_s = "";
	$q4_s = "";
	$qs_s = "";
	$qe_s = "";
	switch($quarter){
		case("1st Quarter"):
			$q1_s = "selected";
			break;
		case("2nd Quarter"):
			$q2_s = "selected";
			break;
		case("3rd Quarter"):
			$q3_s = "selected";
			break;
		case("4th Quarter"):
			$q4_s = "selected";
			break;
		case("Summer"):
			$qs_s = "summer";
			break;
		case("Enrollment"):
			$qe_s = "Enrollment";
			break;
	}
	
}

if(empty($exam_week)){
	$ewy_s = "";
	$ewn_s = "";
} else {
	
	$ewy_s = "";
	$ewn_s = "";
	
	switch($exam_week){
		case("yes"):
			$ewy_s = "selected";
			break;
		case("no"):
			$ewn_s = "selected";
			break;
	}
	
}


if(empty($grade_encode)){
	$gey_s = "";
	$gen_s = "";
} else {
	
	$gey_s = "";
	$gen_s = "";
	
	switch($grade_encode){
		case("yes"):
			$gey_s = "selected";
			break;
		case("no"):
			$gen_s = "selected";
			break;
	}
	
}

if(empty($enrollment)){
	$ey_s = "";
	$en_s = "";
} else {
	
	$ey_s = "";
	$en_s = "";
	
	switch($enrollment){
		case("yes"):
			$ey_s = "selected";
			break;
		case("no"):
			$en_s = "selected";
			break;
	}
	
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
		<div class="row">	
			<div class="input-field col s6">
				<select class="browser-default" id="school_year">
					<option selected disabled>Current School Year</option>
					<option value="<?=$sy1?>" <?=$sy1_s?>><?=$sy1?></option>
					<option value="<?=$sy2?>" <?=$sy2_s?>><?=$sy2?></option>
				</select>	
			</div>
			
			<div class="input-field col s6">
				<select class="browser-default" id="quarter">
				 <option selected disabled>Current Quarter</option>
					<option value="1st Quarter" <?=$q1_s?>>1st Quarter</option>
					<option value="2nd Quarter" <?=$q2_s?>>2nd Quarter</option>
					<option value="3rd Quarter" <?=$q3_s?>>3rd Quarter</option>
					<option value="4th Quarter" <?=$q4_s?>>4th Quarter</option>
					<option value="Summer" <?=$qs_s?>>Summer</option>
					<option value="Enrollment" <?=$qe_s?>>Enrollment Period</option>
				</select>
			</div>
			</div>
			<div class="row">
			<div class="input-field col s6">
				<p class="grey-text">Exam Week</p>
				<select id="exam_week" class="browser-default">
					<option value="yes" <?=$ewy_s?>>Yes</option>
					<option value="no" <?=$ewn_s?>>No</option>
				</select>
			</div>
			
			<div class="input-field col s6">
				<p class="grey-text">Encoding of Grades</p>
				<select id="grade_encode" class="browser-default">
					<option value="yes" <?=$gey_s?>>Yes</option>
					<option value="no" <?=$gen_s?>>No</option>
				</select>
			</div>
			
			<div class="input-field col s6">
				<p class="grey-text">Enrollment</p>
				<select id="enrollment" class="browser-default">
					<option value="yes" <?=$ey_s?>>Yes</option>
					<option value="no" <?=$en_s?>>No</option>
				</select>
			</div>
			
			
			</div>
			
			
						
			<br><br>
			<button id="saveButton" class="btn btn-large waves-effect waves-light <?=$accent_color?>">Save</button>
  		<span id="response" class="red-text"></span>
			
			<br><br><br><br><br>
		</div>
	</body>
</html>
<script type="text/javascript">
	
	$(document).ready().keypress(function(e){
		var key = e.which;
		if(key == 13){
			saveChanges();
		}
	})

	$("#saveButton").click(function(){
		saveChanges();
	});
	
	function saveChanges(){
		
		var s_y = $("#school_year").val();
		var q = $("#quarter").val();
		var e_w = $("#exam_week").val();
		var g_e = $("#grade_encode").val();
		var e = $("#enrollment").val();
		
		if(!s_y){
			$("#response").html("School Year is required");
		} else{
			if(!q){
				$("#response").html("Quarter is required");
			} else {
				
				$.ajax({
					type: 'POST',
					url: '../../action/admin/set_schooldata.php',
					data: {
						school_year: s_y,
						quarter: q,
						exam_week: e_w,
						grade_encode: g_e,
						enrollment: e
					},
					cache: false,
					success: function(result){
						$("#response").html(result);
					}
				}).fail(function(){
					$("#response").html("Error connecting to server");
				});
				
			}
		}
			
	}
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">