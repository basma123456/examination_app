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
    <title>login</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <link rel="stylesheet" href="css/css.css"/>

</head>
<body>
<?php  print_r($_SESSION);  ?>

<div class="container">
<div class="row">

  <div class="offset-md-3 col-md-6">
    <h2 class="myHfirst text-center">
    OUR SCHOOL
    </h2>
  </div>

</div>
<!--////////////////////////////////////////-->
  <div class="row">
      <div class="offset-md-3 col-md-6">
          <form  class="text-center myForm" method = "post"  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >

          <input type ="text" name="name"   placeholder="Insert your name"  /><br><br>
          <input type ="text" name ="email"   placeholder="Insert your email"  /><br><br>
          <input type ="password"   name="pass"   placeholder="Insert your password"  /><br><br>
          <input class="submit" type="submit" value="submit" />



          </form>

      </div>


  </div>
  <div class="row">
      <div class="col-md-3">
        <a class="myAdminButton" href="login.php">Admin only</a>

      </div>

  </div>
</div>
<?php




if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }


  $name = $_POST['name'];
  $email = $_POST['email'];
  $pass = $_POST['pass'];
  


$name1 ='';
$email1 = '';
$pass1 = '';

$formErrors = array();

    ////////////////////////////////////////////////
if(!isset($name) || empty($name)){                                                    /* notice error when i put !isset($name) && empty($name) i think must put !isset || empty */

                $formErrors[] = "you must enter the name"; 

}else{

        $name1 =test_input($name);

        if(!preg_match("/^[a-zA-Z-' ]*$/",$name1)) {
                          $formErrors[] = "Only letters and white space allowed";
                        }elseif(strlen($name1) <3 || strlen($name1) >40){
                          $formErrors[] = "The name must be more than 2 and less than 40";

                
        }
}


    /////////////////////////////////////////////////////////

if(!isset($email) || empty($email)){


    $formErrors[] = "You must enter hte email";
}else{

            $email1 = test_input($email);

          if(!filter_var($email1, FILTER_VALIDATE_EMAIL)) {
              $formErrors[] = "Invalid email format";
            }

}


  //////////////////////////////////////////////////////
  if( !isset($pass) || empty($pass)){

  $formErrors[] = "You must insert your password";
  }else{
    $pass1 = test_input($pass);
    $hashedPass = sha1($pass1);


  }
    

    /////////////////////////////////////////////////////////







      if(empty($formErrors)){



                        $stmt1 = $con->prepare("SELECT name , email FROM users WHERE name = ? AND email = ?");
                        $stmt1->execute(array($name1,$email1));
                        $count1 = $stmt1->rowCount();
                        if($count1 > 0){
                          echo "<h2>The name or the email is already exist , Please insert another</h2>";
                        }else{


                          ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                                            $stmt = $con->prepare("INSERT INTO users (grouping_id, reg_status , name,email,password, date) VALUES ( 0 , 0 , :zname , :zemail , :zpass ,  NOW())");

                                            $stmt->execute(array(

                                                    "zname" => $name1,
                                                    "zemail" => $email1,
                                                    "zpass"  => $hashedPass

                                            ));                         

                                            $count = $stmt->rowCount();


                                                    if($count > 0){
                                                          if(!empty($name1)){


                                                              $_SESSION['anyUser']  = $name1; 
                                                          }

                                                        header("Location: exam.php");
                                                    }// if($count > 0){

                          }//the end of the else of the if($count1 > 0) of the check of the user name and email is exist or no




      }else{  //if(empty($formErrors)){

                          foreach($formErrors as $error){

                            echo "<div style='margin-top:-15px;'><div class='container'><div class='row'><div class='offset-md-4 col-md-5'><h2 class='text-danger'>" . $error . "</h2>" . "<br></div></div></div></div>";
                          }// foreach($formErrors as $error){


      }//else of if(empty($formErrors))


}//(isset($_REQUEST['METHOD']) && $_RE

?>
















<script src="js/jquery-3.5.1.min.js"></script>

<script src="js/bootstrap.min.js"></script>

<script src="js/js.js"></script>
    
</body>
</html>


<?php
ob_end_flush();

?>