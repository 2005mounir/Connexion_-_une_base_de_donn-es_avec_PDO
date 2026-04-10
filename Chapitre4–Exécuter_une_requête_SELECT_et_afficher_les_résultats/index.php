<?php
require "function.php";


if($_SERVER['REQUEST_METHOD']==='POST'){

    // Get "nom" value from the form safely
    //Get "email" value from the form safely
    $nom = isset($_POST['nom']) ? htmlspecialchars(trim($_POST['nom'])) : "";
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : "";
        
    //Calling up functions from a file function.php
    ValidNom($nom);
    validEmail($email);
    addData($pdo , $nom , $email);
    //getData($pdo);
}

// updateData($pdo);
// deletData($pdo);

?>