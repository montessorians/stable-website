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
    <body>
    <nav class="<?=$primary_color?>">
		<a class="title"><?=$page_title?></a>
		<a href="/" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
    </nav>
    <div class="container">