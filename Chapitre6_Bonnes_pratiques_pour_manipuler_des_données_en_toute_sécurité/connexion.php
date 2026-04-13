<?php

$host = "localhost";
$dbname = 'testdata';
$user = 'root';
$password = '';

try{
    $pdo = new PDO("mysql:host=$host;dbname=$dbname",$user,$password);
    $pdo ->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
}catch(PDOException $erreur){
    echo "you have erreur in :" .$erreur->getMessage();
}

?>