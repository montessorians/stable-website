<?php
require('_connect.php');
require("../_system/database/db.php");

$db = new DBase("admin","../_store");
$admins = $db->select(array());

foreach($admins as $admin){
    $admin_id = $admin['admin_id'];
    $admin_office = $admin['admin_office'];
    $admin_position = $admin['admin_position'];
    $first_name = $admin['first_name'];
    $middle_name = $admin['middle_name'];
    $last_name = $admin['last_name'];
    $suffix_name = $admin['suffix_name'];
    $gender = $admin['gender'];
    $birth_month = $admin['birth_month'];
    $birth_day = $admin['birth_day'];
    $birth_year = $admin['birth_year'];
    $birth_place = $admin['birth_place'];
    $address = $admin['address'];
    $city = $admin['city'];
    $country = $admin['country'];
    $mobile_number = $admin['mobile_number'];
    $telephone_number = $admin['telephone_number'];
    $email = $admin['email'];

    $query = "INSERT INTO `admin` (admin_id,admin_office,admin_position,first_name,middle_name,last_name,suffix_name,gender,birth_month,birth_day,birth_year,birth_place,address,city,country,mobile_number,telephone_number,email) VALUES ('$admin_id','$admin_office','$admin_position','$first_name','$middle_name','$last_name','$suffix_name','$gender','$birth_month','$birth_day','$birth_year','$birth_place','$address','$city','$country','$mobile_number','$telephone_number','$email')";
    if($mysqli->query($query)){
        echo "$admin_id added successfully!<br>";
    } else {
        echo $mysqli->error . "<br>";
    }
}
echo "abc<br><br>";

$r = $mysqli->query("SELECT * FROM admin");
while($entry = $r->fetch_assoc()){
    echo $entry['username'] . "<br>";
}
?>