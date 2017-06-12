<?php
session_start();
$ac = "montessorians";
if(empty($_POST['code'])){
	$proceed = 0;
} else {
	$access_code = $_POST['code'];
	if($access_code === $ac){
		$proceed = 1;
	} else {
		$proceed = 0;
	}
}

if(empty($access_code)){
} else {
	
	if($proceed == 0){
		echo "Wrong access code";
	} else {
		
		$_SESSION['account_type'] = $_POST['account_type'];
		$_SESSION['logged_in'] = True;
		$_SESSION['user_id'] = 0;
	
	echo "Account set as " . $_SESSION['account_type'];
		
	}
	
}

?>
<!Doctype html>
<html>
	<head>
		<title>Account Switcher Utility</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
	</head>
	<body>
		<h4>Account Switcher Utility</h4>
		<p>HCM Developer Internal Tool. Logged-in state will be changed to True but with 0 User ID.</p>
		<hr>
		<form method="post" action="accountswitch.php">
		Choose an Account type
			<select name="account_type">
				<option value="student">Student</option>
				<option value="admin">Admin</option>
				<option value="teacher">Teacher</option>
				<option value="parent">Parent</option>
				<option value="staff">Staff</option>
				<option value="developer">Developer</option>
			</select>
			<br>
			<input type="password" name="code" placeholder="Access Code">
			<br>
			<button type="submit">Set</button>
		</form>
	</body>
</html>