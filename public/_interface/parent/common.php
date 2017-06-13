<?php
$first_name = $db_parent->get("first_name", "parent_id","$parent_id");
$last_name = $db_parent->get("last_name", "parent_id","$parent_id");
$suffix_name = $db_parent->get("suffix_name", "parent_id","$parent_id");
$name = $first_name . " " . $last_name . " " . $suffix_name;
?>
<style>
.title{margin-left: 30px;}
.round{
	border-radius: 30pt;
}
</style>
<body class="grey lighten-3">
<nav class="nav-extended <?=$primary_color?>">
    <div class="nav-wrapper">
      <a class="title"><?=$site_title?></a>
      <a href="#notifications" class="button-collapse show-on-large right modal-trigger" id="notif-trigger"><i id="notificon" class="material-icons">notifications</i></a>
	  <a href="#apps" class="button-collapse show-on-large hide-on-small-only right modal-trigger" id="notif-trigger"><i class="material-icons">apps</i></a>
    </div>
    <div class="nav-content">
					<ul class="tabs tabs-transparent">
						<li class="tab"><a href="#home"><i class="material-icons">home</i></a></li>
						<li class="tab"><a href="#people"><i class="material-icons">group</i></a></li>
						<li class="tab"><a href="#assessment"><i class="material-icons">assessment</i></a></li>
						<li class="tab"><a href="#me"><i class="material-icons">account_circle</i></a></li>
					</ul>
				</div>
  </nav>
  <div class="col s12" id="home">
  		<div class="progress green lighten-4">
     	<div class="indeterminate green"></div>
  		</div>
  </div>
  <div class="col s12" id="people">
  		<div class="progress green lighten-4">
     	<div class="indeterminate green"></div>
  		</div>
  </div>
  <div class="col s12" id="assessment">
  		<div class="progress green lighten-4">
     	<div class="indeterminate green"></div>
  		</div>
  </div>
  <div class="col s12" id="me">
  		<div class="progress green lighten-4">
     	<div class="indeterminate green"></div>
  		</div>
  </div>
  
<?php
	// Interface Modals
	include("_interface/_common/notifications.php");
	// Common Apps
	include("_contents/common/apps.php");
?>
  
</body>
<script type="text/javascript">
	$(document).ready(function(){
		setTitle();
		home(); people(); assessment(); me(); notif();
		$('.modal').modal();
		$('ul.tabs').tabs({swipeable:false});
		$(document).ready(function(){ $('.tooltipped').tooltip({delay: 50}); });
		
		setInterval(function(){
			home();
		},90000);
		setInterval(function(){
			notif();
			setTitle();
		},20000);
		
	});
	
	$("#clearNotif").click(function(){
		deleteAllNotification();
	});
	
	var error = "<div class='container'><br><br><center><h4 class='grey-text'><i class='medium material-icons'>warning</i><br>You are offline</h4></center></div>";
	function home(){
		$.ajax({
			type: 'GET',
			url: '_contents/parent/home.php',
			success: function(result){
				$("#home").html(result);
			}
		}).fail(function(){$("#home").html(error);});
	}

	function people(){
		$.ajax({
			type: 'GET',
			url: '_contents/parent/people.php',
			success: function(result){
				$("#people").html(result);
			}
		}).fail(function(){$("#people").html(error);});
	}

	function assessment(){
		$.ajax({
			type: 'GET',
			url: '_contents/parent/assessment.php',
			success: function(result){
				$("#assessment").html(result);
			}
		}).fail(function(){$("#assessment").html(error);});
	}

	function me(){
		$.ajax({
			type: 'GET',
			url: '_contents/parent/me.php',
			success: function(result){
				$("#me").html(result);
			}
		}).fail(function(){$("#me").html(error);});
	}
	
	function notif(){
		$.ajax({
			type: 'GET',
			url: '_contents/common/notification.php',
			success: function(result){
				$("#notificationContent").html(result);
			}
		}).fail(function(){$("#notificationContent").html(error);});
	}
	
	function deleteAllNotification(){
	$.ajax({
		type:'POST',
		url: "action/account/delete_notification_all.php",
		data: {
			content: 'none'
		},
		cache: false,
		success: function(result){
			if(result=="ok"){
				notif();
			} else {
				Materialize.toast("Error clearing notifications");
			}
		}
		}).fail(function(){
			Materialize.toast("Error clearing notifications");
		});
	}

	function setTitle(){
		var siteTitle = "<?=$site_title?>";
		$.ajax({
			type: 'POST',
			url: 'action/account/notification_count.php',
			cache: false,
			data: {
				user_id: '<?=$user_id?>'
			},
			success: function(result){
				var notifCount = result;
				if(!notifCount || notifCount==0){
				var title = siteTitle;
				$("#notificon").html("notifications_none");
				} else {
					var title = "(" + notifCount + ") " + siteTitle;
					$("#notificon").html("notifications");
				}
				$(document).prop("title", title);
			}
		}).fail(function(){
			$(document).prop("title", siteTitle);
			$("#notificon").html("notifications_paused");
			console.log('Error fetching notification count');
			});		
	}
</script>