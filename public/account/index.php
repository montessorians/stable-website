<?php
// Start Session
session_start();
include("../_system/config.php");
$activity_title = "Account";
$showContinue = False;

// Handle redirection after login
if(empty($_REQUEST['from'])){
    if(empty($_SERVER['HTTP_REFERER'])){
        $from = "../";
        $showContinue = False;
    } else {
        $from = $_SERVER['HTTP_REFERER'];
        if(empty($_REQUEST['local'])){
            $showContinue = True;
        } else {
            $showContinue = False;                        
        }
    }
} else {
    $from = $_REQUEST['from'];
    $showContinue = True;
}

// Check if user is already logged in
if(empty($_SESSION['logged_in'])){} else {
    header("Location: $from");
}

if($showContinue==True){
    $msg = "To continue you must be logged-in";
} else {
    $msg = "Sign-In with your Holy Child Montessori Account";
}
?>
<!Doctype html>
<html>
    <head>
        <title><?=$activity_title." - ".$site_title?></title>
        <?php include("../_system/styles.php"); ?>
        <script>
            const from = "<?=$from?>";
        </script>
        <style>
            .splashscreen{
                background-color: gainsboro !important;
            }
        </style>
    </head>
    <body class="grey lighten-4" id="body">
        <div class="splashscreen"></div>
        <br><br><br>
        <div class="container"><div class="container">

            <!-- Ask for Username card -->
            <div class="card z-depth-5 hoverable" id="askUsernameCard">
                <div class="progress green lighten-4"><div class="indeterminate seagreen"></div></div>
                <div class="card-content">
                    <img width="70px" height="70px" src="logo.png" id="logo">
                    <h5 class="blue-grey-text text-darken-1">Welcome Montessorian!</h5>
                    <p><?=$msg?></p>
                    <br><br>
                    <div class="input-field">
                        <input type="text" name="username" id="username">
                        <label for="username">Username</label>
                    </div>
                    <br><br>
                    <button class="btn btn-medium btn-block seagreen waves-effect waves-light hide-on-med-and-up usernameButton">Next</button>
                    <a href="#publicnetwork"><p class="grey-text hide-on-med-and-up"><br>On free wifi or public network?</p></a>
                    <div class="row">
                        <div class="col s8">
                        <a href="#publicnetwork"><p class="grey-text hide-on-small-only">On free wifi or public network?</p></a>
                        </div>
                        <div class="col s4">
                            <button class="btn btn-medium btn-block seagreen waves-effect waves-light hide-on-small-only usernameButton">Next</button>
                        </div>                    
                    </div><br><br>
                </div>
            </div>

            <!-- Ask for Password card -->
            <div class="card z-depth-5 hoverable" id="askPasswordCard">
                <div class="progress green lighten-4"><div class="indeterminate seagreen"></div></div>
                <div class="card-content">
                    <img width="100px" src="../assets/noimg.bmp" id="accountIcon">
                    <h5 class="blue-grey-text text-darken-1">Welcome <span id="firstName">User</span>!</h5>
                    <p id="userID">@username</p>
                    <br><br>
                    <div class="input-field">
                        <input type="password" name="password" id="password" class="tooltipped" data-position="top" data-tooltip="Enter your Password">
                        <label for="password">Password</label>
                    </div>
                    <br><br>
                    <button class="btn btn-medium btn-block seagreen waves-effect waves-light hide-on-med-and-up loginButton">Sign-In</button>                    
                    <div class="row">
                        <div class="col s8"></div>
                        <div class="col s4">
                            <button class="btn btn-medium btn-block seagreen waves-effect waves-light hide-on-small-only loginButton">Sign-In</button>
                        </div>                    
                    </div><br><br>
                </div>
            </div>

        </div></div>
        <br><br>
        	<center>
				<a class="btn btn-flat grey-text" href="http://hcm-help.likesyou.org/index.php?controller=post&action=view&id_post=2">Forgot Password</a> 
				<a class="btn btn-flat grey-text" href="http://hcm-help.likesyou.org/index.php?controller=post&action=view&id_post=3">Privacy Information</a>
				<p class="grey-text">Copyright <?=date("Y")?><br>
				<b><?=$site_title?></b> </p>
			</center>
        <br><br><br>
    </body>
<div id="publicnetwork" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h5>Warning About Signing-In on Free Wifi & Public Networks</h5>
      <p style="text-align:justify">
	  	Free WiFi and other public networks can read the data you are sending. Unless you are not using the password in Holy Child Montessori to your other accounts (Social Network or Email), DO NOT proceed in signing-in.
        If you suspect that there is an unknown change to your account, change your password immediately on a private network. You may also contact us to reset it for you. 
	  </p>
    </div>
    <div class="modal-footer">
      <a class="modal-action modal-close waves-effect waves-green btn-flat">I Understand</a>
    </div>
</div>
</html>
<script type="text/javascript" src="loginizer.js"></script>