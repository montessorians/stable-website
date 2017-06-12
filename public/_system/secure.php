<?php
if(empty($_SESSION['account_type'])){
	header("Location: ../../");
} else {
		if($_SESSION['account_type'] == "admin"){
		} else {
			if($_SESSION['account_type'] == "teacher"){
			} else {
				header("Location: ../../");
			}
		}
}
?>