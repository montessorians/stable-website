<?php
// Generate ID
$developer_id = mt_rand(1000000000,9999999999);

// Construct Array
$array1 = array(
    "developer_id" => "$developer_id",
    "first_name" => "$first_name",
    "middle_name" => "$middle_name",
    "last_name" => "$last_name",
    "suffix_name" => "$suffix_name",
    "gender" => "$gender",
    "birth_month" => "$birth_month",
    "birth_day" => "$birth_day",
    "birth_year" => "$birth_year",
    "birth_place" => "$birth_place",
    "address" => "$address",
    "city" => "$city",
    "country" => "$country",
    "mobile_number" => "$mobile_number",
    "telephone_number" => "$telephone_number",
    "email" => "$email"							
);

// Add to DB
$db_developer->add($array1);

echo "Developer Added Successfully. Developer ID no. is $developer_id";
?>