<?php
require "db.php";


// // Sélectionner les données de la base de données et stocker les erreurs dans un autre fichier ;
function RqsDatda($pdo){
    $sql = "SELECT * FROM  recipes";

 try{
     $data = $pdo -> query($sql);
     $allData = $data -> fetchAll(PDO::FETCH_ASSOC);
     return $allData;
 }
 catch(PDOException $e){
     $logFile = __DIR__ . '/erreurs.log';
     $message = "[" . date('Y-m-d H:i:s') . "] " . $e->getMessage() . PHP_EOL;
     file_put_contents($logFile, $message, FILE_APPEND);
     
        return [];
    
    die("you have an error");
 }
}
RqsDatda($pdo);


















?>