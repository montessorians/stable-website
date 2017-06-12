<?php
session_start();
include("../../_system/database/db.php");
$db_account = new DBase("account", "../../_store");
$db_parent = new DBase("parent", "../../_store");

$query = $_POST['query'];
$searchBy = $_POST['searchBy'];

if(empty($query)){
	$r = $db_account->select(array("parent_id"));
} else {
	
	switch($searchBy){
		case("username"):
			$r = $db_account->like(array("parent_id"), "username", "/.*$query/");
			break;
		case("user_id"):
			$r = $db_account->like(array("parent_id"), "user_id", "/.*$query/");
			break;
		case("parent_id"):
			$r = $db_parent->like(array("parent_id"), "parent_id", "/.*$query/");
			break;
		case("first_name"):
			$r = $db_parent->like(array("parent_id"), "first_name", "/.*$query/");
			break;
		case("last_name"):
			$r = $db_parent->like(array("parent_id"), "last_name", "/.*$query/");
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
					foreach($key as $parent_id){
						$user_id = $db_account->get("user_id", "parent_id", "$parent_id");
						$photo_url = $db_account->get("photo_url", "user_id", "$user_id");
						$first_name = $db_parent->get("first_name", "parent_id", "$parent_id");
						$last_name = $db_parent->get("last_name", "parent_id", "$parent_id");
						$suffix_name = $db_parent->get("suffix_name", "parent_id", "$parent_id");						
						echo "
						
							<div class='card'>
								<div class='card-content'>";
								
								if(empty($photo_url)){} else {
									echo "<img class='right' src='../../$photo_url' width='150px'>";
								}
								
								echo "
									<strong>$first_name $last_name $suffix_name</strong>
									<p><font size='4'>$parent_id</font></p>
								</div>";
							
							if($_SESSION['account_type'] == "admin"){
									
									echo "
									<div class='card-action'>
										<a class='black-text' href='../../profile/?parent_id=$parent_id'>View Profile</a>
										<a class='black-text' href='../../forms/account/add_user.php?parent_id=$parent_id'>Edit Profile</a>
										<a class='black-text' href='../../forms/account/connect_parent.php?parent_id=$parent_id'>Connect to Student</a>
										<a class='black-text' href='../../query/account/connect_parent.php?parent_id=$parent_id'>View Connected Children</a>										
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