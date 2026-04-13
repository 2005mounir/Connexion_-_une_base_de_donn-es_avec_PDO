<?php
require "connection.php";

$nom = "ibrahim";
$email = "ibrhim@gmail.com";


//bindParam
$sql = "INSERT INTO user(nom,email)VALUES(:nom , :email)";
try{
    $Data = $pdo->prepare($sql);
    $Data->bindParam('nom' ,$nom);
    $nom = "mounir"; //The value is only read when you call execute().
    $Data->bindParam('email',$email);
    $Data->execute();
}catch(PDOException $erreur){
    echo "you erreur in :".$erreur->getMessage();
}




/*

// bindValue
$sql = "INSERT INTO user(nom,email)VALUES(:nom , :email)";
try{
    $Data = $pdo->prepare($sql);
    $Data->bindValue('nom' ,$nom);
    $nom = "mounir"; //The value is stored at that moment and does not change.
    $Data->bindValue('email',$email);
    $Data->execute();
    echo 'Data in database now';
}catch(PDOException $erreur){
    echo "you erreur in :".$erreur->getMessage();
}


*/






























?>