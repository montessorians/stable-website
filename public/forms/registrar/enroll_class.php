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
	$activity_title = "Enroll in a Class";
	
	if(empty($_GET['student_id'])){
		$student_id = "";
	} else {
		$student_id = $_GET['student_id'];
	}
	if(empty($_GET['class_id'])){
		$class_id = "";
	} else {
		$class_id = $_GET['class_id'];
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
				<input type="text" id="student_id" value="<?=$student_id?>">
				<label for="student_id">Student ID</label>
			</div>
			<div class="input-field">
				<input type="text" id="class_id" value="<?=$class_id?>">
				<label for="class_id">Class ID</label>
			</div>
						
			<br><br>
			<button id="enrollButton" class="btn btn-large waves-effect waves-light <?=$accent_color?>">Enroll</button>
  		<span id="response" class="red-text"></span>
			
			<br><br><br><br><br>
		</div>
	</body>
</html>
<script type="text/javascript">
	
	$(document).ready().keypress(function(e){
		var key = e.which;
		if(key == 13){
			enroll();
		}
	})

	$("#enrollButton").click(function(){
		enroll();
	});
	
	function enroll(){
		var s_i = $("#student_id").val();
		var c_i = $("#class_id").val();
		
		if(!s_i){
			$("#response").html("Student ID Required");
		} else {
			if(!c_i){
				$("#response").html("Class ID");
			} else {
				
				$.ajax({
					type: 'POST',
					url: '../../action/registrar/enroll_class_manual.php',
					data: {
						student_id: s_i,
						class_id: c_i
					},
					cache: false,
					success: function(result){
						$("#response").html(result);
						$("#class_id").val("");
					}
				}).fail(function(){
					$("#response").html("Error connecting to server");
				});
				
			}
		}
		
	}
</script>
<!--link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"-->