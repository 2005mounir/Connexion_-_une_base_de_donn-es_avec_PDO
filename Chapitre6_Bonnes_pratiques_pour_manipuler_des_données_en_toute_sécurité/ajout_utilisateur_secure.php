<?php

require 'connexion.php';

if($_SERVER['REQUEST_METHOD'] ==="POST"){


//Récupérer l'élément du formulaire
$nom = htmlspecialchars(trim($_POST['nom']));
$email= htmlspecialchars(trim($_POST['email']));




// Fonction pour valider cet élément
function validElement($nom , $email){
  if(!$nom){
    
     die( "Nom invalide");
  }
    if(!$email){
     
     die( "emailinvalide");
  }
}
validElement($nom , $email);



// // Stocker ces éléments dans la base de données  
function StokeElemnts($pdo , $nom , $email){
    try{
        $data  = $pdo->prepare("INSERT INTO user(nom , email)VALUES(:nom , :email)");
        $data -> execute([
            'nom'=>$nom,
            'email' => $email
        ]); 
    }catch(PDOException $e){
        $logFile = __DIR__ . '/erreurs.log';
        $message = "[" . date('Y-m-d H:i:s') . "] " . $e->getMessage() . PHP_EOL;
        file_put_contents($logFile, $message, FILE_APPEND);
        die();
    }
}
StokeElemnts($pdo , $nom , $email);


}

?>