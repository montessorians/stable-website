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
    echo "<div class='cards-container'>";
    foreach($children_array as $child){
        $parentchild_id = $child['parentchild_id'];
        $student_id = $child['student_id'];
        
        $student_info = $db_student->where(array(),"student_id","$student_id");
        
        foreach($student_info as $student){

            $first_name = $student['first_name'];
            $last_name = $student['last_name'];
            $suffix_name = $student['suffix_name'];
            $grade = $student['grade'];
            $section = $student['section'];
            
            $address = $student['address'];
            $city = $student['city'];
            $country = $student['country'];
            $mobile_number = $student['mobile_number'];
            $telephone_number = $student['telephone_number'];
            $email = $student['email'];

        }
        
        $photo_url = $db_account->get("photo_url","student_id", "$student_id");
        $user_id = $db_account->get("user_id", "student_id", "$student_id");
        $username = $db_account->get("username","student_id","$student_id");

        if(empty($photo_url))$photo_url="assets/imgs/noimg.png";

        echo "
		<style>
			.previewImgStudent$student_id{
				 background-image: url('$photo_url');
				 max-width: 100%;
	                    	 height: 180px;
        	            	 background-repeat: no-repeat;
                		 background-position: center;
                   	 	 background-size: cover;
			}
		</style>
                <div class='col s4'>
                <a href='#card$student_id'>
                <div class='card hoverable'>
                    <div class='card-img'>
                        <div class='previewImgStudent$student_id'></div>
                    </div>
                    <div class='card-content'>
                       <p><font size='4'><b class='seagreen-text'>$first_name $last_name $suffix_name</b></font><br>
                       <span class='grey-text text-darken-2'>$grade - $section<br><span class='truncate'>@$username</span></span></p>
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
			        Username: @$username
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
    <h4 class="seagreen-text">Teachers</h4>
<?php
$noclass_card = " <div class='card hoverable'><div class='card-content'><center>
<p class='grey-text'><i class='material-icons medium'>sentiment_very_dissatisfied</i><br>No Teacher Information Yet</p>
</center></div></div>";

$teacher_array = array();

if(empty($children_array)) echo $noclass_card;
if(!empty($children_array))
{
    foreach($children_array as $child){
        $parentchild_id = $child['parentchild_id'];
        $student_id = $child['student_id'];
        $student_classes = $db_enroll->where(array(),"student_id","$student_id");
        if(!empty($student_classes)){
            $current_classes = array();
            foreach($student_classes as $class){
                $school_year = $class['school_year'];
                if($school_year == $current_sy) array_push($current_classes, $class);
            }
            if(!empty($current_classes)){
                foreach($current_classes as $class){
                    $class_id = $class['class_id'];
                    $teacher_id = $db_class->get("teacher_id","class_id","$class_id");
                    if(!empty($teacher_id)) {
                        if(!in_array($teacher_id,$teacher_array)) array_push($teacher_array, $teacher_id);
                    }
                }
            }
        }
    }    
}

if(empty($teacher_array)) echo $noclass_card;
if(!empty($teacher_array)){
    echo "<div class='cards-container'>";
    foreach($teacher_array as $teacher_id){
        $teacher_info = $db_teacher->where(array(),"teacher_id", "$teacher_id");
        foreach($teacher_info as $teacher){
            $teacher_id = $teacher['teacher_id'];
            $first_name = $teacher['first_name'];
            $last_name = $teacher['last_name'];
            $suffix_name = $teacher['suffix_name'];
            $mobile_number = $teacher['mobile_number'];
            $telephone_number = $teacher['telephone_number'];
            $email = $teacher['email'];
        }
        $username = $db_account->get("username", "teacher_id", "$teacher_id");
        $photo_url = $db_account->get("photo_url", "teacher_id", "$teacher_id");
   
        if(empty($photo_url)) $photo_url = "/assets/imgs/noimg.png";

        echo "
	<style>
		.imgPreviewTeacher$teacher_id{
			background-image: url('$photo_url');
			max-width: 100%;
	                height: 180px;
        	        background-repeat: no-repeat;
                	background-position: center;
                   	background-size: cover;
		}
	</style>
        <div class='col s4'>
            <div class='card hoverable' id='card$teacher_id'>
            <a href='#card$teacher_id'>
                <div class='card-img'>
                    <div class='imgPreviewTeacher$teacher_id'></div>
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
		            Username: @$username
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
    echo "</div>";
}
?>
    <br>
    <h4 class="seagreen-text">Administrators</h4>
<?php
$noclass_card = "
<div class='card hoverable'><div class='card-content'><center>
<p class='grey-text'><i class='material-icons medium'>sentiment_very_dissatisfied</i><br>No Administrators Yet</p>
</center></div></div>";

if(empty($admin_array)) echo $noclass_card;

if(!empty($admin_array)){
    echo "<div class='cards-container'>";  
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

     if(!$photo_url) $photo_url = "assets/imgs/noimg.png";

                     echo "
		     	 <style>
			 	.imgPreviewAdmin$admin_id{
					background-image: url('$photo_url');
					max-width: 100%;
					height: 180px;
					background-repeat: no-repeat;
					background-position: center;
					background-size: cover;
				}
			 </style>
                         <div class='col s4'>
                         <a href='#card$admin_id'>
                         <div class='card hoverable'>
                            <div class='card-img'>
                                <div class='imgPreviewAdmin$admin_id'></div>
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
				                    	Username: @$username
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
