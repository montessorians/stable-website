<?php
session_start();
if(empty($_SESSION['logged_in'])){
  $logged_in = False;
} else {
  $logged_in = True;
  $account_type = $_SESSION['account_type'];
}

if($logged_in == False){
  echo "
    <h5 class='nav-group-title'>Account</h5>  
    <a class='nav-group-item' id='loginbutton'>
      <span class='icon icon-login'></span>
      Sign-In
    </a>
    <script>
      const {dialog} = require('electron').remote;
      const {BrowserWindow} = require('electron').remote;
      $('#loginbutton').click(function(){
        let loginWindow = new BrowserWindow({width: 400, height: 500, webPreferences:{nodeIntegration:false}});
        loginWindow.loadURL('http://localhost/account');''
        dialog.showMessageBox(loginWindow,{title: 'Sign-In'});});
    </script>
  ";
}
?>
