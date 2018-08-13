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
            <div id="myidnav" class="right" style="padding-right:30px;"></div>
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
    
    <div class="modal modal-fixed-footer blue-grey" id="myid">
  		<div class="modal-content">
  			<center>
              <br><br>
  				<p class="white-text">
  					<font size="12pt" id="student_id"></font><br>
                    Montessori Pay
  				</p>
  				</center>
  		</div>
		<div class="modal-footer blue-grey lighten-2">
  			<a class="modal-action modal-close waves-effect waves-red btn-flat">
  				Close
  			</a>
  		</div>
    </div>


</body>
</html>
<script>
$(document).ready(()=>{
    $('.modal').modal();
    btn();
});

function btn(){
    if(localStorage.getItem("hcm-logged-in") == "true"){
        console.log("student is logged-in");
        $("#student_id").html(localStorage.getItem("hcm-student-id"));
        $("#myidnav").html("<a href='#myid' class='modal-trigger' data-trigger='myid'><i class='material-icons white-text'>payment</i></a>");
    }
}

</script>