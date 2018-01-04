<?php
session_start();

include("../../_system/secure.php");

if(empty($_GET['from'])){
	if(empty($_SERVER['HTTP_REFERER'])){
		$from = "../../";
	} else {
		$from = $_SERVER['HTTP_REFERER'];
	}
} else {
	$from = $_GET['from'];
}

if(!$_SESSION['account_type'] == "admin"){
	if(!$_SESSION['account_type'] == "developer") header("Location: $from");
}

include("../../_system/config.php");
$activity_title = "Reset Password";

$user_id = "";
if(!empty($_REQUEST['user_id'])) $user_id = $_REQUEST['user_id'];
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
			<input type="text" id="user_id" value="<?=$user_id?>">
			<label for="user_id">User ID</label>
		</div>
		<div class="input-field">
			<input type="text" id="password" value="">
			<label for="password">Password</label>
		</div>
	
		<p>Generated password is <b><span id="pw"></span></b>. It is a best practice to let account users change their passwords personally.</p>

		<br><br>
		<button id="resetPasswordButton" class="btn btn-large waves-effect waves-light <?=$accent_color?>">Reset Password</button>
		<span id="response" class="red-text"></span>
		<br><br><br>
	</div>
</body>
</html>
<script type="text/javascript">
function generatePassword() {
    var length = 8,
        charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    return retVal;
}

$(document).ready(()=>{
	genpw();
}).keypress(function(e){
	var key = e.which;
	if(key == 13){
		resetPassword();
	}
});

function genpw(){
	var gnpw = generatePassword();
	$("#pw").html(gnpw);
	$("#password").val(gnpw);
}

$("#resetPasswordButton").click(function(){
	resetPassword();
}); 
	
	
function resetPassword(){
	var u_i = $("#user_id").val();
	var p = $("#password").val();
	
	if(!u_i){
		$("#response").html("User ID is required");
	} else {
		if(!p){
			$("#response").html("Password is required");
		} else {
			
			$.ajax({
			type: 'POST',
			url: '../../action/account/reset_password.php',
			data: {
				user_id: u_i,
				password: p
			},
			cache: false,
			success: (result)=>{
				$("#response").html(result);
			}
			}).fail(()=>{
				$("#response").html("Error connecting to server");
			});
			
		}
	}
}
</script>
<!--link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"-->