<?php
session_start();

$perm = 3;

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

include("../../_system/config.php");
$activity_title = "Post Feed";
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
			<input type="text" id="post_title">
			<label for="post_title">Title</label>
		</div>
		<div class="input-field">
			<textarea id="post_content" class="materialize-textarea"></textarea>
			<label for="post_content">Content</label>
		</div>
		<div class="input-field">
			<input type="text" id="photo_url">
			<label for="photo_url">Photo Url</label>
		</div>
		<br><br>
		<button id="postButton" class="btn btn-large waves-effect waves-light <?=$accent_color?>">Post</button>
		<span id="response" class="red-text"></span>
		<br><br><br>
	</div>
</body>
</html>
<script type="text/javascript">
$(document).ready().keypress((e)=>{
	var key = e.which;
	if(key == 13){ post(); }
});

$("#postButton").click(()=>{ post(); });
	
function post(){
	
	var p_t = $("#post_title").val();
	var p_c = $("#post_content").val();
	var p_u = $("#photo_url").val();
	
	if(!p_c){
		$("#response").html("Content required");
	} else {
		
		$.ajax({
			type: 'POST',
			url: '../../action/account/post_feed.php',
			data: {
				post_title: p_t,
				post_content: p_c,
				photo_url: p_u
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
</script>
<!--link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"-->