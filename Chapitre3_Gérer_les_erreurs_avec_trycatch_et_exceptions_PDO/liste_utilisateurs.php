<?php
require "connection.php";

try{
    $sql = "SELECT * FROM item";
    $data = $pdo -> query($sql);
    $results = $data->fetchAll(PDO::FETCH_ASSOC);
    foreach($results as $rslt){
        echo $rslt['id'].'<br>';
        echo $rslt['nom'].'<br>';
        echo $rslt['email'].'<br>';
    }
}
catch (PDOException $e) {
    $logFile = __DIR__ . '/erreurs.log';
    $message = "[" . date('Y-m-d H:i:s') . "] " . $e->getMessage() . PHP_EOL;
    file_put_contents($logFile, $message, FILE_APPEND);

    echo "Une erreur est survenue. Contactez l'administrateur.";
}

































?>