<?php
/*
Holy Child Montessori
All Rights Reserved 
2017
*/

// Site Config
$primary_color = "seagreen";
$secondary_color = "green darken-2";
$theme_color = "seagreen";
$accent_color = "blue-grey darken-2";
$accent_color_text = "white-text";

$site_title = "Holy Child Montessori";

// Site Versioning Settings
$hcm_version_no = "1.01";
$hcm_version_release = "Public";
$hcm_version_date = "July 2017 (Week 1)";

$ua = $_SERVER['HTTP_USER_AGENT'];
if(stripos($ua,"hcm-windows")){
    $desktop = True;
    $hcm_windows_version_user = $ua;
} else {
    $desktop = False;
    $hcm_windows_version_user = "";
}
?>