<?php
include("../_include/setup.php");
$exam_week = $db_schooldata->get("exam_week", "school_id", "1");
if($exam_week === "yes"){
	$exam_week = "
		<div class='card yellow'>
			<div class='card-content'>
				<center>School is on Exam Week (Change this in settings)</center>
			</div>
		</div>
	";
} else {
	$exam_week = "";
}
?>
<script type="text/javascript">
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('txt').innerHTML =
    h + ":" + m + ":" + s;
    var t = setTimeout(startTime, 500);
}
function checkTime(i) {
    if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}
startTime();
</script>
<div class="container">
<br>
<h4 class="blue-grey-text text-darken-2">
	My Feed
</h4>
<br>
	<a href="forms/account/post_feed.php" class="btn btn-large blue-grey darken-2 waves-effect waves-light">Post</a>
<br><br>
<div class="card">
<div class="card-content">
	<h5>
		Today is <?=date("M d Y")?> <span id="txt"></span>
	</h5>
</div>
</div>
<div id="postFeed">
<?php
	echo $exam_week;
	include("../../action/account/show_posts.php");
?>
</div>
</div>
<br><br><br><br><br>
