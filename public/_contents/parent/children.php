<?php
include("_setup.php");
$children_array = $db_parentchild->where(array("parentchild_id"), "parent_id", "$parent_id");
?>
<div class="container">
    <br>
    <h4 class="seagreen-text">My Children</h4>
    <?php
    if(empty($children_array)){
        echo "
            <div class='card'>
                <div class='card-content'><br><center>
                    <p class='grey-text'>
                        <i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
                        You don't have any child connected to your account yet.
                    </p></center></br>
                </div>
            </div>";
    } else {

        echo "<div class='row'>";

        foreach($children_array as $key){
            foreach($key as $parentchild_id){

                $student_id = $db_parentchild->get("student_id", "parentchild_id", "$parentchild_id");
                $first_name = $db_student->get("first_name","student_id", "$student_id");
                $last_name = $db_student->get("last_name","student_id", "$student_id");
                $suffix_name = $db_student->get("suffix_name","student_id", "$student_id");
                $grade = $db_student->get("grade","student_id", "$student_id");
                $section = $db_student->get("section","student_id", "$student_id");
                $photo_url = $db_account->get("photo_url","student_id", "$student_id");
                
                if(empty($photo_url)){
                    $photo_url = "assets/noimg.bmp";
                } 

                echo "
                <div class='col s6'>
                <div class='card'>
                    <div class='card-img'>
                        <img src='$photo_url' width='100%'>
                    </div>
                    <div class='card-content'>
                       <p><font size='4'><b class='seagreen-text'>$first_name $last_name $suffix_name</b></font><br>
                       <span class='grey-text text-darken-2'>$grade - $section</span></p>
                    </div>
                </div>
                </div>
                ";

            }
        }

        echo "</div>";// End of row

    }

    ?>
</div>
<br><br><br>