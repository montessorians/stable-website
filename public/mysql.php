<?php
session_start();
$q = mysqli_connect("localhost:3306","root", "admin","sample_db");
$keyword = $_REQUEST['keyword'];
$value = $_REQUEST['value'];
$result = mysqli_query($q,"INSERT INTO basic_table(keyword,value) VALUES('$keyword','$value')") or die();
//while($row=mysqli_fetch_array($result)){echo $row[0];}
?>