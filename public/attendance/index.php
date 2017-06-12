<?php
session_start();
if(empty($_SESSION['logged_in'])){
	header("Location: ../");
} else {
	if($_SESSION['account_type'] == "admin"){} else {
		if($_SESSION['account_type'] == "developer"){} else {
			header("Location: ../");
		}
	}
}
include("../_system/config.php");
?>
<!Doctype html>
<html>
	<head>
		<title></title>
		<?php
			include("../_system/styles.php");
		?>
	</head>
	<body class='blue-grey'>
		<nav>
    <div class="nav-wrapper <?=$primary_color?>">
        <div class="input-field">
          <input id="search" type="search" required>
          <label class="label-icon" for="search"><i class="material-icons">person</i></label>
          <i class="material-icons">close</i>
        </div>
    </div>
  </nav>
  
  <div class="container">
  	<br>
  		<div class="card">
  			<div class="card-content">
  				<span id="textresult"></span>
  			</div>
  		</div>
  	
  </div>
  
	</body>
</html>
<script type="text/javascript">
	$(document).click(function(){
		attr();
	});	
	
	$("#search").keyup(function(){
		att();
	});
	
	function att(){
		var v = $("#search").val();
		var l = $("#search").val().length;
		if(l == 10){
			$.ajax({
				type: 'POST',
				url: '../action/registrar/attendance.php',
				data: {
					student_id: v
				},
				cache: false,
				success:	 function(result){
					$("#textresult").html(result);
					$("#search").val("");
				}
			}).fail(function(){
				Materialize.toast("Error connecting to server");
				$("#search").val("");
			});
		}
	}
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">