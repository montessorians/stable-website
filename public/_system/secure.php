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

/*
empty - admin only
1 - allow all 
2 - allow logged in only
3 - allow teachers and admin only
4 - allow admin only
*/
if(!$perm) $perm = 3;

if($perm === 0){

}

?>