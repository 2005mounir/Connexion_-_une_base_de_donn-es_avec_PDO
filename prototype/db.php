<?php

//Connexion à la base de données;
$host = 'localhost';
$dbname = 'dataproject';
$user = 'root';
$password = '';

$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";

try {
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
} catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
}




















































?>