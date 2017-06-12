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
	
	include("../../_system/config.php");
	include("../../_system/database/db.php");
	$activity_title = "View Class";
	
	$db_class = new DBase("class", "../../_store");
	$db_teacher = new DBase("teacher", "../../_store");
	$db_student = new DBase("student", "../../_store");
	$db_enroll = new DBase("student_class", "../../_store");
	
	if(empty($_REQUEST['class_id'])){
		header("Location: $from");
	} else {
		$class_id = $_REQUEST['class_id'];
		$class_id = $db_class->get("class_id", "class_id", "$class_id");
		if(empty($class_id)){
			header("Location: $from");
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
	$start_time = date("h:i a", strtotime($start_time));
	$end_time = $db_class->get("end_time", "class_id", "$class_id");
	$end_time = date("h:i a", strtotime($end_time));
	$schedule = $db_class->get("schedule", "class_id", "$class_id");
	$units = $db_class->get("units", "class_id", "$class_id");
	
	if(empty($teacher_id)){
		$teacher = "Teacher: No teacher assigned";
	} else {
		$first_name = $db_teacher->get("first_name", "teacher_id", "$teacher_id");
		$middle_name = $db_teacher->get("middle_name", "teacher_id", "$teacher_id");
		$last_name = $db_teacher->get("last_name", "teacher_id", "$teacher_id");
		$suffix_name = $db_teacher->get("suffix_name", "teacher_id", "$teacher_id");
		$teacher = "Teacher: $first_name $middle_name $last_name $suffix_name ($teacher_id)";
	}
	
	$enrollees = $db_enroll->where(array("enroll_id"),"class_id", "$class_id");
	
?>
<!Doctype html>
<html>
	<head>
		<title><?=$activity_title?> - <?=$site_title?></title>
		<?php
			include("../../_system/styles.php");
		?>
	</head>
	<body class="grey lighten-3">
		<nav class="nav-extended <?=$primary_color?>">
			<div class="nav-wrapper">
			<a class="title"><?=$activity_title?></a>
			<a href="<?=$from?>" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
			</div>
			<div class="nav-content">
				<span class="nav-title"><?=$class_title?></span>
			</div>
		</nav>

		<ul class="collection">
			<li class="collection-item">
				Description: <?=$class_description?>
			</li>
			<li class="collection-item">
				School Year: <?=$school_year?>
			</li>
			<li class="collection-item">
				Grade: <?=$grade?>
			</li>
			<li class="collection-item">
				Section: <?=$section?>
			</li>
			<li class="collection-item">
				Class Code: <?=$class_code?>
			</li>
			<li class="collection-item">
				Access Code: <?=$access_code?>
			</li>
			<li class="collection-item">
				<?=$teacher?>
			</li>
			<li class="collection-item">
				Schedule: <?=$start_time." - ".$end_time." ($schedule)"?>
			</li>
		</ul>
		<br>
		<div class="container">
		<h4 class="green-text text-darken-2">
			Enrolled Students
		</h4>
		<?php
			if(empty($enrollees)){
				echo "
					<div class='card'>
						<div class='card-content'>
							<center><p>No Students Yet</p></center>
						</div>
					</div>
				";
			} else {
				
				foreach($enrollees as $key){
					foreach($key as $enroll_id){
						
						$student_id = $db_enroll->get("student_id", "enroll_id", "$enroll_id");
						$first_name = $db_student->get("first_name", "student_id", "$student_id");
						$last_name = $db_student->get("last_name", "student_id", "$student_id");
						$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
						$grade = $db_student->get("grade", "student_id", "$student_id");
						$section = $db_student->get("section", "student_id", "$student_id");
						$school_year = $db_student->get("school_year", "student_id", "$student_id");
						
						echo "
						<div class='card'>
							<div class='card-content'>
								<p><strong>$first_name $last_name $suffix_name</strong></p>
								<p class='grey-text'>
									$grade - $section ($school_year)
									$student_id
								</p>
							</div>
						</div>
						";
						
					}
				}
				
			}
		?>
		</div>
				<br><br><br><br><br>
	</body>
</html>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">