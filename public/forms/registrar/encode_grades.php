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
	
	$class_id = $_GET['class_id'];
	if(empty($class_id)){
		header("Location: $from");
	} else {
		$check_classid = $db_class->get("class_id","class_id", "$class_id");
		if(empty($check_classid)){
			header("Location: $from");
		} else {
		}
	}
	
	$class_title = $db_class->get("class_title", "class_id","$class_id");
	$grade_encode = $db_schooldata->get("grade_encode", "school_id", "1");
	$current_quarter = $db_schooldata->get("quarter", "school_id", "1");
	$enroll_array = $db_enroll->where(array("enroll_id"), "class_id", "$class_id");
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
		<a class="title"><?=$activity_title?> (<?=$current_quarter?>)</a>
		<a href="<?=$from?>" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
		</nav>
		<div class="container">
		<br>
			<h4 class="green-text text-darken-2"><?=$class_title?> Grades</h4>
		<br>
			<?php
			
				if(empty($enroll_array)){
					echo "<div class='card'><div class='card-content'><center>No Enrollees</center></div></div>";
				} else {
					echo "<table>
					<thead>
						<tr>
							<th>Student</th>
							<th>1st</th>
							<th>2nd</th>
							<th>3rd</th>
							<th>4th</th>
							<th>Final</th>
						</tr>
					</thead>
					<tbody>
					";
					foreach($enroll_array as $key){
						foreach($key as $enroll_id){
							$student_id = $db_enroll->get("student_id", "enroll_id", "$enroll_id");
							$first_name = $db_student->get("first_name", "student_id", "$student_id");
							$last_name = $db_student->get("last_name", "student_id", "$student_id");
							$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
							$first_quarter_grade = $db_enroll->get("first_quarter_grade", "enroll_id", "$enroll_id");
							$second_quarter_grade = $db_enroll->get("second_quarter_grade", "enroll_id", "$enroll_id");
							$third_quarter_grade = $db_enroll->get("third_quarter_grade", "enroll_id", "$enroll_id");
							$fourth_quarter_grade = $db_enroll->get("fourth_quarter_grade", "enroll_id", "$enroll_id");
							$final_grade = $db_enroll->get("final_grade", "enroll_id", "$enroll_id");
							
							$reg = "<tr>
								<td>$first_name $last_name $suffix_name</td>
								<td><input type='text' id='first$enroll_id' value='$first_quarter_grade'></td>
								<td><input type='text' id='second$enroll_id' value='$second_quarter_grade'></td>
								<td><input type='text' id='third$enroll_id' value='$third_quarter_grade'></td>
								<td><input type='text' id='fourth$enroll_id' value='$fourth_quarter_grade'></td>
								<td><input type='text' id='final$enroll_id' value='$final_grade'></td></tr>";

							if($_SESSION['account_type']=="admin"){
								echo $reg;
							} else {

								switch($current_quarter){
									case("1st Quarter"):
										echo "<tr>
											<td>$first_name $last_name $suffix_name</td>	
											<td><input type='text' id='first$enroll_id' value='$first_quarter_grade'></td>
											<td><input type='text' id='second$enroll_id' value='$second_quarter_grade' disabled></td>
											<td><input type='text' id='third$enroll_id' value='$third_quarter_grade' disabled></td>
											<td><input type='text' id='fourth$enroll_id' value='$fourth_quarter_grade' disabled></td>
											<td><input type='text' id='final$enroll_id' value='$final_grade' disabled></td></tr>";
										break;
									case("2nd Quarter"):
										echo "<tr>
											<td>$first_name $last_name $suffix_name</td>	
											<td><input type='text' id='first$enroll_id' value='$first_quarter_grade' disabled></td>
											<td><input type='text' id='second$enroll_id' value='$second_quarter_grade'></td>
											<td><input type='text' id='third$enroll_id' value='$third_quarter_grade' disabled></td>
											<td><input type='text' id='fourth$enroll_id' value='$fourth_quarter_grade' disabled></td>
											<td><input type='text' id='final$enroll_id' value='$final_grade' disabled></td></tr>";
										break;
									case("3rd Quarter"):
										echo "<tr>
											<td>$first_name $last_name $suffix_name</td>	
											<td><input type='text' id='first$enroll_id' value='$first_quarter_grade' disabled></td>
											<td><input type='text' id='second$enroll_id' value='$second_quarter_grade' disabled></td>
											<td><input type='text' id='third$enroll_id' value='$third_quarter_grade'></td>
											<td><input type='text' id='fourth$enroll_id' value='$fourth_quarter_grade' disabled></td>
											<td><input type='text' id='final$enroll_id' value='$final_grade' disabled></td></tr>";
										break;
									case("4th Quarter"):
										echo "<tr>
											<td>$first_name $last_name $suffix_name</td>	
											<td><input type='text' id='first$enroll_id' value='$first_quarter_grade' disabled></td>
											<td><input type='text' id='second$enroll_id' value='$second_quarter_grade' disabled></td>
											<td><input type='text' id='third$enroll_id' value='$third_quarter_grade' disabled></td>
											<td><input type='text' id='fourth$enroll_id' value='$fourth_quarter_grade'></td>
											<td><input type='text' id='final$enroll_id' value='$final_grade'></td></tr>";
										break;
									case("Summer"):
										echo $reg;
										break;
									case("Enrollment Period"):
										echo $reg;
										break;
								}// switch

							}
							
						}
					}
					
					echo "
					</tbody>
					</table>
					<br><br>
			<button class='btn btn-large waves-effect waves-light $accent_color' id='saveButton'>Save</button>
					
					";
					
				}
			
			?>
			<br><br>
			<div id='response'></div>
			<br><p>We do not restrict the grades that you input but limit grades to the ceiling grades provided. (1st Qtr. 97, 2nd Qtr. 98, 3rd Qtr. 99, 4th Qtr. 100)</p>
		</div><br><br><br><br>
	</body>
</html>
<script>
	$("#saveButton").click(function(){
		saveGrades();
	});
	
	function saveGrades(){
		<?php
			foreach($enroll_array as $key){
				foreach($key as $enroll_id){
					$student_id = $db_enroll->get("student_id", "enroll_id", "$enroll_id");
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
							enroll_id: $enroll_id,
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
			}
		?>
		
	}
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">