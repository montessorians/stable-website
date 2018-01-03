<?php
/**
 * Holy Child Montessori
 * Profile
 * 
 * 2017
 */

// Start Session
session_start();

// Set Permission Level
$perm = 3;
require_once("../_system/secure.php");

$viewer_account_type = $_SESSION['account_type'];
$viewer_user_id = $_SESSION['user_id'];

// Config
require_once("../_system/config.php");

// Include DB
require_once("../_system/database/db.php");

$activity_title = "Profile";

$db_account = new DBase("account", "../_store");

$user_id = "";
$username = "";
$student_id = "";
$admin_id = "";
$parent_id = "";
$teacher_id = "";
$staff_id = "";
$developer_id = "";

// Returns User ID
function userIdGetter($key, $val){
    $db_account = new DBase("account", "../_store");
    return $db_account->get("user_id","$key","$val");
}

if(!empty($_REQUEST['user_id'])){
    $user_id = $_REQUEST['user_id'];
    $user_id = userIdGetter("user_id","$user_id");
}
if(!empty($_RQUEST['username'])){
    $username = $_REQUEST['username'];
    $user_id = userIdGetter("username","$username");
} 
if(!empty($_REQUEST['student_id'])){
    $student_id = $_REQUEST['student_id'];
    $user_id = userIdGetter("student_id","$student_id");
} 
if(!empty($_REQUEST['admin_id'])){
    $admin_id = $_REQUEST['admin_id'];
    $user_id = userIdGetter("admin_id","$admin_id");
} 
if(!empty($_REQUEST['parent_id'])){
    $parent_id = $_REQUEST['parent_id'];
    $user_id = userIdGetter("parent_id","$parent_id");
} 
if(!empty($_REQUEST['teacher_id'])){
    $teacher_id = $_REQUEST['teacher_id'];
    $user_id = userIdGetter("teacher_id","$teacher_id");
} 
if(!empty($_REQUEST['staff_id'])){
    $staff_id = $_REQUEST['staff_id'];
    $user_id = userIdGetter("staff_id","$staff_id");
}
if(!empty($_REQUEST['developer_id'])){
    $developer_id = $_REQUEST['developer_id'];
    $user_id = userIdGetter("developer_id","$developer_id");
}

if(empty($user_id)) die("User Not Found");

$account = $db_account->where(array(),"user_id","$user_id");

foreach($account as $acc){
    $user_id = $acc['user_id'];
    $account_type = $acc['account_type'];
    $username = $acc['username'];
    $photo_url = $acc['photo_url'];

    $admin_id = $acc['admin_id'];
    $student_id = $acc['student_id'];
    $parent_id = $acc['parent_id'];
    $teacher_id = $acc['teacher_id'];
    $staff_id = $acc['staff_id'];
    $developer_id = $acc['developer_id'];
}

// Returns Specific Array of Data according to acct type
function dataGetter($acc_type,$id){
    $db_tmp = new DBase("$acc_type","../_store");
    $const = $acc_type . "_id";
    return $db_tmp->where(array(),"$const", "$id");
}

function childGetter($id){
    $arr = array();
    $db_loc = "../_store";
    $db_student = new DBase("student",$db_loc);
    $db_parentchild = new DBase("parentchild",$db_loc);
    $parentchild = $db_parentchild->where(array(),"parent_id",$id);
    foreach($parentchild as $pc){
        $student_id = $pc['student_id'];
        $relation = $pc['relation'];
        $student_info  = $db_student->where(array(),"student_id",$student_id);
        foreach($student_info as $student){
            $student_fn = $student['first_name'];
            $student_ln = $student['last_name'];
            $student_sn = $student['suffix_name'];
            $student_name = "$student_fn $student_ln $student_sn";
        }
    

    $const_array = array(
        "student_id"=>$student_id,
        "relation"=>$relation,
        "student_name"=>"$student_name"
    );
    array_push($arr, $const_array);
    }

    return $arr;
}



function parentGetter($id){
    $arr = array();
    $db_loc = "../_store";
    $db_parent = new DBase("parent",$db_loc);
    $db_parentchild = new DBase("parentchild",$db_loc);
    $parentchild = $db_parentchild->where(array(),"student_id",$id);
    foreach($parentchild as $pc){
        $parent_id = $pc['parent_id'];
        $relation = $pc['relation'];
        $parent_info  = $db_parent->where(array(),"parent_id",$parent_id);
        foreach($parent_info as $parent){
            $parent_fn = $parent['first_name'];
            $parent_ln = $parent['last_name'];
            $parent_sn = $parent['suffix_name'];
            $parent_name = "$parent_fn $parent_ln $parent_sn";
        }
    

    $const_array = array(
        "parent_id"=>$parent_id,
        "relation"=>$relation,
        "parent_name"=>"$parent_name"
    );
    array_push($arr, $const_array);
    }

    return $arr;
}

function studentClassGetter($id){
    $arr = array();
    $db_loc = "../_store";
    $db_enroll = new DBase("student_class",$db_loc);
    $db_class = new DBase("class",$db_loc);
    $db_subject = new DBase("subject",$db_loc);
    $db_teacher = new DBase("teacher",$db_loc);

    $student_class = $db_enroll->where(array("enroll_id","school_year","class_id"),"student_id",$id);
    
    foreach($student_class as $enroll){
    
        $enroll_id = $enroll['enroll_id'];
        $school_year_taken = $enroll['school_year'];
        $class_id = $enroll['class_id'];
        $class_info = $db_class->where(array(),"class_id",$class_id);
    
        foreach($class_info as $class){
            $subject_id = $class['subject_id'];
            $subject_info = $db_subject->where(array(),"subject_id",$subject_id);
            foreach($subject_info as $subject){
                $subject_title = $subject['subject_title'];
                $subject_description = $subject['subject_description'];
                $grade = $subject['grade'];
            }
            $school_year = $class['school_year'];
            $section = $class['section'];
            $class_code = $class['class_code'];
            $class_room = $class['class_room'];
            $start_time = $class['start_time'];
            $end_time = $class['end_time'];
            $teacher_id = $class['teacher_id'];
            $teacher_info = $db_teacher->where(array("first_name","last_name","suffix_name"),"teacher_id",$teacher_id);
            foreach($teacher_info as $teacher){
                $teacher_fn = $teacher['first_name'];
                $teacher_ln = $teacher['last_name'];
                $teacher_sn = $teacher['suffix_name'];
                $teacher_name = "$teacher_fn $teacher_ln $teacher_sn";
            }
            $schedule = $class['schedule'];
        }

        $const_array = array(
            "class_id"=>$class_id,
            "subject_id"=>$subject_id,
            "subject_title"=>$subject_title,
            "subject_description"=>$subject_description,
            "school_year"=>$school_year,
            "school_year_taken"=>$school_year_taken,
            "grade"=>$grade,
            "section"=>$section,
            "class_room"=>$class_room,
            "start_time"=>$start_time,
            "end_time"=>$end_time,
            "teacher_id"=>$teacher_id,
            "teacher_name"=>$teacher_name,
            "schedule"=>$schedule
        );
        array_push($arr, $const_array);
    

    }
    return $arr;
}

$data = array();

switch($account_type){
    case("admin"):
        $data = dataGetter("admin",$admin_id);
        foreach($data as $adm){
            $admin_office = $adm['admin_office'];
            $admin_position = $adm['admin_position'];    
        }
        break;
    case("student"):
        $data = dataGetter("student",$student_id);
        foreach($data as $stud){
            $student_lrn = $stud['student_lrn'];
            $grade = $stud['grade'];
            $school_year = $stud['school_year'];
            $section = $stud['section'];    
        }
        $subjects = studentClassGetter($student_id);
        $parents = parentGetter($student_id);
        if(empty($subjects)) $subjects = array();
        if(empty($parents)) $parents = array();
        break;
        case("parent"):
        $data = dataGetter("parent",$parent_id);
        $children = childGetter($parent_id);
        if(empty($children)) $children = array();
        break;
    case("teacher"):
        $data = dataGetter("teacher",$teacher_id);
        break;
    case("staff"):
        $data = dataGetter("staff",$staff_id);
        break;
    case("developer"):
        $data = dataGetter("developer",$developer_id);
        break;
}

foreach($data as $user){
    $first_name = $user['first_name'];
    $middle_name = $user['middle_name'];
    $last_name = $user['last_name'];
    $suffix_name = $user['suffix_name'];
    $gender = $user['gender'];
    $birth_month = $user['birth_month'];
    $birth_day = $user['birth_day'];
    $birth_year = $user['birth_year'];
    $birth_place = $user['birth_place'];
    $address = $user['address'];
    $city = $user['city'];
    $country = $user['country'];
    $mobile_number = $user['mobile_number'];
    $telephone_number = $user['telephone_number'];
    $email = $user['email'];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo "$activity_title - $site_title"; ?></title>
    <?php
        include("../_system/styles.php");
    ?>
    <style>
        nav {
            background-color:seagreen;            
        }
    </style>
</head>
<body class="grey lighten-3">
<?php
    switch($account_type){
        case("student"):
            include("_includes/student.php");
            break;
        case("admin"):
            include("_includes/admin.php");
            break;
        case("teacher"):
            include("_includes/teacher.php");
            break;
        case("parent"):
            include("_includes/parent.php");
            break;
        case("staff"):
            include("_includes/common.php");
            break;
        case("developer"):
            include("_includes/common.php");
            break;
        default:
            die("Unknown account type");
            break;
    }
?>
</body>
</html>
<!--link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"-->