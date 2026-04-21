<?php

$host ="localhost";
$dbname="products";
$username="root";
$password ="";

$dsn="mysql:host=$host;dbname=$dbname;charset=utf8";
try{
  $pdo=new PDO($dsn,$username,$password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 
}catch(PDOException $e){
   echo 'erreur in :'. $e->getMessage();
}

?>

    