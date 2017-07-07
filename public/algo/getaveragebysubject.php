<?php
/*
Get 
*/
session_start();
include("../_system/database/db.php");
$db_enroll = new DBase("student_class","../_store");
$db_class = new DBase("class","../_store");
$db_student = new DBase("student", "../_store");

$req_student_id = $_REQUEST['student_id'];
$req_class_id = $_REQUEST['class_id'];
$req_school_year = $_REQUEST['school_year'];

$proceed = 0;
$array = $db_enroll->where(array(),"class_id", "$req_class_id");

if(!$array){
    echo "Empty records";
} else { $proceed = 1; }

if($proceed==1){
    // Count Total Entries
    $element_count = count($array);
    $iterate_count = 0;
    //Initialize List
    $first_grade_list = array();
    $second_grade_list = array();
    $third_grade_list = array();
    $fourth_grade_list = array();
    $final_grade_list = array();

    foreach($array as $enroll){
        $enroll_id = $enroll['enroll_id'];
        $school_year = $enroll['school_year'];
        $student_id = $enroll['student_id'];
        $first_quarter_grade = $enroll['first_quarter_grade'];
        $second_quarter_grade = $enroll['second_quarter_grade'];
        $third_quarter_grade = $enroll['third_quarter_grade'];
        $fourth_quarter_grade = $enroll['fourth_quarter_grade'];
        $final_grade = $enroll['final_grade'];
        if(!$first_quarter_grade){$first_quarter_grade=0;}
        if(!$second_quarter_grade){$second_quarter_grade=0;}
        if(!$third_quarter_grade){$third_quarter_grade=0;}
        if(!$fourth_quarter_grade){$fourth_quarter_grade=0;}
        if(!$final_grade){$final_grade=0;}

        if($school_year == $req_school_year){
            if($student_id == $req_student_id){
                $student_first_grade = $first_quarter_grade;
                $student_second_grade = $second_quarter_grade;
                $student_third_grade = $third_quarter_grade;
                $student_fourth_grade = $fourth_quarter_grade;
                $student_final_grade = $final_grade;
            }

            $iterate_count = $iterate_count+1;

            array_push($first_grade_list,$first_quarter_grade);
            array_push($second_grade_list,$second_quarter_grade);
            array_push($third_grade_list,$third_quarter_grade);
            array_push($fourth_grade_list,$fourth_quarter_grade);
            array_push($final_grade_list,$final_grade);

        }

    }

    $student_grade_max = max(array_map("floatval",array($student_first_grade,$student_second_grade,$student_third_grade,$student_fourth_grade)));
    if(!$student_first_grade){$divisor=1;}
    if(!$student_second_grade){$divisor=2;}
    if(!$student_third_grade){$divisor=3;}
    if(!$student_fourth_grade){$divisor=4;}
    if(isset($student_final_grade)){$divisor=4;}
    $student_average_grade = ceil(($student_first_grade+$student_second_grade+$student_third_grade+$student_fourth_grade)/$divisor);

    $first_grade_max = max(array_map("floatval",$first_grade_list));
    $second_grade_max = max(array_map("floatval",$second_grade_list));
    $third_grade_max = max(array_map("floatval",$third_grade_list));
    $fourth_grade_max = max(array_map("floatval",$fourth_grade_list));
    $final_grade_max = max(array_map("floatval",$final_grade_list));
    $total_max = max(array_map("floatval",array($first_grade_max,$second_grade_max, $third_grade_max, $fourth_grade_max)));

    $first_grade_average = array_sum($first_grade_list)/$iterate_count;
    $second_grade_average = array_sum($second_grade_list)/$iterate_count;
    $third_grade_average = array_sum($third_grade_list)/$iterate_count;
    $fourth_grade_average = array_sum($fourth_grade_list)/$iterate_count;
    $final_grade_average = array_sum($final_grade_list)/$iterate_count;

    if(!$first_grade_average){$div = 1;}
    if(!$second_grade_average){$div = 2;}
    if(!$third_grade_average){$div = 3;}
    if(!$fourth_grade_average){$div = 4;}
    if(isset($fourth_grade_average)){$div=4;}
    $average_grade_average = $first_grade_average+$second_grade_average+$third_grade_average+$fourth_grade_average;
    $average_grade_average = ceil($average_grade_average/$div);

    $class_title = $db_class->get("class_title","class_id","$req_class_id");
    $first_name = $db_student->get("first_name","student_id", "$req_student_id");

    $mood = "";
    $s1="";
    $p1="";
    if($student_grade_max == $total_max){
        $mood = "max";
        $s1 = "Congratulations! You got the highest grade of $student_grade_max in $class_title! Keep up the good work!";
        $p1 = "Congratulations! $first_name got the highest grade of $student_grade_max in $class_title!";
    } else {

    if($student_average_grade > $average_grade_average){
        $mood = "max";
        $s1 = "Congratulations! You are above the average of class grade in $class_title with an average of $student_average_grade!";
        $p1 = "Congratulations! $first_name is above average of the class grade in $class_title with an average of $student_average_grade!";
    } else {
        if($student_average_grade == $average_grade_average){
            $mood = "medium";
            $s1 = "You got the $class_title's class average grade of $student_average_grade. Study more to get even better grades!";
            $p1 = "$first_name got the $class_title's class average grade of $student_average_grade.";
        } else {
            $needtomake = $average_grade_average - $student_average_grade;
            $mood = "min";
            $s1 = "You need to make at least $needtomake to be within the average grade of the whole class in $class_title.";
            $p1 = "$first_name needs to make at least $needtomake to be within the average grade of the whole class in $class_title.";
        }
    }
    }

    $msg = array(
        "mood"=>"$mood",
        "student"=>"$s1",
        "parent"=>"$p1"
    );
    header("Content-Type:text/json");
    echo json_encode($msg);

/*    echo "first_grade_max: ".$first_grade_average."<br>";
    echo "second_grade_max: ".$second_grade_average."<br>";
    echo "first_grade_average: ".$first_grade_average."<br>";
    echo "second_grade_average: ".$second_grade_average."<br>";
    echo "third_grade_average: ".$third_grade_average."<br>";
    echo "fourth_grade_average: ".$fourth_grade_average."<br>";
    echo "final_grade_average: ".$final_grade_average."<br>";
    echo "average_grade_average: ".$average_grade_average."<br>";*/
}

?>