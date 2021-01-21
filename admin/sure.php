<?php
ob_start();
session_start();
include "includes/connect.php";

if(isset($_SESSION['admin'])){

    if(isset($_GET['delete']) && isset($_GET['userId'])){

        $name = $_GET['delete'];
         $_SESSION['id'] = $_GET['userId'];

        echo "Are you sure you want to delete " . $_GET['delete'];
        echo "<br> <a href='?yesSure'>Yes</a> <a href='users.php?notSure'>No</a>";

            if(isset($_GET['yesSure'])){
                     
               

                $stmt4 = $con->prepare("DELETE FROM users WHERE user_id = ? AND grouping_id = 0 LIMIT 1");
                $stmt4->execute(array($_SESSION['id']));
                $count4 = $stmt4->rowCount();
                if($count4 > 0){
                    echo "yes";
                }else{
                    echo "no";
                }
            }


            if(isset($_GET['notSure'])){

                header("Location: users.php");
            }

    }// if(isset($_GET['delete'] && isset($_GET['userId'])){




}//if(isset($_SESSION['admin'])){



ob_end_flush();

?>