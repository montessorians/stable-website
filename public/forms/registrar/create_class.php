<?php
session_start();
include("../../_system/secure.php");
	if(empty($_GET['from'])){
		if(empty($_SERVER['HTTP_REFERER'])){
			$from = "../../";
		} else {
			$from = $_SERVER['HTTP_REFERER'];
		}} else {
		$from = $_GET['from'];
	}
	if($_SESSION['account_type'] == "admin"){} else {
		if($_SESSION['account_type'] == "developer"){} else {
				header("Location: $from");
		}
	}
	
	include("../../_system/config.php");
	include("../../_system/database/db.php");
	$db_class = new DBase("class", "../../_store");

	$activity_title = "Edit Class";
	$url = "../../action/registrar/edit_class.php";
	$class_id = 0;
	$button = "Edit";
	$class_title = "";
	$class_description = "";
	$school_year = date("Y")."-".(date("Y")+1);
	$grade = "";
	$section = "";
	$class_code = "";
	$class_room = "";
	$access_code = "";
	$teacher_id = "";
	$start_time = "";
	$end_time = "";
	$schedule = "";
	$units = "";

	if(empty($_GET['class_id'])){
		$activity_title = "Create a Class";	
		$button = "Create";
		$url = "../../action/registrar/create_class.php";
	} else {
		$class_id = $_GET['class_id'];
		$class_id = $db_class->get("class_id", "class_id", "$class_id");
		if(empty($class_id)){
			header("Location: ../../");
		}
	}
	
	$class_title = $db_class->get("class_title", "class_id", "$class_id");
	$class_description = $db_class->get("class_description", "class_id", "$class_id");
	$school_year = $db_class->get("school_year", "class_id", "$class_id");
	$grade = $db_class->get("grade", "class_id", "$class_id");
	$section = $db_class->get("section", "class_id", "$class_id");
	$class_code = $db_class->get("class_code", "class_id", "$class_id");
	$class_room = $db_class->get("class_room", "class_id", "$class_id");
	$access_code = $db_class->get("access_code", "class_id", "$class_id");
	$teacher_id = $db_class->get("teacher_id", "class_id", "$class_id");
	$start_time = $db_class->get("start_time", "class_id", "$class_id");
	$end_time = $db_class->get("end_time", "class_id", "$class_id");
	$schedule = $db_class->get("schedule", "class_id", "$class_id");
	$units = $db_class->get("units", "class_id", "$class_id");
	
	$g_non = "";
	$g_n1 = "";
	$g_n2 = "";
	$g_k1 = "";
	$g_k2 = "";
	$g_p = "";
	$g_g1 = "";
	$g_g2 = "";
	$g_g3 = "";
	$g_g4 = "";
	$g_g5 = "";
	$g_g6 = "";
	$g_g7 = "";
	$g_g8 = "";
	$g_g9 = "";
	$g_g10 = "";
	$g_g11 = "";
	$g_g12 = "";
	$g_t = "";
	$g_f = "";
	$g_o = "";
	$g_m = "";
	$g_tr = "";
	$g_s = "";
	
	$sel = "selected";

	switch($grade){
		case("Nursery 1"):
			$g_non = "";
			$g_n1 = $sel;
			break;
		case("Nursery 2"):
			$g_non = "";
			$g_n2 = $sel;
			break;
		case("Kindergarten 1"):
			$g_non = "";
			$g_k1 = $sel;
			break;
		case("Kindergarten 2"):
			$g_non = "";
			$g_k2 = $sel;
			break;	
		case("Preparatory"):
			$g_non = "";
			$g_p = $sel;
			break;
		case("Grade 1"):
			$g_non = "";
			$g_g1 = $sel;
			break;
		case("Grade 2"):
			$g_non = "";
			$g_g2 = $sel;
			break;
		case("Grade 3"):
			$g_non = "";
			$g_g3 = $sel;
			break;
		case("Grade 4"):
			$g_non = "";
			$g_g4 = $sel;
			break;
		case("Grade 5"):
			$g_non = "";
			$g_g5 = $sel;
			break;
		case("Grade 6"):
			$g_non = "";
			$g_g6 = $sel;
			break;
		case("Grade 7"):
			$g_non = "";
			$g_g7 = $sel;
			break;
		case("Grade 8"):
			$g_non = "";
			$g_g8 = $sel;
			break;
		case("Grade 9"):
			$g_non = "";
			$g_g9 = $sel;
			break;
		case("Grade 10"):
			$g_non = "";
			$g_g10 = $sel;
			break;
		case("Grade 11"):
			$g_non = "";
			$g_g11 = $sel;
			break;
		case("Grade 12"):
			$g_non = "";
			$g_g12 = $sel;
			break;
		case("Tutorial"):
			$g_non = "";
			$g_t = $sel;
			break;
		case("Free Class"):
			$g_non = "";
			$g_f = $sel;
			break;
		case("Online Class"):
			$g_non = "";
			$g_o = $sel;
			break;
		case("Multilevel"):
			$g_non = "";
			$g_m = $sel;
			break;
		case("Training"):
			$g_non = "";
			$g_tr = $sel;
			break;
		case("Seminar"):
			$g_non = "";
			$g_s = $sel;
			break;
	} //switch - grade
	
	$s_non = $sel;
	$s_wkd = "";
	$s_mwf = "";
	$s_tth = "";
	$s_mw = "";
	$s_m = "";
	$s_t = "";
	$s_w = "";
	$s_th = "";
	$s_f = "";
	$s_s = "";
	$s_su = "";
	$s_od = "";
	$s_tba = "";
	$s_nsc = "";
	
	switch($schedule){
		case("Weekdays"):
			$s_non = "";
			$s_wkd = $sel;
			break;
		case("Mon-Wed-Fri"):
			$s_non = "";
			$s_mwf = $sel;
			break;
		case("Tue-Thu"):
			$s_non = "";
			$s_tth = $sel;
			break;
		case("Mon-Wed"):
			$s_non = "";
			$s_mw = $sel;
			break;
		case("Monday"):
			$s_non = "";
			$s_m = $sel;
			break;
		case("Tuesday"):
			$s_non = "";
			$s_t = $sel;
			break;
		case("Wednesday"):
			$s_non = "";
			$s_w = $sel;
			break;
		case("Thursday"):
			$s_non = "";
			$s_th = $sel;
			break;
		case("Friday"):
			$s_non = "";
			$s_f = $sel;
			break;
		case("Saturday"):
			$s_non = "";
			$s_s = $sel;
			break;
		case("Sunday"):
			$s_non = "";
			$s_su = $sel;
			break;
		case("Open Days"):
			$s_non = "";
			$s_od = $sel;
			break;
		case("TBA"):
			$s_non = "";
			$s_tba = $sel;
			break;
		case("No Schedule"):
			$s_non = "";
			$s_nsc = $sel;
			break;
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
			
			<div class="input-field">
				<input type="text" id="class_title" value="<?=$class_title?>">
				<label for="class_title">Title</label>
			</div>
			
			<div class="input-field">
				<textarea id="class_description" class="materialize-textarea"><?=$class_description?></textarea>
				<label for="class_description">Description</label>
			</div>
			
			<div class="input-field">
				<input type="text" id="school_year" value="<?=$school_year?>">
				<label for="school_year">School Year</label>
			</div>
			
			<div class="row">
			
			<div class="input-field col s6">
				<select id="grade" class="browser-default">
					<option disabled <?=$g_non?>>Grade/Class Type</option>
					<option value="Nursery" <?=$g_n1?>>Nursery 1</option>
					<option value="Nursery" <?=$g_n2?>>Nursery 2</option>
					<option value="Kindergarten" <?=$g_k1?>>Kindergarten 1</option>
					<option value="Kindergarten" <?=$g_k2?>>Kindergarten 2</option>
					<option value="Preparatory" <?=$g_p?>>Preparatory</option>
					<option value="Grade 1" <?=$g_g1?>>Grade 1</option>
					<option value="Grade 2" <?=$g_g2?>>Grade 2</option>
					<option value="Grade 3" <?=$g_g3?>>Grade 3</option>
					<option value="Grade 4" <?=$g_g4?>>Grade 4</option>
					<option value="Grade 5" <?=$g_g5?>>Grade 5</option>
					<option value="Grade 6" <?=$g_g6?>>Grade 6</option>
					<option value="Grade 7" <?=$g_g7?>>Grade 7</option>
					<option value="Grade 8" <?=$g_g8?>>Grade 8</option>
					<option value="Grade 9" <?=$g_g9?>>Grade 9</option>
					<option value="Grade 10" <?=$g_g10?>>Grade 10</option>
					<option value="Grade 11" <?=$g_g11?>>Grade 11</option>
					<option value="Grade 12" <?=$g_g12?>>Grade 12</option>
					<option value="Tutorial" <?=$g_t?>>Tutorial</option>
					<option value="Free Class" <?=$g_f?>>Free Class</option>
					<option value="Online Class" <?=$g_o?>>Online Class</option>
					<option value="Multilevel" <?=$g_m?>>Multilevel</option>
					<option value="Training" <?=$g_tr?>>Training</option>
					<option value="Seminar" <?=$g_s?>>Seminar</option>
				</select>
			</div>
			
			<div class="input-field col s6">
				<input type="text" id="section" value="<?=$section?>">
				<label for="section">Section</label>
			</div>
			
			</div>
			
			<div class="row">
			
			<div class="input-field col s6">
				<input type="text" id="class_code" value="<?=$class_code?>">
				<label for="class_code">Class Code</label>
			</div>
			
			<div class="input-field col s6">
				<input type="text" id="class_room" value="<?=$class_room?>">
				<label for="class_room">Room</label>
			</div>
			
			</div>
			
			<div class="row">
			
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
					<option disabled <?=$s_non?>>Schedule</option>
					<option value="Weekdays" <?=$s_wkd?>>Weekdays</option>
					<option value="Mon-Wed-Fri" <?=$s_mwf?>>Mon-Wed-Fri</option>
					<option value="Tue-Thu" <?=$s_tth?>>Tue-Thu</option>
					<option value="Mon-Wed" <?=$s_mw?>>Mon-Wed</option>
					<option value="Monday" <?=$s_m?>>Monday</option>
					<option value="Tuesday" <?=$s_t?>>Tuesday</option>
					<option value="Wednesday" <?=$s_w?>>Wednesday</option>
					<option value="Thursday" <?=$s_th?>>Thursday</option>
					<option value="Friday" <?=$s_f?>>Friday</option>
					<option value="Saturday" <?=$s_s?>>Saturday</option>
					<option value="Sunday" <?=$s_su?>>Sunday</option>
					<option value="Open Days" <?=$s_od?>>Open Days</option>
					<option value="TBA" <?=$s_tba?>>TBA</option>
					<option value="No Schedule" <?=$s_nsc?>>No Schedule</option>
				</select>
			</div>
			
			<div class="input-field col s6">
				<input type="text" id="class_units" value="<?=$units?>">
				<label for="class_units">Units</label>
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
	$("#createClassButton").click(function(){
		createClass();
	});
	
	function createClass(){
		
		var t = $("#class_title").val();
		var d = $("#class_description").val();
		var s_y = $("#school_year").val();
		var g = $("#grade").val();
		var s = $("#section").val();
		var c = $("#class_code").val();
		var r = $("#class_room").val();
		var a_c = $("#access_code").val();
		var t_i = $("#teacher_id").val();
		var s_t = $("#start_time").val();
		var e_t = $("#end_time").val();
		var sc = $("#schedule").val();
		var u = $("#class_units").val();
		if(!t){
			$("#response").html("Title cannot be empty");
		} else {
			if(!g){
				$("#response").html("Grade/Class Type is Required");
			} else {
				
				if(!s_y){
					$("#response").html("School Year is Required");
				} else {
				
				$.ajax({
					type: 'POST',
					url: '<?=$url?>',
					data: {
						<?php
						if(empty($class_id)){
						} else {
						echo "class_id: '$class_id',";
						}
						?>
						class_title: t,
						class_description: d,
						school_year: s_y,
						grade: g,
						section: s,
						class_code: c,
						class_room: r,
						access_code: a_c,
						teacher_id: t_i,
						start_time: s_t,
						end_time: e_t,
						schedule: sc,
						units: u
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
	}
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">