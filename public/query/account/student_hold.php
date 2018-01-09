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
	$activity_title = "Student Hold Query";
	
	if(empty($_REQUEST['student_id'])){
		$student_id = "";
	} else {
		$student_id = $_REQUEST['student_id'];
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
	<body class="grey lighten-3">
		<nav class="<?=$primary_color?>">
			<a class="title"><?=$activity_title?></a>
			<a href="../../" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
		</nav>
		
		<div class="container">
			<br>
			<div class="row">
				<div class="input-field col s7">
					<input type="text" id="student_id" value="<?=$student_id?>">
					<label for="student_id">Student ID</label>
				</div>
				<div class="input-field col s3">
					<button class="btn btn-medium <?=$accent_color?> waves-effect waves-light" id="searchButton">Search</button>
				</div>
			</div>
			<div id="searchresult"></div>
			
		</div>
		<br><br><br><br><br>
	</body>
</html>
<script type="text/javascript">
$(document).ready().keypress(function(e){
		var key = e.which;
		if(key == 13){
			search();
		}
	});

	$("#searchButton").click(function(){
		search();
	});
	
	function search(){
		var s_i = $("#student_id").val();
		$.ajax({
			type: 'POST',
			url: '../../action/account/search_studenthold.php',
			data: {
				student_id: s_i
			},
			cache: false,
			success: function(result){
				$("#searchresult").html(result);
			}
		}).fail(function(){
			var failview = "<div class='card'><div class='card-content'><center><p class='grey-text'>Error connecting to server</p></center></div></div>";
			$("#searchresult").html(failview);
		});
	}
</script>
