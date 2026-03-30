<?php

$host = 'localhost';
$dbname = 'pdodatabase';
$user = 'root';
$password = '';

try{
 $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user ,$password);
  $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
  echo "connected";
}
catch(PDOException $e){
    echo "error: " . $e->getMessage();
}
















?>