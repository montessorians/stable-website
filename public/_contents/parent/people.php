<?php
include("../_include/setup.php");
$children_array = $db_parentchild->where(array(), "parent_id", "$parent_id");
$admin_array = $db_admin->select(array());
?>
<div class="container">
    <br>
    <h4 class="seagreen-text">My Children</h4>
<?php
$proceed = 0;
if(!$children_array){
    echo "
        <div class='card hoverable'>
            <div class='card-content'><br><center>
                <p class='grey-text'>
                    <i class='material-icons medium'>sentiment_very_dissatisfied</i><br>
                    You don't have any child connected to your account yet.
                </p></center></br>
            </div> 
        </div>";
    $proceed = 0;
} else {$proceed = 1;}

if($proceed==1){
    echo "<div class='row'>";
    foreach($children_array as $child){
        $parentchild_id = $child['parentchild_id'];
        $student_id = $child['student_id'];
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
        $user_id = $db_account->get("user_id", "student_id", "$student_id");
        if(!$photo_url)$photo_url="assets/noimg.bmp";

        echo "
                <div class='col s6'>
                <a href='#card$student_id'>
                <div class='card hoverable'>
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
                                E-Cash Enabled: <span id='allowecash$student_id'></span>
                            </li>
                            <li class='collection-item'>
                                E-Cash Balance: <span id='ecashbalance$student_id'></span> <a onclick='checkEcashBalance$student_id();' class='seagreen-text'>(Refresh)</a>
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
                        <a class='modal-action waves-effect waves-green btn-flat' onclick='toggleAllowEcash$student_id();' id='toggleAllowEcashButton$student_id()'>Allow/Disallow E-cash</a>
                    </div>
                </div>
                <script type='text/javascript'>
                    checkEcashBalance$student_id();
                    checkAllowEcash$student_id();

                    function checkEcashBalance$student_id(){
                        $('#ecashbalance$student_id').hide();
                        $.ajax({
                            type:'POST',
                            url:'action/ecash/ecash_inquire.php',
                            data: {
                                user_id: '$user_id'
                            },
                            cache: 'false',
                            success: function(result){
                                var balance = 'PHP ' + result;
                                $('#ecashbalance$student_id').html(balance);
                                $('#ecashbalance$student_id').fadeIn();
                            }
                        }).fail(function(){
                            $('#ecashbalance$student_id').html('Unavailable');
                            $('#ecashbalance$student_id').fadeIn();
                        });
                    }

                    function checkAllowEcash$student_id(){
                        $('#allowecash$student_id').hide();
                        $.ajax({
                            type:'POST',
                            url:'action/ecash/check_ecash_status.php',
                            data: {
                                user_id: '$user_id'
                            },
                            cache: 'false',
                            success: function(result){
                                $('#allowecash$student_id').html(result);
                                $('#allowecash$student_id').fadeIn();
                            }
                        }).fail(function(){
                            $('#allowecash$student_id').html('Unavailable');
                            $('#allowecash$student_id').fadeIn();
                        });
                    }

                    $('#toggleAllowEcashButton$student_id').click(function(){
                        toggleAllowEcash();
                    });

                    function toggleAllowEcash$student_id(){
                        $.ajax({
                            type:'POST',
                            url: 'action/ecash/toggle_allow_ecash.php',
                            data: {
                                user_id: '$user_id'
                            },
                            cache: 'false',
                            success: function(result){
                                Materialize.toast(result, 3000);
                                checkAllowEcash$student_id();  
                            }
                        }).fail(function(){
                            Materialize.toast('Error Changing E-Cash Setting', 3000);
                            checkAllowEcash$student_id();
                        });
                    }
                </script>
                ";

    }    
    echo "</div>";// End of row
}
?>
    <br>
    <h4 class="seagreen-text">Administrators</h4>
<?php
$noclass_card = "
<div class='card hoverable'><div class='card-content'><center>
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
                         <div class='card hoverable'>
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