<?php
include("../_include/setup.php");
$array = $db_notification->where(array(), "user_id", "$user_id");
?>
<style>
	.notif-content{
		padding-right: 30px;
		text-align: left;
	}
</style>
	<?php
	if(empty($array)){
		echo "<div class='container'><br><br><center><h5 class='grey-text'><i class='medium material-icons'>sentiment_very_satisfied</i><br>All Caught Up!</h5></center></div>";
	} else {
		
		echo "<ul class='collection'>";
		
		$array = array_reverse($array);
		
		foreach($array as $notif){
			$notification_id = $notif['notification_id'];
			$notification_title = $notif['notification_title'];
			$notification_content = $notif['notification_content'];
			$photo_url = $notif['photo_url'];
			$notification_url = $notif['notification_url'];
			$notification_icon = $notif['notification_icon'];
			$sender_alternative = $notif['sender_alternative'];
			$sender_id = $notif['sender_id'];
			$create_month = $notif['create_month'];
			$create_day = $notif['create_day'];
			$create_year = $notif['create_year'];
			$create_time = $notif['create_time'];

			echo "<li class='collection-item avatar'>";
			if(isset($notification_url))echo "<a href='$notification_url'>";
			if(!$photo_url){echo "<i class='material-icons circle $accent_color'>$notification_icon</i>";} else {echo "<img src='$photo_url' class='circle'>";}
			echo "
			 	<p class='notif-content black-text'>
			 		<b>$notification_title</b><br>
			 		<span class='grey-text text-darken-2'>$notification_content</span>
			 	</p>
			 	<p><font size='-1' class='grey-text'>
			 		$sender_alternative - $create_month $create_day, $create_year $create_time
			 	</font></p>
			";
			if(isset($notification_url))echo"</a>";
			echo "<a class='secondary-content' onclick='deleteID$notification_id()' href='#'>
				<i class='material-icons black-text'>close</i>
				</a></li>
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
		echo "</ul>";
	}
?>
