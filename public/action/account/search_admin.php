<?php
session_start();

// Declare Permission Level
$perm = 5;
require_once("../../_system/secure.php");

include("../_require/db.php");

$query = $_POST['query'];
$searchBy = $_POST['searchBy'];

if(empty($query)){
	$r = $db_account->select(array("admin_id"));
} else {
	
	switch($searchBy){
		case("username"):
			$r = $db_account->like(array("admin_id"), "username", "/.*$query/");
			break;
		case("user_id"):
			$r = $db_account->like(array("admin_id"), "user_id", "/.*$query/");
			break;
		case("admin_id"):
			$r = $db_admin->like(array("admin_id"), "admin_id", "/.*$query/");
			break;
		case("first_name"):
			$r = $db_admin->like(array("admin_id"), "first_name", "/.*$query/");
			break;
		case("last_name"):
			$r = $db_admin->like(array("admin_id"), "last_name", "/.*$query/");
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
					foreach($key as $admin_id){
						$user_id = $db_account->get("user_id", "admin_id", "$admin_id");
						$photo_url = $db_account->get("photo_url", "user_id", "$user_id");
						$first_name = $db_admin->get("first_name", "admin_id", "$admin_id");
						$last_name = $db_admin->get("last_name", "admin_id", "$admin_id");
						$suffix_name = $db_admin->get("suffix_name", "admin_id", "$admin_id");						
						echo "
						
							<div class='card'>
								<div class='card-content'>";
								
								if(empty($photo_url)){} else {
									echo "<img class='right' src='../../$photo_url' width='150px'>";
								}
								
								echo "
									<strong>$first_name $last_name $suffix_name</strong>
									<p><font size='4'>$admin_id</font></p>
								</div>";
							
							if($_SESSION['account_type'] == "admin"){
									
									echo "
									<div class='card-action'>
										<a class='black-text' href='../../profile/?admin_id=$admin_id'>View Profile</a>
										<a class='black-text' href='../../forms/account/add_user.php?admin_id=$admin_id'>Edit Profile</a>
										<a class='black-text' href='../../forms/account/reset_password.php?user_id=$user_id'>Reset Password</a>
										<a class='black-text' href='../../forms/account/upload_img.php?user_id=$user_id'>Upload Picture</a>
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