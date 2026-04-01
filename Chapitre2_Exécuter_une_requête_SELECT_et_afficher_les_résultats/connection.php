<?php

$host = 'localhost';
$dbname ='dbconnect';
$user = 'root';
$password ='';

$dsn = "mysql:host=localhost;dbname=dbconnect";


try{
    $pdo = new PDO($dsn , $user , $password);
    $pdo ->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    
}
catch(PDOException $e){
 echo "erreur in :"." ".$e ->getMessage();
}



























?>