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

$data = array();

switch($account_type){
    case("admin"):
        $data = dataGetter("admin",$admin_id);
        $admin_office = $data[0]['admin_office'];
        $admin_position = $data[0]['admin_position'];
        break;
    case("student"):
        $data = dataGetter("student",$student_id);
        $student_lrn = $data[0]['student_lrn'];
        $grade = $data[0]['grade'];
        $school_year = $data[0]['school_year'];
        $section = $data[0]['section'];
        break;
    case("parent"):
        $data = dataGetter("parent",$parent_id);
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
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">