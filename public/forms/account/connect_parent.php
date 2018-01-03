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
	$activity_title = "Connect a Parent to Student";
	
	if(empty($_REQUEST['student_id'])){
		$student_id = "";
	} else {
		$student_id = $_REQUEST['student_id'];
	}
    if(empty($_REQUEST['parent_id'])){
		$parent_id = "";
	} else {
		$parent_id = $_REQUEST['parent_id'];
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
  			<input type="text" id="parent_id" value="<?=$parent_id?>">
  			<label for="department">Parent ID</label>
      		</div><br>
            <div class="input-field">
  			<input type="text" id="student_id" value="<?=$student_id?>">
  			<label for="student_id">Student ID</label>
 	 		</div><br>
			<div class="input-field">
  			<input type="text" id="relation">
  			<label for="relation">Relation</label>
 	 		</div><br>
  		<br>
  						<button id="addConnect" class="btn btn-large waves-effect waves-light <?=$accent_color?>">Connect</button>
  						<span id="response" class="red-text"></span>
  						<br><br><br>
		</div>
		
	</body>
</html>
<script type="text/javascript">
$(document).ready().keypress(function(e){
		var key = e.which;
		if(key == 13){
			addConnect();
		}
	});

	$("#addConnect").click(function(){
		addConnect();
	});
	
	function addConnect(){
		var p_i = $("#parent_id").val();
        var s_i = $("#student_id").val();
		var r = $("#relation").val();
		
		if(!p_i){
			$("#response").html("Parent ID is required");
		} else {
			if(!s_i){
				$("#response").html("Student ID is required");
			} else {
				
				$.ajax({
					type: 'POST',
					url: '../../action/account/connect_parent.php',
					data: {
                        parent_id: p_i,
						student_id: s_i,
						relation: r
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