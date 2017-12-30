<?php
/*
Holy Child Montessori
2017

Search Connect Parent
*/

// Start Session
session_start();

// Declare Permission Level
$perm = 5;

// Require Secure Files
require_once("../../_system/secure.php");

// Include DB
include("../_require/db.php");

// Handle Post Data
$query = $_POST['query'];
$searchBy = $_POST['searchBy'];

// Check if empty query
if(empty($query)){

	$r = $db_parentchild->select(array());

} else {
	
	switch($searchBy){

		case("parent_id"):

			$r = $db_parentchild->like(array(), "parent_id", "/.*$query/");
			break;

		case("student_id"):

			$r = $db_parentchild->like(array(), "student_id", "/.*$query/");
			break;

			}//
					
	}
	

// Check for empty result
if(empty($r)){

	echo "
	<div class='card'>
		<div class='card-content'>
			<center>No results found for $query</center>
		</div>
	</div>";

}

if(!empty($r)){
	
	foreach($r as $pc){
		$parentchild_id = $pc['parentchild_id'];
		$parent_id = $pc['parent_id'];
		$student_id = $pc['student_id'];
		$relation = $pc['relation'];

		$parent_info = $db_parent->where(array(),"parent_id",$parent_id);
		$student_info = $db_student->where(array(),"student_id",$student_id);

		foreach($parent_info as $parent){
			$p_first_name = $parent['first_name'];
			$p_last_name = $parent['last_name'];
			$p_suffix_name = $parent['suffix_name'];
			$p_name = "$p_first_name $p_last_name $p_suffix_name";
		}
		foreach($student_info as $student){
			$s_first_name = $student['first_name'];
			$s_last_name = $student['last_name'];
			$s_suffix_name = $student['suffix_name'];
			$s_name = "$s_first_name $s_last_name $s_suffix_name";
		}

		echo "
		<div class='card'>
			<div class='card-content'>
				<p><font size='3'><b>Parent: $p_name<br>Child: $s_name ($student_id)</b></font></p>
		</div>";

		// Show addt'l options for admin							
		if($_SESSION['account_type'] == "admin"){
								
			echo "
			<div class='card-action'>
				<a class='black-text' href='../../profile/?parent_id=$parent_id'>View Parent</a>
				<a class='black-text' href='../../profile/?student_id=$student_id'>View Student</a>
				<a class='black-text' href='../../action/account/delete_parentchild.php?parentchild_id=$parentchild_id'>Remove Connection</a>
			</div></div>";
								
		}
							
		// card ender
		echo "</div>";
	}
		
}

?>