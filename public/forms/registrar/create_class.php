<?php
session_start();

$perm = 5;

include("../../_system/secure.php");

if(empty($_GET['from'])){
	if(empty($_SERVER['HTTP_REFERER'])){
		$from = "../../";
	} else {
		$from = $_SERVER['HTTP_REFERER'];
	}
} else {
	$from = $_GET['from'];
}

include("../../_system/config.php");
include("../../_system/database/db.php");

$db_class = new DBase("class", "../../_store");

// Schedule List
$schedule_list = array(
	"Mon-Wed-Fri", "Tue-Thu", "Mon-Wed",
	"Monday", "Tuesday", "Wednesday",
	"Thursday", "Friday", "Saturday",
	"Sunday", "Open Days", "TBA",
	"No Schedule"
);

$activity_title = "Edit Class";
$url = "../../action/registrar/edit_class.php";
$class_id = 0;
$button = "Edit";
$subject_id = "";
$school_year = date("Y")."-".(date("Y")+1);
$section = "";
$class_code = "";
$class_room = "";
$access_code = "";
$teacher_id = "";
$start_time = "";
$end_time = "";
$schedule = "";
$max_students = "20";

if(empty($_GET['class_id'])){
	$activity_title = "Create a Class";	
	$button = "Create";
	$url = "../../action/registrar/create_class.php";
	if(isset($_GET['subject_id'])) $subject_id = $_GET['subject_id'];
} else {
	$class_id = $_GET['class_id'];
	$class_id = $db_class->get("class_id", "class_id", "$class_id");
	if(empty($class_id)){
		header("Location: ../../");
	}
}

if(!empty($class_id)){
	$class_info = $db_class->where(array(),"class_id",$class_id);
	foreach($class_info as $class){
		$subject_id = $class['subject_id'];
		$school_year = $class['school_year'];
		$section = $class['section'];
		$class_code = $class['class_code'];
		$class_room = $class['class_room'];
		$access_code = $class['access_code'];
		$teacher_id = $class['teacher_id'];
		$start_time = $class['start_time'];
		$end_time = $class['end_time'];
		$schedule = $class['schedule'];
		$max_students = $class['max_students'];
	}
}

?>
<!Doctype html>
<html>
<head>
	<title><?=$activity_title?> - <?=$site_title?></title>
	<?php
		include("../../_system/styles.php");
	?>
</head>
<body class="grey lighten-4">
	<nav class="<?=$primary_color?>">
		<a class="title"><?=$activity_title?></a>
		<a href="<?=$from?>" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
	</nav>
	<div class="container">
		<br><br>
		<div class="row">

			<div class="input-field col s6">
				<input type="text" id="subject_id" value="<?=$subject_id?>">
				<label for="subject_id">Subject ID</label>
			</div>

			<div class="input-field col s6">
				<input type="text" id="school_year" value="<?=$school_year?>">
				<label for="school_year">School Year</label>
			</div>

		</div>
		
		<div class="row">
	
			<div class="input-field col s6">
				<input type="text" id="section" value="<?=$section?>">
				<label for="section">Section</label>
			</div>
						
			<div class="input-field col s6">
				<input type="text" id="class_code" value="<?=$class_code?>">
				<label for="class_code">Class Code</label>
			</div>

		</div>
		
		<div class="row">

			<div class="input-field col s6">
				<input type="text" id="class_room" value="<?=$class_room?>">
				<label for="class_room">Room</label>
			</div>


			<div class="input-field col s6">
				<input type="text" id="access_code" value="<?=$access_code?>">
				<label for="access_code">Access Code</label>
			</div>
			
			<div class="input-field col s6">
				<input type="text" id="teacher_id" value="<?=$teacher_id?>">
				<label for="teacher_id">Teacher ID</label>
			</div>
		
		</div>
		
		<div class="row">

			<div class="col s6">
				<p class="grey-text">Start Time</p>
				<input type="time" id="start_time" value="<?=$start_time?>">
			</div>

			<div class="col s6">
			<p class="grey-text">End Time</p>
				<input type="time" id="end_time" value="<?=$end_time?>">
			</div>

		</div>
		
		<div class="row">

			<div class="input-field col s6">
				<select id="schedule" class="browser-default">
					<option disabled>Schedule</option>
					<?php
					foreach($schedule_list as $schedule_entry){
						$selected = "";
						if($schedule_entry === $schedule) $selected="selected";
						echo "<option value='$schedule_entry' $selected>$schedule_entry</option>";
					}
					?>
				</select>
			</div>
		
			<div class="input-field col s6">
				<input type="text" id="max_students" value="<?=$max_students?>">
				<label for="max_students">Max no. of Students</label>
			</div>
		
		</div>		
		<br><br>
		<button id="createClassButton" class="btn btn-large waves-effect waves-light <?=$accent_color?>"><?=$button?></button>
		<span id="response" class="red-text"></span>	
		<br><br><br><br><br>
	</div>
</body>
</html>
<script type="text/javascript">
$("#createClassButton").click(()=>{
	createClass();
});

function createClass(){
	
	var si = $("#subject_id").val();
	var s_y = $("#school_year").val();
	var s = $("#section").val();
	var c = $("#class_code").val();
	var r = $("#class_room").val();
	var a_c = $("#access_code").val();
	var t_i = $("#teacher_id").val();
	var s_t = $("#start_time").val();
	var e_t = $("#end_time").val();
	var sc = $("#schedule").val();
	var ms = $("#max_students").val();
	if(!i){
		$("#response").html("Title cannot be empty");
	} else {
		if(!s_y){
			$("#response").html("School Year is Required");
		} else {
		
			$.ajax({
				type: 'POST',
				url: '<?=$url?>',
				data: {
					<?php
					if(!empty($class_id)) echo "class_id: '$class_id',";
					?>
					subject_id: si,
					school_year: s_y,
					section: s,
					class_code: c,
					class_room: r,
					access_code: a_c,
					teacher_id: t_i,
					start_time: s_t,
					end_time: e_t,
					schedule: sc,
					max_students: ms
				},
				cache: false,
				success: function(result){
					$("#response").html(result);
					<?php
					if(empty($class_id)){
						echo "
						$(\"input[type=text], textarea\").val(\"\");
						$(\"input[type=password]\").val(\"\");
						";
					}
					?>
				}
			}).fail(function(){
				$("#response").html("Error connecting to server");
			});
		
		}
	}
}
</script>
<!--link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"-->