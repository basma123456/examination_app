
<?php
ob_start();
session_start();

include "includes/connect.php";




if(isset($_SESSION['anyUser']) || isset($_SESSION['admin']) ){




///////////////////////////est3lam/////////////////////////////////////
    $questions = $con->prepare("SELECT * FROM question LIMIT 10");
    $questions->execute();
    $questionsF = $questions->fetchAll();
/////////////////////////////////////////////////////////////////////
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css" />

<link rel="stylesheet" href="css/css.css"/>

    <title>Document</title>





</head>
<body id="examPage">



   <div id='sec'>nn</div> 

   
<br>

<div class="container">
    <div class="row">
        <div class="offset-md-2 col-md-8">

            <form class="formExamPage" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" >


            <?php
            foreach($questionsF as $que){?>



                            <?php echo $que['q_value']." ? <br>"; ?>
                            
                            
                            <?php
                                    //////////////est3lam/////////////////
                                $stmt2 = $con->prepare("SELECT * FROM answer where q_id = ? LIMIT 4"); 
                                $stmt2->execute(array($que['q_id']));
                                $answersF = $stmt2->fetchAll();

                                ?>
                            
                            <?php   foreach($answersF as $ans){?>
                                
                                <span class='th'>   <?php echo $ans['ansValue'];  ?> </span>      <input class='th' style='display:inline-block;' type='radio' value='<?php  echo $ans["ansValue"]; ?>' name='<?php echo $ans["q_id"] . $ans["answer_id"];  ?>' />   <br>
                            <?php                   
                            
                                        } ?>
            <hr>
            <?php
                    }
                    ?>





                        <input type='submit' value='Done' />
            </form>

        </div>
    </div>
</div>
<?php
    $degree = array();


if($_SERVER['REQUEST_METHOD']=="POST"){


    foreach($questionsF as $que){
        
                    //////////////est3lam/////////////////
            $stmt2 = $con->prepare("SELECT * FROM answer where q_id = ? LIMIT 4"); 
            $stmt2->execute(array($que['q_id']));
            $answersF = $stmt2->fetchAll();

                

            foreach($answersF as $ans){

                $inner = $ans['q_id'] . $ans['answer_id'];


                        if(isset($_POST[$inner]) && $ans['status'] == 1){
                            


                                $degree[] = 1;



                        }

            }//foreach($questionsF as $que){


    }//foreach($questionsF as $que){



                        if(isset($_SESSION['anyUser'])){


                                echo count($degree);

                                if(count($degree) >= 5){

                                    $len = count($degree);

                                    $stmt4 = $con->prepare("UPDATE users SET results = ? WHERE name = ?");
                                    $stmt4->execute(array($len , $_SESSION['anyUser']));
                                    $count4 = $stmt4->rowCount();



                                    header("Location:success.php");
                                }else{

                                    $len = count($degree);

                                    $stmt4 = $con->prepare("UPDATE users SET results = ? WHERE name = ?");
                                    $stmt4->execute(array($len , $_SESSION['anyUser']));
                                    $count4 = $stmt4->rowCount();


                                    header("Location:goodLuck.php");
                                }
                        }





}//if($_SERVER['REQUEST_METHOD']=="POST"){

?>



<?php


    //////////////////////////////////////////////////here/////////////////////////////////////////////////////////
    /*

?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Exam</title>

        <link rel="stylesheet" href="css.css"/>




    </head>
    <body>



    <h2>Exam</h2>

    <?php




    $big = array(
        array("What is my name ?" , "Basma" , "basma2" , "basma3" , "basma4"),
        array("how old my age ?" , "20" , "30" , "29" , "40"),
        array("Where do i live ?" , "lebnan" , "masrElGededa" , "shobra" , "october"),
        array("What is this number 1 ?" , "1one" , "1two" , "1three" , "1four"),
        array("What is this number 2 ?" , "2one" , "2two" , "2three" , "2four"),
        array("What is this number 3 ?" , "3one" , "3two" , "3three" , "3four"),
        array("What is this number 4 ?" , "4one" , "4two" , "4three" , "4four"),
        array("What is this number 5 ?" , "5one" , "5two" , "5three" , "5five"),
        array("What is this number 6 ?" , "6one" , "6two" , "6three" , "6six"),
        array("What is this number 7 ?" , "7one" , "7two" , "7three" , "7seven")








    );

    ///////////////////////////////////////////////////////////////////////////////////////////////
    ?>













    </script>
    <form method="POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
    <?php






    for($qno=0; $qno<=9; $qno++){


                echo $big[$qno][0] . "<br>";
                for($i=1; $i<=4; $i++){



                        ?>

    <script>
    var x = false;

    </script>


                    


                    <?php    echo  $big[$qno][$i];  ?> <input  class='<?php echo $i; ?>' type='radio'  value='<?php echo $big[$qno][$i];?>' 
                                                        name='answer<?php echo $big[$qno][$i];  ?>' 
                                                        onmousedown="if (this.checked) { x = true; }" onclick="if (x) {this.checked = false; x = false; return true;}"
                                                        
                                                        /> 
                        <br>
                        <?php
                }
                echo "<hr>";

        
    }


    ?>



    <input type="submit" id='submit' name='submit' value='submit'/>
    </form>
    <!-- ////////////////////////////////////////////////////////////////////////////////-->



    <?php
    if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="POST"){
        $one = 0;  $two = 0; $three = 0; $four=0; $five = 0; $six = 0; $seven = 0; $eight = 0; $nine = 0; $ten=0;


    for($qno=0; $qno<=9; $qno++){
        for($i=1; $i<=4; $i++){



                if(isset($_POST['answer' . $big[$qno][$i] ])){





                    if($qno == 0 && $i == 1 && $i !== 2 && $i !== 3 && $i !== 4 && !isset($wrongOne)){
                        $one = 1;
                        


                    }elseif($qno == 0 && $i !==1){
                        $one = 0;
                        $wrongOne = "";


                    }elseif($qno == 0 && !isset($i)){

                        $one = 0;
                        $wrongOne = "";

                    }



                    



    //////////////////////////////////////////////////////////////////////////////////////////



                    if($qno == 1 && $i == 3 && $i !== 1 && $i !== 2 && $i !== 4 && !isset($wrongTwo)){
                        $two = 1;


                    }elseif($qno == 1 && $i !== 3){
                        $two = 0;
                        $wrongTwo = '';



                    }elseif($qno == 1 && !isset($i)){

                        $two = 0;
                        $wrongTwo = '';

                    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////


                    if($qno == 2 && $i == 4 && $i !== 1 && $i !== 2 && $i !== 3 && !isset($wrongThree)){
                        $three = 1;



                    }elseif($qno == 2 && $i !== 4){

                        $three = 0;
                        $wrongThree = "";


                    }elseif($qno == 2 && !isset($i)){

                        $three = 0;
                        $wrongThree = "";

                    }




    ///////////////////////////////////////////////////////////////////////////////////////////////////                

                    if($qno == 3 && $i == 1 && $i !== 2 && $i !== 3 && $i !== 4 && !isset($wrongFour)){


                        $four =1;


                    }elseif($qno == 3 && $i !== 1){

                        $four =0;
                        $wrongFour ='';



                    }elseif($qno == 3 && !isset($i)){

                        $four = 0;
                        $wrongFour ='';

                    }




    //////////////////////////////////////////////////////////////////////////////////////////////////


                    if($qno == 4 && $i == 2 && $i !== 1 && $i !== 3 && $i !== 4 && !isset($wrongFive)){


                        $five = 1;



                    }elseif($qno == 4 && $i !== 2){
                        $five = 0;
                        $wrongFive = "";


                    }elseif($qno == 4 && !isset($i)){

                        $five = 0;
                        $wrongFive = "";

                    }


    //////////////////////////////////////////////////////////////////////////////////////////////////////                

                    if($qno == 5 && $i == 3 && $i !== 1 && $i !== 2 && $i !== 4 && !isset($wrongSix)){


                        $six = 1;


                    }elseif($qno == 5 && $i !== 3){

                        $six = 0;
                        $wrongSix = "";


                    }elseif($qno == 5 && !isset($i)){

                        $six = 0;
                        $wrongSix = "";
                    }

    //////////////////////////////////////////////////////////////////////////////////////                

                    if($qno == 6 && $i == 4 && $i !== 2 && $i !== 3 && $i !== 1 && !isset($wrongSeven)){


                        $seven = 1;


                    }elseif($qno == 6 && $i !== 4){

                        $seven = 0;
                        $wrongSeven ="";

                    }elseif($qno == 6 && !isset($i)){

                        $seven = 0;
                        $wrongSeven ="";

                    }




                        
    ////////////////////////////////////////////////////////////////////////////////////////


                    if($qno == 7 && $i == 4 && $i !== 2 && $i !== 3 && $i !== 1 && !isset($wrongEight)){


                        $eight = 1;


                    }elseif($qno == 7 && $i !== 4){

                        $eight = 0;
                        $wrongEight = "";



                    }elseif($qno == 7 && !isset($i)){

                        $eight = 0;
                        $wrongEight = "";

                    }



    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                    if($qno == 8 && $i == 4 && $i !== 2  && $i !== 3 && $i !== 1 && !isset($wrongNine)){


                        $nine = 1;



                    }elseif($qno == 8 && $i !== 4){

                        $nine = 0;
                        $wrongNine = "";


                    }elseif($qno == 8 && !isset($i)){

                        $nine = 0;
                        $wrongNine = "";
                    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////

                    if($qno == 9 && $i ==4 && $i !==2 && $i !== 3 && $i !== 1 && !isset($wrongTen)){


                        $ten = 1;




                    }elseif($qno == 9 && $i !== 4){

                        $ten = 0;
                        $wrongTen = "";


                    }elseif($qno == 9 && !isset($i)){

                        $ten = 0;
                        $wrongTen = "";
                    }













                            


                }//if(isset($_POST))




        }//    for($i=1; $i<=4; $i++){

    }//for($qno=0; $qno<=2; $qno++){
    /*
    if($_POST['answer' . 1] + $_POST['answer' . 2] + $_POST['answer' . 3] + $_POST['answer' . 4] +  )

        if(isset($succeed) && ){

            header('Location: http://localhost/myexam/success.php');

        }else{


            echo "not working";
        }
        */

    /*
        if(isset($one) && isset($two) && isset($three) && isset($four) && isset($five) && isset($six) &&
        isset($seven) && isset($eight) && isset($nine) && isset($ten) &&
        
    !(isset($wrongOne) && isset($wrongTwo) && 
        isset($wrongThree) && isset($wrongFour) && isset($wrongFive) &&

        isset($wrongSix) && isset($wrongSeven) && isset($wrongEight) && isset($wrongNine)

        && isset($wrongTen))){

            echo "<h1>hi basma</h1>";
        
        header('Location: http://localhost/myexam/success.php');

        }
    */  

/*

    $trueResult = $one + $two + $three + $four + $five + $six + $seven + $eight + $nine + $ten;
    
    if($trueResult > 4){

        echo $trueResult;

        header('Location: http://localhost/myexam/success.php');

    }else{
        echo $trueResult;


        echo " sorry";
    }




    }else{echo "<h2>no</h2>";}//isset($_REQUEST['METHOD'])

*///here


    ?>


<!--///////////////////////////////////////////////////////////////////////-->

<script>
                        var th = document.getElementsByClassName("th");

        var seconds = 119,
        countDiv = document.getElementById("sec"),

        secondPass,

        countDownInterval = setInterval(function(){

            "use strict";
            secondPass();


        },100);


        function   secondPass(){

            "use strict";
            var minutes = Math.floor(seconds/60),
                remSeconds = seconds % 60;



                countDiv.innerHTML = minutes + " : " + remSeconds;

                if(seconds > 0){

                    seconds = seconds-1;


                }else{

                    clearInterval(countDownInterval);
//document.location.replace("http://localhost/fullExam/examSubmit.php");

                        var i;
                        for (i = 0; i < th.length; i++) {
                            th[i].style.display = "none";
                        }

                        alert("Your time is out , Please press submit button at the end of the page");


                }


        }//function   secondPass(){


                
    
    </script>





<!--//////////////////////////////////////////////////////////////////////////-->




<script src="js/jquery-3.5.1.min.js"></script>

<script src="js/bootstrap.min.js"></script>

<script src="js/js.js"></script>
    </body>
</html>



<?php
}//if(isset($_SESSION['anyUser']))


ob_end_flush();
?>