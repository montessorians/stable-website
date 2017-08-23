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
	$activity_title = "Upload User Image";
	
	if(empty($_REQUEST['user_id'])){
		$user_id = "";
	} else {
		$user_id = $_REQUEST['user_id'];
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
			<form action="/action/account/upload_img.php" method="post" enctype="multipart/form-data">

			<div class="input-field">
  			<input type="text" name="user_id" id="user_id" value="<?=$user_id?>">
  			<label for="user_id">User ID</label>
  		</div>
  		  		
  		<div class="file-field input-field">
  			<div class="btn <?=$primary_color?>">
  				<span>Image</span>
  				<input type="file" id="fileToUpload" name="fileToUpload">
  			</div>
  			<div class="file-path-wrapper">
  				<input class="file-path validate" type="text">
  			</div>
  		</div>
			<br>
  		<br>
  						<button type="submit" class="btn btn-large waves-effect waves-light <?=$accent_color?>">Upload</button>
  						</form>
  						<br><br><br>
		</div>
		
	</body>
</html>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">