<?php
/**
 * Holy Child Montessori
 * 2018
 * 
 * Montessori Pay
 */
session_start();

if(empty($_REQUEST['student_id'])) $student_id = "";
if(!empty($_REQUEST['student_id'])) $student_id = $_REQUEST['student_id'];

if(empty($_SESSION['logged_in'])){
    header("Location: account/?from=pay.php?student_id=$student_id");
} else {
    if($_SESSION['account_type'] == 'admin'){
        header("Location: forms/ecash/transact.php?student_id=$student_id");
    } else {
        header("Location: index.php");
    }
}
?>