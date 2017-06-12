<?php
$db_post = new DBase("post", "../../_store");
$db_account = new DBase("account", "../../_store");
$db_student = new DBase("student", "../../_store");
$db_parent = new DBase("parent", "../../_store");
$db_teacher = new DBase("teacher", "../../_store");
$db_admin = new DBase("admin", "../../_store");
$db_staff = new DBase("staff", "../../_store");
$db_developer = new DBase("developer", "../../_store");

$array = $db_post->select(array("post_id"));
if(empty($array)){
	
	echo "
	<div class='card'>
		<div class='card-content'>
			<center>No Posts Yet</center>
		</div>
	</div>";
	
} else {
	echo "<div class='cards-container'>";
	
	$array = array_reverse($array);
	
	foreach($array as $key){
		foreach($key as $post_id){
			
			$user_id = $db_post->get("user_id", "post_id", "$post_id");
			$post_title = $db_post->get("post_title", "post_id", "$post_id");
			$post_content = $db_post->get("post_content", "post_id", "$post_id");
			$photo_url = $db_post->get("photo_url", "post_id", "$post_id");
			$create_month = $db_post->get("create_month", "post_id", "$post_id");
			$create_day = $db_post->get("create_day", "post_id", "$post_id");
			$create_year = $db_post->get("create_year", "post_id", "$post_id");
			$create_time = $db_post->get("create_time", "post_id", "$post_id");
			$account_type = $db_account->get("account_type", "user_id", "$user_id");

			switch($account_type){
				case("student"):
					$id = $db_account->get("student_id", "user_id", "$user_id");
					$first_name = $db_student->get("first_name", "student_id", "$id");
					$last_name = $db_student->get("last_name", "student_id", "$id");
					$suffix_name = $db_student->get("suffix_name", "student_id", "$id");
					break;
					
				case("admin"):
					$id = $db_account->get("admin_id", "user_id", "$user_id");
					$first_name = $db_admin->get("first_name", "admin_id", "$id");
					$last_name = $db_admin->get("last_name", "admin_id", "$id");
					$suffix_name = $db_admin->get("suffix_name", "admin_id", "$id");
					break;
					
				case("parent"):
					$id = $db_account->get("parent_id", "user_id", "$user_id");
					$first_name = $db_parent->get("first_name", "parent_id", "$id");
					$last_name = $db_parent->get("last_name", "parent_id", "$id");
					$suffix_name = $db_parent->get("suffix_name", "parent_id", "$id");
					break;
				
				case("teacher"):
					$id = $db_account->get("teacher_id", "user_id", "$user_id");
					$first_name = $db_teacher->get("first_name", "teacher_id", "$id");
					$last_name = $db_teacher->get("last_name", "teacher_id", "$id");
					$suffix_name = $db_teacher->get("suffix_name", "teacher_id", "$id");
					break;
					
				case("staff"):
					$id = $db_account->get("staff_id", "user_id", "$user_id");
					$first_name = $db_staff->get("first_name", "staff_id", "$id");
					$last_name = $db_staff->get("last_name", "staff_id", "$id");
					$suffix_name = $db_staff->get("suffix_name", "staff_id", "$id");
					break;
					
				case("developer"):
					$id = $db_account->get("developer_id", "user_id", "$user_id");
					$first_name = $db_developer->get("first_name", "developer_id", "$id");
					$last_name = $db_developer->get("last_name", "developer_id", "$id");
					$suffix_name = $db_developer->get("suffix_name", "developer_id", "$id");
					break;
			}//
			
			echo "<div class='col s6'><div class='card reveal'>";
				
				if(empty($photo_url)){
				} else {
					echo "
					<div class='card-img' height='300px'>
						<img src='$photo_url' class='responsive-img' width='100%'>
					</div>
					";
				}
				
				echo "
				<div class='card-content'>
					";
					
					if(empty($post_title)){
						echo "
							<p><b>$first_name $last_name $suffix_name</b></p><br>
							<p>$post_content</p>
							<br>
							<p><font class='grey-text' size='-1'>$create_month $create_day, $create_year $create_time</font></p>
						";
					} else {
						echo "
							<p><strong><font size='4pt'>$post_title</font></strong></p><br>
							<p>$post_content</p>
							<br>
							<p><font class='grey-text' size='-1'>$first_name $last_name $suffix_name - $create_month $create_day $create_year $create_time</font></p>
						";
					}
					
					echo "
				</div>
				";
			
		$sh = "
			<div class='card-action'>
				<a href='action/account/delete_post.php?post_id=$post_id' class='red-text'>Delete</a>
			</div>
		";	
			
		if($_SESSION['account_type'] == "admin"){
			echo $sh;
		} else {
			if($_SESSION['account_type'] == "developer"){
				echo $sh;
			} else {
				
			}
		}
			
			echo "</div></div>";
		}
	}
	
	echo "</div>";
}
?>
<script src="_system/scrollreveal.min.js"></script>
<script type="text/javascript">
window.sr = ScrollReveal();
sr.reveal('.reveal', {reset: false});
</script>