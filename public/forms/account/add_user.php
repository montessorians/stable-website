<?php
session_start();

$perm = 5;

include("../../_system/secure.php");
include("../../_system/database/db.php");

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

$activity_title = "Edit User";

$edit = 0;

$process_url = "../../action/account/edit_user.php";

$db_loc = "../../_store";

$db_account = new DBase("account",$db_loc);
$db_student = new DBase("student",$db_loc);
$db_admin = new DBase("admin",$db_loc);
$db_parent = new DBase("parent",$db_loc);
$db_teacher = new DBase("teacher",$db_loc);
$db_staff = new DBase("staff",$db_loc);
$db_developer = new DBase("developer",$db_loc);

function infoGetter($acc_type,$id){
	$db_temp = new DBase($acc_type,"../../_store");
	$id_f = $acc_type."_id";
	$arr = $db_temp->where(array(),$id_f,$id);
	return $arr;
}

$first_name = "";
$middle_name = "";
$last_name = "";
$suffix_name = "";
$gender = "male";
$birth_month = "";
$birth_day = "";
$birth_year = "";
$birth_place = "";
$address = "";
$city = "";
$country = "";
$mobile_number = "";
$telephone_number = "";
$email = "";
$user_id = "";
$user_name = "";

if(!empty($_REQUEST['user_id'])){
	$user_id = $_GET['user_id'];
	$user_id = $db_account->get("user_id", "user_id", $user_id);
	$edit = 1;
}
if(!empty($_REQUEST['student_id'])){
	$student_id = $_GET['student_id'];
	$user_id = $db_account->get("user_id", "student_id", $student_id);
	$edit = 1;
}
if(!empty($_REQUEST['admin_id'])){
	$admin_id = $_GET['admin_id'];
	$user_id = $db_account->get("user_id", "admin_id", $admin_id);
	$edit = 1;
}
if(!empty($_REQUEST['parent_id'])){
	$parent_id = $_GET['parent_id'];
	$user_id = $db_account->get("user_id", "parent_id", $parent_id);
	$edit = 1;
}
if(!empty($_REQUEST['teacher_id'])){
	$teacher_id = $_GET['teacher_id'];
	$user_id = $db_account->get("user_id", "teacher_id", $teacher_id);
	$edit = 1;
}
if(!empty($_REQUEST['staff_id'])){
	$staff_id = $_GET['staff_id'];
	$user_id = $db_account->get("user_id", "staff_id", $staff_id);
	$edit = 1;
}
if(!empty($_REQUEST['developer_id'])){
	$developer_id = $_GET['developer_id'];
	$user_id = $db_account->get("user_id", "developer_id", $developer_id);
	$edit = 1;
}

$button = "Add";

if($edit === 0){
	$activity_title = "Add a User";
	$process_url = "../../action/account/add_user.php";
	$button = "Edit";
}

if($edit === 1){
	$account_type = $db_account->get("account_type", "user_id", "$user_id");
	$username = $db_account->get("username", "user_id", "$user_id");

	$person_data = infoGetter($account_type,$student_id);
	foreach($person_data as $person){
		$first_name = $person['first_name'];
		$middle_name = $person['middle_name'];
		$last_name = $person['last_name'];
		$suffix_name = $person['suffix_name'];
		$gender = $person['gender'];
		$birth_month = $person['birth_month'];
		$birth_day = $person['birth_day'];
		$birth_year = $person['birth_year'];
		$birth_place = $person['birth_place'];
		$address = $person['address'];
		$city = $person['city'];
		$country = $person['country'];
		$mobile_number = $person['mobile_number'];
		$telephone_number = $person['telephone_number'];
		$email = $person['email'];
	}

}

$mon_non = "selected";
$mon_jan = "";
$mon_feb = "";
$mon_mar = "";
$mon_apr = "";
$mon_may = "";
$mon_jun = "";
$mon_jul = "";
$mon_aug = "";
$mon_sep = "";
$mon_oct = "";
$mon_nov = "";
$mon_dec = "";

switch($birth_month){
	case("January"):
		$mon_non = "";
		$mon_jan = "selected";
		break;
	case("February"):
		$mon_non = "";
		$mon_feb = "selected";
		break;
	case("March"):
		$mon_non = "";
		$mon_mar = "selected";
		break;
	case("April"):
		$mon_non = "";
		$mon_apr = "selected";
		break;
	case("May"):
		$mon_non = "";
		$mon_ = "selected";
		break;
	case("June"):
		$mon_non = "";
		$mon_jun = "selected";
		break;
	case("July"):
		$mon_non = "";
		$mon_jul = "selected";
		break;
	case("August"):
		$mon_non = "";
		$mon_aug = "selected";
		break;
	case("September"):
		$mon_non = "";
		$mon_sept = "selected";
		break;
	case("October"):
		$mon_non = "";
		$mon_oct = "selected";
		break;
	case("November"):
		$mon_non = "";
		$mon_nov = "selected";
		break;
	case("December"):
		$mon_non = "";
		$mon_dec = "selected";
		break;
}

$gen_non = "selected";
$gen_m = "";
$gen_f = "";
switch($gender){
	case("male"):
		$gen_non = "";
		$gen_m = "selected";
		break;
	case("female"):
		$gen_non = "";
		$gen_f = "selected";
		break;
}

$cou_non = "selected";
$cou_ph = "";

switch($country){
	case("Philippines"):
		$cou_non = "";
		$cou_ph = "selected";
		break;
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
	<br>
	<?php
	if(!$edit == 1){
	echo '
	<div class="input-field">
		<select name="account_type" class="browser-default" id="account_type">
			<option disabled selected>Account Type</option>
			<option value="student">Student</option>
			<option value="parent">Parent</option>
			<option value="teacher">Teacher</option>
			<option value="staff">Staff</option>
			<option value="admin">Admin</option>
			<option value="developer">Developer</option>
		</select>
	</div>
	
	';
	}							
	?>
	<div class="input-field">
		<input type="text" name="first_name" id="first_name" value="<?=$first_name?>">
		<label for="first_name">First Name</label>
	</div>
	<div class="input-field">
		<input type="text" name="middle_name" id="middle_name" value="<?=$middle_name?>">
		<label for="middle_name">Middle Name</label>
	</div>
	<div class="input-field">
		<input type="text" name="last_name" id="last_name" value="<?=$last_name?>">
		<label for="last_name">Last Name</label>
	</div>
	<div class="input-field">
		<input type="text" name="suffix_name" id="suffix_name" value="<?=$suffix_name?>">
		<label for="suffix_name">Suffix</label>
	</div>
					
	<div class="input-field">
		<select name="birth_month" class="browser-default" id="birth_month">
			<option disabled <?=$mon_non?>>Birth Month</option>
			<option value="January" <?=$mon_jan?>>January</option>
			<option value="February" <?=$mon_feb?>>February</option>
			<option value="March" <?=$mon_mar?>>March</option>
			<option value="April" <?=$mon_apr?>>April</option>
			<option value="May" <?=$mon_may?>>May</option>
			<option value="June" <?=$mon_jun?>>June</option>
			<option value="July" <?=$mon_jul?>>July</option>
			<option value="August" <?=$mon_aug?>>August</option>
			<option value="September" <?=$mon_sep?>>September</option>
			<option value="October" <?=$mon_oct?>>October</option>
			<option value="November" <?=$mon_nov?>>November</option>
			<option value="December" <?=$mon_dec?>>December</option>
		</select>
	</div>
					
	<div class="input-field">
		<input type="text" name="birth_day" id="birth_day" value="<?=$birth_day?>">
		<label for="birth_day">Birth Day</label>
	</div>
					
	<div class="input-field">
		<input type="text" name="birth_year" id="birth_year" value="<?=$birth_year?>">
		<label for="birth_year">Birth Year</label>
	</div>
	
	<div class="input-field">
		<input type="text" name="birth_place" id="birth_place" value="<?=$birth_place?>">
		<label for="birth_place">Birth Place</label>
	</div>
	
	<div class="input-field">
		<select name="gender" class="browser-default" id="gender">
			<option disabled <?=$gen_non?>>Gender</option>
			<option value="male" <?=$gen_m?>>Male</option>
			<option value="female" <?=$gen_f?>>Female</option>
		</select>
	</div>
					
	<div class="input-field">
		<input type="text" name="address" id="address" value="<?=$address?>">
		<label for="address">Address</label>
	</div>
	
	<div class="input-field">
		<input type="text" name="city" id="city" value="<?=$city?>">
		<label for="city">City</label>
	</div>
	
	<div class="input-field">
		<select name="country" class="browser-default" id="country" value="<?=$country?>">
			<option disabled <?=$cou_non?>>Country</option>
			<option value="Philippines" <?=$cou_ph?>>Philippines</option>
		</select>
	</div>
					
	<div class="input-field">
		<input type="text" name="mobile_number" id="mobile_number" value="<?=$mobile_number?>">
		<label for="mobile_number">Mobile Number</label>
	</div>
	
	<div class="input-field">
		<input type="text" name="telephone_number" id="telephone_number" value="<?=$telephone_number?>">
		<label for="telephone_number">Telephone Number</label>
	</div>
	
	<div class="input-field">
		<input type="text" name="email" id="email" value="<?=$email?>">
		<label for="email">E-Mail</label>
	</div>
					
	<br><br>
	<div class='input-field'>
		<input type='text' name='username' id='username' value='<?=$username?>'>
		<label for='username'>Username</label>
	</div>
	<?php
	if(!$edit == 1){							
		echo "											
		<div class='input-field'>
			<input type='password' name='password' id='password' value=''>
			<label for='password'>Password</label>
		</div>
		Random Password is <span id='pw'></span>";
	}
	?>
					
					
	<br><br>
	<button id="addPersonButton" class="btn btn-large waves-effect waves-light <?=$accent_color?>"><?=$button?></button>
	<span id="addpersonresponse" class="red-text"></span>
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
}).keypress((e)=>{
		var key = e.which;
		if(key == 13){
			enroll();
		}
	});

function genpw(){
	var gnpw = generatePassword();
	$("#pw").html(gnpw);
	$("#password").val(gnpw);
}

// Add a Person Form

$("#addPersonButton").click(function(){
<?php
	if($edit == 1){
		echo "var a_t = '$account_type';
		";
	} else {
		echo "var a_t = $('#account_type').val();";
	}
?>
var f_n = $("#first_name").val();
var m_n = $("#middle_name").val();
var l_n = $("#last_name").val();
var s_n = $("#suffix_name").val();
var g = $("#gender").val();
var b_m = $("#birth_month").val();
var b_d = $("#birth_day").val();
var b_y = $("#birth_year").val();
var b_p = $("#birth_place").val();
var a = $("#address").val();
var c = $("#city").val();
var co = $("#country").val();
var mo_n = $("#mobile_number").val();
var te_n = $("#telephone_number").val();
var e = $("#email").val();
var u = $('#username').val();
<?php
	if($edit == 1){
	} else {
		echo "
		var p = $('#password').val();
		";
	}
?>

<?php
if($edit == 1){
} else {
	echo "
	if(!u){
	$('#addpersonresponse').html('Username is required');
} else {
	
	";	
}
?>


$.ajax({
	type: 'POST',
	url: '<?=$process_url?>',
	data: {
	<?php
	if($edit == 1){
		echo "
		user_id: '$user_id',";
	}
	?>
	account_type: a_t,
	first_name: f_n,
	middle_name: m_n,
	last_name: l_n,
	suffix_name: s_n,
	gender: g,
	birth_month: b_m,
	birth_day: b_d,
	birth_year: b_y,
	birth_place: b_p,
	address: a,
	city: c,
	country: co,
	mobile_number: mo_n,
	telephone_number: te_n,
	email: e,
	username: u

	<?php
	if(!$edit == 1){
		echo ",
	password: p";
	}
	?>
	},
	cache: false,
	success: (result)=>{
		Materialize.toast(result, 8000);
		<?php
			if(!$edit == 1){
			echo "				
				$('input[type=text], textarea').val('');
				$('input[type=password]').val('');";
			}
		?>
		genpw();
	}
}).fail(()=>{
	$("#addpersonresponse").html("Error connecting to server");
});

<?php if(!$edit == 1) echo "}"; ?>
		
});
</script>
<!--link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"-->