<?php
ob_start();

session_start();

include("includes/connect.php");



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link rel="stylesheet" href="css.css"  />
</head>
<body>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];   ?>">

<input type="text" name="user" placeholder="Inter Your Name" /><br><br>
<input type="password" name="pass" placeholder="Inter Your Password" /><br><br>
<input type="submit" value="submit" />

</form>

<?php
if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="POST"){

    $user = $_POST['user'];
    $pass = $_POST['pass'];




    $stmt = $con->prepare("SELECT name , password FROM users WHERE name = ? AND password = ? AND grouping_id = 1 LIMIT 1");
    $stmt->execute(array($user , $pass));
    $count = $stmt->rowCount();
    if($count > 0){

        $_SESSION['admin'] = $user;

        header("Location: admin/index.php");
        echo $_SESSION['admin'];

    }else{

        echo $count;

    }


}//isset($_SERVER['request_method']) && $_SERVER['request_me

?>







<script src="includes/jquery-3.5.1.js"></script>
<script src="css.css"></script>


</body>
</html>



<?php 


ob_end_flush();
?>