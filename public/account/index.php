<?php
	session_start();
	include("../_system/config.php");
	$activity_title = "Account";
	if(empty($_GET['from'])){
		if(empty($_SERVER['HTTP_REFERER'])){
			$from = "../";
			$show = 0;
		} else {
			$from = $_SERVER['HTTP_REFERER'];
			if(empty($_GET['local'])){
				$show = 1;
			} else {
				$show = 0;
			}
		}
	} else {
		$from = $_GET['from'];
		$show = 1;
	}
	
	if(empty($_SESSION['logged_in'])){
	} else {
		header("Location: $from");
	}
?>
<!Doctype html>
<html>
	<head>
		<title>
			<?=$activity_title?> - <?=$site_title?>
		</title>
		<?php
		include("../_system/styles.php");
		?>
	</head>
	<body class="grey lighten-4">
		<div class="container">
			<div class="container">
			<br><br><br>

			<div class="card z-depth-5 hoverable" id="loginCard">
				<div class="card-content">
					<img width="70px" height="70px" src="logo.png" id="logo">
					<h5 class="blue-grey-text text-darken-2">Welcome Montessorian!</h5>
					<center>
						
					<?php
						if(empty($show)){
						} else { 
						echo "<p>You must be logged-in to continue</p>";
						}
					?>
					</center><br>
					<center><div id="response"></div></center>
					<div class="input-field" id="usernameh">
						<input type="text" id="username" name="username">
						<label for="username">Username</label>
					</div>
					<div class="input-field" id="passwordh">
						<input type="password" id="password" name="password">
						<label for="username">Password</label>
					</div>
					<br>
					<center>
					<button id="sub" class="btn btn-large waves-effect waves-light <?=$primary_color?>">Sign-In</button>
					
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
  </center>
				</div>
			</div>
			<br>
			<br><br>
			<center>
					<a class="btn btn-flat grey-text" href="http://hcm-help.likesyou.org/index.php?controller=post&action=view&id_post=2">Forgot Password</a> 
					<a class="btn btn-flat grey-text" href="http://hcm-help.likesyou.org/index.php?controller=post&action=view&id_post=3">Privacy Information</a>
				<p class="grey-text">Copyright <?=date("Y")?><br>
				<b><?=$site_title?></b> </p>
			</center>
			</div>
		</div>
		<br><br><br>
	</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
		$("meta[name='theme-color']").attr("content", "silver");
		$("#loginCard").hide();
		$("#logo").hide();
		$("#loginCard").slideDown({duration: 300});
		$("#logo").fadeIn({duration: 800});
		$("#sub2").hide();
	}).keypress(function(e){
		var key = e.which;
		if(key == 13){
			doLogin();
		}
	});
	
	$("#sub").click(function(){
		doLogin();
	});
	
	function doLogin(){
		$("#usernameh").hide();
		$("#passwordh").hide();
		$("#sub").hide();
		$("#sub2").show();
		
		var u = $("#username").val();
		var p = $("#password").val();
		
		$.ajax({
		type: 'POST',
		url: 'loginprocess.php',
		data: {
			username: u,
			password: p
		},
		cache: false,
		success: function(result){
			if(result == "Ok"){
				$("#response").hide();
				window.location.replace("<?=$from?>");
			} else {
				$("#response").html("<div class='chip'>"+ result + "</div><br>");
				$("#usernameh").show();
				$("#passwordh").show();
				$("#sub").show();
				$("#sub2").hide();
			}
		}
	}).fail(function(){
		$("#response").html("<div class='chip'>Cannot connect to server</div><br>");
		$("#usernameh").show();
		$("#passwordh").show();
		$("#sub").show();
		$("#sub2").hide();
	});
	}
</script>