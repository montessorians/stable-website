<?php
$first_name = $db_parent->get("first_name", "parent_id","$parent_id");
$last_name = $db_parent->get("last_name", "parent_id","$parent_id");
$suffix_name = $db_parent->get("suffix_name", "parent_id","$parent_id");
$name = $first_name . " " . $last_name . " " . $suffix_name;
?>
<style>
.title{
	margin-left: 30px;
}
.round{
	border-radius: 30pt;
}
</style>
<body class="grey lighten-3">
<div class="splashscreen"></div>
<nav class="nav-extended <?=$primary_color?>">
    <div class="nav-wrapper">
      <a class="title" href="/"><?=$site_title?></a>
      <a href="#notifications" class="button-collapse show-on-large right modal-trigger" id="notifButton"><i id="notificon" class="material-icons">notifications</i></a>
	  <a href="#apps" class="button-collapse show-on-large hide-on-small-only right modal-trigger"><i class="material-icons">apps</i></a>
    </div>
    <div class="nav-content">
		<ul class="tabs tabs-transparent">
			<li class="tab"><a class="tooltipped" data-position="top" data-tooltip="Home" href="#home" id="homeButton"><i class="material-icons">home</i></a></li>
			<li class="tab"><a class="tooltipped" data-position="top" data-tooltip="People" href="#people"><i class="material-icons">group</i></a></li>
			<li class="tab"><a class="tooltipped" data-position="top" data-tooltip="Grades" href="#assessment"><i class="material-icons">assessment</i></a></li>
			<li class="tab"><a class="tooltipped" data-position="top" data-tooltip="Me" href="#me"><i class="material-icons">account_circle</i></a></li>
		</ul>
	</div>
</nav>
<div class="col s12" id="home"></div>
<div class="col s12" id="people"></div>
<div class="col s12" id="assessment"></div>
<div class="col s12" id="me"></div>  
<?php
	// Interface Modals
	include("_interface/_common/notifications.php");
	// Common Apps
	include("_contents/common/apps.php");
?>  
</body>
<script type="text/javascript">
// Declaratives
<?php include("_interface/_common/js_global_declaratives.php"); ?>

// Initialization
$(document).ready(()=>{

	// Creates a Smooth Transition to prevent half-baked render
	$(".splashscreen").fadeOut();

	// Initialize tasks
	setTitle(); home(); people(); assessment(); me(); notif();

	// Activate modals etc.
	$('.modal').modal();
	$('ul.tabs').tabs({swipeable:false});
	$('.tooltipped').tooltip({delay: 50});		

	// Start Timer
	setInterval(()=>{
		setTitle();
	},100000);

});

// Event Handling - Listen to Button Press
$("#notifButton").click(()=>{ notif(); });
$("#homeButton").click(()=>{ home(); });
$("#clearNotif").click(()=>{ deleteAllNotification(); });

// Global Functions
<?php include("_interface/_common/scripts.php"); ?>

// Local Functions

// Home
function home(){
	// Show Ajax loader
	$("#home").html(loading);
	// Start Ajax
	$.ajax({
		type: 'GET',
		url: '_contents/parent/home.php',
		success: (result)=>{
			// Show resulting content
			$("#home").html(result);
		}
	}).fail(()=>{$("#home").html(error);});
}

// People
function people(){
	// Show Ajax Loader
	$("#people").html(loading);
	// Start Ajax
	$.ajax({
		type: 'GET',
		url: '_contents/parent/people.php',
		success: (result)=>{
			// Show resulting content
			$("#people").html(result);
		}
	}).fail(()=>{$("#people").html(error);});
}

// Assessment
function assessment(){
	// Show Ajax Loader
	$("#asessment").html(loading);
	// Start Ajax
	$.ajax({
		type: 'GET',
		url: '_contents/parent/assessment.php',
		success: (result)=>{
			$("#assessment").html(result);
		}
	}).fail(()=>{$("#assessment").html(error);});
}

// Me
function me(){
	// Show Ajax Loader
	$("#me").html(loading);
	// Start Ajax
	$.ajax({
		type: 'GET',
		url: '_contents/parent/me.php',
		success: (result)=>{
			$("#me").html(result);
		}
	}).fail(()=>{$("#me").html(error);});
}
</script>