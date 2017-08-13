<?php
// Start Session
session_start();

// Include Database
include("../_require/db.php");

//Handle post_id
if(empty($_REQUEST['post_id'])){
    $do = False;
} else {
    $post_id = $_REQUEST['post_id'];
    $check_post_existence = $db_post->get("post_id","post_id", "$post_id");
    if(empty($check_post_existence)){
        $do = False;
    } else {
        $do = True;
    }
}

if($do == True){
    $comment_array = $db_comment->where(array(), "post_id", "$post_id");
    if(empty($comment_array)){
        echo "<ul class='collection'><li class='collection-item'><center><p class='grey-text'>No Comments Yet</p></center></li></ul>";
    } else {
        $comment_array = array_reverse($comment_array);
        echo "<ul class='collection'>";
        foreach($comment_array as $comment){
            $comment_id = $comment['comment_id'];
            $user_id = $comment['user_id'];
            $comment_body = $comment['comment_body'];
            $date = $comment['date'];
            $time = $comment['time'];
            
            $username = $db_account->get("username","user_id","$user_id");                    
            $account_type = $db_account->get("account_type", "user_id", "$user_id");

            $first_name = "";
            $last_name = "";
            $suffix_name = "";

            switch($account_type){
                case("student"):
                    $student_id = $db_account->get("student_id","user_id","$user_id");
                    $first_name = $db_student->get("first_name", "student_id", "$student_id");
                    $last_name = $db_student->get("last_name", "student_id", "$student_id");
                    $suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
                    break;
                case("parent"):
                    $parent_id = $db_account->get("parent_id","user_id","$user_id");
                    $first_name = $db_parent->get("first_name", "parent_id", "$parent_id");
                    $last_name = $db_parent->get("last_name", "parent_id", "$parent_id");
                    $suffix_name = $db_parent->get("suffix_name", "parent_id", "$parent_id");
                    break;
                case("teacher"):
                    $teacher_id = $db_account->get("teacher_id","user_id","$user_id");
                    $first_name = $db_teacher->get("first_name", "teacher_id", "$teacher_id");
                    $last_name = $db_teacher->get("last_name", "teacher_id", "$teacher_id");
                    $suffix_name = $db_teacher->get("suffix_name", "teacher_id", "$teacher_id");
                    break;
                case("admin"):
                    $admin_id = $db_account->get("admin_id","user_id","$user_id");
                    $first_name = $db_admin->get("first_name", "admin_id", "$admin_id");
                    $last_name = $db_admin->get("last_name", "admin_id", "$admin_id");
                    $suffix_name = $db_admin->get("suffix_name", "admin_id", "$admin_id");
                    break;
                case("developer"):
                    $developer_id = $db_account->get("developer_id","user_id","$user_id");
                    $first_name = $db_developer->get("first_name", "developer_id", "$developer_id");
                    $last_name = $db_developer->get("last_name", "developer_id", "$developer_id");
                    $suffix_name = $db_developer->get("suffix_name", "developer_id", "$developer_id");                
                    break;
                case("staff"):                
                    $staff_id = $db_account->get("staff_id","user_id","$user_id");
                    $first_name = $db_staff->get("first_name", "staff_id", "$staff_id");
                    $last_name = $db_staff->get("last_name", "staff_id", "$staff_id");
                    $suffix_name = $db_staff->get("suffix_name", "staff_id", "$staff_id");
                    break;
            }

            $time = date("h:i a", $time);

            if($_SESSION['account_type'] == "admin"){
                $show_del = True;
            } else {
                if($_SESSION['user_id'] == $user_id){
                    $show_del = True;
                } else {
                    $show_del = False;
                }
            }

            echo "<li class='collection-item'>
                <p>$comment_body</p>
                <p class='grey-text'><font size='-1'>$first_name $last_name $suffix_name - @$username ($date $time)";
            if($show_del == True){
             echo " - <a id='deletecomment$comment_id' href='#' class='red-text'>Delete</a></font></p>";   
            }
            echo"</li>";

        }
        echo "</ul>";
        if($show_del == True){
            echo "
            <script type='text/javascript'>
                $('#deletecomment$comment_id').click(function(){
                    delete$comment_id();
                });
                function delete$comment_id(){
                    $.ajax({
                        type: 'POST',
                        url: 'action/feed/delete_comment.php',
                        cache: 'false',
                        data: {
                            comment_id: '$comment_id'
                        },
                        success: function(result){
                            Materialize.toast(result,3000);
                            fetchComment$post_id();
                        }
                    }).fail(function(){
                        Materialize.toast('Error deleting comment',3000);
                    });
                }
            </script>
            ";
        }
    }
} else {
    
}

?>