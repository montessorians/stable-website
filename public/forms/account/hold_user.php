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
	$activity_title = "Hold a Student";
	
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
			<a href="<?=$from?>" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
		</nav>
		
		<div class="container">
			<br><br>
			<div class="input-field">
  			<input type="text" id="student_id" value="<?=$student_id?>">
  			<label for="student_id">Student ID</label>
  		</div>
  		
  		<div class="input-field">
  			<input type="text" id="department">
  			<label for="department">Department</label>
  		</div>
  		
  		<div class="input-field">
  			<input type="text" id="hold_content">
  			<label for="hold_content">Hold Content</label>
  		</div>
			<br>
  		<br>
  						<button id="addHoldButton" class="btn btn-large waves-effect waves-light <?=$accent_color?>">Add Hold</button>
  						<span id="response" class="red-text"></span>
  						<br><br><br>
		</div>
		
	</body>
</html>
<script type="text/javascript">
$(document).ready().keypress(function(e){
		var key = e.which;
		if(key == 13){
			addHold();
		}
	});

	$("#addHoldButton").click(function(){
		addHold();
	});
	
	function addHold(){
		var s_i = $("#student_id").val();
		var d = $("#department").val();
		var h_c = $("#hold_content").val();
		
		if(!s_i){
			$("#response").html("Student ID is required");
		} else {
			if(!h_c){
				$("#response").html("Content is required");
			} else {
				
				$.ajax({
					type: 'POST',
					url: '../../action/account/hold_user.php',
					data: {
						student_id: s_i,
						department: d,
						hold_content: h_c
					},
					cache: false,
					success: function(result){
						$("#response").html(result);
					}
				}).fail(function(){
					$("#response").html("Error connecting to server");
				});
				
			}
		}
	}
</script>
<!--link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"-->