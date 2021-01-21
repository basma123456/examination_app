<?php
ob_start();  
session_start();
include "includes/connect.php";
/////////////////////////////////////////////////////

if(isset($_SESSION['admin'])){

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href='css.css' />

</head>
<body>
<!--/////////////////////////////////////////////////////////////////////////////////////////////////////-->


<?php
$stmt = $con->prepare("SELECT * FROM users");
$stmt->execute();
$fetch = $stmt->fetchAll();


?>
<div>

    <table>
                        <tr> <td>User Id</td> <td>User Name</td> <td>Registered Date</td>  <td>Degree 1st</td> <td>Deletion</td>  </tr>

        <?php   
            foreach($fetch as $user){

                if($user['grouping_id'] == 1){

                    $color = "style ='background-color:pink;' ";
                }else{
                    $color = "";
                }

                    echo "<tr " . $color . " > <td>" . $user['user_id']. "</td>  <td>" . $user['name'] . "</td>  <td>" . $user['date'] . "</td>    <td>". $user['results'] ." / 10 </td> 
                    <td>

                    <a   
                    onmousedown='confirmDel(this);'                  
                    href='?delete=". $user['name'] ."&userId=". $user['user_id'] ."' data-id='" . $user['user_id'] . "' >
                    <button >
                    Delete
                    </button>
                    </a>
                    
                    </td> </tr>";
                    



                            ?>

                            





                             <?php  
                                       

                                        



                        




                    
            }//foreach
?>

            
<?php                             if(isset($_GET['delete']) && isset($_GET['userId'])){
    ?>
                        <div id='myModal' class='modal' style='display:none;' >
    
                            <form method='GET' action='userDeletion.php' id='form-delete-user'>
                                <input type='hidden' name='delete' value='<?php echo $_GET['delete']; ?>' />
                                <input type='hidden' name='userId' value='<?php echo $_GET['userId'] ?>' />    
                                <input type='text' name='idName' />   
              
                            </form>
    
    
                                <button onmousedown='closeNow();'>close</button>
                                <button type='submit' form='form-delete-user' >Confirm</button>
    
                        </div>
    
    <?php }//isset($_GET['delete']) ?>
    
        
        
    </table>


</div>

<?php  

?>


<script>


function confirmDel(self){

    var id = self.getAttribute("data-id");

    document.getElementById("form-delete-user").idName.value = id;

    document.getElementById("myModal").style.display = "block";
    

}



function closeNow(){

   var modal = document.getElementById("myModal");
    modal.style.display = "none";
}


</script>


<!--/////////////////////////////////////////////////////////////////////////////////////////////////////-->

<script src="includes/jquery-3.5.1.js"></script>
</body>
</html>





<?php
////////////////////////////////////////////////////
}//isset($_SESSION['admin])
ob_end_flush();
?>