<?php
include("../_include/setup.php");
$children_array = $db_parentchild->where(array(), "parent_id", "$parent_id");
if($exam_week === "yes"){
	$exam_week = "
		<div class='card yellow hoverable'>
			<div class='card-content'>
				<center>School is on Exam Week</center>
			</div>
		</div>
	";
} else {
	$exam_week = "";
}
?>
<div class="container">
<br>
<h4 class="seagreen-text">
	My Feed
</h4>
<br>
<div id="postFeed">
<?php
	echo $exam_week;
if(isset($children_array)){
foreach($children_array as $child){
	$student_id = $child['student_id'];
	$first_name = $db_student->get("first_name", "student_id", "$student_id");
	$last_name = $db_student->get("last_name", "student_id", "$student_id");
	$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
	$name = $first_name." ".$last_name." ".$suffix_name;
	$hold_array = $db_hold->where(array(), "student_id", "$student_id");
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
				<b>$name</b> <font class='grey-text text-darken-2'>was held by $department</font><br>
				$hold_content<br>
				<br>
				<font size='-1' class='grey-text'>$hold_month $hold_day, $hold_year</font>
			</p>
			</div>
		</div>
		";
	}
	}
}
}

	include("../../action/account/show_posts.php");
?>
</div>
</div>
<br><br><br><br><br>
