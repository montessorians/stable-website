<?php
// Generate ID
$staff_id = mt_rand(1000000000,9999999999);

// Construct Array
$add_staff_array = array(
    "staff_id" => "$staff_id",
    "staff_office" => "",
    "staff_position" => "",
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
$db_staff->add($add_staff_array);

echo "Staff Added Successfully. Staff ID no. is $staff_id";
?>