<?php
session_start();
if(empty($_SESSION['logged_in'])){
	header("Location: ../../account");
}
include("../../_system/config.php");
$activity_title = "Edit Personal Information";
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
            <?php
                if($_SESSION['account_type'] === "student"){} else {
                    echo "

            <div class='input-field'>
                <input type='text' name='first_name' id='first_name' value=''>
                <label for='first_name'>First Name</label>
            </div>
            <div class='input-field'>
                <input type='text' name='middle_name' id='middle_name' value=''>
                <label for='middle_name'>Middle Name</label>
            </div>
            <div class='input-field'>
                <input type='text' name='last_name' id='last_name' value=''>
                <label for='last_name'>Last Name</label>
            </div>
            <div class='input-field'>
                <input type='text' name='suffix_name' id='suffix_name' value=''>
                <label for='last_name'>Suffix Name</label>
            </div>        
            <br><br>
                    ";
                }
            ?>
			<div class="input-field">
				<input type="text" name="address" id="address" value="">
  	    		<label for="address">Address</label>
      		</div>
            <div class="row">
            <div class="input-field col s6">
				<input type="text" name="city" id="city" value="">
  	    		<label for="city">City</label>
      		</div>
            <div class="input-field col s6" id='country'>
                <select class='browser-default'>
                    <option value='Philippines'>Philippines</option>
                </select>
      		</div>
            </div>
            <br><br>
            <div class="row">
            <div class="input-field col s6">
				<input type="text" name="mobile_number" id="mobile_number" value="">
  	    		<label for="mobile_number">Mobile Number</label>
      		</div>
            <div class="input-field col s6">
				<input type="text" name="telephone_number" id="telephone_number" value="">
  	    		<label for="telephone_number">Telephone Number</label>
      		</div>
            </div>
            <div class="input-field">
				<input type="text" name="mobile_number" id="mobile_number" value="">
  	    		<label for="mobile_number">Mobile Number</label>
      		</div>
		<br><br>
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