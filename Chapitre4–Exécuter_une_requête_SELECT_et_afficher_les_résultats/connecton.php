<?php

$host = 'localhost';
$dbname = 'testData';
$user = 'root';
$password = '';


try{
    $pdo = new PDO($dsn= "mysql:host=$host;dbname=$dbname;charset=utf8",$user,$password);
    $pdo ->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
  
}
catch(PDOException $erreur){
      $logFile = __DIR__ . '/erreurs.log';
     $message = "[" . date('Y-m-d H:i:s') . "] " . $erreur->getMessage() . PHP_EOL;
     file_put_contents($logFile, $message, FILE_APPEND);
     die();
}


?>