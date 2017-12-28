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
                        Admin Office: <?=$admin_office?>
                    </li>
                    <li class="collection-item">
                        Admin Position: <?=$admin_position?>
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
<br><br><br><br>