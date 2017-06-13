<?php
include("_setup.php");

$parentchild_array = $db_parentchild->where(array("parentchild_id"), "student_id", "$student_id");
$enroll_array = $db_enroll->where(array("enroll_id"), "student_id", "$student_id");
$admin_array = $db_admin->select(array());

?>
<div class="container">
<br>
<h4 class="seagreen-text">My Teachers</h4>
<?php
$noclass_card = "
<div class='card'><div class='card-content'><center>
<p class='grey-text'><i class='material-icons medium'>sentiment_very_dissatisfied</i><br>You Don't Have Any Teacher Yet</p>
</center></div></div>";

if(empty($enroll_array)){
    echo $noclass_card;
} else {
echo "<div class='row'>";
$teacher_array = array();

    foreach($enroll_array as $key){
        foreach($key as $enroll_id){
            $school_year = $db_enroll->get("school_year", "enroll_id", "$enroll_id");
            if($school_year === $current_sy){
                 $class_id = $db_enroll->get("class_id", "enroll_id", "$enroll_id");
                 $teacher_id = $db_class->get("teacher_id", "class_id", "$class_id");
                 if(in_array($teacher_id, $teacher_array)){}
                 else {
                     array_push($teacher_array,$teacher_id);

                     $first_name = $db_teacher->get("first_name", "teacher_id", "$teacher_id");
                     $last_name = $db_teacher->get("last_name", "teacher_id", "$teacher_id");
                     $suffix_name = $db_teacher->get("suffix_name", "teacher_id", "$teacher_id");
                     $mobile_number = $db_teacher->get("mobile_number", "teacher_id", "$teacher_id");
                     $telephone_number = $db_teacher->get("telephone_number", "teacher_id", "$teacher_id");
                     $email = $db_teacher->get("email", "teacher_id", "$teacher_id");

                     $user_id = $db_account->get("user_id", "teacher_id", "$teacher_id");
                     $username = $db_account->get("username", "user_id", "$user_id");  
                     $photo_url = $db_account->get("photo_url", "user_id", "$user_id");                   
                     if(empty($photo_url)){
                         $photo_url = "assets/noimg.bmp";
                     }
                     echo "
                         <div class='col s6'>
                         <a href='#card$teacher_id'>
                         <div class='card'>
                            <div class='card-img'>
                                <img src='$photo_url' width='100%' class='responsive-img'>
                            </div>
                            <div class='card-content'>
                                <p class='seagreen-text'><font size='4'><b>$first_name $last_name $suffix_name</b></font><br>
                                <span class='grey-text text-darken-2 truncate'>@$username</span>
                                </p>
                            </div>
                         </div>
                         </a>
                         </div>
                         <div class='modal modal-fixed-footer' id='card$teacher_id'>
                            <div class='modal-content'>
                                <h5 class='seagreen-text'><b>$first_name $last_name $suffix_name</b></h5>
                                <ul class='collection'>
                                    <li class='collection-item'>
                                        Mobile Number: <a href='tel:$mobile_number' class='seagreen-text'>$mobile_number</a>
                                    </li>
                                    <li class='collection-item'>
                                        Tel. Number: <a href='tel:$telephone_number' class='seagreen-text'>$telephone_number</a>
                                    </li>
                                    <li class='collection-item'>
                                        E-Mail: <a href='mailto:$email' class='seagreen-text'>$email</a>
                                    </li>
                                    <li class='collection-item'>
                                        Teacher ID No.: $teacher_id
                                    </li>
                                </ul>
                            </div>
                            <div class='modal-footer'>
                                <a class='modal-action modal-close waves-effect waves-red btn-flat'>Close</a>
                            </div>
                         </div>
                     ";

                 }
            }//sy
        }//eid
    }//ea

echo "</div>";
}//else
?>
<br>
<h4 class="seagreen-text">My Parents</h4>
<?php
$noclass_card = "
<div class='card'><div class='card-content'><center>
<p class='grey-text'><i class='material-icons medium'>sentiment_very_dissatisfied</i><br>Your Parent's aren't Connect Yet</p>
</center></div></div>";

    if(empty($parentchild_array)){
        echo $noclass_card;
    } else {
        echo "<div class='row'>";

        foreach($parentchild_array  as $key){
            foreach($key as $parentchild_id){

                $parent_id = $db_parentchild->get("parent_id", "parentchild_id", "$parentchild_id");
                $relation = $db_parentchild->get("relation", "parentchild_id", "$parentchild_id");

                $first_name = $db_parent->get("first_name", "parent_id", "$parent_id");
                $last_name = $db_parent->get("last_name", "parent_id", "$parent_id");
                $suffix_name = $db_parent->get("suffix_name", "parent_id", "$parent_id");
                $address = $db_parent->get("address", "parent_id", "$parent_id");
                $city = $db_parent->get("city", "parent_id", "$parent_id");
                $mobile_number = $db_parent->get("mobile_number", "parent_id", "$parent_id");
                $telephone_number = $db_parent->get("telephone_number", "parent_id", "$parent_id");
                $email = $db_parent->get("email", "parent_id", "$parent_id");
                
                $user_id = $db_account->get("user_id", "parent_id", "$parent_id");
                $username = $db_account->get("username", "user_id", "$user_id");  
                $photo_url = $db_account->get("photo_url", "user_id", "$user_id");                   
                if(empty($photo_url)){
                    $photo_url = "assets/noimg.bmp";
                }

                     echo "
                         <div class='col s6'>
                         <a href='#card$parent_id'>
                         <div class='card'>
                            <div class='card-img'>
                                <img src='$photo_url' width='100%' class='responsive-img'>
                            </div>
                            <div class='card-content'>
                                <p class='seagreen-text'><font size='4'><b>$first_name $last_name $suffix_name</b></font><br>
                                <span class='grey-text text-darken-2'>$relation<br><span class='truncate'>@$username</span></span>
                                </p>
                            </div>
                         </div>
                         </a>
                         </div>
                         <div class='modal modal-fixed-footer' id='card$parent_id'>
                            <div class='modal-content'>
                                <h5 class='seagreen-text'><b>$first_name $last_name $suffix_name</b></h5>
                                <ul class='collection'>
                                    <li class='collection-item'>
                                        Relation: $relation
                                    </li>
                                    <li class='collection-item'>
                                        Address: $address
                                    </li>
                                    <li class='collection-item'>
                                        City: $city
                                    </li>          
                                    <li class='collection-item'>
                                        Mobile Number: <a href='tel:$mobile_number' class='seagreen-text'>$mobile_number</a>
                                    </li>
                                    <li class='collection-item'>
                                        Tel. Number: <a href='tel:$telephone_number' class='seagreen-text'>$telephone_number</a>
                                    </li>
                                    <li class='collection-item'>
                                        E-Mail: <a href='mailto:$email' class='seagreen-text'>$email</a>
                                    </li>
                                    <li class='collection-item'>
                                        Parent ID No.: $parent_id
                                    </li>
                                </ul>
                            </div>
                            <div class='modal-footer'>
                                <a class='modal-action modal-close waves-effect waves-red btn-flat'>Close</a>
                            </div>
                         </div>
                     ";



            }// fe k
        }// fe pca

        echo "</div>"; // Row
    }
?>
<br>
<h4 class="seagreen-text">Administrators</h4>
<?php
$noclass_card = "
<div class='card'><div class='card-content'><center>
<p class='grey-text'><i class='material-icons medium'>sentiment_very_dissatisfied</i><br>No Administrators Yet</p>
</center></div></div>";

if(empty($admin_array)){
    echo $noclass_card;
} else {
    echo "<div class='row'>";

    foreach($admin_array as $admin){

        $admin_id = $admin['admin_id'];
        $first_name = $admin['first_name'];
        $last_name = $admin['last_name'];
        $suffix_name = $admin['suffix_name'];
        $email = $admin['email'];
        $telephone_number = $admin['telephone_number'];
        $mobile_number = $admin['mobile_number'];


        $username = $db_account->get("username", "admin_id", "$admin_id");
        $photo_url = $db_account->get("photo_url", "admin_id", "$admin_id");

                     if(empty($photo_url)){
                         $photo_url = "assets/noimg.bmp";
                     }
                     echo "
                         <div class='col s6'>
                         <a href='#card$admin_id'>
                         <div class='card'>
                            <div class='card-img'>
                                <img src='$photo_url' width='100%' class='responsive-img'>
                            </div>
                            <div class='card-content'>
                                <p class='seagreen-text'><font size='4'><b>$first_name $last_name $suffix_name</b></font><br>
                                <span class='grey-text text-darken-2 truncate'>@$username</span>
                                </p>
                            </div>
                         </div>
                         </a>
                         </div>
                         <div class='modal modal-fixed-footer' id='card$admin_id'>
                            <div class='modal-content'>
                                <h5 class='seagreen-text'><b>$first_name $last_name $suffix_name</b></h5>
                                <ul class='collection'>
                                    <li class='collection-item'>
                                        Mobile Number: <a href='tel:$mobile_number' class='seagreen-text'>$mobile_number</a>
                                    </li>
                                    <li class='collection-item'>
                                        Tel. Number: <a href='tel:$telephone_number' class='seagreen-text'>$telephone_number</a>
                                    </li>
                                    <li class='collection-item'>
                                        E-Mail: <a href='mailto:$email' class='seagreen-text'>$email</a>
                                    </li>
                                    <li class='collection-item'>
                                        Admin ID No.: $admin_id
                                    </li>
                                </ul>
                            </div>
                            <div class='modal-footer'>
                                <a class='modal-action modal-close waves-effect waves-red btn-flat'>Close</a>
                            </div>
                         </div>
                     ";
        }
    

    echo "</div>";
}

?>
<br><br><br><br><br>
</div>
<script type="text/javascript">
	$(document).ready(function(){
    $('.modal').modal();
  });
</script>