<?php
session_start();
include("../../_system/database/db.php");
$db_account = new DBase("account", "../../_store");
$db_student = new DBase("student", "../../_store");

$query = $_POST['query'];
$searchBy = $_POST['searchBy'];

if(empty($query)){
	
	$r = $db_account->select(array("student_id"));
	
} else {
	
	switch($searchBy){
		case("username"):
			$r = $db_account->like(array("student_id"), "username", "/.*$query/");
			break;
		case("user_id"):
			$r = $db_account->like(array("student_id"), "user_id", "/.*$query/");
			break;
		case("student_id"):
			$r = $db_student->like(array("student_id"), "student_id", "/.*$query/");
			break;
		case("first_name"):
			$r = $db_student->like(array("student_id"), "first_name", "/.*$query/");
			break;
		case("last_name"):
			$r = $db_student->like(array("student_id"), "last_name", "/.*$query/");
			break;
		case("grade"):
			$r = $db_student->like(array("student_id"), "grade", "/.*$query/");
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
					foreach($key as $student_id){
						$user_id = $db_account->get("user_id", "student_id", "$student_id");
						$photo_url = $db_account->get("photo_url", "student_id", "$student_id");
						$first_name = $db_student->get("first_name", "student_id", "$student_id");
						$last_name = $db_student->get("last_name", "student_id", "$student_id");
						$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
						$grade = $db_student->get("grade", "student_id", "$student_id");
						$section = $db_student->get("section", "student_id", "$student_id");
						$student_lrn = $db_student->get("student_lrn", "student_id", "$student_id");
						
						echo "
						
							<div class='card'>
								<div class='card-content'>";
								
								if(empty($photo_url)){
									
								} else {
									
									echo "<img src='../../$photo_url' class='right' width='100px'><br>";
									
								}
								
								echo "
									<strong>$first_name $last_name $suffix_name</strong>
									<p class='grey-text'>
										User ID: $user_id<br>
										Grade: $grade - $section<br>
										LRN: $student_lrn
									</p>
									<font size='4'>$student_id</font>
								</div>";
								
								if($_SESSION['account_type'] == "admin"){
									echo "
										<div class='card-action'>
											<a href='../../forms/ecash/transact.php?student_id=$student_id' class='black-text'>
												Transact w/ E-Cash
											</a>
											<a href='../../profile/?student_id=$student_id' class='black-text'>
												View Profile
											</a>
											<a href='../../forms/account/add_user.php?student_id=$student_id' class='black-text'>
												Edit Profile
											</a>
											<a href='../../forms/registrar/enroll_student.php?student_id=$student_id' class='black-text'>
												Enroll
											</a>
											<a href='../../forms/registrar/enroll_class.php?student_id=$student_id' class='black-text'>
												Add Class
											</a>
											<a href='../../forms/account/hold_user.php?student_id=$student_id' class='black-text'>
												Add Hold
											</a>
											<a href='../../query/account/student_hold.php?student_id=$student_id' class='black-text'>
												See Hold
											</a>
											<a href='../../forms/registrar/set_lrn.php?student_id=$student_id' class='black-text'>
												Set LRN
											</a>
											<a href='../../forms/ecash/allow_ecash.php?student_id=$student_id' class='black-text'>
												Set E-Cash
											</a>
											<a href='../../forms/account/connect_parent.php?student_id=$student_id' class='black-text'>
												Connect Parent
											</a>
											<a href='../../forms/account/upload_img.php?user_id=$user_id' class='black-text'>
												Set Picture
											</a>
											<a href='../../print/grades/?student_id=$student_id' target='_blank' class='black-text'>
												Progress Report
											</a>
											<a href='../../forms/account/reset_password.php?user_id=$user_id' class='black-text'>
												Reset Password
											</a>
										</div>									
									";
								}
								
							echo "</div>";
					}
				}
				
			}


?>