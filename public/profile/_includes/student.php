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
        <div class="card hoverable">
            <div class="card-content">
                <?php
                    if(empty($photo_url)){
                        echo "<center>No Profile Photo Yet</center>";
                    } else {
                        echo "<center><img src='/$photo_url' width='300px'></center>";
                    }
                ?>
            </div>
        </div>
        <br><br>
        <div class="card hoverable">
            <div class="card-content">
                <h5>General Information</h5><br>
                <ul class="collection">
                    <li class="collection-item">
                        Account Type: <?=$account_type?>
                    </li>
                    <li class="collection-item">
                        Username: <?=$username?>
                    </li>
                    <li class="collection-item">
                        Gender: <?=$gender?>
                    </li>
                    <li class="collection-item">
                        Birthday: 
                        <?php
                            $bdate = "$birth_month $birth_day, $birth_year";
                            $bdatepublic = "$birth_month $birth_day";
                            if($viewer_account_type =="admin"){
                                echo $bdate;
                            } else {
                                if($viewer_user_id == $account_id){
                                    echo $bdate;
                                } else {
                                    echo $bdatepublic;
                                }
                            }
                        ?>
                    </li>
                    <?php
                        $priv = "
                        <li class='collection-item'>Birthplace: $birth_place</li>
                        <li class='collection-item'>Address: $address</li>
                        ";
                        if($viewer_account_type =="admin"){
                            echo $priv;
                        } else {
                            if($viewer_user_id == $account_id){
                                echo $priv;
                            }
                        }                        
                    ?>
                    <li class='collection-item'>City: <?=$city?></li>
                    <li class='collection-item'>Country: <?=$country?></li>
                </ul>
            </div>
        </div>

        <br><br>

        <div class="hoverable card">
            <div class="card-content">
                <h5>Educational Information</h5><br><br>
                <ul class="collection">
                    <li class="collection-item">
                        Student LRN: <?=$student_lrn?>
                    </li>
                    <li class="collection-item">
                        Grade/Section: <?=$grade." - ".$section?>
                    </li>
                    <li class="collection-item">
                        School Year: <?=$school_year?>
                    </li>
                </ul>
            </div>
        </div>

        <br><br>

        <div class="card hoverable">
            <div class="card-content">
                <h5>Contact Information</h5><br><br>
                <ul class="collection">
                    <li class="collection-item">Mobile Number: <?=$mobile_number?></li>
                    <li class="collection-item">Telephone Number: <?=$telephone_number?></li>
                    <li class="collection-item">E-mail: <?=$email?></li>
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
                                    <b>$subject_title</b><br>
                                    $subject_description<br>
                                    <br>
                                    School Year: $school_year<br>
                                    School Year Taken: $school_year_taken<br>
                                    Grade/Section: $grade - $section<br>
                                    Teacher: <a href='/profile?teacher_id=$teacher_id' class='seagreen-text'>$teacher_name</a><br>
                                    Classroom: $class_room<br>
                                    Schedule: $start_time - $end_time ($school_year)<br>
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
                                    Parent ID: $parent_id<br>
                                    Relation:  $relation
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