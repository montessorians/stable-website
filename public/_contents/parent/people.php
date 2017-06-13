<?php
include("_setup.php");
$children_array = $db_parentchild->where(array("parentchild_id"), "parent_id", "$parent_id");
$admin_array = $db_admin->select(array());
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

                $address = $db_student->get("address","student_id", "$student_id");
                $city = $db_student->get("city","student_id", "$student_id");
                $country = $db_student->get("country","student_id", "$student_id");
                $mobile_number = $db_student->get("mobile_number","student_id", "$student_id");
                $telephone_number = $db_student->get("telephone_number","student_id", "$student_id");
                $email = $db_student->get("email","student_id", "$student_id");

                $photo_url = $db_account->get("photo_url","student_id", "$student_id");
                
                if(empty($photo_url)){
                    $photo_url = "assets/noimg.bmp";
                } 

                echo "
                <div class='col s6'>
                <a href='#card$student_id'>
                <div class='card'>
                    <div class='card-img'>
                        <img src='$photo_url' width='100%'>
                    </div>
                    <div class='card-content'>
                       <p><font size='4'><b class='seagreen-text'>$first_name $last_name $suffix_name</b></font><br>
                       <span class='grey-text text-darken-2'>$grade - $section</span></p>
                    </div>
                </div>
                </a>
                </div>                
                <div class='modal modal-fixed-footer' id='card$student_id'>
                    <div class='modal-content'>
                        <h5 class='seagreen-text'><b>$first_name $last_name $suffix_name</b></h5>
                        <ul class='collection'>
                            <li class='collection-item'>
                                Student ID No.: $student_id
                            </li>
                            <li class='collection-item'>
                                Address: $address
                            </li>
                            <li class='collection-item'>
                                City: $city
                            </li>
                            <li class='collection-item'>
                                Country: $country
                            </li>
                            <li class='collection-item'>
                                Mobile Number: $mobile_number
                            </li>
                            <li class='collection-item'>
                                Tel. Number: $telephone_number
                            </li>
                            <li class='collection-item'>
                                E-Mail: $email
                            </li>
                        </ul>
                    </div>
                    <div class='modal-footer'>
                        <a class='modal-action modal-close waves-effect waves-red btn-flat'>Close</a>
                    </div>
                </div>
                ";

            }
        }

        echo "</div>";// End of row

    }

    ?>
    <br>
    <h4 class="seagreen-text">Administrators</h4>
<?php
$noclass_card = "
<div class='card'><div class='card-content'><center>
<p class='grey-text'><i class='material-icons medium'>sentiment_very_dissatisfied</i><br>No Administrators Yet</p>
</center></div></div>";

if(!$admin_array){
    echo $noclass_card;
} else
{
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

     if(!$photo_url) $photo_url = "assets/noimg.bmp";

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
</div>
<br><br><br><br><br>
<script type="text/javascript">
	$(document).ready(function(){
    $('.modal').modal();
  });
</script>