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
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<body class="grey lighten-3">
<div class="splashscreen"></div>
<nav class="nav-extended <?=$primary_color?>">
    <div class="nav-wrapper">
      <a class="title" href="/"><?=$site_title?></a>
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
			<!--li class="tab"><a href="#pulse" id="pulseButton"><i class="material-icons">bubble_chart</i></a></li-->
			<li class="tab"><a href="#me"><i class="material-icons">account_circle</i></a></li>
		</ul>
	</div>
</nav>
<div class="col s12" id="home"></div>
<div class="col s12" id="assessment"></div>
<div class="col s12" id="ecash"></div>
<div class="col s12" id="people"></div>
<div class="col s12" id="pulse"></div>
<div class="col s12" id="me"></div>  
<?php
	// Interface Modals
	include("_interface/_common/notifications.php");
	include("_interface/_common/myid.php");
	// Common Apps
	include("_contents/common/apps.php");
?>
  
</body>
<script type="text/javascript">
	// Declaratives
	<?php include("_interface/_common/js_global_declaratives.php"); ?>

	// Initialization
	$(document).ready(function(){
		// Creates a Smooth Transition to prevent half-baked render
		$(".splashscreen").fadeOut();
		// Initialize Functions
		setTitle(); home(); assessment(); ecash(); me(); people();
		// Start Modals
		$('.modal').modal(); $('ul.tabs').tabs({swipeable:false});
		$('.tooltipped').tooltip({delay: 50});
		// Start Timer
		setInterval(function(){
			setTitle();
		},100000);		
	});

	// Event Handling
	$("#clearNotif").click(function(){ deleteAllNotification(); });	
	$("#homeButton").click(function(){ home(); });
	$("#ecashButton").click(function(){ ecash(); });
	$("#notifButton").click(function(){ notif(); });
	$("#pulseButton").click(function(){ pulse(); });

	// Global Functions
	<?php include("_interface/_common/scripts.php"); ?>

	// Local Functions
	// Home
	function home(){
		// Show Ajax Loader
		$("#home").html(loading);
		// Start Ajax
		$.ajax({
			type: 'GET',
			url: '_contents/student/home.php',
			success: function(result){
				// Show Result
				$("#home").html(result);
			}
		}).fail(function(){$("#home").html(error);});
	}

	// Assessment
	function assessment(){
		// Show Ajax Loader
		$("#assessment").html(loading);
		// Start Ajax
		$.ajax({
			type: 'GET',
			url: '_contents/student/assessment.php',
			success: function(result){
				$("#assessment").html(result);
			}
		}).fail(function(){$("#assessment").html(error);});
	}

	// Ecash
	function ecash(){
		// Show Ajax Loader
		$("#ecash").html(loading);
		// Start Ajax
		$.ajax({
			type: 'GET',
			url: '_contents/student/ecash.php',
			success: function(result){
				// Show result
				$("#ecash").html(result);
			}
		}).fail(function(){$("#ecash").html(error);});
	}

	// People
	function people(){
		// Show Ajax Loader
		$("#people").html(loading);
		// Start Ajax
		$.ajax({
			type: 'GET',
			url: '_contents/student/people.php',
			success: function(result){
				// Show Result
				$("#people").html(result);
			}
		}).fail(function(){$("#people").html(error);});
	}

	// Pulse
	function pulse(){
		// Show Ajax Loader
		$("#pulse").html(loading);
		// Start Ajax
		$.ajax({
			type: 'GET',
			url: '_contents/student/pulse.php',
			success: function(result){
				// Show Result
				$("#pulse").html(result);
			}
		}).fail(function(){$("#pulse").html(error);});
	}

	// Me
	function me(){
		// Show Ajax Loader
		$("#me").html(loading);
		// Start Ajax
		$.ajax({
			type: 'GET',
			url: '_contents/student/me.php',
			success: function(result){
				// Show Result
				$("#me").html(result);
			}
		}).fail(function(){$("#me").html(error);});
	}
</script>