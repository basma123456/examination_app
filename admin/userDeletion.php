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


<?php  


if(isset($_REQUEST['METHOD']) && $_REQUEST['METHOD'] == "POST"){
                                       


                                       if(isset($_GET['delete']) && isset($_GET['userId']) ){
   
                                                 /*                    
                                           $stmt4 = $con->prepare("DELETE FROM users WHERE user_id = ? AND grouping_id = 0 LIMIT 1");
                                           $stmt4->execute(array($_GET['userId']));
                                           $count4 = $stmt4->rowCount();
       
                                           exit("you deleted one item");
                                           */
                                               }// if(isset($_GET['delete']) && isset($_GET['userId'])){
                                           
                                           
   
   
   
                           
   
   
   
   
                       


}//if(isset($_REQUEST['METHOD'])
           
           ?>
   


    
</body>
</html>

<?php
ob_end_flush();

?>