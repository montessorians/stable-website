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
	$activity_title = "Transact with E-Cash";
	
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
  			<input type="text" id="transaction_title" value="Purchase">
  			<label for="transaction_title">Title</label>
  		</div>
  		
  		<div class="input-field">
  			<p class="grey-text">Action</p>
  			<select class="browser-default" id="transaction_action">
  				<option value="subtract">Subtract</option>
  				<option value="add">Add</option>
  			</select>
  		</div>
  		
  		<div class="input-field">
  			<input type="text" id="transaction_merchant" value="Accounting">
  			<label for="transaction_merchant">Merchant</label>
  		</div>
  		
  		<div class="input-field">
  			<input type="text" id="transaction_amount">
  			<label for="transaction_amount">Amount</label>
  		</div>
  		
			<br>
  		<br>
  						<button id="transactButton" class="btn btn-large waves-effect waves-light <?=$accent_color?>">Transact</button>
  						<span id="response" class="red-text"></span>
  						<br><br><br>
		</div>
		
	</body>
</html>
<script type="text/javascript">
$(document).ready().keypress(function(e){
		var key = e.which;
		if(key == 13){
			transact();
		}
	});

	$("#transactButton").click(function(){
		transact();
	});
	
	function transact(){
		var s_i = $("#student_id").val();
		var t_t = $("#transaction_title").val();
		var t_a = $("#transaction_action").val();
		var t_m = $("#transaction_merchant").val();
		var t_am = $("#transaction_amount").val();
		
		if(!s_i){
			$("#response").html("Student ID is required");
		} else {
			if(!t_am){
				$("#response").html("Amount is Required");
			} else {
				
				$.ajax({
					type: 'POST',
					url: '../../action/ecash/transact.php',
					data: {
						student_id: s_i,
						transaction_title: t_t,
						transaction_action: t_a,
						transaction_merchant: t_m,
						transaction_amount: t_am
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