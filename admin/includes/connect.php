<?php  

$dsn = 'mysql:host=localhost;dbname=exam';
$user = 'root';
$pass = '';
$option = array(

    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',

);

try{

    $con = new PDO($dsn , $user , $pass , $option);
    $con->setATTRIBUTE(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "You are connected welcome to database";

}


catch(PDOException $e){

    echo "failed to connect" . $e->getMessage();

}




?>