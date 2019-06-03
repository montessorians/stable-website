<?php
include("../_include/setup.php");

$children_array = $db_parentchild->where(array(), "parent_id", "$parent_id");

$empty_child = "
    <div class='card'>
        <div class='card-content'><br><center>
            <p class='grey-text'>
            	<i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
                You don't have any child connected to your account yet.
            </p></center></br>
        </div>
    </div>";
?>

<div class="container">
    <br>
    <h5 class="seagreen-text">Your Children's Grades <a href="#modal1"><i class="grey-text material-icons">info</i></a></h5>
    <?php
    if(empty($children_array)){

		echo $empty_child;

	} else {

        echo "<div class='row'>";

		foreach($children_array as $child){
			$proceed = 0;
			$parentchild_id = $child['parentchild_id'];
			$student_id = $child['student_id'];
			$check_hold = $db_hold->where(array("hold_id"), "student_id", "$student_id");

			$student_info = $db_student->where(array("first_name","last_name","suffix_name","grade","section"),"student_id","$student_id");

			foreach($student_info as $student){
				$first_name = $student['first_name'];
				$last_name = $student['last_name'];
				$suffix_name = $student['suffix_name'];
				$grade = $student['grade'];
				$section = $student['section'];
			}

			$name = $first_name . " " . $last_name . " " . $suffix_name;
            $sectiongrade = $grade . " - " . $section;

			$classes_array = $db_enroll->where(array(), "student_id", "$student_id");

			$current_classes = array();

			foreach($classes_array as  $class){
				$school_year = $class['school_year'];
				if($school_year == $current_sy) array_push($current_classes, $class);
			}

			$student_title = "<p><font size='4'><b>$name</b> ($sectiongrade)</font></p>";

			if(!empty($check_hold)){
				echo "
            	    <div class='card hoverable'>
                	    <div class='card-content'><br><center>
                    	    <p class='grey-text'>
                        	    <i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
                            	You cannot view $first_name's grade. Please see the hold record of your child or contact the administrators.
                      	    </p></center></br>
                    	</div>
             	 	</div>";
				$proceed = 0;
			} else {

				if(empty($current_classes)){
					echo "
						<div class='card hoverable'><div class='card-content'>
							$student_title
						<center class='grey-text'><br><br>
						<i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
						$first_name doesn't have any subjects yet for S.Y. $current_sy
						</center><br></div></div>";
						$proceed = 0;
				} else {
					$proceed = 1;
				}
			}

		if($proceed == 1){

			echo "
				<div class='card hoverable'>
					<div class='card-content'>
						$student_title
					</div>
				<table class='responsive-table centered'>
					<thead class='seagreen'>
						<tr class='white-text'>
							<th>Subject</th>
							<th>1st</th>
							<th>2nd</th>
							<th>3rd</th>
							<th>4th</th>
							<th>Average</th>
							<th>Final</th>
						</tr>
					</thead>
					<tbody>";
				
				foreach($current_classes as $enroll){

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

					if(empty($fourth_quarter_grade)){$div = 3; $fourth_quarter_grade=null;}
					if(empty($third_quarter_grade)){$div = 2; $third_quarter_grade=null;}
					if(empty($second_quarter_grade)){$div = 1; $second_quarter_grade=null;}
					if(empty($first_quarter_grade)){$div = 1; $first_quarter_grade=null;}

					$average_grade = ceil(($first_quarter_grade + $second_quarter_grade + $third_quarter_grade + $fourth_quarter_grade)/$div);
					if(empty($average_grade))$average_grade=null;

					if(isset($fourth_quarter_grade)){
						if(!$final_grade){
							if($average_grade >= 70){
								$final_grade = "PASS";
							} else {
								$final_grade = "FAIL";
							}
						}
					}


					// Coloring
					$pass_color = " green lighten-4 ";
					$fail_color = " red lighten-4 ";

					$frg_color = ""; $sg_color = ""; $tg_color = ""; $fg_color = ""; $ag_color = "";

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

					echo "
					<tr>
						<td class='seagreen-text'><b>$subject_title</b></td>
						<td class='$fg_color'>$first_quarter_grade</td>
						<td class='$sg_color'>$second_quarter_grade</td>
						<td class='$tg_color'>$third_quarter_grade</td>
						<td class='$fg_color'>$fourth_quarter_grade</td>
						<td class='$ag_color'>$average_grade </td>
						<td>$final_grade </td>
					</tr>
					";


				} //fe

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
				</table>";

				if(empty($check_hold)){

					if($print_grades=="yes"){

						echo "
		             	   <div class='card-action'>
								<a class='grey-text' href='#print$student_id'><i class='material-icons'>print</i></a>
                 			</div>
			 			</div>
	            		<div class='modal' id='print$student_id'>
    	                	<div class='modal-content'>
        	            		<h5>Need a printed copy of $first_name's progress report?</h5>
      	    		            Tap the 'Print' button below. It will open or download a PDF File. Print only the copy you need to lessen our excessive use of paper.
        	    	            <br><br><br><span class='red-text'>THIS IS NOT VALID FOR ENROLLMENT PURPOSES UNLESS SIGNED BY THE PRINCIPAL OR REGISTRAR.</span>
	                	    </div>
    	                <div class='modal-footer'>
        	                <a class='modal-action modal-close waves-effect waves-red btn-flat'>Close</a>
            	            <a class='modal-action waves-effect waves-teal btn-flat' href='print/grades/?student_id=$student_id' target='_blank' rel='noopener'>Print</a>
                    	</div>
	                </div>";

				} else {

					echo "</div>";

				}

			}

		}//p=1

	}

	echo "</div>";// End of row

	}      
?>

<br>
<h5 class="seagreen-text">Your Children's Attendance <a href="#modal3"><i class="grey-text material-icons">info</i></a></h5>
<?php

$proceed = 0;

if(empty($children_array)){

	echo $empty_child;

} else {

	$proceed = 1;

}

if($proceed ==1){

	foreach($children_array as $child){

		$proceed = 0;

		$parentchild_id = $child['parentchild_id'];
		$student_id = $child['student_id'];

		$first_name = $db_student->get("first_name","student_id", "$student_id");
        $last_name = $db_student->get("last_name","student_id", "$student_id");
        $suffix_name = $db_student->get("suffix_name","student_id", "$student_id");
        $grade = $db_student->get("grade","student_id", "$student_id");
        $section = $db_student->get("section","student_id", "$student_id");

		$name = $first_name . " " . $last_name . " " . $suffix_name;
        $sectiongrade = $grade . " - " . $section;

		$attendance_array = $db_attendance->where(array(), "student_id", "$student_id");
		$current_attendance = array();

		foreach($attendance_array as $attendance){
			$school_year = $attendance['school_year'];
			if($school_year == $current_sy) array_push($current_attendance, $attendance);
		}

		if(empty($current_attendance)){
			echo "
				<div class='card hoverable'>
					<div class='card-content'>
						<p><font size='4'><b>$name</b> ($sectiongrade)</font></p><br><br>
						<center><p class='grey-text'>
						<i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
						$first_name is not enrolled for S.Y. $current_sy yet.</p></center><br>
                    </div>
				</div>";
			$proceed = 0;
		} else {
			$proceed = 1;
		}

		if($proceed == 1){
			echo "
			<div class='card hoverable'>
				<div class='card-content'>
					<p><font size='4'><b>$name</b> ($sectiongrade)</font></p>
				</div>
				<table class='responsive-table centered'>
				<thead class='seagreen'>
					<tr class='white-text'>
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
			foreach($current_attendance as $attendance){

				$attendance_id = $attendance['attendance_id'];
				$school_year = $attendance['school_year'];
				$grade = $attendance['grade'];
				$section = $attendance['section'];

				$pres_jan = $attendance['pres_jan'];
				$pres_feb = $attendance['pres_feb'];
				$pres_mar = $attendance['pres_mar'];
				$pres_apr = $attendance['pres_apr'];
				$pres_may = $attendance['pres_may'];
				$pres_jun = $attendance['pres_jun'];
				$pres_jul = $attendance['pres_jul'];
				$pres_aug = $attendance['pres_aug'];
				$pres_sep = $attendance['pres_sep'];
				$pres_oct = $attendance['pres_oct'];
				$pres_nov = $attendance['pres_nov'];
				$pres_dec = $attendance['pres_dec'];

				if(!$pres_jan)$pres_jan=0;if(!$pres_feb)$pres_feb=0;if(!$pres_mar)$pres_mar=0;
				if(!$pres_apr)$pres_apr=0;if(!$pres_may)$pres_may=0;if(!$pres_jun)$pres_jun=0;
				if(!$pres_jul)$pres_jul=0;if(!$pres_aug)$pres_aug=0;if(!$pres_sep)$pres_sep=0;
				if(!$pres_oct)$pres_oct=0;if(!$pres_nov)$pres_nov=0;if(!$pres_dec)$pres_dec=0;

				$pres_total = $pres_jan + $pres_feb + $pres_mar + $pres_apr + $pres_may + $pres_jun + $pres_jul + $pres_aug + $pres_sep + $pres_oct + $pres_nov + $pres_dec;

				if(!$pres_jan)$pres_jan=null;if(!$pres_feb)$pres_feb=null;if(!$pres_mar)$pres_mar=null;
				if(!$pres_apr)$pres_apr=null;if(!$pres_may)$pres_may=null;if(!$pres_jun)$pres_jun=null;
				if(!$pres_jul)$pres_jul=null;if(!$pres_aug)$pres_aug=null;if(!$pres_sep)$pres_sep=null;
				if(!$pres_oct)$pres_oct=null;if(!$pres_nov)$pres_nov=null;if(!$pres_dec)$pres_dec=null;

				$sch_jan = $attendance['sch_jan'];
				$sch_feb = $attendance['sch_feb'];
				$sch_mar = $attendance['sch_mar'];
				$sch_apr = $attendance['sch_apr'];
				$sch_may = $attendance['sch_may'];
				$sch_jun = $attendance['sch_jun'];
				$sch_jul = $attendance['sch_jul'];
				$sch_aug = $attendance['sch_aug'];
				$sch_sep = $attendance['sch_sep'];
				$sch_oct = $attendance['sch_oct'];
				$sch_nov = $attendance['sch_nov'];
				$sch_dec = $attendance['sch_dec'];
	
				if(!$sch_jan)$sch_jan=0;if(!$sch_feb)$sch_feb=0;if(!$sch_mar)$sch_mar=0;
				if(!$sch_apr)$sch_apr=0;if(!$sch_may)$sch_may=0;if(!$sch_jun)$sch_jun=0;
				if(!$sch_jul)$sch_jul=0;if(!$sch_aug)$sch_aug=0;if(!$sch_sep)$sch_sep=0;
				if(!$sch_oct)$sch_oct=0;if(!$sch_nov)$sch_nov=0;if(!$sch_dec)$sch_dec=0;
	
				$sch_total = $sch_jan + $sch_feb + $sch_mar + $sch_apr + $sch_may + $sch_jun + $sch_jul + $sch_aug + $sch_sep + $sch_oct + $sch_nov + $sch_dec;
	
				if(!$sch_jan)$sch_jan=null;if(!$sch_feb)$sch_feb=null;if(!$sch_mar)$sch_mar=null;
				if(!$sch_apr)$sch_apr=null;if(!$sch_may)$sch_may=null;if(!$sch_jun)$sch_jun=null;
				if(!$sch_jul)$sch_jul=null;if(!$sch_aug)$sch_aug=null;if(!$sch_sep)$sch_sep=null;
				if(!$sch_oct)$sch_oct=null;if(!$sch_nov)$sch_nov=null;if(!$sch_dec)$sch_dec=null;

	
				echo "
					<tr>
						<td class='seagreen-text'><b>Days Present</b></td>
						<td>$pres_jan</td>
						<td>$pres_feb</td>
						<td>$pres_mar</td>
						<td>$pres_apr</td>
						<td>$pres_may</td>
						<td>$pres_jun</td>
						<td>$pres_jul</td>
						<td>$pres_aug</td>
						<td>$pres_sep</td>
						<td>$pres_oct</td>
						<td>$pres_nov</td>
						<td>$pres_dec</td>
						<td><b>$pres_total</b></td>
					</tr>
					<tr>
						<td class='seagreen-text'><b>Days of School</b></td>
						<td>$sch_jan</td>
						<td>$sch_feb</td>
						<td>$sch_mar</td>
						<td>$sch_apr</td>
						<td>$sch_may</td>
						<td>$sch_jun</td>
						<td>$sch_jul</td>
						<td>$sch_aug</td>
						<td>$sch_sep</td>
						<td>$sch_oct</td>
						<td>$sch_nov</td>
						<td>$sch_dec</td>
						<td><b>$sch_total</b></td>
					</tr>
				";

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
			</div>"; // close card
		}
	}

} // p=1
?>
<br><br><br><br>
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
<div id="modal3" class="modal bottom-sheet">
    <div class="modal-content">
      <h4>About Your Child's Attendance</h4>
      <p>
	  	<b>Lates</b> - Number of times that your child is not in school on time.<br>
	  	<b>Absences</b> - Days when your child are not in school that is not allowed or excused.<br>
	  </p>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-green btn-flat">Okay</a>
    </div>
</div>

</div><!--Container-->
<script type="text/javascript">
$(document).ready(function(){	
	$('.modal').modal();
});
</script>
