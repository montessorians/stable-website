<?php
include("../_include/setup.php");
$check_hold = $db_hold->count("student_id","$student_id");
$hold_array = $db_hold->where(array(), "student_id", "$student_id");
$first_name = $db_student->get("first_name", "student_id","$student_id");

if($exam_week === "yes"){
	$exam_week = "
		<div class='card hoverable yellow'>
			<div class='card-content'>
				<center>Good luck on your exams!</center>
			</div>
		</div>
	";
} else {
	$exam_week = "";
}
?>

<div class="container">


<a href="#notifications" class="button-collapse show-on-large right modal-trigger seagreen-text" id="notifButton"><i id='notificon' class='material-icons'>notifications</i></a>

<h1 class="seagreen-text">
  <b>Hello<br>
  <?=$first_name; ?>!</b>
</h1>

<br>

<h5 class="seagreen-text">
	Your Feed
</h5>
<?php
if(isset($hold_array)){
	foreach($hold_array as $hold){
		$hold_id = $hold['hold_id'];
		$department = $hold['department'];
		$hold_content = $hold['hold_content'];
		$hold_month = $hold['hold_month'];
		$hold_day = $hold['hold_day'];
		$hold_year = $hold['hold_year'];
		$hold_hour = $hold['hold_hour'];
		$hold_minute = $hold['hold_minute'];

		if(!$department) $department = "Administrator";

		echo "
		<div class='card hoverable'>
			<div class='card-content'>
				<p>
					<strong>$department</strong><br>
					$hold_content<br><br>
					<font size='-1' class='grey-text'>$hold_month $hold_day, $hold_year</font>
				</p>
			</div>
		</div>
		";

	}
}
?>	
<div id="postFeed">
<?php
	echo $exam_week;
	include("../../action/account/show_posts.php");
?>
</div>
</div>
<br><br><br><br><br>
