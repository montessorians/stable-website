<?php
session_start();
include("../../_system/database/db.php");
$db_account = new DBase("account", "../../_store");
$db_teacher = new DBase("teacher", "../../_store");

$query = $_POST['query'];
$searchBy = $_POST['searchBy'];

if(empty($query)){
	$r = $db_account->select(array("teacher_id"));
} else {
	
	switch($searchBy){
		case("username"):
			$r = $db_account->like(array("teacher_id"), "username", "/.*$query/");
			break;
		case("user_id"):
			$r = $db_account->like(array("teacher_id"), "user_id", "/.*$query/");
			break;
		case("teacher_id"):
			$r = $db_teacher->like(array("teacher_id"), "teacher_id", "/.*$query/");
			break;
		case("first_name"):
			$r = $db_teacher->like(array("teacher_id"), "first_name", "/.*$query/");
			break;
		case("last_name"):
			$r = $db_teacher->like(array("teacher_id"), "last_name", "/.*$query/");
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
					foreach($key as $teacher_id){
						$user_id = $db_account->get("user_id", "teacher_id", "$teacher_id");
						$photo_url = $db_account->get("photo_url", "user_id", "$user_id");
						$first_name = $db_teacher->get("first_name", "teacher_id", "$teacher_id");
						$last_name = $db_teacher->get("last_name", "teacher_id", "$teacher_id");
						$suffix_name = $db_teacher->get("suffix_name", "teacher_id", "$teacher_id");						
						echo "
						
							<div class='card'>
								<div class='card-content'>";
								
								if(!empty($photo_url)){
									echo "<img class='right' src='../../$photo_url' width='150px'>";
								}
								
								echo "
									<strong>$first_name $last_name $suffix_name</strong>
									<p><font size='4'>$teacher_id</font></p>
								</div>";
							
							if($_SESSION['account_type'] == "admin"){
									
									echo "
									<div class='card-action'>
										<a class='black-text' href='../../profile/?teacher_id=$teacher_id'>View Profile</a>
										<a class='black-text' href='../../forms/account/add_user.php?teacher_id=$teacher_id'>Edit Profile</a>
										<a class='black-text' href='../../forms/registrar/enroll_teacher.php?teacher_id=$teacher_id'>Assign to Class</a>
										<a class='black-text' href='../../forms/account/reset_password.php?user_id=$user_id'>Reset Password</a>
										<a class='black-text' href='../../forms/account/upload_img.php?user_id=$user_id'>Upload Picture</a>
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