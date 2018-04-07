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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script type="text/javascript">
        localStorage.removeItem("hcm-student-id");
        localStorage.removeItem("hcm-logged-in");
        window.location.replace("/account");
    </script>
    <title>Please Wait...</title>
</head>
<body>
    Please Wait...
</body>
</html>