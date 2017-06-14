<?php
session_start();
include(../_system/config.php);
if(empty($_SESSION['logged_in'])){
  $logged_in = False;
} else {
  $logged_in = True;
  $account_type = $_SESSION['account_type'];
}

echo "<script>
      const {dialog} = require('electron').remote;
      const {BrowserWindow} = require('electron').remote;
</script>";

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
        let loginWindow = new BrowserWindow({width: 400, height: 500, modal:true, icon: false, webPreferences:{nodeIntegration:false, contextIsolation:true, sandbox:true, webSecurity:false}});
        loginWindow.loadURL('http://hcmontessori.likesyou.org/account');
        loginWindow.setMenu(null);
        loginWindow.show();});
    </script>
  ";
}

if($logged_in == True){
  echo "
    <h5 class='nav-group-title'>Tasks</h5>  
    <a class='nav-group-item' id='loginbutton'>
      <span class='icon icon-login'></span>
      Home
    </a>
    <script>
      $('#loginbutton').click(function(){
        let loginWindow = new BrowserWindow({width: 400, height: 500, modal:true, icon: false, webPreferences:{nodeIntegration:false, contextIsolation:true, sandbox:true, webSecurity:false}});
        loginWindow.loadURL('http://hcmontessori.likesyou.org/account');
        loginWindow.setMenu(null);
        loginWindow.show();});
    </script>
  ";
}

$username = $_SESSION['username'];

echo "
<h5 class='nav-group-title'>Application</h5>  
    <a class='nav-group-item' id='loginbutton'>
      <span class='icon icon-info'></span>
      About Program
    </a>
<script>
$('#loginbutton').click(function(){
        dialog.showMessageBox({
            title: 'About HCM Desktop App',
            message: 'HCM WebApp Version: $hcm_version_no - $hcm_version_release ($hcm_version_date)\nLogged-In Username: $username'
        }});
      });
</script>
";
?>
