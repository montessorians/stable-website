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
            <li class="tab"><a href="#children">Children</a></li>
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
                <h5>General Information</h5>
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

        <div class="card hoverable">
            <div class="card-content">
                <h5>Contact Information</h5>
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

<div class="col s12" id="children">
    <div class="container"><br><br>
        <?php
            if(empty($children)){
                echo "
                    <div class='card'>
                        <div class='card-content'>
                            <center>No Children Connected</center>
                        </div>
                    </div>
                ";
            } 


            if(!empty($children)){
                foreach($children as $child){
                    $student_id = $child['student_id'];
                    $student_name = $child['student_name'];
                    $relation = $child['relation'];

                    echo "
                        <div class='card'>
                            <div class='card-content'>
                                <p>
                                    <a class='seagreen-text' href='/profile/?student_id=$student_id'><b>$student_name</b></a><br><br>
                                    Student ID: $student_id<br>
                                    Relationship: $relation
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