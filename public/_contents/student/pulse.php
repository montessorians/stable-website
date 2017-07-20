<?php
include("../_include/setup.php");
$classes = $db_enroll->where(array("school_year","class_id"),"student_id","$student_id");
$check_hold = $db_hold->where(array("hold_id"),"student_id","$student_id");

$c_array = array();
foreach($classes as $enroll){
    $school_year = $enroll['school_year'];
    $class_id = $enroll['class_id'];
    if($school_year == $current_sy){
        array_push($c_array,$class_id);
    }
}
$c = array_rand($c_array);
$chosen_class = $c_array[$c];
$card1 = "
    <div class='card'>
        <div class='card-content'>
            <center><i class='medium material-icons seagreen-text'>sentiment_very_satisfied</i><i class='small material-icons red-text'>favorite</i><i class='medium material-icons seagreen-text'>assessment</i></center>
            <h5><span id='card$chosen_class'></span></h5>
        </div>
    </div>
    <script>
        get$chosen_class();
        function get$chosen_class(){
            $.ajax({
                type:'POST',
                url:'algo/getaveragebysubject.php',
                data:{
                    student_id: '$student_id',
                    school_year: '$current_sy',
                    class_id: '$chosen_class'
                },
                cache:'false',
                success:function(data){
                    result = data;
                        if(!result['student']){
                        $('#card$chosen_class').html('Error loading card content');
                    } else {
                        $('#card$chosen_class').html(result['student']);
                    }
                }
            }).fail(function(){
                $('#card$chosen_class').html('Error loading card content');
            });
        }
    </script>
";
?>
<div class="container">
    <br><br>
    <?php
    if(!$check_hold){
        echo $card1;
    } else {
        echo "
        <div class='card'>
            <div class='card-content'>
				<center>
				    <p class='grey-text large'>
					<i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
					You are not allowed to use Pulse.</p>
				</center>
			</div>
        </div>";
    }
    ?>
</div>