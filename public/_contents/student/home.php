<?php
include("../_include/setup.php");
$check_hold = $db_hold->count("student_id","$student_id");
$hold_array = $db_hold->where(array("hold_id"), "student_id", "$student_id");

if($exam_week === "yes"){
	$exam_week = "
		<div class='card yellow'>
			<div class='card-content'>
				<center>Good luck on your exam week!</center>
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
<?php
	if(empty($hold_array)){} else {
		foreach($hold_array as $key){
			foreach($key as $hold_id){
				
				$department = $db_hold->get("department", "hold_id", "$hold_id");
				$hold_content = $db_hold->get("hold_content", "hold_id", "$hold_id");
				$hold_month = $db_hold->get("hold_month", "hold_id", "$hold_id");
				$hold_day = $db_hold->get("hold_day", "hold_id", "$hold_id");
				$hold_year = $db_hold->get("hold_year", "hold_id", "$hold_id");
				$hold_hour = $db_hold->get("hold_hour", "hold_id", "$hold_id");
				$hold_minute = $db_hold->get("hold_minute", "hold_id", "$hold_id");
				
				echo "
				<div class='card'>
					<div class='card-content'>
						<p>
							<strong>$department</strong><br><br>
							$hold_content<br>
							<font size='-1' class='grey-text'>$hold_month $hold_day, $hold_year</font>
						</p>
					</div>
				</div>
				";
				
			}
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