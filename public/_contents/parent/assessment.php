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
    <h4 class="seagreen-text">My Children's Grades <a href="#modal1"><i class="grey-text material-icons">info</i></a></h4>
    <?php
    if(!$children_array){
        echo $empty_child;
    } else {

        echo "<div class='row'>";

		foreach($children_array as $child){
			$proceed = 0;
			$parentchild_id = $child['parentchild_id'];
			$student_id = $child['student_id'];
			$check_hold = $db_hold->where(array("hold_id"), "student_id", "$student_id");

        	$first_name = $db_student->get("first_name","student_id", "$student_id");
            $last_name = $db_student->get("last_name","student_id", "$student_id");
            $suffix_name = $db_student->get("suffix_name","student_id", "$student_id");
            $grade = $db_student->get("grade","student_id", "$student_id");
            $section = $db_student->get("section","student_id", "$student_id");
            $name = $first_name . " " . $last_name . " " . $suffix_name;
            $sectiongrade = $grade . " - " . $section;

			$classes_array = $db_enroll->where(array(), "student_id", "$student_id");

			$student_title = "<p><font size='4'><b>$name</b> ($sectiongrade)</font></p>";

			if(isset($check_hold)){
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
			if(!$classes_array){
				echo "
					<div class='card hoverable'><div class='card-content'>
						$student_title
					<center class='grey-text'>
                    <i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
                    $first_name doesn't have any subjects yet
                    </center><br><br></div></div>";
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
					<tbody>";
				
				foreach($classes_array as $enroll){
					$div = 4;

					$enroll_id = $enroll['enroll_id'];
					$school_year = $enroll['school_year'];
					$class_id = $enroll['class_id'];
					$class_title = $db_class->get("class_title", "class_id", "$class_id");

					$first_quarter_grade = $enroll['first_quarter_grade'];
					$second_quarter_grade = $enroll['second_quarter_grade'];
					$third_quarter_grade = $enroll['third_quarter_grade'];
					$fourth_quarter_grade = $enroll['fourth_quarter_grade'];
					$final_grade = $enroll['final_grade'];

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

					if($school_year == $current_sy){
					echo "
						<tr>
							<td class='seagreen-text'><b>$class_title</b></td>
							<td>$first_quarter_grade</td>
							<td>$second_quarter_grade</td>
							<td>$third_quarter_grade</td>
							<td>$fourth_quarter_grade</td>
							<td>$average_grade</td>
							<td>$final_grade</td>
						</tr>
						";
					}

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

				if(!$check_hold){
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
            	            <a class='modal-action waves-effect waves-teal btn-flat' href='print/grades/?student_id=$student_id' target='_blank'>Print</a>
                    	</div>
	                </div>";
					}
				}

			}//p=1

		}

	echo "</div>";// End of row

	}      
?>

<br>
<h4 class="seagreen-text">My Children's Attendance <a href="#modal3"><i class="grey-text material-icons">info</i></a></h4>
<?php
$proceed = 0;
if(!$children_array){
	echo $empty_child;
	$proceed = 0;
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

		if(!$attendance_array){
			echo "
				<div class='card hoverable'>
					<div class='card-content'>
						<p><font size='4'><b>$name</b> ($sectiongrade)</font></p><br>
						<center><p class='grey-text'>
						<i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
						$first_name is not enrolled yet.</p></center>
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