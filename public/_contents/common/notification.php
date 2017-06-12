<?php
session_start();
include("../../_system/database/db.php");
include("../../_system/config.php");
$user_id =$_SESSION['user_id'];

$db_notification = new DBase("notification", "../../_store");
$array = $db_notification->where(array("notification_id"), "user_id", "$user_id");
?>
	<?php
	if(empty($array)){
		echo "<div class='container'><br><br><center><h5 class='grey-text'><i class='medium material-icons'>sentiment_very_satisfied</i><br>All Caught Up!</h5></center></div>";
	} else {
		
		echo "<ul class='collection'>";
		
		$array = array_reverse($array);
		
		foreach($array as $key){
			foreach($key as $notification_id){
				
			 $notification_title = $db_notification->get("notification_title", "notification_id", "$notification_id");
			 $notification_content = $db_notification->get("notification_content", "notification_id", "$notification_id");
			 $photo_url = $db_notification->get("photo_url", "notification_id", "$notification_id");
			 $notification_url = $db_notification->get("notification_url", "notification_id", "$notification_id");
			 $notification_icon = $db_notification->get("notification_icon", "notification_id", "$notification_id");
			 $sender_alternative = $db_notification->get("sender_alternative", "notification_id", "$notification_id");
			 $sender_id = $db_notification->get("sender_id", "notification_id", "$notification_id");
			 $create_month = $db_notification->get("create_month", "notification_id", "$notification_id");
			 $create_day = $db_notification->get("create_day", "notification_id", "$notification_id");
			 $create_year = $db_notification->get("create_year", "notification_id", "$notification_id");
			 $create_time = $db_notification->get("create_time", "notification_id", "$notification_id");
			 
			 echo "<li class='collection-item avatar'>";
			 
			 if(empty($notification_url)){} else {
			 		echo "<a href='$notification_url'>";
			 }
			 
			 if(empty($photo_url)){
			 		echo "<i class='material-icons circle $accent_color'>$notification_icon</i>";
			 } else {
			 		echo "<img src='$photo_url' class='circle'>";
			 }
			 
			 echo "
			 	<p class='black-text'>
			 		<b>$notification_title</b><br>
			 		<span class='grey-text text-darken-2'>$notification_content</span>
			 	</p>
			 	<p><font size='-1' class='grey-text'>
			 		$sender_alternative - $create_month $create_day, $create_year $create_time
			 	</font></p>
			 ";
			 if(empty($notification_url)){} else {
			 	 echo "</a>";
			 }
			 echo "<a class='secondary-content' onclick='deleteID$notification_id()' href='#'>
				<i class='material-icons black-text'>close</i>
				</a>";
			 echo "</li>";
				
				echo "
				<script type='text/javascript'>
					function deleteID$notification_id(){
						$.ajax({
							url:'../../action/account/delete_notification.php?notification_id=$notification_id',
							success:function(){
								notif(); setTitle();}
								}).fail(function(){
									Materialize.toast('Server error', 2000);
									console.log('Error connecting to server');
									});}
				</script>
						";
				
			}
		}
		
		echo "</ul>";
		
	}?>
