<?php
    include("_setup.php");
    $current_sy = $db_schooldata->get("school_year", "school_id", "1");
    $grade_encode = $db_schooldata->get("grade_encode", "school_id", "1");
    $classes_array = $db_class->where(array("class_id"), "teacher_id", "$teacher_id");
?>
<div class="container">
    <br>
    <h4 class="seagreen-text">My Classes</h4>
    <br>
    <?php
        if(empty($classes_array)){
            echo "
            <div class='card'>
                <div class='card-content'><br><center>
                    <p class='grey-text'>
                        <i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
                        You are not assigned to any class yet
                    </p></center></br>
                </div>
            </div>";
        } else {

            foreach($classes_array as $key){
                foreach($key as $class_id){
                    
                    $school_year = $db_class->get("school_year", "class_id", "$class_id");

                    if($school_year == $current_sy){
                    
                    $class_title = $db_class->get("class_title", "class_id", "$class_id");
                    $grade = $db_class->get("grade", "class_id", "$class_id");
                    $section = $db_class->get("section", "class_id", "$class_id");
                    $class_code = $db_class->get("class_code", "class_id", "$class_id");
                    $class_room = $db_class->get("class_room", "class_id", "$class_id");
                    $start_time = $db_class->get("start_time", "class_id", "$class_id");
                    $end_time = $db_class->get("end_time", "class_id", "$class_id");
                    $schedule = $db_class->get("schedule", "class_id", "$class_id");

                    // Disabled due to errors
                   // $start_time = date("H:i a", str_replace($start_time);
                   // $end_time = date("H:i a", $end_time);

                    echo "<div class='card'>";// Card Open

                    echo "
                    <div class='card-content'>
                        <h5 class='seagreen-text'>$class_title</h5>
                        <p>
                            <strong>Grade/Section:</strong> $grade - $section<br>
                            <strong>Schedule:</strong> $start_time - $end_time ($schedule)<br>
                            <strong>Class Code:</strong> $class_code
                        </p>
                    </div>";

                    echo "<div class='card-action'>
                        <a class='seagreen-text' href='query/registrar/class.php?class_id=$class_id'>View Class</a>
                    ";// Card Action Open

                    if($grade_encode == "yes"){
                        echo "<a class='seagreen-text' href='forms/registrar/encode_grades.php?class_id=$class_id'>Encode Grades</a>";
                    } else {}

                    echo "</div>";// Card Action Close

                    echo "</div>";// Card Close

                    } else {}

                }
            }

        }
    ?>
</div>