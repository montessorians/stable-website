<?php
include("_setup.php");
$exam_week = $db_schooldata->get("exam_week", "school_id", "1");
if($exam_week === "yes"){
	$exam_week = "
		<div class='card yellow'>
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
	include("../../action/account/show_posts.php");
?>
</div>
</div>
<br><br><br><br><br>
