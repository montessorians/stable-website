<?php
/*
Holy Child Montessori
2017

Show Posts
*/

// Declare Location
$loc = "../../_store";

// Create obj
$db_post = new DBase("post", "$loc");
$db_account = new DBase("account", "$loc");
$db_student = new DBase("student", "$loc");
$db_parent = new DBase("parent", "$loc");
$db_teacher = new DBase("teacher", "$loc");
$db_admin = new DBase("admin", "$loc");
$db_staff = new DBase("staff", "$loc");
$db_developer = new DBase("developer", "$loc");

// Get array of posts
$array = $db_post->select(array());

// Check for empty array
if(empty($array)){
	
	echo "
	<div class='card hoverable'>
		<div class='card-content'>
			<center>No Posts Yet</center>
		</div>
	</div>";
	
} else {

	echo "<div class='cards-container'>";

	// Reverse Array to make last as first	
	$array = array_reverse($array);
	
	foreach($array as $post){

		$post_id = $post['post_id'];
		$user_id = $post['user_id'];

		$post_title = $post['post_title'];
		$post_content = $post['post_content'];
		$photo_url = $post['photo_url'];

		$create_month = $post['create_month'];
		$create_day = $post['create_day'];
		$create_year = $post['create_year'];
		$create_time = $post['create_time'];

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

		}

		echo "<div class='col s6'><div class='card reveal hoverable'>";

		if(!empty($photo_url)){
			echo "
			<div class='card-img' height='300px'>
				<img src='$photo_url' class='responsive-img' width='100%'>
			</div>";
		}

		echo "<div class='card-content'>";

		if(empty($post_title)){
			echo "
			<p><b>$first_name $last_name $suffix_name</b></p><br>
			<p>$post_content</p><br>
			<p><font class='grey-text' size='-1'>$create_month $create_day, $create_year $create_time</font></p>";
		} else {
			
			echo "
			<p><strong><font size='4pt'>$post_title</font></strong></p><br>
			<p>$post_content</p><br>
			<p><font class='grey-text' size='-1'>$first_name $last_name $suffix_name - $create_month $create_day $create_year $create_time</font></p>";
		}

		echo "</div>";

		echo "
		<div class='card-action'>
			<a id='likeButton$post_id' class='grey-text'><i class='material-icons' id='likedStatus$post_id'></i></a>
			<a href='#comment$post_id' id='button$post_id' class='grey-text'><i class='material-icons'>comment</i></a>";

		$sh = "<a href='action/account/delete_post.php?post_id=$post_id' class='red-text'><i class='material-icons'>delete</i></a>"; 

		if($_SESSION['account_type'] == "admin"){
			echo $sh;
		} else {
			if($_SESSION['account_type'] == "developer") echo $sh;
		}

	echo "
	</div></div></div>
	<div class='modal modal-fixed-footer grey-lighten-4' id='comment$post_id'>
		<div class='modal-content'>
			<div class='card'>
				<div class='card-content'>
					<p><strong><font size='4pt'>$post_title</font></strong></p><br>
					<p>$post_content</p><br>
					<p><font class='grey-text' size='-1'>$first_name $last_name $suffix_name - $create_month $create_day $create_year $create_time</font></p>
				</div>
			</div><br>
			<h5 class='grey-text'>Comments</h5>
			<div class='row'>
				<div class='input-field col s8'>
					<input type='text' id='commentfield$post_id'>
					<label for='commentfield$post_id'>Add a Comment</label>
				</div>
				<div class='input-field col s4'>
					<button class='btn btn-medium btn-block seagreen' id='commentbutton$post_id'><i class='material-icons'>comment</i></button>
				</div>
			</div>
			<div id='commentbox$post_id'></div>";

	$user_id = $_SESSION['user_id'];

	echo "</div>
		<div class='modal-footer'>
			<a class='modal-action modal-close waves-effect waves-red btn-flat'>Close</a>
		</div>
	</div>
	<script type='text/javascript'>

		$(document).ready(function(){
			checkLiked$post_id();
		});

		$('#likeButton$post_id').click(function(){
			toggleLike$post_id();
		});

		$('#button$post_id').click(function(){
			fetchComment$post_id();
		});

		$('#commentbutton$post_id').click(function(){
			sendComment$post_id();
		});

		function toggleLike$post_id(){
			$('#likedStatus$post_id').hide();
			$.ajax({
				type:'POST',
				url: 'action/feed/toggle_liked.php',
				cache: 'false',
				data: {
					post_id: '$post_id'
				},
				success: function(result){
					checkLiked$post_id();
					$('#likedStatus$post_id').slideDown();
				}				
			}).fail(function(){
				Materialize.toast('Cannot connect to server');
				$('#likedStatus$post_id').slideDown();							
			});
		}

		function checkLiked$post_id(){
			var likedDom = '<font class=\'red-text\'>favorite</font>';
			var unlikedDom = 'favorite_border';

			$.ajax({
				type:'POST',
				url:'action/feed/check_liked.php',
				cache: 'false',
				data: {
					user_id : '$user_id',
					post_id : '$post_id'
				},
				success: function(result){
					if(result==='yes'){
						$('#likedStatus$post_id').html(likedDom);
					} else {
						$('#likedStatus$post_id').html(unlikedDom);
					}
				}
			}).fail(function(){
				$('#likedStatus$post_id').html(unlikedDom);
			});
		}

		function fetchComment$post_id(){
			var error = '<div><center>Error Connecting to Server</center></div>';
			$.ajax({
				type:'POST',
				url:'action/feed/show_comments.php',
				data: {
					post_id: '$post_id'
				},
				cache: 'false',
				success: function(result){
					$('#commentbox$post_id').html(result);
				}
			}).fail(function(){
				$('#commentbox$post_id').html('Error');
			});
		}

		function sendComment$post_id(){
			var cb = $('#commentfield$post_id').val();
			if(!cb){
				Materialize.toast('Comment cannot be empty',3000);
			} else {
				$.ajax({
					type:'POST',
					url: 'action/feed/addcomment.php',
					cache: 'false',
					data: {
						post_id: '$post_id',
						comment_body: cb
					},
					success: function(result){
						Materialize.toast(result,3000);						
						fetchComment$post_id();
						$('#commentfield$post_id').val('');
					}
				}).fail(function(){
					Materialize.toast('Error posting comment. Try again.',3000);
				});
			}
		}
	</script>";//footer

	}
}
?>
<script type="text/javascript">
window.sr = ScrollReveal();
sr.reveal('.reveal', {reset: false});

$(document).ready(function(){
    $('.modal').modal();
});
</script>