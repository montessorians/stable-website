<?php
/*
Holy Child Montessori
2017
All Rights Reserved 

config.php
*/

// Site Versioning Settings
$hcm_version_major = '1';
$hcm_version_minor = '07';
$hcm_version_patch = '0';
$hcm_version_release = "Public";
$hcm_version_date = "October 2017 (Week 2)";


// Site Config
$primary_color = "seagreen";
$secondary_color = "green darken-2";
$theme_color = "seagreen";
$accent_color = "blue-grey darken-2";
$accent_color_text = "white-text";

$site_title = "Holy Child Montessori";

$ua = $_SERVER['HTTP_USER_AGENT'];

if(!empty($hcm_version_patch)) $hcm_version_patch_d = ".$hcm_version_patch";
if(!empty($hcm_version_minor)) $hcm_version_minor_d = ".$hcm_version_minor";
if(!empty($hcm_version_release)) $hcm_version_release_d = " - $hcm_version_release";
if($hcm_version_patch == 0) $hcm_version_patch_d = ".$hcm_version_patch";
if($hcm_version_minor == 0) $hcm_version_minor_d = ".$hcm_version_minor";

$hcm_version_no = $hcm_version_major.$hcm_version_minor_d.$hcm_version_patch_d.$hcm_version_release_d;

/*

For Windows Client

if(stripos($ua,"hcm-windows")){
    $desktop = True;
    $hcm_windows_version_user = $ua;
} else {
    $desktop = False;
    $hcm_windows_version_user = "";
}*/
?>