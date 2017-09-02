<?php
/*
HOLY CHILD MONTESSORI
Website
2017
*/

// Start Session
session_start();
// Include Main.php if not found automatically redirect to maintenance page
if(!@include("main.php")){header("Location: maintenance");};
?>
