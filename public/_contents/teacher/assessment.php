<?php
    include("../_include/setup.php");
    $classes_array = $db_class->where(array(), "teacher_id", "$teacher_id");
?>
<div class="container">
    <br>
    <h4 class="seagreen-text">My Classes</h4>
    <br>
<?php
$proceed = 0;
if(!classes_array){
    echo "
        <div class='card hoverable'>
            <div class='card-content'><br><center>
                <p class='grey-text'>
                    <i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
                    You are not assigned to any class yet
                </p></center></br>
            </div>
        </div>";
    $proceed = 0;
} else {
    $proceed = 1;
}

// Finally Proceeds
if($proceed==1){
    foreach($classes_array as $class){
        $class_id = $class['class_id'];
		$subject_id = $db_class->get("subject_id","class_id","$class_id");
		$subject_title = $db_subject->get("subject_title", "subject_id", "$subject_id");
        $school_year = $class['school_year'];
        $grade = $db_subject->get("grade","subject_id","$subject_id");
        $section = $class['section'];
        $class_code = $class['class_code'];
        $class_room = $class['class_room'];
        $start_time = $class['start_time'];
        $end_time = $class['end_time'];
        $schedule = $class['schedule'];

        // Filter: Check if school year on class the same as current school year.
        if($school_year == $current_sy){
            echo "<div class='card hoverable'>
                    <div class='card-content'>
                        <h5 class='seagreen-text'>$subject_title</h5>
                        <p>
                            <strong>Grade/Section:</strong> $grade - $section<br>
                            <strong>Schedule:</strong> $start_time - $end_time ($schedule)<br>
                            <strong>Class Code:</strong> $class_code
                        </p>
                    </div>
                    <div class='card-action'>
                        <a class='seagreen-text' href='query/registrar/class.php?class_id=$class_id'>View Class</a>";// Card Action Open
            if($grade_encode == "yes"){echo "<a class='seagreen-text' href='forms/registrar/encode_grades.php?class_id=$class_id'>Encode Grades</a>";}
            echo "</div></div>";
        }
    }    
}
?>
</div>
<br><br><br><br>