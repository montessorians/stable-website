<?php
/*
Holy Child Montessori
2017

Logout
*/

// Start Session
session_start();
// Destroy Session
session_destroy();
// Redirect Home
header("Location: ../");
?>