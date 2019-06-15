<?php
include("../_include/setup.php");
$first_name = $db_admin->get("first_name","admin_id",$_SESSION['admin_id']);
$exam_week = $db_schooldata->get("exam_week", "school_id", "1");
if($exam_week === "yes"){
	$exam_week = "
		<div class='card yellow'>
			<div class='card-content'>
				<center>School is on Exam Week (Change this in settings)</center>
			</div>
		</div>
	";
} else {
	$exam_week = "";
}
?>
<script type="text/javascript">
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
startTime();
</script>
<div class="container">

<a href="#notifications" onclick="notif()" class="button-collapse show-on-large right modal-trigger seagreen-text" id="notifButton"><i id="notificon" class="material-icons">notifications</i></a>
<h1 class="seagreen-text" style="text-emphasis:bold;">
  Hello<br><?=$first_name?>!
</h1>

<br>
<h5 class="seagreen-text">
	My Feed
</h5>
<br>
	<a href="forms/account/post_feed.php" class="btn btn-large seagreen waves-effect waves-light">Post</a>
<br><br>
<div class="card">
<div class="card-content">
	<h5>
		Today is <?=date("M d Y")?> <span id="txt"></span>
	</h5>
</div>
</div>
<div id="postFeed">
<?php
	echo $exam_week;
	include("../../action/account/show_posts.php");
?>
</div>
</div>
<br><br><br><br><br>
<script>
    $(document).ready(()=>{
          setInterval(()=>{
              setTitle();
                },100000); 
              });
	/* Load Notification in Modal */

	function notif(){
		// Show Ajax Loader
		$("#notificationContent").html(loadingCircle);
		// Start Ajax
		$.ajax({
			type: 'GET',
			url: '_contents/common/notification.php',
			success: (result)=>{
				// Show fetched content in Modal
				$("#notificationContent").html(result);
				// Slowly fade-in content
				$("#notificationContent").fadeIn(500);
			}
		}).fail(()=>{
			// Show an Error if Fail
			$("#notificationContent").html(error);
			// Slowly fade-in content
			$("#notificationContent").fadeIn(500);
		});
	}

	/* Delete All Notification */
	function deleteAllNotification(){
	// Start AJAX
	$.ajax({
		type:'POST',
		url: "action/account/delete_notification_all.php",
		data: {
			content: 'none'
		},
		cache: false,
		success: (result)=>{
			// If result returns ok
			if(result=="ok"){
				// Refresh notif
				notif();
				// Set Page Title
				setTitle();
            } else {
                //console.log(result);
				// Show an Error to user if Fail Clearing Notifs
				Materialize.toast("Error clearing notifications");
			}
		}
		}).fail(()=>{
			// Show an Error if Failed to Pass Through
			Materialize.toast("Error clearing notifications");
		});
	}

	/* Set Page Title */
	function setTitle(){
		// Set Site Title
		var siteTitle = "<?=$site_title?>";
		// Start AJAX
		$.ajax({
			type: 'POST',
			url: 'action/account/notification_count.php',
			cache: false,
			data: {
				user_id: '<?=$user_id?>'
			},
			success: (result)=>{
				// Hold result as notifCount
				var notifCount = result;
				// Check if Notif Count is empty
				if(!notifCount || notifCount==0){
				// Set Title to be used
				var title = siteTitle;
				// Set Empty Notification Icon
				$("#notificon").html("notifications_none");
				} else {
					// Check if Returned Result is not a Number
					if(isNaN(notifCount)){
						// Set Title to be Used
						var title = siteTitle;
					} else {
						if(notifCount>100) var title = "100+";
						if(notifCount>1000)var title = "1000+";
						// Construct and Set title
						var title = `(${notifCount}) ${siteTitle}`;
					}
					// Set Notification Icon
					$("#notificon").html("notifications");
				}
				// Set Page Title
				$(document).prop("title", title);
			}
		}).fail(()=>{
			// Set Initial Title as Page Title
			$(document).prop("title", siteTitle);
			// Set Paused Notification Title
			$("#notificon").html("notifications_paused");
			// Log the Error to Client Browser for Reference
			console.error('Error fetching notification count');
			});		
	}
</script>
