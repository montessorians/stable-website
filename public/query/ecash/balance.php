<?php
session_start();

include("../../_system/secure.php");

if(empty($_GET['from'])){
    if(empty($_SERVER['HTTP_REFERER'])){
        $from = "../../";
    } else {
        $from = $_SERVER['HTTP_REFERER'];
    }} else {
    $from = $_GET['from'];
}

include("../../_system/config.php");
include("../../_system/database/db.php");

$activity_title = "E-Cash Balance Inquiry";

$student_id = "";
if(!empty($_REQUEST['student_id'])) $student_id = $_REQUEST['student_id'];
?>
<!Doctype html>
<html>
    <head>
        <title><?="$activity_title - $site_title"?></title>
        <?php
			include("../../_system/styles.php");
		?>
    </head>
    <body class="grey lighten-3">
        <nav class="<?=$primary_color?>">
			<a class="title"><?=$activity_title?></a>
			<a href="../../" class="button-collapse show-on-large"><i class="material-icons">arrow_back</i></a>
		</nav>
        <div class="container">
            <br><br>
            <div class="row">
                <div class="input-field col s9">
                    <input type="text" id="student_id" value="<?=$student_id?>">
                    <label for="student_id">Student ID</label>
                </div>
                <div class="input-field col s3">
                    <button id="searchButton" class="btn btn-medium waves-effect waves-light <?=$accent_color?>"><i class='material-icons'>search</i></button>
                </div>
            </div><br>
            <div class="searchresult"></div>
        </div>
    </body>
</html>
<script type="text/javascript">
$(document).ready(()=>{
    $("#searchButton").click(()=>{
        search();
    });
}).keypress(function(e){
    var key = e.which;
    if(key == 13){
        search();
    }
});

function search(){
    let sid = $("#student_id").val();
    if(!sid){
        Materialize.toast("Student ID is required",3000);
    } else {
        $.ajax({
            type:'POST',
            url:'../../action/ecash/ecash_inquire.php',
            cache:'false',
            data: {
                student_id: sid
            },
            success: (result)=>{
                if(isNaN(result)){
                    Materialize.toast(result,3000);
                } else {
                    let bal = result;
                    var render = `
                        <div class='card'>
                            <div class='card-content'>
                                <center><h4>PHP ${bal}</h4></center>
                            </div>
                        </div>
                    `;
                    $(".searchresult").html(render);
                }
            }
        }).fail(()=>{
            Materialize.toast("Error connecting to server",3000);
        });
    }
}
</script>
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">