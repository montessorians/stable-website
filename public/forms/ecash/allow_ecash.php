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
	
	$activity_title = "Allow E-Cash";
	
	if(empty($_REQUEST['student_id'])){
		$student_id = "";
	} else {
		$student_id = $_REQUEST['student_id'];
	}
	
	$db_account = new DBase("account", "../../_store");
	$db_ecash = new DBase("ecash", "../../_store");
	$db_student = new Dbase("student", "../../_store");
	
	$student_id = $db_student->get("student_id", "student_id", "$student_id");

	if(empty($student_id)){
		header("Location: ../../");
	}
	$user_id = $db_account->get("user_id", "student_id", "$student_id");
	$allow_ecash = $db_ecash->get("allow_ecash", "user_id", "$user_id");

	$a_y	= "";
	$a_n = "";
	
	switch($allow_ecash){
		case("yes"):
			$a_y = "selected";
			break;
		case("no"):
			$a_n = "selected";
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
  			<p class="grey-text">Allow E-Cash</p>
  			<select class="browser-default" id="allow_ecash">
  				<option value="yes" <?=$a_y?>>Yes</option>
  				<option value="no" <?=$a_n?>>No</option>
  			</select>
  		</div>
  		
			<br>
  		<br>
  						<button id="setButton" class="btn btn-large waves-effect waves-light <?=$accent_color?>">Set</button>
  						<span id="response" class="red-text"></span>
  						<br><br><br>
		</div>
		
	</body>
</html>
<script type="text/javascript">
$(document).ready().keypress(function(e){
		var key = e.which;
		if(key == 13){
			set();
		}
	});

	$("#setButton").click(function(){
		set();
	});
	
	function set(){
		var s_i = $("#student_id").val();
		var a_e = $("#allow_ecash").val();
		
		if(!s_i){
			$("#response").html("Student ID is required");
		} else {
				$.ajax({
					type: 'POST',
					url: '../../action/ecash/allow_ecash.php',
					data: {
						student_id: s_i,
						allow_ecash: a_e
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
			
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">