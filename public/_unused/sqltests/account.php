<?php
require('_connect.php');
require("../_system/database/db.php");

$db_account = new DBase("account","../_store");
$accounts = $db_account->select(array());

foreach($accounts as $account){
    $user_id = $account['user_id'];
    $account_type = $account['account_type'];
    $student_id = $account['student_id'];
    $admin_id = $account['admin_id'];
    $teacher_id = $account['teacher_id'];
    $parent_id = $account['parent_id'];
    $developer_id = $account['developer_id'];
    $staff_id = $account['staff_id'];
    $username = $account['username'];
    $password = $account['password'];
    $photo_url = $account['photo_url'];
    $create_month = $account['create_month'];
    $create_day = $account['create_day'];
    $create_year = $account['create_year'];
    $create_hour = $account['create_hour'];
    $create_minute = $account['create_minute'];
    $query = "INSERT INTO `account` (user_id,account_type,student_id,admin_id,teacher_id,parent_id,developer_id,staff_id,username,password,photo_url,create_month,create_day,create_year,create_hour,create_minute) VALUES ('$user_id','$account_type','$student_id','$admin_id','$teacher_id','$parent_id','$developer_id','$staff_id','$username','$password','$photo_url','$create_month','$create_day','$create_year','$create_hour','$create_minute')";
    if($mysqli->query($query)){
        echo "$user_id added successfully!<br>";
    } else {
        echo $mysqli->error . "<br>";
    }
}
echo "abc<br><br>";

$r = $mysqli->query("SELECT * FROM account");
while($entry = $r->fetch_assoc()){
    echo $entry['username'] . "<br>";
}
?>