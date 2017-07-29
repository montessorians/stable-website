<?php
require('_connect.php');
require("../_system/database/db.php");

$db = new DBase("developer","../_store");
$developers = $db->select(array());

foreach($developers as $developer){
    $developer_id = $developer['developer_id'];
    $first_name = $developer['first_name'];
    $middle_name = $developer['middle_name'];
    $last_name = $developer['last_name'];
    $suffix_name = $developer['suffix_name'];
    $gender = $developer['gender'];
    $birth_month = $developer['birth_month'];
    $birth_day = $developer['birth_day'];
    $birth_year = $developer['birth_year'];
    $birth_place = $developer['birth_place'];
    $address = $developer['address'];
    $city = $developer['city'];
    $country = $developer['country'];
    $mobile_number = $developer['mobile_number'];
    $telephone_number = $developer['telephone_number'];
    $email = $developer['email'];

    $query = "INSERT INTO `developer` (developer_id,first_name,middle_name,last_name,suffix_name,gender,birth_month,birth_day,birth_year,birth_place,address,city,country,mobile_number,telephone_number,email) VALUES ('$developer_id','$first_name','$middle_name','$last_name','$suffix_name','$gender','$birth_month','$birth_day','$birth_year','$birth_place','$address','$city','$country','$mobile_number','$telephone_number','$email')";
    if($mysqli->query($query)){
        echo "$developer_id added successfully!<br>";
    } else {
        echo $mysqli->error . "<br>";
    }
}
echo "abc<br><br>";

$r = $mysqli->query("SELECT * FROM developer");
while($entry = $r->fetch_assoc()){
    echo $entry['username'] . "<br>";
}
?>