<?php
/*
Holy Child Montessori
*/
include("_system/config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Version Info</title>
<?php
include("_system/styles.php");
?>
<title></title>
</head>
<body>
    <br><br>
    <div class="container">
        <h4 class="seagreen-text">Current Version is <b><?=$hcm_version_no?></b></h4>
        <br>
        <p>
        <?php echo "
            Site Title: $site_title<br>
            <br>
            Major version: $hcm_version_major<br>
            Minor version: $hcm_version_minor<br>
            Patch version: $hcm_version_patch<br>
            <br>
            Release: $hcm_version_release<br>
            <br>
            Date: $hcm_version_date<br>
        ";
        ?>
        </p>
    </div>
</body>
</html>