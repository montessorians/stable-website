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
        <style>
            .splashscreen{ background-color: gainsboro !important; }
            .switch label input[type=checkbox]:checked+.lever {
                background-color: rgb(139, 219, 174) !important;
            }

            .switch label input[type=checkbox]:checked+.lever:after {
                background-color: seagreen !important;
                left: 24px;
            }

            .card {
              border-radius: 20px 20px 20px 20px !important;
            }
            .btn {
              border-radius: 20px 20px 20px 20px !important;
            }
        </style>
    </head>
    <body id="body" style="background-color: #EBFDF3; font-family: 'Rubik', sans-serif !important;">
        <div class="splashscreen valign-wrapper">
            <div class="valign center-block">
                <noscript>
                    <b class="seagreen-text">
                    <center>
                        <h4>Sorry!</h4>
                        <h5>This web application requires Javascript to be turned-on.</h5>
                    </center>
                    </b>
                </noscript>
            </div>
        </div>
        <br><br><br>
        <div class="container"><div class="container">
            
            <br>
            <a class="grey-text text-darken-3" href="/home.php">
                <i class="material-icons tiny">arrow_back</i> Back to Homepage
            </a>
            <br><br>

            <!-- Ask for Username card -->
            <div class="card z-depth-5 hoverable" id="askUsernameCard">
                <div class="progress green lighten-4"><div class="indeterminate seagreen"></div></div>
                <div class="card-content">
                    <div class="lg"></div>
                    <img width="70px" height="70px" src="/assets/imgs/logo.jpg" id="logo">
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
                    <img width="100px" src="../assets/imgs/noimg.png" id="accountIcon">
                    <h5 class="blue-grey-text text-darken-1">Welcome <span id="firstName">User</span>!</h5>
                    <p id="userID">@username</p>
                    <br><br>
                    <div class="input-field">
                        <input type="password" name="password" id="password" autocomplete="new-password">
                        <label for="password">Password</label>
                    </div>
                    <div class="input-field">
                        <div class="switch">
                            <label>
                                Hide
                                <input type="checkbox" id="showPasswordToggle" onclick="togglePassword()">
                                <span class="lever"></span>
                                Show
                            </label>
                        </div>
                    </div>
                    <br><br>
                    <div class="hide-on-med-and-up">
                        <br><br>
                        <button class="btn btn-medium btn-block seagreen waves-effect waves-light loginButton">Sign-In</button>
                    </div>
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

    // Get which key
    var key = e.which;

    // Check if enter is pressed
    if(key==13){

        // Get value of password
        var p = $("#password").val();

        // Check if empty password
        if(!p){

            // Proceed with username check
            usernameProceed();

        } else {

            // Proceed with login
            login();

        }

    }

});

// Initialization Function
function init(){

    $('.tooltipped').tooltip({delay: 50});
    $('.modal').modal();

    $("meta[name='theme-color']").attr("content", "#defceb");
    $("#username").attr("disabled","disabled");
    $("#password").attr("disabled","disabled");
    hideCards();
    $(".splashscreen").fadeOut();
    displayEnterUsername();
}


/*
Button Handlers
 */

// Username Check Button
$(".usernameButton").click(function(){
    usernameProceed();
});

// Login Button
$(".loginButton").click(function(){
    login();
});

function togglePassword(){
    var pwinp = document.getElementById("password");
    if(pwinp.type === 'password'){
        pwinp.type = "text";
    } else {
        pwinp.type = "password";
    }
}

// Hide Cards Function
function hideCards(){
    $(".card").hide();
    $(".progress").hide();
}

// Display Enter Username Card
function displayEnterUsername(){
    $("#username").removeAttr("disabled","");
    $("#askUsernameCard").slideDown({duration:300});
    $("#logo").fadeIn({duration: 800});
}

// Display Password Entry Card
function displayPasswordEntry(){
    $("#password").removeAttr("disabled","");
    $("#progress").hide();
    hideCards();    
    $("#askPasswordCard").slideDown();
}

/*
Form Processing
*/

// Username Checker
function usernameProceed(){

    // Handle UI
    $(".progress").show();
    $(".usernameButton").attr("disabled","disabled");
    $("#username").attr("disabled",true);

    // Get Username from Form
    let u = $("#username").val();

    // Check if empty username
    if(!u){

        // Alert User of empty Username
        Materialize.toast("Please enter your username",3000);

        // Handle UI
        $(".progress").hide();
        $(".usernameButton").attr("disabled",false);
        $("#username").attr("disabled",false);

    } else {

        // Send Data
        $.ajax({
            type:'POST',
            url:'../action/account/check_username.php',
            data: {
                username : u
            },
            cache:'false',
            success: function(result){
 
                // JSON parse result
                let data = JSON.parse(result);

                // Check if contains username
                if(!data['username']){
 
                    // Alert user that account was not found
                    Materialize.toast("The account was not found",3000);

                    // Handle UI
                    $(".progress").hide();
                    $(".usernameButton").attr("disabled",false);
                    $("#username").attr("disabled",false);
                    $("#username").val("");
 
                } else {

                    // Var the user data
                    var fn = data['first_name'];
                    var un = "@"+data['username'];
                    var pu = "../"+data['photo_url'];

                    // Set env
                    $("#firstName").html(fn);
                    $("#userID").html(un);
 
                    // Check for user image
                    if(!data['photo_url']){
                    } else {

                        // Set user image
                        $("#accountIcon").attr('src',pu);
 
                    }                
 
                    // Display Password entry
                    displayPasswordEntry();
 
                }
            }

        }).fail(function(){

            // Alert if error occured
            Materialize.toast("An error occured. Please try again", 3000);

            // Handle UI
            $(".progress").hide();
            $(".usernameButton").attr("disabled",false);
            $("#username").attr("disabled",false);

        });
    }
}

// Login Function
function login(){

    // Get Username from Form
    var u = $("#username").val();

    // Check if empty username
    if(!u){
    } else {

        // Handle UI
        $(".progress").show();
        $(".usernameButton").attr("disabled",true);
        $(".loginButton").attr("disabled",true);
        $("#username").attr("disabled",true);
        $("#password").attr("disabled",true);

        // Get Password from Form
        var p = $("#password").val();

        // Check if empty password
        if(!p){

            // Alert of empty password
            Materialize.toast("Please enter your password", 3000);

            // Handle UI
            $(".progress").hide();
            $(".usernameButton").attr("disabled",false);
            $(".loginButton").attr("disabled",false);
            $("#username").attr("disabled",false);
            $("#password").attr("disabled",false);

        } else {

            // Send data
            $.ajax({
                type:'POST',
                url:'loginprocess.php',
                cache:'false',
                data: {
                    username: u,
                    password: p
                },
                success: function(result){

                    // JSON parse result
                    let data = JSON.parse(result);

                    if(!data['code']){

                        Materialize.toast("An Error Occured");

                    } else {

                        let code = data['code'];
                        let msg = data['message'];
                        localStorage.setItem("hcm-student-id",data['student_id']);
                        localStorage.setItem("hcm-logged-in", "true");

                        if(code == 200){

                            var from = "<?=$from?>";
                            if(!from){
                                window.location.replace("/");
                            } else {
                                window.location.replace("/"+from);
                            }

                        } else {

                            Materialize.toast(msg,3000);

                            // Handle UI
                            $(".progress").hide();
                            $(".usernameButton").attr("disabled",false);
                            $(".loginButton").attr("disabled",false);
                            $("#username").attr("disabled",false);
                            $("#password").attr("disabled",false);

                        }

                    }
                    
                }

            });

        }
    }
}
</script>
