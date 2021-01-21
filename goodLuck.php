<?php
ob_start();
session_start();

include "includes/connect.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<h4 style=' display:block; margin-left:470px; font-size:50px;'>You have ended your exam</h4>
<h2 style=' display:block; margin-left:500px; font-size:100px'>Good Luck<h2>

</body>
</html>

<?php  
session_unset();
session_destroy();
?>

<?php
ob_end_flush();
?>