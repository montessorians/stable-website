<?php
session_start();
include("../../_system/config.php");
if(!$page_title) $page_title = "Page";
?>
<html>
    <head>
        <title><?=$page_title?> - <?=$site_title?></title>
        <?php include("../../_system/styles.php"); ?>
    </head>
    <body style="background-color:#EBFDF3">
    <nav class="transparent z-depth-0">
		<a class="title seagreen-text"><?=$page_title?></a>
		<a href="/" class="seagreen-text button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
    </nav>
    <div class="container">
