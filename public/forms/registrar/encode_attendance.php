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
		$absent_jan = $att['absent_jan'];
		$absent_feb = $att['absent_feb'];
		$absent_mar = $att['absent_mar'];
		$absent_apr = $att['absent_apr'];
		$absent_may = $att['absent_may'];
		$absent_jun = $att['absent_jun'];
		$absent_jul = $att['absent_jul'];
		$absent_aug = $att['absent_aug'];
		$absent_sep = $att['absent_sep'];
		$absent_oct = $att['absent_oct'];
		$absent_nov = $att['absent_nov'];
		$absent_dec = $att['absent_dec'];

		$late_jan = $att['late_jan'];
		$late_feb = $att['late_feb'];
		$late_mar = $att['late_mar'];
		$late_apr = $att['late_apr'];
		$late_may = $att['late_may'];
		$late_jun = $att['late_jun'];
		$late_jul = $att['late_jul'];
		$late_aug = $att['late_aug'];
		$late_sep = $att['late_sep'];
		$late_oct = $att['late_oct'];
		$late_nov = $att['late_nov'];
		$late_dec = $att['late_dec'];

		if($school_year == $current_sy){
			echo "
				<tr>
					<td class='green-text text-darken-2'><b>Absences</b></td>
					<td><input type='text' id='absent_jan' value='$absent_jan'></td>
					<td><input type='text' id='absent_feb' value='$absent_feb'></td>
					<td><input type='text' id='absent_mar' value='$absent_mar'></td>
					<td><input type='text' id='absent_apr' value='$absent_apr'></td>
					<td><input type='text' id='absent_may' value='$absent_may'></td>
					<td><input type='text' id='absent_jun' value='$absent_jun'></td>
					<td><input type='text' id='absent_jul' value='$absent_jul'></td>
					<td><input type='text' id='absent_aug' value='$absent_aug'></td>
					<td><input type='text' id='absent_sep' value='$absent_sep'></td>
					<td><input type='text' id='absent_oct' value='$absent_oct'></td>
					<td><input type='text' id='absent_nov' value='$absent_nov'></td>
					<td><input type='text' id='absent_dec' value='$absent_dec'></td>
				</tr>
				<tr>
					<td class='green-text text-darken-2'><b>Lates</b></td>
					<td><input type='text' id='late_jan' value='$late_jan'></td>
					<td><input type='text' id='late_feb' value='$late_feb'></td>
					<td><input type='text' id='late_mar' value='$late_mar'></td>
					<td><input type='text' id='late_apr' value='$late_apr'></td>
					<td><input type='text' id='late_may' value='$late_may'></td>
					<td><input type='text' id='late_jun' value='$late_jun'></td>
					<td><input type='text' id='late_jul' value='$late_jul'></td>
					<td><input type='text' id='late_aug' value='$late_aug'></td>
					<td><input type='text' id='late_sep' value='$late_sep'></td>
					<td><input type='text' id='late_oct' value='$late_oct'></td>
					<td><input type='text' id='late_nov' value='$late_nov'></td>
					<td><input type='text' id='late_dec' value='$late_dec'></td>
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
		echo "var ab_$month = $('#absent_$month').val();
		";
		echo "var la_$month = $('#late_$month').val()
		";
	}
?>
		
	$.ajax({
		type: 'POST',
		url: '../../action/registrar/encode_attendance.php',
		data: {
<?php
foreach($m_a as $month){
	echo "absent_$month: ab_$month,
	";
	echo "late_$month: la_$month,
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