<?php
$first_name = $db_student->get("first_name", "student_id","$student_id");
$last_name = $db_student->get("last_name", "student_id","$student_id");
$suffix_name = $db_student->get("suffix_name", "student_id","$student_id");
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
      <a href="#notifications" class="button-collapse show-on-large right modal-trigger" id="notifButton"><i id='notificon' class='material-icons'>notifications</i></a>
	  <a href="#apps" class="button-collapse show-on-large hide-on-small-only right modal-trigger"><i class="material-icons">apps</i></a>
      <a href="#myid" class="button-collapse hide-on-med-and-up right modal-trigger"><i class="material-icons">fingerprint</i></a>
    </div>
    <div class="nav-content">
					<ul class="tabs tabs-transparent">
						<li class="tab"><a href="#home" id="homeButton"><i class="material-icons">home</i></a></li>
						<li class="tab"><a href="#assessment"><i class="material-icons">assessment</i></a></li>
						<li class="tab"><a href="#ecash" id="ecashButton"><i class="material-icons">account_balance_wallet</i></a></li>
						<li class="tab"><a href="#people"><i class="material-icons">group</i></a></li>
						<li class="tab"><a href="#me"><i class="material-icons">account_circle</i></a></li>
					</ul>
				</div>
  </nav>
  <div class="col s12" id="home">
  		<div class="progress green lighten-4">
     	<div class="indeterminate green"></div>
  		</div>
  </div>
  <div class="col s12" id="assessment">
  		<div class="progress green lighten-4">
     	<div class="indeterminate green"></div>
  		</div>
  </div>
  <div class="col s12" id="ecash">
  		<div class="progress green lighten-4">
     	<div class="indeterminate green"></div>
  		</div>
  </div>
  <div class="col s12" id="people">
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
	include("_interface/_common/myid.php");
	// Common Apps
	include("_contents/common/apps.php");
?>
  
</body>
<script type="text/javascript">
	$(document).ready(function(){
		setTitle();
		home(); assessment(); ecash(); me(); people(); notif();
		$('.modal').modal();
		$('ul.tabs').tabs({swipeable:false});
		$(document).ready(function(){ $('.tooltipped').tooltip({delay: 50}); });

		setInterval(function(){
			setTitle();
		},100000);
		
	});
	
	$("#clearNotif").click(function(){
		deleteAllNotification();
	});
	
	var error = "<div class='container'><br><br><center><h4 class='grey-text'><i class='medium material-icons'>warning</i><br>You are offline</h4></center></div>";


	$("#homeButton").click(function(){
		home();
	});
	$("#ecashButton").click(function(){
		ecash();
	});
	$("#notifButton").click(function(){
		notif();
	});

	function home(){
		$.ajax({
			type: 'GET',
			url: '_contents/student/home.php',
			success: function(result){
				$("#home").html(result);
			}
		}).fail(function(){$("#home").html(error);});
	}

	function assessment(){
		$.ajax({
			type: 'GET',
			url: '_contents/student/assessment.php',
			success: function(result){
				$("#assessment").html(result);
			}
		}).fail(function(){$("#assessment").html(error);});
	}

	function ecash(){
		$.ajax({
			type: 'GET',
			url: '_contents/student/ecash.php',
			success: function(result){
				$("#ecash").html(result);
			}
		}).fail(function(){$("#ecash").html(error);});
	}

	function people(){
		$.ajax({
			type: 'GET',
			url: '_contents/student/people.php',
			success: function(result){
				$("#people").html(result);
			}
		}).fail(function(){$("#people").html(error);});
	}

	function me(){
		$.ajax({
			type: 'GET',
			url: '_contents/student/me.php',
			success: function(result){
				$("#me").html(result);
			}
		}).fail(function(){$("#me").html(error);});
	}

	function notif(){
		$("#notificationContent").hide();
		$.ajax({
			type: 'GET',
			url: '_contents/common/notification.php',
			success: function(result){
				$("#notificationContent").html(result);
				$("#notificationContent").fadeIn(1000);
			}
		}).fail(function(){
			$("#notificationContent").html(error);
			$("#notificationContent").fadeIn(1000);
		});
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
				setTitle();
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