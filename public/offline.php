<?php
include("_system/config.php");
?>
<!Doctype html>
<html lang="en">
<head>
    <title>Offline</title>
    <?php
        include("_system/styles.php");
    ?>
    <style>
        .title {
            margin-left: 20px;
        }
    </style>
</head>
<body class="grey lighten-3">
    <div class="navbar-fixed">
        <nav class="<?=$primary_color?>">
            <a class="title"><?=$site_title?></a>
        </nav>
    </div>
    <div class="container"><br><br>
        <center>
            <h5 class="grey-text">
                <i class="material-icons medium">signal_cellular_connected_no_internet_4_bar</i><br>
                <br>
                <b>You are Offline!</b><br>
                Connect to the internet to use this app.
            </h5><br>
            <br>
            <a class="btn btn-medium <?=$accent_color?> waves-effect waves-light" href="/">Try Connecting</a>
        </center>
    </div>
</body>
</html>