<?php
include("../_include/setup.php");
$classes_array = $db_enroll->where(array(), "student_id", "$student_id");
$attendance_array = $db_attendance->where(array(), "student_id", "$student_id");
$check_hold = $db_hold->where(array("hold_id"),"student_id","$student_id");
?>
<div class="container">
<br>
<h4 class="seagreen-text">My Grades</h4>
<div class="card hoverable">
	<?php
	if(empty($check_hold)){
	
		if(empty($classes_array)){
			
			echo "
			<div class='card-content'>
				<center>
					<p class='grey-text'>
						<i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
						You don't have any subjects yet.
					</p>
				</center>
			</div>";	
			
		} else {
			
			echo "
				<table class='responsive-table centered'>
				<thead>
					<tr class='blue-grey-text text-darken-2'>
						<th>Subject</th>
						<th>1st</th>
						<th>2nd</th>
						<th>3rd</th>
						<th>4th</th>
						<th>Average</th>
						<th>Final</th>
					</tr>
				</thead>
				<tbody>
			";
			
			foreach($classes_array as $enroll){
				$div = 4;

				$enroll_id = $enroll['enroll_id'];
				$school_year = $enroll['school_year'];
				$class_id = $enroll['class_id'];
				$subject_id = $db_class->get("subject_id","class_id","$class_id");
				$subject_title = $db_subject->get("subject_title", "subject_id", "$subject_id");

				$first_quarter_grade = $enroll['first_quarter_grade'];
				$second_quarter_grade = $enroll['second_quarter_grade'];
				$third_quarter_grade = $enroll['third_quarter_grade'];
				$fourth_quarter_grade = $enroll['fourth_quarter_grade'];
				$final_grade = $enroll['final_grade'];
				$enroll_notes = $enroll['enroll_notes'];

				if(!$fourth_quarter_grade){$div = 3; $fourth_quarter_grade=null;}
				if(!$third_quarter_grade){$div = 2; $third_quarter_grade=null;}
				if(!$second_quarter_grade){$div = 1; $second_quarter_grade=null;}
				if(!$first_quarter_grade){$div = 1; $first_quarter_grade=null;}

				$average_grade = ceil(($first_quarter_grade + $second_quarter_grade + $third_quarter_grade + $fourth_quarter_grade)/$div);
				if(!$average_grade)$average_grade=null;

				if(isset($fourth_quarter_grade)){
					if(!$final_grade){
						if($average_grade >= 70){
							$final_grade = "PASS";
						} else {
							$final_grade = "FAIL";
						}
					}
				}

				// Indicators
				$up = "<i class='tiny material-icons green-text text-darken-1'>arrow_drop_up</i>";
				$down = "<i class='tiny material-icons red-text text-darken-1'>arrow_drop_down</i>";
				$nc = "<i class='tiny material-icons yellow-text text-darken-1'>remove</i>";

				$sg_indic = ""; $tg_indic = ""; $fg_indic = "";

				if(!empty($second_quarter_grade)){
					if($second_quarter_grade > $first_quarter_grade) $sg_indic = $up;
					if($second_quarter_grade < $first_quarter_grade) $sg_indic = $down;
					if($second_quarter_grade == $first_quarter_grade) $sg_indic = $nc;
				}

				if(!empty($third_quarter_grade)){
					if($third_quarter_grade > $second_quarter_grade) $tg_indic = $up;
					if($third_quarter_grade < $second_quarter_grade) $tg_indic = $down;
					if($third_quarter_grade == $second_quarter_grade) $tg_indic = $nc;
				}

				if(!empty($fourth_quarter_grade)){
					if($fourth_quarter_grade > $third_quarter_grade) $fg_indic = $up;
					if($fourth_quarter_grade < $third_quarter_grade) $fg_indic = $down;
					if($fourth_quarter_grade == $third_quarter_grade) $fg_indic = $nc;
				}

				// Coloring
				$pass_color = " green lighten-4 ";
				$fail_color = " red lighten-4 ";

				$frg_color = ""; $sg_color = ""; $tg_color = ""; $fg_color = ""; $ac_color = "";

				if(!empty($first_quarter_grade)){
					if($first_quarter_grade >= 70) $frg_color = $pass_color;
					if($first_quarter_grade < 70) $frg_color = $fail_color;
				}

				if(!empty($second_quarter_grade)){
					if($second_quarter_grade >= 70) $sg_color = $pass_color;
					if($second_quarter_grade < 70) $sg_color = $fail_color;
				}

				if(!empty($third_quarter_grade)){
					if($third_quarter_grade >= 70) $tg_color = $pass_color;
					if($third_quarter_grade < 70) $tg_color = $fail_color;
				}

				if(!empty($fourth_quarter_grade)){
					if($fourth_quarter_grade >= 70) $fg_color = $pass_color;
					if($fourth_quarter_grade < 70) $fg_color = $fail_color;
				}

				if(!empty($average_grade)){
					if($average_grade >= 70) $ag_color = $pass_color;
					if($average_grade < 70) $ag_color = $fail_color;
				}

				if($school_year == $current_sy){
					echo "
						<tr>
							<td class='seagreen-text'><b>$subject_title</b></td>
							<td class='$fg_color'>$first_quarter_grade</td>
							<td class='$sg_color'>$second_quarter_grade $sg_indic</td>
							<td class='$tg_color'>$third_quarter_grade $tg_indic</td>
							<td class='$fg_color'>$fourth_quarter_grade $fg_indic</td>
							<td class='$ag_color'>$average_grade</td>
							<td>$final_grade</td>
						</tr>
						";
				}

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
			</tr>
			</tbody>
			</table>
			";
			
		} //
		
	 else {
			echo "
			<div class='card-content'>
				<center>
					<p class='grey-text large'>
						<i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
						You are not allowed to view your grades.</p>
				</center>
			</div>";				
	}
	
	if(empty($check_hold)){
		
		echo "
		<div class='card-action'>";

		if($print_grades == "yes"){
			echo "
			<a class='grey-text' href='#modal2'>
				<i class='material-icons'>print</i>
			</a>
			";
		}

		echo"
			<a class='grey-text' href='#modal1'>
				<i class='material-icons'>info</i>
			</a>
		</div>
		";
		
	}
	
	?>
</div>
<br>
<h4 class="seagreen-text">My Classes</h4>
<div class="card hoverable">
	<ul class="collection">
		<?php
			if(empty($classes_array)){
				echo "
				<li class='collection-item'>
					<center><p>You haven't enrolled to any subject yet.</p></center>
				</li>
				";
			} else {
				echo "
				<li class='collection-item'>
					<a class='black-text' id='vcShow'>View Classes <i class='material-icons'>expand_more</i></a>
					<a class='black-text' id='vcHide'>Hide Classes <i class='material-icons'>expand_less</i></a>
				</li>
				<div class='vcContainer'>
				";

				foreach($classes_array as $enroll){
					$proceed = 0;
					$enroll_id = $enroll['enroll_id'];
					$school_year = $enroll['school_year'];
					$class_id = $enroll['class_id'];

					if($school_year == $current_sy){
						$subject_id = $db_class->get("subject_id","class_id","$class_id");
						$subject_title = $db_subject->get("subject_title", "subject_id", "$subject_id");
						$start_time = $db_class->get("start_time", "class_id", "$class_id");
						$start_time = date("h:i a", strtotime($start_time));
						$end_time = $db_class->get("end_time", "class_id", "$class_id");
						$end_time = date("h:i a", strtotime($end_time));
						$schedule = $db_class->get("schedule", "class_id", "$class_id");
						$room = $db_class->get("class_room", "class_id", "$class_id");
						if(!$room)$room = "To be announced";
						$teacher_id = $db_class->get("teacher_id", "class_id", "$class_id");
						$first_name = $db_teacher->get("first_name", "teacher_id", "$teacher_id");
						$last_name = $db_teacher->get("last_name", "teacher_id", "$teacher_id");
						$suffix_name = $db_teacher->get("suffix_name", "teacher_id", "$teacher_id");
						$teacher_name = $first_name . " " . $last_name . " " . $suffix_name;
						if(!$last_name)$teacher_name = "To be Announced";
						$proceed = 1;	
					}

					if($proceed==1){
						echo "
							<li class='collection-item'>
								<p>
									<font size='4pt'>$subject_title</font><br>
									<span class='grey-text'>
										Time: $start_time - $end_time<br>
										Days: $schedule<br>
										Room: $room<br>
										Teacher: $teacher_name
									</span>
								</p>
							</li>
							";
					}

				}

			echo "</div>
				<script>
				$(document).ready(function(){
					$('.vcContainer').hide();
					$('#vcHide').hide();
				});
				$('#vcShow').click(function(){
					$('#vcShow').hide();
					$('#vcHide').show();
					$('.vcContainer').slideDown();										
				});
				$('#vcHide').click(function(){
					$('#vcShow').show();
					$('#vcHide').hide();
					$('.vcContainer').slideUp();										
				});
				</script>
				";
			}
		?>
		</ul>
</div>
	<br>
	<h4 class="seagreen-text">My Attendance</h4>
	<div class="card hoverable">
		<?php
			if(empty($attendance_array)){
				echo "
				<div class='card-content'>
					<center>
						<p class='grey-text'>
							<i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
							You are not enrolled yet.
						</p>
					</center>
				</div>";
			} else {
				
				echo "
				<table class='responsive-table centered'>
				<thead>
					<tr class='blue-grey-text text-darken-2'>
						<th>Attendance</th>
						<th>Jan</th>
						<th>Feb</th>
						<th>Mar</th>
						<th>Apr</th>
						<th>May</th>
						<th>Jun</th>
						<th>Jul</th>
						<th>Aug</th>
						<th>Sep</th>
						<th>Oct</th>
						<th>Nov</th>
						<th>Dec</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
			";

			foreach($attendance_array as $attendance){
				$attendance_id = $attendance['attendance_id'];
				$school_year = $attendance['school_year'];
				$grade = $attendance['grade'];
				$section = $attendance['section'];
				$absent_jan = $attendance['absent_jan'];
				$absent_feb = $attendance['absent_feb'];
				$absent_mar = $attendance['absent_mar'];
				$absent_apr = $attendance['absent_apr'];
				$absent_may = $attendance['absent_may'];
				$absent_jun = $attendance['absent_jun'];
				$absent_jul = $attendance['absent_jul'];
				$absent_aug = $attendance['absent_aug'];
				$absent_sep = $attendance['absent_sep'];
				$absent_oct = $attendance['absent_oct'];
				$absent_nov = $attendance['absent_nov'];
				$absent_dec = $attendance['absent_dec'];
				if(!$absent_jan)$absent_jan=0;if(!$absent_feb)$absent_feb=0;if(!$absent_mar)$absent_mar=0;
				if(!$absent_apr)$absent_apr=0;if(!$absent_may)$absent_may=0;if(!$absent_jun)$absent_jun=0;
				if(!$absent_jul)$absent_jul=0;if(!$absent_aug)$absent_aug=0;if(!$absent_sep)$absent_sep=0;
				if(!$absent_oct)$absent_oct=0;if(!$absent_nov)$absent_nov=0;if(!$absent_dec)$absent_dec=0;
				$absent_total = $absent_jan + $absent_feb + $absent_mar + $absent_apr + $absent_may + $absent_jun + $absent_jul + $absent_aug + $absent_sep + $absent_oct + $absent_nov + $absent_dec;
				if(!$absent_jan)$absent_jan=null;if(!$absent_feb)$absent_feb=null;if(!$absent_mar)$absent_mar=null;
				if(!$absent_apr)$absent_apr=null;if(!$absent_may)$absent_may=null;if(!$absent_jun)$absent_jun=null;
				if(!$absent_jul)$absent_jul=null;if(!$absent_aug)$absent_aug=null;if(!$absent_sep)$absent_sep=null;
				if(!$absent_oct)$absent_oct=null;if(!$absent_nov)$absent_nov=null;if(!$absent_dec)$absent_dec=null;

				$late_jan = $attendance['late_jan'];
				$late_feb = $attendance['late_feb'];
				$late_mar = $attendance['late_mar'];
				$late_apr = $attendance['late_apr'];
				$late_may = $attendance['late_may'];
				$late_jun = $attendance['late_jun'];
				$late_jul = $attendance['late_jul'];
				$late_aug = $attendance['late_aug'];
				$late_sep = $attendance['late_sep'];
				$late_oct = $attendance['late_oct'];
				$late_nov = $attendance['late_nov'];
				$late_dec = $attendance['late_dec'];
				if(!$late_jan)$late_jan=0;if(!$late_feb)$late_feb=0;if(!$late_mar)$late_mar=0;
				if(!$late_apr)$late_apr=0;if(!$late_may)$late_may=0;if(!$late_jun)$late_jun=0;
				if(!$late_jul)$late_jul=0;if(!$late_aug)$late_aug=0;if(!$late_sep)$late_sep=0;
				if(!$late_oct)$late_oct=0;if(!$late_nov)$late_nov=0;if(!$late_dec)$late_dec=0;
				$late_total = $late_jan + $late_feb + $late_mar + $late_apr + $late_may + $late_jun + $late_jul + $late_aug + $late_sep + $late_oct + $late_nov + $late_dec;
				if(!$late_jan)$late_jan=null;if(!$late_feb)$late_feb=null;if(!$late_mar)$late_mar=null;
				if(!$late_apr)$late_apr=null;if(!$late_may)$late_may=null;if(!$late_jun)$late_jun=null;
				if(!$late_jul)$late_jul=null;if(!$late_aug)$late_aug=null;if(!$late_sep)$late_sep=null;
				if(!$late_oct)$late_oct=null;if(!$late_nov)$late_nov=null;if(!$late_dec)$late_dec=null;

				if($school_year == $current_sy){

				echo "
					<tr>
						<td class='seagreen-text'><b>Absences</b></td>
						<td>$absent_jan</td>
						<td>$absent_feb</td>
						<td>$absent_mar</td>
						<td>$absent_apr</td>
						<td>$absent_may</td>
						<td>$absent_jun</td>
						<td>$absent_jul</td>
						<td>$absent_aug</td>
						<td>$absent_sep</td>
						<td>$absent_oct</td>
						<td>$absent_nov</td>
						<td>$absent_dec</td>
						<td><b>$absent_total</b></td>
					</tr>
					<tr>
						<td class='seagreen-text'><b>Lates</b></td>
						<td>$late_jan</td>
						<td>$late_feb</td>
						<td>$late_mar</td>
						<td>$late_apr</td>
						<td>$late_may</td>
						<td>$late_jun</td>
						<td>$late_jul</td>
						<td>$late_aug</td>
						<td>$late_sep</td>
						<td>$late_oct</td>
						<td>$late_nov</td>
						<td>$late_dec</td>
						<td><b>$late_total</b></td>
					</tr>
				";

				}

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
				<td></td>
			</tr>
			</tbody>
			</table>
			";	
				
			
		?>
	<div class="card-action">
		<a class="grey-text" href="#modal3"><i class="material-icons">info</i></a>
	</div>
	</div>
	<br><br><br>
</div>

<div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
      <h4>Grading System</h4>
      <p>
		<table>
		<thead>
			<th>Percentage</th>
			<th>Symbol</th>
			<th>Level of Assessment</th>
		</thead>
		<tbody>
			<tr>
				<td>90% above</td>
				<td>A</td>
				<td>Advanced</td>
			</tr>
			<tr>
				<td>85%-89%</td>
				<td>P</td>
				<td>Proficient</td>
			</tr>
			<tr>
				<td>80%-84%</td>
				<td>AP</td>
				<td>Approaching Proficiency</td>
			</tr>
			<tr>
				<td>75%-79%</td>
				<td>D</td>
				<td>Developing</td>
			</tr>
			<tr>
				<td>74% Below</td>
				<td>B</td>
				<td>Beginning</td>
			</tr>
		</tbody>
		</table>

		</p>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-green btn-flat">Okay</a>
    </div>
</div>
<div id="modal2" class="modal">
    <div class="modal-content">
		<h5>Need a printed copy of your progress report?</h5>
        Tap the 'Print' button below. It will open or download a PDF File. Print only the copy you need to lessen our excessive use of paper.
        <br><br><br><span class='red-text'>THIS IS NOT VALID FOR ENROLLMENT PURPOSES UNLESS SIGNED BY THE PRINCIPAL OR REGISTRAR.</span>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-red btn-flat">Close</a>
	  <a class="modal-action waves-effect waves-teal btn-flat" href="print/grades" target="_blank">Print</a>
    </div>
</div>
<div id="modal3" class="modal bottom-sheet">
    <div class="modal-content">
      <h4>About your Attendance</h4>
      <p>
	  	<b>Lates</b> - Number of times that you are not in school on time.<br>
	  	<b>Absences</b> - Days when you are not in school that is not allowed or excused.<br>
	  </p>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-green btn-flat">Okay</a>
    </div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
    $('.modal').modal();
  });
/*
  google.charts.load('current',{packages:['bar']});
  google.charts.setOnLoadCallback(gradeChart);

  function gradeChart(){

	var data = new google.visualization.DataTable();
	data.addColumn('string','Subject');
	data.addColumn('number','1st Quarter Grade');
	data.addColumn('number','2nd Quarter Grade');
	data.addColumn('number','3rd Quarter Grade');
	data.addColumn('number','4th Quarter Grade');
	data.addRows([
		['English',90,91,92,93],
		['Math',91,92,94,95],
		['Filipino',96,97,98,99]
	]);

	var options = {
		bars:"horizontal",
		height:"auto"
	}
	var chart = new google.charts.Bar(document.getElementById('gradeChart'));

	chart.draw(data,options);
  }*/
</script>
