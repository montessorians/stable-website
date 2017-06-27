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
    hideCards();
    displayEnterEmail();
}

$("#usernameButton").click(function(){
    usernameProceed();
});
$("#loginButton").click(function(){
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
    $("#usernameButton").attr("disabled","disabled");
    $("#username").attr("disabled","disabled");
    let u = $("#username").val();
    if(!u){
        Materialize.toast("Please enter your username",3000);
        $(".progress").hide();
        $("#usernameButton").attr("disabled",false);
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
            $("#usernameButton").attr("disabled",false);
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
        $("#usernameButton").attr("disabled",false);
        $("#username").attr("disabled",false);
    });}
}

function setCurrentUserID(param){
    let user_id = param;
    let fetchedAccountsList = localStorage.getItem("hcm-savedaccounts");
    if(!fetchedAccountsList){
        var accL = [];
        var accL = JSON.stringify(accL.push(user_id));
        localStorage.setItem("hcm-savedaccounts",accL);
    } else {
        var accountsList = JSON.parse(fetchedAccountsList);
        if(_.some(accountsList,function(uid){return uid === user_id;})){} else {        
        let aL = JSON.stringify(accountsList.push(user_id));
        localStorage.setItem("hcm-savedaccounts",aL);
        alert(user_id + " added");
    }

    }
}

function login(){
    var u = $("#username").val();
    if(!u){
    } else {
        $(".progress").show();
        $("#usernameButton").attr("disabled","disabled");
        $("#loginButton").attr("disabled","disabled");
        $("#username").attr("disabled","disabled");
        $("#password").attr("disabled","disabled");
        var p = $("#password").val();
        if(!p){
            Materialize.toast("Please enter your password", 3000);
            $(".progress").hide();
            $("#usernameButton").attr("disabled",false);
            $("#loginButton").attr("disabled",false);
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
                        $("#usernameButton").attr("disabled",false);
                        $("#loginButton").attr("disabled",false);
                        $("#username").attr("disabled",false);
                        $("#password").attr("disabled",false);
                    }
                }
            });
        }
    }
}