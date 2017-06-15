<?php
session_start();
if(empty($_SESSION['logged_in'])){
	header("Location: ../../account");
}
include("../../_system/config.php");
$activity_title = "Account Settings";
if(empty($_GET['from'])){
		if(empty($_SERVER['HTTP_REFERER'])){
			$from = "../../";
		} else {
			$from = $_SERVER['HTTP_REFERER'];
		}} else {
		$from = $_GET['from'];
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
	<body>
		<nav class="navbar <?=$primary_color?>">
			<a class="title"><?=$activity_title?></a>
			<a href="<?=$from?>" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
		</nav>
		<div class="container">
			<br>
				<p class="red-text" id="response"></span>
			<br>
			<div class="input-field" id="usernameh">
				<input type="text" name="username" id="username" value="<?=$_SESSION['username']?>">
  			<label for="username">Username</label>
  		</div>
  		<div class="input-field" id="passwordh">
  				<input type="password" name="password" id="password">
  				<label for="password">Password</label>
  		</div>
  		<br>
		  <p>Please make sure your Montessori account password is not the same with your Social Network and E-Mail Password. Also, don't sign-in and/or change your password if you are using Public Free Wifi. <a class="seagreen-text" href="http://hcmontessori.likesyou.org/support/2017/06/choosing-a-password" target="_blank">Click Here for Info</a></p>
		<br>
  		<button id="saveChanges" class="btn btn-large waves-effect waves-light <?=$accent_color?>">Save Changes</button>
  		<button id="sub2" class="btn btn-large btn-flat"><div class="preloader-wrapper small active">
    <div class="spinner-layer spinner-green-only">
      <div class="circle-clipper left">
        <div class="circle"></div>
      </div><div class="gap-patch">
        <div class="circle"></div>
      </div><div class="circle-clipper right">
        <div class="circle"></div>
      </div>
    </div>
  </div></button>
  	</div>
  	<br><br><br><br>
	</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("#sub2").hide();
	});
	function saveChanges(){
		$("#sub2").show();
		$("#saveChanges").hide();
		
		var u = $("#username").val();
		var p = $("#password").val();
		
		if(!u){
			$("#response").html("Username required <br><br>");
			$("#sub2").hide();
			$("#saveChanges").show();
		} else {
			if(!p){
				$("#response").html("Password required <br><br>");
				$("#sub2").hide();
				$("#saveChanges").show();
			} else {
				
				$.ajax({
		type: 'POST',
		url: '../../action/account/edit_login.php',
		data: {
			username: u,
			password: p
		},
		cache: false,
		success: function(result){
				$("#response").html(result + "<br><br>");
				$("#sub2").hide();
				$("#saveChanges").show();}
	}).fail(function(){
		$("#response").html("Cannot connect to server<br><br>");
		$("#sub2").hide();
		$("#saveChanges").show();
	});
				
			}
		}
	}
	
	$("#saveChanges").click(function(){
		saveChanges();
	});
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">