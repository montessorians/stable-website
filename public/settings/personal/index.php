<?php
session_start();
include("../../_system/database/db.php");

$db_account = new DBase("account","../../_store");

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

$user_id = $_SESSION['user_id'];
$account_type = $_SESSION['account_type'];
$id_const = $account_type . "_id";
$db = new DBase("$account_type", "../../_store");
$p_id = $db_account->get("$id_const","user_id", "$user_id");
$first_name = $db->get("first_name", "$id_const", "$p_id");
$middle_name = $db->get("middle_name", "$id_const", "$p_id");
$last_name = $db->get("last_name", "$id_const", "$p_id");
$suffix_name = $db->get("suffix_name", "$id_const", "$p_id");
$birth_month = $db->get("birth_month", "$id_const", "$p_id");
$birth_day = $db->get("birth_day", "$id_const", "$p_id");
$birth_year = $db->get("birth_year", "$id_const", "$p_id");
$birth_place = $db->get("birth_place", "$id_const", "$p_id");
$gender = $db->get("gender", "$id_const", "$p_id");
$address = $db->get("address","$id_const","$p_id");
$city = $db->get("city","$id_const","$p_id");
$country = $db->get("country","$id_const","$p_id");
$mobile_number = $db->get("mobile_number","$id_const","$p_id");
$telephone_number = $db->get("telephone_number","$id_const","$p_id");
$email = $db->get("email","$id_const","$p_id");
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
            <?php
                if($_SESSION['account_type'] === "student"){} else {
                    echo "

            <div class='input-field'>
                <input type='text' name='first_name' id='first_name' value='$first_name'>
                <label for='first_name'>First Name</label>
            </div>
            <div class='input-field'>
                <input type='text' name='middle_name' id='middle_name' value='$middle_name'>
                <label for='middle_name'>Middle Name</label>
            </div>
            <div class='input-field'>
                <input type='text' name='last_name' id='last_name' value='$last_name'>
                <label for='last_name'>Last Name</label>
            </div>
            <div class='input-field'>
                <input type='text' name='suffix_name' id='suffix_name' value='$suffix_name'>
                <label for='last_name'>Suffix Name</label>
            </div>        
            <br><br>
                    ";
                }
            ?>
			<br>
			<div class="row">
			<p><font size="-1" class="seagreen-text">Birth Date</font></p>
			<div class="input-field col s5">
				<select  name="birth_month" id="birth_month">
					<?php
					$months = array("January","February","March","April","May","June","July", "August", "September", "October", "November", "December");
					foreach($months as $month){
						if($month == $birth_month){$s=" selected";}else{$s = "";}
						echo "<option value='$month'$s>$month</option>
						";
					}
					?>
				</select>
			</div>
			<div class="input-field col s3">
				<select  name="birth_day" id="birth_day">
					<?php
						$i = 1;
						while($i <= 31){
							if($i == $birth_day){$s=" selected";} else {$s="";}
							echo "<option value='$i'$s>$i</option>
							";
							$i++;
						}						
					?>
				</select>
			</div>
			<div class="input-field col s4">
				<select  name="birth_year" id="birth_year">
					<?php
						$i = date("Y");
						while($i >= 1950){
							if($i == $birth_year){$s=" selected";} else {$s="";}
							echo "<option value='$i'$s>$i</option>
							";
							$i--;
						}						
					?>
				</select>
			</div>
			</div>
			<div class="row">
			<div class="input-field col s6">
				<input type="text" name="birth_place" id="birth_place" value="<?=$birth_place?>">
  	    		<label for="birth_place">Birth Place</label>
      		</div>
			<div class="input-field col s6">
				<select  name="gender" id="gender">
				<?php
					$genders = array("male","female");
					foreach($genders as $g){
						$g_label = ucfirst($g);
						if($g==$gender){$s=" selected";}else{$s="";}
						echo "<option value='$g'$s>$g_label</option>
						";
					}
				?>
				</select>
			</div>
			</div>
			<br><br>
			<div class="input-field">
				<input type="text" name="address" id="address" value="<?=$address?>">
  	    		<label for="address">Address</label>
      		</div>
            <div class="row">
            <div class="input-field col s6">
				<input type="text" name="city" id="city" value="<?=$city?>">
  	    		<label for="city">City</label>
      		</div>
            <div class="input-field col s6" id='country'>
                <select class='browser-default'>
					<option disabled>CHOOSE A COUNTRY</option>
					<?php
					$countries = array("Philippines", "United States");
					foreach($countries as $c){
						if($c == $country){$s=" selected";} else {$s="";}
						echo "<option value='$c'$s>$c</option>
						";
					}
					?>
                </select>
      		</div>
            </div>
            <br><br>
            <div class="row">
            <div class="input-field col s6">
				<input type="text" name="mobile_number" id="mobile_number" value="<?=$mobile_number?>">
  	    		<label for="mobile_number">Mobile Number</label>
      		</div>
            <div class="input-field col s6">
				<input type="text" name="telephone_number" id="telephone_number" value="<?=$telephone_number?>">
  	    		<label for="telephone_number">Telephone Number</label>
      		</div>
            </div>
            <div class="input-field">
				<input type="text" name="email" id="email" value="<?=$email?>">
  	    		<label for="email">E-Mail</label>
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
		$('select').material_select();
	});
	function saveChanges(){
		$("#sub2").show();
		$("#saveChanges").hide();

		<?php
			if($_SESSION['account_type']=="student"){} else {
				echo "
		var f_n = $('#first_name').val();
		var m_n = $('#middle_name').val();
		var l_n = $('#last_name').val();								
				";
			}
		?>
		var g = $("#gender").val();
		var b_m = $("#birth_month").val();
		var b_d = $("#birth_day").val();
		var b_y = $("#birth_year").val();
		var b_p = $("#birth_place").val();
		var a = $("#address").val();
		var c = $("#city").val();
		var co = $("#country").val();
		var mob = $("#mobile_number").val();
		var tel = $("#telephone_number").val();
		var e = $("#email").val();
		var d = 1;
		<?php
		if($_SESSION['account_type'] == "student"){
			echo "
		var d = 1;
			";
		} else {
			echo "

		if(!f_n){
			Materialize.toast('First Name is Required',3000);
			var d = 0;
		} else { var d = 1; }
		if(!l_n){
			Materialize.toast('Last Name is Required',3000);
			var d = 0;
		} else { var d = 1; }

			";
		}
		?>

		if(d==0){} else {

			$.ajax({
				type:'POST',
				url:'../../action/account/edit_user_self.php',
				cache:'false',
				data:{
<?php
if($_SESSION['account_type']=="student"){} else {
	echo "
				first_name: f_n,
				middle_name: m_n,
				last_name: l_n,
	";
}
?>
				gender: g,
				birth_month: b_m,
				birth_day: b_d,
				birth_year: b_y,
				birth_place: b_p,
				address: a,
				city: c,
				country: co,
				mobile_number: mob,
				telephone_number: tel,
				email: e

				},
				success: function(result){
					if(result=="ok"){
						Materialize.toast("Personal Information Edited Successfully!",3000,'',function(){location.reload();});
					} else {
						Materialize.toast(result,3000);
					}				
					$('#sub2').hide();
					$('#saveChanges').show();
				}
			}).fail(function(){
				Materialize.toast("An Error Occured",3000);
				$("#sub2").hide();
				$("#saveChanges").show();
			});
		}

	}
	
	$("#saveChanges").click(function(){
		saveChanges();
	});
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">