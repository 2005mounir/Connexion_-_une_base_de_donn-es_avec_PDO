<?php

$host = 'localhost';
$dbname = 'recipes_db';
$user = 'root';
$password = '';
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try{
    $pdo = new PDO($dsn,$user,$password);
     $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    
}
catch(PDOException $erreurs){
  echo $erreurs->getMessage();
}
























?>