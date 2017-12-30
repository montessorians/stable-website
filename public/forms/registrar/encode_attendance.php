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
	include("../../_system/database/db.php");
	$activity_title = "Encode Attendance";
	
	$db_student = new DBase("student", "../../_store");
	$db_attendance = new DBase("student_attendance", "../../_store");
	$db_schooldata = new DBase("school_data", "../../_store");
	
	$student_id = $_GET['student_id'];
	if(empty($student_id)){
		header("Location: $from");
	} else {
		$check_studentid = $db_student->get("student_id","student_id", "$student_id");
		if(empty($check_studentid)){
			header("Location: $from");
		} else {
		}
	}
	
	$first_name = $db_student->get("first_name", "student_id", "$student_id");
	$last_name = $db_student->get("last_name", "student_id", "$student_id");
	$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
	$grade = $db_student->get("grade", "student_id", "$student_id");
	$section = $db_student->get("section", "student_id", "$student_id");
	
	$current_sy = $db_schooldata->get("school_year", "school_id","1");
	$attendance_array = $db_attendance->where(array(), "student_id", "$student_id");
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
		<br>
			<h5 class="green-text text-darken-2">Attendance of <?="$first_name $last_name $suffix_name ($student_id) $grade - $section"?> for S.Y. <?=$current_sy?></h5>
		<br>
<?php
			
if(empty($attendance_array)){
	echo "<div class='card'><div class='card-content'><center>Student Never Been Enrolled</center></div></div>";
} else {
	echo "
		<table class='tbl white z-depth-2'>
		<thead class='seagreen white-text'>
			<tr>
				<th><center>Attendance</center></th>
				<th><center>Jan</center></th>
				<th><center>Feb</center></th>
				<th><center>Mar</center></th>
				<th><center>Apr</center></th>
				<th><center>May</center></th>
				<th><center>Jun</center></th>
				<th><center>Jul</center></th>
				<th><center>Aug</center></th>
				<th><center>Sep</center></th>
				<th><center>Oct</center></th>
				<th><center>Nov</center></th>
				<th><center>Dec</center></th>
			</tr>
		</thead>
		<tbody>
	";

	foreach($attendance_array as $att){
		$attendance_id = $att['attendance_id'];
		$school_year = $att['school_year'];
		$grade = $att['grade'];
		$section = $att['section'];
		$pres_jan = $att['pres_jan'];
		$pres_feb = $att['pres_feb'];
		$pres_mar = $att['pres_mar'];
		$pres_apr = $att['pres_apr'];
		$pres_may = $att['pres_may'];
		$pres_jun = $att['pres_jun'];
		$pres_jul = $att['pres_jul'];
		$pres_aug = $att['pres_aug'];
		$pres_sep = $att['pres_sep'];
		$pres_oct = $att['pres_oct'];
		$pres_nov = $att['pres_nov'];
		$pres_dec = $att['pres_dec'];

		$sch_jan = $att['sch_jan'];
		$sch_feb = $att['sch_feb'];
		$sch_mar = $att['sch_mar'];
		$sch_apr = $att['sch_apr'];
		$sch_may = $att['sch_may'];
		$sch_jun = $att['sch_jun'];
		$sch_jul = $att['sch_jul'];
		$sch_aug = $att['sch_aug'];
		$sch_sep = $att['sch_sep'];
		$sch_oct = $att['sch_oct'];
		$sch_nov = $att['sch_nov'];
		$sch_dec = $att['sch_dec'];

		if($school_year == $current_sy){
			echo "
				<tr>
					<td class='green-text text-darken-2'><b>Days Present</b></td>
					<td><input type='text' id='pres_jan' value='$pres_jan'></td>
					<td><input type='text' id='pres_feb' value='$pres_feb'></td>
					<td><input type='text' id='pres_mar' value='$pres_mar'></td>
					<td><input type='text' id='pres_apr' value='$pres_apr'></td>
					<td><input type='text' id='pres_may' value='$pres_may'></td>
					<td><input type='text' id='pres_jun' value='$pres_jun'></td>
					<td><input type='text' id='pres_jul' value='$pres_jul'></td>
					<td><input type='text' id='pres_aug' value='$pres_aug'></td>
					<td><input type='text' id='pres_sep' value='$pres_sep'></td>
					<td><input type='text' id='pres_oct' value='$pres_oct'></td>
					<td><input type='text' id='pres_nov' value='$pres_nov'></td>
					<td><input type='text' id='pres_dec' value='$pres_dec'></td>
				</tr>
				<tr>
					<td class='green-text text-darken-2'><b>Days of School</b></td>
					<td><input type='text' id='sch_jan' value='$sch_jan'></td>
					<td><input type='text' id='sch_feb' value='$sch_feb'></td>
					<td><input type='text' id='sch_mar' value='$sch_mar'></td>
					<td><input type='text' id='sch_apr' value='$sch_apr'></td>
					<td><input type='text' id='sch_may' value='$sch_may'></td>
					<td><input type='text' id='sch_jun' value='$sch_jun'></td>
					<td><input type='text' id='sch_jul' value='$sch_jul'></td>
					<td><input type='text' id='sch_aug' value='$sch_aug'></td>
					<td><input type='text' id='sch_sep' value='$sch_sep'></td>
					<td><input type='text' id='sch_oct' value='$sch_oct'></td>
					<td><input type='text' id='sch_nov' value='$sch_nov'></td>
					<td><input type='text' id='sch_dec' value='$sch_dec'></td>
				</tr>
				";
		}

	}
					
	echo "
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	</tbody>
	</table>
	";	
					
	echo "
	<br><br>
	<button class='btn btn-large waves-effect waves-light $accent_color' id='saveButton'>Save</button>";
}				
?>
			<br><br>
			<div id='response'></div>
			
		</div><br><br><br><br>
	</body>
</html>
<script>
$("#saveButton").click(function(){
	saveAttendance();
});
	
function saveAttendance(){
<?php
	$m_a = array('jan','feb','mar','apr','may','jun','jul','aug','sep','oct','nov','dec');
	foreach($m_a as $month){
		echo "var pr_$month = $('#pres_$month').val();
		";
		echo "var sc_$month = $('#sch_$month').val()
		";
	}
?>
		
	$.ajax({
		type: 'POST',
		url: '../../action/registrar/encode_attendance.php',
		data: {
<?php
foreach($m_a as $month){
	echo "pres_$month: pr_$month,
	";
	echo "sch_$month: sc_$month,
	";
}
foreach($attendance_array as $att){
	$attendance_id = $att['attendance_id'];
	$school_year = $att['school_year'];

	if($school_year == $current_sy) echo "attendance_id: '$attendance_id'";
}
?>
		},
		cache: false,
		success: function(result){
			$("#response").html(result);
		}
	}).fail(function(){
		$("#response").html("Error connecting to server");
	});
			
}
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">