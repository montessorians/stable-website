<?php
/**
 * Holy Child Montessori
 * 2017
 * 
 * Action
 * Account
 * Student
 * 
 * Add a Student Account
 */

// Generate Student ID
$student_id = date("Y") . mt_rand(100000,999999);

// Query Student ID to prevent redundancy
$stdid_check = $db_student->get("student_id", "student_id", "$student_id");				

// Regenerate if exists
if(!empty($stdid_check)) $student_id = date("Y") . mt_rand(100000,999999);

// Construct Array
$add_student_array = array(
    "student_id" => "$student_id",
    "student_lrn" => "",
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
    "email" => "$email",
    "grade" => "",
    "school_year" => "",
    "section" => ""
);

// Add to DB
$db_student->add($add_student_array);

/*
Create Montessori Pay Account
*/

// Montessori Pay ID
$ecash_id = uniqid();				

$add_ecash_array = array(
    "ecash_id" => "$ecash_id",
    "user_id" => "$user_id",
    "allow_ecash" => "no",
    "daily_limit" => "500.00",
    "current_balance" => "0",
    "previous_balance" => "0",
    "previous_transaction" => "",
    "previous_transaction_merchant" => "",
    "previous_transaction_month" => "",
    "previous_transaction_day" => "",
    "previous_transaction_year" => "",
    "previous_transaction_time" => ""
);

//  Add to DB
$db_ecash->add($add_ecash_array);
					
echo "Student Added Successfully. Student ID no. is $student_id";

?>