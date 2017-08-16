<?php
// Generate ID
$teacher_id = mt_rand(1000000000,9999999999);

// Construct Array
$add_teacher_array = array(
    "teacher_id" => "$teacher_id",
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
$db_teacher->add($add_teacher_array);

echo "Teacher Added Successfully. Teacher ID no. is $teacher_id";
?>