
<?php
ob_start();
session_start();

include "includes/connect.php";

if(isset($_SESSION['admin'])){




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
$question1 = $question2 = $question3 = $question4 = $question5 = $question6 = $question7 = $question8 = $question9 = $question10 = "Enter Qusetion ...?"; 

$firstRight = $secondRight = $thirdRight = $fourthRight = $fifthRight = $sixthRight = $seventhRight = $eighthRight = $ninethRight = $tengthRight = "Enter the right answer";

$first2 =$first3= $first4= $second1 = $second2= $second4 = $third1 = $third2 = $third3 =$fourth2 =$fourth3 = $fourth4 = "....";

$fifth1= $fifth3= $fifth4= $sixth1 = $sixth2 =$sixth4 = $seventh1 = $seventh2 = $seventh3 = $eighth1 = $eighth2 = $eighth3 = "....";

$nineth1 = $nineth2 = $nineth3 = $tength1 = $tength2 =$tength3 = "....";

$big = array(
    array($question1 , $firstRight , $first2 , $first3 , $first4),
    array($question2 , $second1 , $second2 , $secondRight , $second4),
    array($question3 , $third1 , $third2 , $third3 , $thirdRight),
    array($question4 , $fourthRight , $fourth2 , $fourth3 , $fourth4),
    array($question5 , $fifth1 , $fifthRight , $fifth3 , $fifth4),
    array($question6 , $sixth1 , $sixth2 , $sixthRight , $sixth4),
    array($question7 , $seventh1 , $seventh2 , $seventh3 , $seventhRight),
    array($question8 , $eighth1 , $eighth2 , $eighth3 , $eighthRight),
    array($question9 , $nineth1 , $nineth2 , $nineth3 , $ninethRight),
    array($question10 , $tength1 , $tength2 , $tength3 , $tengthRight)







);

///////////////////////////////////////////////////////////////////////////////////////////////
?>













<form method="POST" action = "<?php echo $_SERVER['PHP_SELF']; ?>">
<?php






for($qno=0; $qno<=9; $qno++){


            echo "<input type = 'text'  name='" . $qno . "' placeholder=' " . $big[$qno][0] . " ' value='' />   <br>";
            for($i=1; $i<=4; $i++){



                    ?>



                 <input  class='<?php echo $i; ?>' value=""  type='text' value=''  placeholder='<?php echo $big[$qno][$i];?>' 
                                                    name='<?php echo $qno.$i; ?>' 
                                                   
                                                    
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

if(isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD']=="POST" ){


                    //the trick of entering data (questions and answers)


                    /*
    for($qno=0; $qno<=9; $qno++){



        $question = $_POST[$qno];

            $stmt = $con->prepare("INSERT INTO question(q_value)
                                    VALUES(:zquestion)");
            $stmt->execute(array(
                'zquestion' => $question
            ));    
            
            $count = $stmt->rowCount();

            if($count > 0){ echo $question; }

       
/*
                    for($i=1; $i<=4; $i++){



                        $ans = "answer" . $qno . $i; 
                        $answer = $_POST[$ans];

                        $stmt2 = $con->prepare("INSERT INTO answer(ansValue)
                                                            VALUES(:zans) ");
                        $stmt2->execute(array(

                            'zans' => $answer

                        ));                                    

                        $count2 = $stmt2->rowCount();
                        if($count2 > 0){echo $answer;}



                    }//    for($i=1; $i<=4; $i++){
                        */


/*

    }//for($qno=0; $qno<=9; $qno++){


        ///////////////////////////////////////////////////////////


        $stmt0 = $con->prepare("SELECT q_id FROM question");
$stmt0->execute();
$qIds = $stmt0->fetch(); 


    for($qno=0; $qno<=9; $qno++){
        for($i=1; $i<=4; $i++){
            foreach($qIds as $qId){


            $ans = "answer" . $qno . $i;

            $answer = $_POST[$ans];

            $stmt4 = $con->prepare("INSERT INTO answer(ansValue, q_id)
                                    VALUES(:zans , :zid)
            ");

                $stmt4->execute(array(

                    'zans' => $answer,
                    'zid' => $qId


                ));

                $count = $stmt->rowCount();
                if($count > 0){

                    echo "answer inserted";
                }



        }


    }

}//foreach


*/

for($qno = 0; $qno<= 9; $qno++){


    $question = $_POST[$qno];

    if(isset($question) && !empty($question) && isset($_SESSION['admin'])){

        $stmt0 = $con->prepare("INSERT INTO question(q_value)
                                VALUES(:zvalue)");
    

        $stmt0->execute(array(
            
            ':zvalue' =>  $question
        
        ));

        $count = $stmt0->rowCount();
        if($count > 0){

            echo $question;


            ///////////////////////////////////////////

            $stmt1 = $con->prepare("SELECT q_id FROM question WHERE q_value = ?");
            $stmt1->execute(array($question));
            $fetch = $stmt1->fetch();
            foreach($fetch as $fet){

                $_SESSION['q_id'] = $fet;

                echo $fet;


        ///////////////////////the next is the inner lope of answers which is inside the question lope//////////////////////////////////////////



                    for($i=1; $i<=4; $i++){


                        //////////////////////////////trick////////////////////////////

                        $range = [01,13,24,31,42,53,64,74,84,94];




                        $ins = $qno . $i;

                        if(in_array($ins,$range)){

                            $reg_status =1;
                        }else{
                            $reg_status =0;
                        }
                        /////////////////////////////////////////////////////////////


                            $answer = $_POST[$ins]; //here

                            
                            if(isset($answer) && !empty($answer)){

                                    $stmt3 = $con->prepare("INSERT INTO answer(ansValue,user_id,q_id,status)
                                    
                                                                VALUES(?,1,?,?) LIMIT 1 ");

                                        $stmt3->execute(array(

                                             $answer,
                                             $_SESSION['q_id'],
                                             $reg_status
                                             

                                        ));  
                                        
                                        $count3 = $stmt3->rowCount();

                                        if($count3 > 0 ){
                                            echo $answer;
                                        }else{echo "no no";}
                                        

                                        echo $answer;

                                        header("Location: changeData.php");

                            }//if(isset($answer) && !empty($answer))
                        
                        
                    }// for($i=1; $i<=4; $i++ )



    }//    if(isset($question) && isset($_SESSION['admin'])){




            }// foreach($fetch as $fet){

        }// if(isset($question) && !empty($question) && isset($_SESSION['admin'])){

    




}//for($qno = 0; $qno<= 9; $qno++){





   
}//isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'

?>

<br>

<?php    
if(isset($_GET['delete']) && $_GET['delete']=="all"){

    $stmt3 = $con->prepare("DELETE FROM question");
    $stmt3->execute();
    $count3 = $stmt3->rowCount();
    if($count3 > 0){
        echo "You deleted all the data";
    }
}

?>
<a href='../exam.php' target='_plank'>Show Exam</a>

<a href='?delete=all'>Delete All</a>

<br><br>

<a href='users.php'> Show All Users </a>



<script src="includes/jquery-3.5.1.js"></script>

<script src="js.js"></script>
</body>
</html>



<?php

}else{echo "<h2>You must enter this page by admin login page only</h2>";}//isset($_SESSION['user'])


ob_end_flush();
?>