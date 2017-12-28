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
	include("../../_system/config.php");
	include("../../_system/database/db.php");
	$activity_title = "Encode Grades";
	
	$db_schooldata = new DBase("school_data", "../../_store");
	$db_class = new DBase("class", "../../_store");
	$db_student = new DBase("student", "../../_store");
	$db_enroll = new DBase("student_class", "../../_store");
	$db_subject = new DBase("subject", "../../_store");

	$class_id = $_GET['class_id'];
	if(empty($class_id)){
		header("Location: $from");
	} else {
		$check_classid = $db_class->get("class_id","class_id", "$class_id");
		if(empty($check_classid)) header("Location: $from");
	}
	
	$subject_id = $db_class->get("subject_id", "class_id","$class_id");
	$subject_title = $db_subject->get("subject_title", "subject_id", "$subject_id");
	$grade = $db_subject->get("grade","subject_id","$subject_id");
	$section = $db_class->get("section","class_id","$class_id");

	$grade_encode = $db_schooldata->get("grade_encode", "school_id", "1");
	$current_quarter = $db_schooldata->get("quarter", "school_id", "1");
	$enroll_array = $db_enroll->where(array(), "class_id", "$class_id");
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
		<a class="title"><b><?=$activity_title?></b> <?=$current_quarter?></a>
		<a href="<?=$from?>" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
		</nav>
		<div class="container">
		<br>
			<h5 class="green-text text-darken-2"><?="<b>$subject_title</b> ($grade - $section) Grades" ?></h5>
		<br>
			<?php
			
				if(empty($enroll_array)){
					echo "<div class='card'><div class='card-content'><center>No Enrollees</center></div></div>";
				} else {
					echo "
				<table class='white z-depth-2'>
					<thead>
						<tr class='seagreen white-text'>
							<th><center>Student</center></th>
							<th><center>1st</center></th>
							<th><center>2nd</center></th>
							<th><center>3rd</center></th>
							<th><center>4th</center></th>
							<th><center>Final</center></th>
						</tr>
					</thead>
					<tbody>
					";

					foreach($enroll_array as $enroll){
						$enroll_id = $enroll['enroll_id'];
						$student_id = $enroll['student_id'];
						$first_quarter_grade = $enroll['first_quarter_grade'];
						$second_quarter_grade = $enroll['second_quarter_grade'];
						$third_quarter_grade = $enroll['third_quarter_grade'];
						$fourth_quarter_grade = $enroll['fourth_quarter_grade'];
						$final_grade = $enroll['final_grade'];

						$first_name = $db_student->get("first_name", "student_id", "$student_id");
						$last_name = $db_student->get("last_name", "student_id", "$student_id");
						$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");


						$reg = "
						<tr>
							<td><b>$last_name</b>, $first_name $suffix_name</td>
							<td><input type='text' id='first$enroll_id' value='$first_quarter_grade'></td>
							<td><input type='text' id='second$enroll_id' value='$second_quarter_grade'></td>
							<td><input type='text' id='third$enroll_id' value='$third_quarter_grade'></td>
							<td><input type='text' id='fourth$enroll_id' value='$fourth_quarter_grade'></td>
							<td><input type='text' id='final$enroll_id' value='$final_grade'></td>
						</tr>";
	
						if($_SESSION['account_type']=="admin"){
							echo $reg;
						} else {

							$fq_d = "disabled";
							$sq_d = "disabled";
							$tq_d = "disabled";
							$fq_d = "disabled";
							$f_d = "disabled";

							switch($current_quarter){
								case("1st Quarter"):
									$fq_d = "";
									break;
								case("2nd Quarter"):
									$sq_d = "";
									break;
								case("3rd Quarter"):
									$tq_d = "";
									break;
								case("4th Quarter"):
									$fq_d = "";
									$f_d = "";
									break;
								case("Summer"):
									$fq_d = "";
									$sq_d = "";
									$tq_d = "";
									$fq_d = "";
									$f_d = "";
									break;
								case("Enrollment Period"):
									$fq_d = "";
									$sq_d = "";
									$tq_d = "";
									$fq_d = "";
									$f_d = "";
									break;
							}

							echo "
							<tr>
								<td><b>$last_name</b>, $first_name $suffix_name</td>	
								<td><input type='text' id='first$enroll_id' value='$first_quarter_grade' $fq_d></td>
								<td><input type='text' id='second$enroll_id' value='$second_quarter_grade' $sq_d></td>
								<td><input type='text' id='third$enroll_id' value='$third_quarter_grade' $tq_d></td>
								<td><input type='text' id='fourth$enroll_id' value='$fourth_quarter_grade' $fq_d></td>
								<td><input type='text' id='final$enroll_id' value='$final_grade' $f_d></td>
							</tr>";


						}

					}
					
					echo "
					</tbody>
					</table>
					<br><br>
				<button class='btn btn-large waves-effect waves-light $accent_color' id='saveButton'>Save</button>";
					
				}
			
			?>
			<br><br>
			<div id='response'></div>
			<br><p>We do not restrict the grades that you input but limit grades to the ceiling grades provided. (1st Qtr. 97, 2nd Qtr. 98, 3rd Qtr. 99, 4th Qtr. 100)</p>
			<p>If no final grade is given, the average grade or (Q1+Q2+Q3+Q4)/4 would be computed and would show a PASS or FAIL mark on the student's report card.</p>
		</div><br><br><br><br>
	</body>
</html>
<script>
$("#saveButton").click(function(){
	saveGrades();
});
	
function saveGrades(){
<?php
foreach($enroll_array as $enroll){
	$enroll_id = $enroll['enroll_id'];
	$student_id = $enroll['student_id'];
	$first_name = $db_student->get("first_name", "student_id", "$student_id");
	$last_name = $db_student->get("last_name", "student_id", "$student_id");
	$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");

	echo "
	var Vfirst$enroll_id = $('#first$enroll_id').val();
	var Vsecond$enroll_id = $('#second$enroll_id').val();
	var Vthird$enroll_id = $('#third$enroll_id').val();
	var Vfourth$enroll_id = $('#fourth$enroll_id').val();
	var Vfinal$enroll_id = $('#final$enroll_id').val();
	
	$.ajax({
		type: 'POST',
		url: '../../action/registrar/encode_grades.php',
		data: {
			enroll_id: '$enroll_id',
			first_quarter_grade: Vfirst$enroll_id,
			second_quarter_grade: Vsecond$enroll_id,
			third_quarter_grade: Vthird$enroll_id,
			fourth_quarter_grade: Vfourth$enroll_id,
			final_grade: Vfinal$enroll_id,
		},
		cache: false,
		success: function(result){
			$('#response').append(result + '<br>');
		}
	}).fail(function(){
		$('#response').append('Error saving grade of $first_name $last_name $suffix_name');						
	});
	";
}

?>	
}
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">