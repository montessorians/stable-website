
<style>
	.t{
		padding-left: 20px;
	}
</style>
<body class="grey lighten-3">
<nav class="nav-extended blue-grey darken-2">
    <div class="nav-wrapper">
      <a class="title">Admin Console</a>
      <a class="button-collapse show-on-large"><i class="material-icons">person</i></a>
      <a href="#notifications" href="account" class="button-collapse show-on-large right modal-trigger" id="notifButton"><i id="notificon" class="material-icons">notifications</i></a>
	  <a href="#apps" class="button-collapse show-on-large hide-on-small-only right modal-trigger"><i class="material-icons">apps</i></a>
    </div>
    <div class="nav-content">
					<ul class="tabs tabs-transparent">
						<li class="tab"><a href="#home" id="homeButton">Home</a></li>
						<li class="tab"><a href="#calendar">Calendar</a></li>
						<li class="tab"><a href="#ecash">E-Cash</a></li>
						<li class="tab"><a href="#registrar">Registrar</a></li>
			
						<li class="tab"><a href="#administration">Administration</a></li>
						<li class="tab"><a href="#more">More</a></li>
					</ul>
				</div>
  </nav>
  
  <div id="home">
  	<div class="container">
  		<br>
  		<h5 class="blue-grey-text text-darken-2">My Feed</h5>
  	</div>
  </div>
  <div id="ecash" class="col s12">
  	<ul class="collection">
			<li class="collection-item">
				<a href="forms/ecash/transact.php" class="black-text">Transact with E-Cash</a>
			</li>
		</ul>
  </div>
  <div id="calendar" class="col s12">
	<iframe src="https://calendar.google.com/calendar/embed?showTitle=0&amp;showCalendars=0&amp;showTz=0&amp;height=500&amp;wkst=1&amp;bgcolor=%23ffffff&amp;src=fnlv7nr0lp27l04m7nk9fht4q0%40group.calendar.google.com&amp;color=%23711616&amp;ctz=Asia%2FManila" style="border-width:0" width="100%" height="500" frameborder="0" scrolling="no"></iframe>
  </div>
  
  <div id="registrar" class="col s12">
  <br>
  <h5 class="blue-grey-text t">Quick Search</h5>
  	<ul class="collection">
  		<li class="collection-item">
  			<a href="query/account/students.php" class="black-text">Search a Student</a>
  		</li>
  		<li class="collection-item">
  			<a href="query/account/teachers.php" class="black-text">Search a Teacher</a>
  		</li>
  		<li class="collection-item">
  			<a href="query/registrar/classes.php" class="black-text">Search Classes</a>
  		</li>
  		<li class="collection-item">
  			<a href="query/account/parent.php" class="black-text">Search a Parent</a>
  		</li>
  		</ul>
  		<h5 class="blue-grey-text t">User Management</h5>
  		<ul class="collection">
  		<li class="collection-item">
  			<a href="forms/account/add_user.php" class="black-text">Add User</a>
  		</li>
		<li class="collection-item">
  			<a href="forms/account/connect_parent.php" class="black-text">Connect Parent to Student</a>
  		</li>
  		</ul>
  		<h5 class="blue-grey-text t">Class and Enrollment</h5>
  		<ul class="collection">
  		<li class="collection-item">
  			<a href="query/registrar/classes.php" class="black-text" target="_blank">Search Classes & Encode Grades</a>
  		</li>
  		<li class="collection-item">
  			<a href="forms/registrar/enroll_student.php" class="black-text">Enroll a Student</a>
  		</li>
  		<li class="collection-item">
  			<a href="forms/registrar/enroll_class.php" class="black-text">Add a Subject/Class to a Student</a>
  		</li>
  		<li class="collection-item">
  			<a href="forms/registrar/enroll_teacher.php" class="black-text">Assign Teacher to a Class</a>
  		</li>
  		<li class="collection-item">
  			<a href="forms/registrar/create_class.php" class="black-text">Create a Subject/Class</a>
  		</li>
  		<li class="collection-item">
  			<a href="forms/registrar/set_lrn.php" class="black-text">Set Student LRN</a>
  		</li>
  	</ul>
  </div>
  
  <div id="administration">
  		<ul class="collection">
  		<li class="collection-item">
  			<a href="forms/registrar/set_schooldata.php" class="black-text">Set School Data</a>
  		</li>
  		<li class="collection-item">
  			<a href="forms/account/hold_user.php" class="black-text">Hold a Student</a>
  		</li>
  		<li class="collection-item">
  			<a href="query/account/student_hold.php" class="black-text">Search/Delete Hold</a>
  		</li>
  		<li class="collection-item">
  			<a href="query/account/admin.php" class="black-text">Search an Admin</a>
  		</li>
  	</ul>
  </div>
  
  <div id="more" class="col s12">
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
		$("meta[name='theme-color']").attr("content", "#455a64");
		setTitle();
		home(); me();	notif();
		$('.modal').modal();
		$('.collapsible').collapsible();

		setInterval(function(){
			setTitle();
		},100000);

	}).keypress(function(e){
		var key = e.which;
		if(key == 13){
			window.location.replace("query/account/students.php");
		}
	});

	$("#homeButton").click(function(){
		home();
	});
	
	$("#notifButton").click(function(){
		notif();
	});

	$("#clearNotif").click(function(){
		deleteAllNotification();
	});
	
	var error = "<div class='container'><br><br><center><h4 class='grey-text'><i class='medium material-icons'>warning</i><br>You are offline</h4></center></div>";
	
	function home(){
		$.ajax({
			type: 'GET',
			url: '_contents/administrator/home.php',
			success: function(result){
				$("#home").html(result);
			}
		}).fail(function(){$("#home").html(error);});
	}

	function me(){
		$.ajax({
			type: 'GET',
			url: '_contents/administrator/me.php',
			success: function(result){
				$("#more").html(result);
			}
		}).fail(function(){$("#more").html(error);});
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