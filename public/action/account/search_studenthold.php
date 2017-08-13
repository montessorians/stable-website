<?php
session_start();
include("../_require/db.php");

$student_id = $_POST['student_id'];

if(empty($student_id)){
	$student_hold = $db_hold->select(array("hold_id"));
} else {
	
	$check_studentid = $db_student->get("student_id", "student_id", "$student_id");
	
	if(empty($check_studentid)){ 
		echo "<div class='card'><div class='card-content'>Student not found</div></div>";
	} else {
		
		$student_hold = $db_hold->where(array("hold_id"), "student_id","$student_id");
		
		
			}
			
		}
		
		
		if(empty($student_hold)){
			echo "<div class='card'><div class='card-content'>No record found</div></div>";
		} else {
			
			foreach($student_hold as $key){
				foreach($key as $hold_id){
					$student_id = $db_hold->get("student_id", "hold_id", "$hold_id");
					$first_name = $db_student->get("first_name", "student_id", "$student_id");
					$last_name = $db_student->get("last_name", "student_id", "$student_id");
					$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
					$grade = $db_student->get("grade", "student_id", "$student_id");
					$section = $db_student->get("section", "student_id", "$student_id");
					$department = $db_hold->get("department", "hold_id", "$hold_id");
					$hold_content = $db_hold->get("hold_content", "hold_id", "$hold_id");
					
					echo "
						<div class='card' id='card$hold_id'>
							<div class='card-content'>
								<p>
								<span class='grey-text'>
								$first_name $last_name $suffix_name ($student_id)<br>
								$grade - $section</font><br></span>
								<br>
								Department: <strong>$department</strong><br>
								Content: $hold_content
								<br>
							</div>
							<div class='card-action'>
								<a class='red-text' onclick='delete$hold_id()'>Delete</a>
							</div>
						</div>
						<script type='text/javascript'>
							function delete$hold_id(){
								$.ajax({
									type:'POST',
									url: '../../action/account/delete_hold.php',
									data: {
										hold_id: '$hold_id'
									},
									cache: false,
									success: function(){
										$('#card$hold_id').hide();
									}
								}).fail(function(){
									Materialize.toast('Error deleting hold', 3000);
								});
							}
						</script>
					";
					
				}
		
	}
	
}

?>