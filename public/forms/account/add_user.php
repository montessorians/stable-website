<?php
	session_start();
	include("../../_system/secure.php");
	include("../../_system/database/db.php");
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
	$activity_title = "Edit User";
	$edit = 1;
	$process_url = "../../action/account/edit_user.php";
$db_account = new DBase("account", "../../_store");
$db_student = new DBase("student", "../../_store");
$db_admin = new DBase("admin", "../../_store");
$db_parent = new DBase("parent", "../../_store");
$db_teacher = new DBase("teacher", "../../_store");
$db_staff = new DBase("staff", "../../_store");
$db_developer = new DBase("developer", "../../_store");

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

if(empty($_GET['user_id'])){
		if(empty($_GET['student_id'])){
			if(empty($_GET['admin_id'])){
				if(empty($_GET['parent_id'])){
					if(empty($_GET['teacher_id'])){
						if(empty($_GET['staff_id'])){
							if(empty($_GET['developer_id'])){
								$activity_title = "Add a User";
								$process_url = "../../action/account/add_user.php";
								$edit = 0;
							} else {
								$developer_id = $_GET['developer_id'];
								$user_id = $db_account->get("user_id", "developer_id", "$developer_id");
							} 
						} else {
							$staff_id = $_GET['staff_id'];
							$user_id = $db_account->get("user_id", "staff_id", "$staff_id");
						}
					} else {
						$teacher_id = $_GET['teacher_id'];
						$user_id = $db_account->get("user_id", "teacher_id", "$teacher_id");
					}
				} else {
					$parent_id = $_GET['parent_id'];
					$user_id = $db_account->get("user_id", "parent_id", "$parent_id");
				}
			} else {
				$admin_id = $_GET['admin_id'];
				$user_id = $db_account->get("user_id", "admin_id", "$admin_id");
			}
		} else {
			$student_id = $_GET['student_id'];
			$user_id = $db_account->get("user_id", "student_id", "$student_id");
		}
	} else {
		$user_id = $_GET['user_id'];
		$user_id = $db_account->get("user_id", "user_id", "$user_id");
	}

$account_type = $db_account->get("account_type", "user_id", "$user_id");

$username = $db_account->get("username", "user_id", "$user_id");

switch($account_type){
		case("student"):
			$student_id = $db_account->get("student_id", "user_id", "$user_id");
			$first_name = $db_student->get("first_name", "student_id", "$student_id");
			$middle_name = $db_student->get("middle_name", "student_id", "$student_id");
			$last_name = $db_student->get("last_name", "student_id", "$student_id");
			$suffix_name = $db_student->get("suffix_name", "student_id", "$student_id");
			$gender = $db_student->get("gender", "student_id", "$student_id");
			$birth_month = $db_student->get("birth_month", "student_id", "$student_id");
			$birth_day = $db_student->get("birth_day", "student_id", "$student_id");
			$birth_year = $db_student->get("birth_year", "student_id", "$student_id");
			$birth_place = $db_student->get("birth_place", "student_id", "$student_id");
			$address = $db_student->get("address", "student_id", "$student_id");
			$city = $db_student->get("city", "student_id", "$student_id");
			$country = $db_student->get("country", "student_id", "$student_id");
			$mobile_number = $db_student->get("mobile_number", "student_id", "$student_id");
			$telephone_number = $db_student->get("telephone_number", "student_id", "$student_id");
			$email = $db_student->get("email", "student_id", "$student_id");
			break;
			
		case("parent"):
			$parent_id = $db_account->get("parent_id", "user_id", "$user_id");
			$first_name = $db_parent->get("first_name", "parent_id", "$parent_id");
			$middle_name = $db_parent->get("middle_name", "parent_id", "$parent_id");
			$last_name = $db_parent->get("last_name", "parent_id", "$parent_id");
			$suffix_name = $db_parent->get("suffix_name", "parent_id", "$parent_id");
			$gender = $db_parent->get("gender", "parent_id", "$parent_id");
			$birth_month = $db_parent->get("birth_month", "parent_id", "$parent_id");
			$birth_day = $db_parent->get("birth_day", "parent_id", "$parent_id");
			$birth_year = $db_parent->get("birth_year", "parent_id", "$parent_id");
			$birth_place = $db_parent->get("birth_place", "parent_id", "$parent_id");
			$address = $db_parent->get("address", "parent_id", "$parent_id");
			$city = $db_parent->get("city", "parent_id", "$parent_id");
			$country = $db_parent->get("country", "parent_id", "$parent_id");
			$mobile_number = $db_parent->get("mobile_number", "parent_id", "$parent_id");
			$telephone_number = $db_parent->get("telephone_number", "parent_id", "$parent_id");
			$email = $db_parent->get("email", "parent_id", "$parent_id");
			break;
			
		case("teacher"):
			$teacher_id = $db_account->get("teacher_id", "user_id", "$user_id");
			$first_name = $db_teacher->get("first_name", "teacher_id", "$teacher_id");
			$middle_name = $db_teacher->get("middle_name", "teacher_id", "$teacher_id");
			$last_name = $db_teacher->get("last_name", "teacher_id", "$teacher_id");
			$suffix_name = $db_teacher->get("suffix_name", "teacher_id", "$teacher_id");
			$gender = $db_teacher->get("gender", "teacher_id", "$teacher_id");
			$birth_month = $db_teacher->get("birth_month", "teacher_id", "$teacher_id");
			$birth_day = $db_teacher->get("birth_day", "teacher_id", "$teacher_id");
			$birth_year = $db_teacher->get("birth_year", "teacher_id", "$teacher_id");
			$birth_place = $db_teacher->get("birth_place", "teacher_id", "$teacher_id");
			$address = $db_teacher->get("address", "teacher_id", "$teacher_id");
			$city = $db_teacher->get("city", "teacher_id", "$teacher_id");
			$country = $db_teacher->get("country", "teacher_id", "$teacher_id");
			$mobile_number = $db_teacher->get("mobile_number", "teacher_id", "$teacher_id");
			$telephone_number = $db_teacher->get("telephone_number", "teacher_id", "$teacher_id");
			$email = $db_teacher->get("email", "teacher_id", "$teacher_id");
			break;
			
		case("admin"):
			$admin_id = $db_account->get("admin_id", "user_id", "$user_id");
			$first_name = $db_admin->get("first_name", "admin_id", "$admin_id");
			$middle_name = $db_admin->get("middle_name", "admin_id", "$admin_id");
			$last_name = $db_admin->get("last_name", "admin_id", "$admin_id");
			$suffix_name = $db_admin->get("suffix_name", "admin_id", "$admin_id");
			$gender = $db_admin->get("gender", "admin_id", "$admin_id");
			$birth_month = $db_admin->get("birth_month", "admin_id", "$admin_id");
			$birth_day = $db_admin->get("birth_day", "admin_id", "$admin_id");
			$birth_year = $db_admin->get("birth_year", "admin_id", "$admin_id");
			$birth_place = $db_admin->get("birth_place", "admin_id", "$admin_id");
			$address = $db_admin->get("address", "admin_id", "$admin_id");
			$city = $db_admin->get("city", "admin_id", "$admin_id");
			$country = $db_admin->get("country", "admin_id", "$admin_id");
			$mobile_number = $db_admin->get("mobile_number", "admin_id", "$admin_id");
			$telephone_number = $db_admin->get("telephone_number", "admin_id", "$admin_id");
			$email = $db_admin->get("email", "admin_id", "$admin_id");
			break;

		case("staff"):
			$staff_id = $db_account->get("staff_id", "user_id", "$user_id");
			$first_name = $db_staff->get("first_name", "staff_id", "$staff_id");
			$middle_name = $db_staff->get("middle_name", "staff_id", "$staff_id");
			$last_name = $db_staff->get("last_name", "staff_id", "$staff_id");
			$suffix_name = $db_staff->get("suffix_name", "staff_id", "$staff_id");
			$gender = $db_staff->get("gender", "staff_id", "$staff_id");
			$birth_month = $db_staff->get("birth_month", "staff_id", "$staff_id");
			$birth_day = $db_staff->get("birth_day", "staff_id", "$staff_id");
			$birth_year = $db_staff->get("birth_year", "staff_id", "$staff_id");
			$birth_place = $db_staff->get("birth_place", "staff_id", "$staff_id");
			$address = $db_staff->get("address", "staff_id", "$staff_id");
			$city = $db_developer->get("city", "staff_id", "$staff_id");
			$country = $db_staff->get("country", "staff_id", "$staff_id");
			$mobile_number = $db_staff->get("mobile_number", "staff_id", "$staff_id");
			$telephone_number = $db_staff->get("telephone_number", "staff_id", "$staff_id");
			$email = $db_staff->get("email", "staff_id", "$staff_id");
			break;
			
		case("developer"):
			$developer_id = $db_account->get("developer_id", "user_id", "$user_id");
			$first_name = $db_developer->get("first_name", "developer_id", "$developer_id");
			$middle_name = $db_developer->get("middle_name", "developer_id", "$developer_id");
			$last_name = $db_developer->get("last_name", "developer_id", "$developer_id");
			$suffix_name = $db_developer->get("suffix_name", "developer_id", "$developer_id");
			$gender = $db_developer->get("gender", "developer_id", "$developer_id");
			$birth_month = $db_developer->get("birth_month", "developer_id", "$developer_id");
			$birth_day = $db_developer->get("birth_day", "developer_id", "$developer_id");
			$birth_year = $db_developer->get("birth_year", "developer_id", "$developer_id");
			$birth_place = $db_developer->get("birth_place", "developer_id", "$developer_id");
			$address = $db_developer->get("address", "developer_id", "$developer_id");
			$city = $db_developer->get("city", "developer_id", "$developer_id");
			$country = $db_developer->get("country", "developer_id", "$developer_id");
			$mobile_number = $db_developer->get("mobile_number", "developer_id", "$developer_id");
			$telephone_number = $db_developer->get("telephone_number", "developer_id", "$developer_id");
			$email = $db_developer->get("email", "developer_id", "$developer_id");
			break;
	}//
	
	if($edit == 1){
		$button = "Edit";
	} else {
		$button = "Add";
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
				if($edit == 1){
					
				} else {
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
  							if($edit == 1){
  								 
  							} else {
  								
  								echo "
  								
  								
  						  						
  						<div class='input-field'>
  							<input type='password' name='password' id='password' value=''>
  							<label for='password'>Password</label>
  						</div>
  						Random Password is <span id='pw'></span>
  								 								
  								";
  								
  							}
  						?>
  						
  						
  						<br>
  						<br>
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

$(document).ready(function(){
	genpw();
}).keypress(function(e){
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
							user_id: '$user_id',
							";
						} else {}
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
					if($edit == 1){
						
					} else {
						echo ",
					password: p	
						";
					}
					?>
			},
			cache: false,
			success: function(result){
				Materialize.toast(result, 8000);
				<?php
					if($edit == 1){
					} else {
						echo "
						
							$('input[type=text], textarea').val('');
							$('input[type=password]').val('');
						
						";
					}
				?>
				genpw();
			}
		}).fail(function(){
			$("#addpersonresponse").html("Error connecting to server");
		});
		
		<?php
		if($edit == 1){
			
		} else {
			echo "}";	
		}
		
		?>
		
		
		});
</script>
<!--link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"-->