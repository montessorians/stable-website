<?php
/**
 * Holy Child Montessori
 * 2017
 * 
 * Action
 * Account
 * Admin
 * 
 * Add an Admin Account
 */

// Generate Admin ID
$admin_id = mt_rand(1000000000,9999999999);

// Construct Array
$add_admin_array = array(
    "admin_id" => "$admin_id",
    "admin_office" => "",
    "admin_position" => "",
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
$db_admin->add($add_admin_array);

echo "Administrator Added Successfully. Admin ID no. is $admin_id";

?>