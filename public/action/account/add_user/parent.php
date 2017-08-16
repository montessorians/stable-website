<?php
// Generate ID
$parent_id = mt_rand(1000000000,9999999999);

// Construct Array
$add_parent_array = array(
    "parent_id" => "$parent_id",
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
$db_parent->add($add_parent_array);

echo "Parent Added Successfully. Parent ID no. is $parent_id";
?>