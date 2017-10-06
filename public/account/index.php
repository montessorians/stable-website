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
if(!empty($_SESSION['logged_in'])) header("Location: $from");

if($showContinue==True){
    $msg = "To continue, you must be signed-in";
} else {
    $msg = "Sign-In with your Holy Child Montessori Account";
}
?>
<!--
    Holy Child Montessori
    2017
    All Rights Reserved

    Account
-->
<!Doctype html>
<html lang="en">
    <head>
        <title><?=$activity_title." - ".$site_title?></title>
        <?php include("../_system/styles.php"); ?>
        <script type="text/javascript">
            const from = "<?=$from?>";
        </script>
        <style>
            .splashscreen{ background-color: gainsboro !important; }
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
                    <img width="70px" height="70px" src="../assets/logo.jpg" id="logo">
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
                        <input type="password" name="password" id="password">
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
				<a class="btn btn-flat grey-text" href="#forgotpassword">Forgot Password</a> 
				<a class="btn btn-flat grey-text" href="#privacyinformation">Privacy Information</a>
				<p class="grey-text">Copyright <?=date("Y")?><br>
				<b><?=$site_title?></b> </p>
			</center>
        <br><br><br>
    </body>

<!--
Public Network Modal
-->
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

<!--
Forgot Password Modal
-->
<div id="forgotpassword" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h5>Forgot Password</h5>
        <p style="text-align:justify">
            If you forgot your password, please immediately contact us through our office to reset it for you. We will send you a
            temporary password that you can use to sign in to your account.<br>
            <br>
            Once we have given you a temporary password please change it with your new password.
        </p>
    </div>
    <div class="modal-footer">
        <a class="modal-action modal-close waves-effect waves-red btn-flat">Close</a>
    </div>
</div>

<!--
Privacy Information
-->
<div id="privacyinformation" class="modal modal-fixed-footer">
    <div class="modal-content">
        <h5>Privacy Information</h5>
        <p style="text-align:justify">
            We care about your privacy, Holy Child Montessori strives to protect your information.
            Even if we apply sophisticated security methods in our system, there might be instances
            that security would be compromised especially in your end. If this ever happen, the school
            is not liable for any loss or damage to you.
        </p>
    </div>
    <div class="modal-footer">
        <a class="modal-action modal-close waves-effect waves-red btn-flat">Close</a>
    </div>
</div>

</html>
<script type="text/javascript">
// Initialization Event
$(document).ready(function(){
    init();
}).keypress(function(e){
    var key = e.which;
    if(key==13){
        var p = $("#password").val();
        if(!p){
            usernameProceed();
        } else {
            login();
        }
    }
});

// Initialization Function
function init(){
    $('.tooltipped').tooltip({delay: 50});
    $('.modal').modal();
    $("meta[name='theme-color']").attr("content", "gainsboro");
    hideCards();
    $(".splashscreen").fadeOut();
    displayEnterEmail();
}

$(".usernameButton").click(function(){
    usernameProceed();
});
$(".loginButton").click(function(){
    login();
});

function hideCards(){
    $(".card").hide();
    $(".progress").hide();
}


function displayEnterEmail(){
    $("#askUsernameCard").slideDown({duration:300});
    $("#logo").fadeIn({duration: 800});
}

function displayPasswordEntry(){
    $("#progress").hide();
    hideCards();    
    $("#askPasswordCard").slideDown();
}

function usernameProceed(){
    $(".progress").show();
    $(".usernameButton").attr("disabled","disabled");
    $("#username").attr("disabled",true);
    let u = $("#username").val();
    if(!u){
        Materialize.toast("Please enter your username",3000);
        $(".progress").hide();
        $(".usernameButton").attr("disabled",false);
        $("#username").attr("disabled",false);
    } else {
    $.ajax({
        type:'POST',
        url:'../action/account/check_username.php',
        data: {
            username : u
        },
        cache:'false',
        success: function(result){
            let data = JSON.parse(result);
            if(!data['username']){
            Materialize.toast("The account was not found",3000);
            $(".progress").hide();
            $(".usernameButton").attr("disabled",false);
            $("#username").attr("disabled",false);
            $("#username").val("");
        } else {
                var fn = data['first_name'];
                var un = "@"+data['username'];
                var pu = "../"+data['photo_url'];
                $("#firstName").html(fn);
                $("#userID").html(un);
                if(!data['photo_url']){} else {
                    $("#accountIcon").attr('src',pu);
                }                
                displayPasswordEntry();
            }
        }
    }).fail(function(){
        Materialize.toast("An error occured. Please try again", 3000);
        $(".progress").hide();
        $(".usernameButton").attr("disabled",false);
        $("#username").attr("disabled",false);
    });}
}

function login(){
    var u = $("#username").val();
    if(!u){
    } else {
        $(".progress").show();
        $(".usernameButton").attr("disabled",true);
        $(".loginButton").attr("disabled",true);
        $("#username").attr("disabled",true);
        $("#password").attr("disabled",true);
        var p = $("#password").val();
        if(!p){
            Materialize.toast("Please enter your password", 3000);
            $(".progress").hide();
            $(".usernameButton").attr("disabled",false);
            $(".loginButton").attr("disabled",false);
            $("#username").attr("disabled",false);
            $("#password").attr("disabled",false);
        } else {
            $.ajax({
                type:'POST',
                url:'loginprocess.php',
                cache:'false',
                data: {
                    username: u,
                    password: p
                },
                success: function(result){
                    if(result=="Ok"){
                        window.location.replace(from);
                    } else {
                        Materialize.toast(result,3000);
                        $(".progress").hide();
                        $(".usernameButton").attr("disabled",false);
                        $(".loginButton").attr("disabled",false);
                        $("#username").attr("disabled",false);
                        $("#password").attr("disabled",false);
                    }
                }
            });
        }
    }
}
</script>
