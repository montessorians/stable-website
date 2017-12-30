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
$value="";
$preselect="";	

    if(empty($_REQUEST['parent_id'])){
 if(empty($_REQUEST['student_id'])){
        $value = "";
    } else {
        $value = $_REQUEST['student_id'];
        $preselect = "student_id";
    }
    } else {
        $value = $_REQUEST['parent_id'];
        $preselect = "parent_id";
    }

    

    $ps_si = "";
    $ps_pi = "";
    switch($preselect){
        case("parent_id"):
            $ps_pi = "selected";
            break;
        case("student_id"):
            $ps_si = "selected";
            break;
    }

	include("../../_system/config.php");
	$activity_title = "Connected Parent Accounts";
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
			<a href="../../" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
		</nav>
		
		<div class="container">
			<br>
			<div class="row">
				<div class="input-field col s6">
					<input type="text" id="query" value="<?=$value?>">
					<label for="query">Query</label>
				</div>
				<div class="input-field col s6">
					<select id="searchBy">
						<option value="parent_id" <?=$ps_pi?>>Parent ID</option>
						<option value="student_id" <?=$ps_si?>>Student ID</option>
					</select>
				</div>
			</div>
			<button class="btn btn-medium <?=$accent_color?> waves-effect waves-light" id="searchButton">Search</button>
			<br><br>
			<div id="searchresult"></div>
			
		</div>
		<br><br><br><br><br>
	</body>
</html>
<script type="text/javascript">
	
$(document).ready(function(){
	$('select').material_select();
}).keypress(function(e){
	var key = e.which;
	if(key == 13){
		search();
	}
});

$("#searchButton").click(function(){
	search();
});

function search(){
	var q = $("#query").val();
	var s = $("#searchBy").val();
	
	$.ajax({
		type: 'POST',
		url: '../../action/account/search_connect_parent.php',
		data: {
			query: q,
			searchBy: s
		},
		cache: false,
		success: function(result){
			$("#searchresult").html(result);
		}
	}).fail(function(){
		var failview = "<div class='card'><div class='card-content'><center><p class='grey-text'>Error connecting to server</p></center></div></div>";
		$("#searchresult").html(failview);
	});
}
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">