<?php
session_start();
include("../_require/db.php");

$query = $_POST['query'];
$searchBy = $_POST['searchBy'];

if(empty($query)){
	$r = $db_parentchild->select(array("parentchild_id"));
} else {
	
	switch($searchBy){
		case("parent_id"):
			$r = $db_parentchild->like(array("parentchild_id"), "parent_id", "/.*$query/");
			break;
		case("student_id"):
			$r = $db_parentchild->like(array("parentchild_id"), "student_id", "/.*$query/");
			break;
			}//
					
				}
	
	
	if(empty($r)){
				echo "
					<div class='card'>
						<div class='card-content'>
							<center>No results found for $query</center>
						</div>
					</div>
				";
			} else {
				
				foreach($r as $key){
					foreach($key as $parentchild_id){
                        $parent_id = $db_parentchild->get("parent_id", "parentchild_id", "$parentchild_id");
                        $student_id = $db_parentchild->get("student_id", "parentchild_id", "$parentchild_id");

                        $p_first_name = $db_parent->get("first_name", "parent_id", "$parent_id");
                        $p_last_name = $db_parent->get("last_name", "parent_id", "$parent_id");
                        $p_suffix_name = $db_parent->get("suffix_name", "parent_id", "$parent_id");
                        $p_name = $p_first_name." ".$p_last_name." ".$p_suffix_name;

                        $s_first_name = $db_student->get("first_name", "student_id", "$student_id");
                        $s_last_name = $db_student->get("last_name", "student_id", "$student_id");
                        $s_suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
                        $s_name = $s_first_name." ".$s_last_name." ".$s_suffix_name;


						echo "
						
							<div class='card'>
								<div class='card-content'>";
																
								echo "
                                    <p><font size='3'><b>Parent: $p_name<br>Child: $s_name ($student_id)</b></font></p>

								</div>";
							
							if($_SESSION['account_type'] == "admin"){
									
									echo "
									<div class='card-action'>
										<a class='black-text' href='../../profile/?parent_id=$parent_id'>View Parent</a>
                                        <a class='black-text' href='../../profile/?student_id=$student_id'>View Student</a>
										<a class='black-text' href='../../action/account/delete_parentchild.php?parentchild_id=$parentchild_id'>Remove Connection</a>
									</div>
									</div>
									";
									
							}
							
						echo	"
							</div>
						";
						
					}
				
			} 
	
	
}

?>