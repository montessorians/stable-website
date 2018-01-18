<?php
$birth_date = "";
$bdate = "$birth_month $birth_day, $birth_year";
$bdatepublic = "$birth_month $birth_day";
if($viewer_account_type =="admin"){
    $birth_date = $bdate;
} else {
    if($viewer_user_id == $user_id){
        $birth_date = $bdate;
    } else {
        $birth_date = $bdatepublic;
    }
}
?>
<nav class="nav-extended">
    <div class="nav-wrapper">
        <a class="title"><?=$activity_title?></a>
        <a href="../" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
    </div>
    <div class="nav-content">
        <span class="nav-title">
            <?=$first_name." ".$middle_name." ".$last_name." ".$suffix_name?> 
        </span>
        <ul class="tabs tabs-transparent">
            <li class="tab"><a href="#info">Info</a></li>
            <li class="tab"><a href="#subjects">Subjects</a></li>
            <li class="tab"><a href="#parents">Parents</a></li>
        </ul>
    </div>
</nav>

<div class="col s12" id="info">
    <div class="container">
        <br><br>
            <div class="container"><center>
                <?php
                 if(empty($photo_url)){
                     echo "<img src='/assets/imgs/noimg.png' width='60%' class='z-depth-4 hoverable'>";
                 } else {
                    echo "<img src='/$photo_url' width='60%' class='z-depth-4 hoverable'>";
                 }
                ?>
            </center></div>
        <br><br>
        <div class="card hoverable">
            <div class="card-content">
                <h5>General Information</h5><br>
                <ul class="collection">
                <profile-entry
                        title="Account Type"
                        content="<?=$account_type?>">
                    </profile-entry>
                    <profile-entry
                        title="Username"
                        content="<?=$username?>">
                    </profile-entry>
                    <profile-entry
                        title="Gender"
                        content="<?=$gender?>">
                    </profile-entry>
                    <profile-entry
                        title="Birth Date"
                        content="<?=$birth_date?>">
                    </profile-entry>
                    <?php
                        $priv = "
                        <profile-entry
                            title='Birthplace'
                            content='$birth_place'>
                        </profile-entry>
                        <profile-entry
                            title='Address'
                            content='$address'>
                        </profile-entry>
                        ";
                        if($viewer_account_type =="admin"){
                            echo $priv;
                        } else {
                            if($viewer_user_id == $user_id){
                                echo $priv;
                            }
                        }                        
                    ?>
                    <profile-entry
                        title="City"
                        content="<?=$city?>">
                    </profile-entry>
                    <profile-entry
                        title="Country"
                        content="<?=$country?>">
                    </profile-entry>
                </ul>
            </div>
        </div>

        <br><br>

        <div class="hoverable card">
            <div class="card-content">
                <h5>Educational Information</h5><br>
                <ul class="collection">
                    <profile-entry
                        title="Student LRN"
                        content="<?=$student_lrn?>">
                    </profile-entry>
                    <profile-entry
                        title="Grade/Section"
                        content="<?=$grade." - ".$section?>">
                    </profile-entry>
                    <profile-entry
                        title="School Year"
                        content="<?=$school_year?>">
                    </profile-entry>
                </ul>
            </div>
        </div>

        <br><br>

        <div class="card hoverable">
            <div class="card-content">
                <h5>Contact Information</h5><br>
                <ul class="collection">
                    <profile-entry
                        title="Mobile Number"
                        content="<?=$mobile_number?>">
                    </profile-entry>
                    <profile-entry
                        title="Telephone Number"
                        content="<?=$telephone_number?>">
                    </profile-entry>
                    <profile-entry
                        title="E-Mail"
                        content="<?=$email?>">
                    </profile-entry>
                </ul>
            </div>
        </div>

    </div>
</div>

<div class="col s12" id="subjects">
    <div class="container">
    <br><br>
        <?php
            if(empty($subjects)){
                echo "
                    <div class='card'>
                        <div class='card-content'>
                            <center>Student has no subjects yet</center>
                        </div>
                    </div>
                ";
            }
            if(!empty($subjects)){
                echo "<div class='cards-container'>";
                foreach($subjects as $subject){
                    $subject_title = $subject['subject_title'];
                    $subject_description = $subject['subject_description'];
                    $school_year = $subject['school_year'];
                    $school_year_taken = $subject['school_year_taken'];
                    $grade = $subject['grade'];
                    $section = $subject['section'];
                    $class_room = $subject['class_room'];
                    $start_time = $subject['start_time'];
                    $end_time = $subject['end_time'];
                    $teacher_id = $subject['teacher_id'];
                    $teacher_name = $subject['teacher_name'];
                    $schedule = $subject['schedule'];

                    echo "
                        <div class='card col s6'>
                            <div class='card-content'>
                                <p>
                                    <b class='seagreen-text'>$subject_title</b><br>
                                    $subject_description<br>
                                    <br>
                                    <b>School Year</b>: $school_year<br>
                                    <b>School Year Taken</b>: $school_year_taken<br>
                                    <b>Grade/Section</b>: $grade - $section<br>
                                    <b>Teacher</b>: <a href='/profile?teacher_id=$teacher_id' class='seagreen-text'>$teacher_name</a><br>
                                    <b>Classroom</b>: $class_room<br>
                                    <b>Schedule</b>: $start_time - $end_time ($school_year)<br>
                                </p>
                            </div>
                        </div>
                    ";
                }
                echo "</div>";
            }
        ?>
    </div>
</div>

<div class="col s12" id="parents">
    <div class="container"><br><br>
        <?php
            if(empty($parents)){
                echo "
                    <div class='card'>
                        <div class='card-content'>
                            <center>No Parents Connected</center>
                        </div>
                    </div>
                ";
            }

            if(!empty($parents)){
                foreach($parents as $parent){
                    $parent_id = $parent['parent_id'];
                    $parent_name = $parent['parent_name'];
                    $relation = $parent['relation'];

                    echo "
                        <div class='card'>
                            <div class='card-content'>
                                <p>
                                    <a class='seagreen-text' href='/profile/?parent_id=$parent_id'><b>$parent_name</b></a><br>
                                    <br>
                                    <b>Parent ID</b>: $parent_id<br>
                                    <b>Relation</b>:  $relation
                                </p>
                            </div>
                        </div>
                    ";
                }
            }
        ?>
    </div>
</div>
<br><br><br><br>