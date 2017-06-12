<?php
include("_setup.php");
$children_array = $db_parentchild->where(array("parentchild_id"), "parent_id", "$parent_id");
$current_sy = $db_schooldata->get("school_year", "school_id", "1");

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
    if(empty($children_array)){
        echo $empty_child;
    } else {

        echo "<div class='row'>";

        foreach($children_array as $key){
            foreach($key as $parentchild_id){
                
                $student_id = $db_parentchild->get("student_id", "parentchild_id", "$parentchild_id");
                
                $check_hold = $db_hold->where(array("hold_id"), "student_id", "$student_id");

                $first_name = $db_student->get("first_name","student_id", "$student_id");
                $last_name = $db_student->get("last_name","student_id", "$student_id");
                $suffix_name = $db_student->get("suffix_name","student_id", "$student_id");
                $grade = $db_student->get("grade","student_id", "$student_id");
                $section = $db_student->get("section","student_id", "$student_id");
                $name = $first_name . " " . $last_name . " " . $suffix_name;
                $sectiongrade = $grade . " - " . $section;

                $classes_array = $db_enroll->where(array("enroll_id"), "student_id", "$student_id");

                if(empty($check_hold)){                                    

                 echo "<div class='card'>
                     <div class='card-content'>
                        <p><font size='4'><b>$name</b> ($sectiongrade)</font></p>
                     </div>";
                
                if(empty($classes_array)){
                    echo "<center class='grey-text'>
                    <i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
                    $first_name doesn't have any subjects yet
                    </center><br><br>";
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

            foreach($classes_array as $key){
                foreach($key as $enroll_id){
					$school_year = $db_enroll->get("school_year", "enroll_id", "$enroll_id");
					
					$class_id = $db_enroll->get("class_id", "enroll_id",  "$enroll_id");
					$class_title = $db_class->get("class_title", "class_id", "$class_id");
					$class_id = $db_enroll->get("class_id", "enroll_id",  "$enroll_id");
					$first_quarter_grade = $db_enroll->get("first_quarter_grade", "enroll_id", "$enroll_id");
					$second_quarter_grade = $db_enroll->get("second_quarter_grade", "enroll_id", "$enroll_id");
					$third_quarter_grade = $db_enroll->get("third_quarter_grade", "enroll_id", "$enroll_id");
					$fourth_quarter_grade = $db_enroll->get("fourth_quarter_grade", "enroll_id", "$enroll_id");

                    $div = 4;
					 if(empty($fourth_quarter_grade)){$div = 3;}
					 if(empty($third_quarter_grade)){$div = 2;}
					 if(empty($second_quarter_grade)){	$div = 1;}
					 if(empty($first_quarter_grade)){$div = 1;}
					 $average_grade = ceil(($first_quarter_grade + $second_quarter_grade + $third_quarter_grade + $fourth_quarter_grade)/$div);
						$final_grade = $db_enroll->get("final_grade", "class_id", "$class_id");
						if(empty($fourth_quarter_grade)){
						} else {
							if(empty($final_grade)){
								if($average_grade >= 70){
									$fg = "PASS";
								} else {
									$fg = "FAIL";
								}
								$final_grade = $fg;
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
						
						} else {
						
						}

                } //feinner
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
			</table>
			";

                }
                 echo "
                 <div class='card-action'>
                    <a class='grey-text' href='#print$student_id'><i class='material-icons'>print</i></a>
                 </div>
                 ";
                 echo "</div>
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
                 </div>
                 ";

                } else {
                 echo "
                <div class='card'>
                    <div class='card-content'><br><center>
                        <p class='grey-text'>
                            <i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
                            You cannot view $first_name's grade. Please see the hold record of your child or contact the administrators.
                        </p></center></br>
                    </div>
                </div>";   
                }
                

            }
        }
        

        echo "</div>";// End of row

    }

    ?>

<br>
<h4 class="seagreen-text">My Children's Attendance <a href="#modal3"><i class="grey-text material-icons">info</i></a></h4>
<?php
    if(empty($children_array)){
        echo $empty_child;
    } else {

        foreach($children_array as $key){
            foreach($key as $parentchild_id){
                $student_id = $db_parentchild->get("student_id", "parentchild_id", "$parentchild_id");
 
                $first_name = $db_student->get("first_name","student_id", "$student_id");
                $last_name = $db_student->get("last_name","student_id", "$student_id");
                $suffix_name = $db_student->get("suffix_name","student_id", "$student_id");
                $grade = $db_student->get("grade","student_id", "$student_id");
                $section = $db_student->get("section","student_id", "$student_id");
                $name = $first_name . " " . $last_name . " " . $suffix_name;
                $sectiongrade = $grade . " - " . $section;
 
                $attendance_array = $db_attendance->where(array("attendance_id"), "student_id", "$student_id");

                echo "<div class='card'><div class='card-content'>
                    <p><font size='4'><b>$name</b> ($sectiongrade)</font></p></div>";

                if(empty($attendance_array)){
                    echo "<div class='card-content'>
								<center>
									<p class='grey-text'>
									<i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
									You are not enrolled yet.</p>
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
				<tbody>";

                foreach($attendance_array as $key){
                    foreach($key as $attendance_id){
                        $school_year = $db_attendance->get("school_year", "attendance_id", "$attendance_id");
                        if($school_year === $current_sy){
					$grade  = $db_attendance->get("grade", "attendance_id", "$attendance_id");
					$section  = $db_attendance->get("section", "attendance_id", "$attendance_id");
					$absent_jan  = $db_attendance->get("absent_jan", "attendance_id", "$attendance_id");
					$absent_feb  = $db_attendance->get("absent_feb", "attendance_id", "$attendance_id");
					$absent_mar  = $db_attendance->get("absent_mar", "attendance_id", "$attendance_id");
					$absent_apr  = $db_attendance->get("absent_apr", "attendance_id", "$attendance_id");
					$absent_may  = $db_attendance->get("absent_may", "attendance_id", "$attendance_id");
					$absent_jun  = $db_attendance->get("absent_jun", "attendance_id", "$attendance_id");
					$absent_jul  = $db_attendance->get("absent_jul", "attendance_id", "$attendance_id");
					$absent_aug  = $db_attendance->get("absent_aug", "attendance_id", "$attendance_id");
					$absent_sep  = $db_attendance->get("absent_sep", "attendance_id", "$attendance_id");
					$absent_oct  = $db_attendance->get("absent_oct", "attendance_id", "$attendance_id");
					$absent_nov  = $db_attendance->get("absent_nov", "attendance_id", "$attendance_id");
					$absent_dec  = $db_attendance->get("absent_dec", "attendance_id", "$attendance_id");
					$absent_total = $absent_jan + $absent_feb + $absent_mar + $absent_apr + $absent_may + $absent_jun + $absent_jul + $absent_aug + $absent_sep + $absent_oct + $absent_nov + $absent_dec;
					
					$late_jan  = $db_attendance->get("late_jan", "attendance_id", "$attendance_id");
					$late_feb  = $db_attendance->get("late_feb", "attendance_id", "$attendance_id");
					$late_mar  = $db_attendance->get("late_mar", "attendance_id", "$attendance_id");
					$late_apr  = $db_attendance->get("late_apr", "attendance_id", "$attendance_id");
					$late_may  = $db_attendance->get("late_may", "attendance_id", "$attendance_id");
					$late_jun  = $db_attendance->get("late_jun", "attendance_id", "$attendance_id");
					$late_jul  = $db_attendance->get("late_jul", "attendance_id", "$attendance_id");
					$late_aug  = $db_attendance->get("late_aug", "attendance_id", "$attendance_id");
					$late_sep  = $db_attendance->get("late_sep", "attendance_id", "$attendance_id");
					$late_oct  = $db_attendance->get("late_oct", "attendance_id", "$attendance_id");
					$late_nov  = $db_attendance->get("late_nov", "attendance_id", "$attendance_id");
					$late_dec  = $db_attendance->get("late_dec", "attendance_id", "$attendance_id");
					$late_total = $late_jan + $late_feb + $late_mar + $late_apr + $late_may + $late_jun + $late_jul + $late_aug + $late_sep + $late_oct + $late_nov + $late_dec; 
						
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
		    	</table>";

                }
                
                echo "</div>";
                
                
            }//foreach k as i
        }//foreach aa

    }
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