<?php
require 'connection.php';
if($_SERVER['REQUEST_METHOD'] ==="POST"){

    
//Récupérer l'élément du formulaire
 $nom = isset($_POST['nom']) ? htmlspecialchars(trim($_POST['nom'])) : "";
 $email= isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : "";




// fonction pour  stocker les erreurs
function Postelament($nom , $email){
    $erreurs = []; 
      if (empty($nom)) {
        $erreurs[] = "Le nom est obligatoire.";
    }
    if (empty($email)) {
        $erreurs[] = "L'email est obligatoire.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'email n'est pas valide.";
    }
    return $erreurs;
}




//Erreurs d'impression
$elemntsErreurs = Postelament($nom , $email);
if(!empty($elemntsErreurs)){
    foreach($elemntsErreurs as $ers){
        echo $ers."<br>";
    }
}else{
        function StokeElemnts($pdo , $nom , $email){
        try{
            $data  = $pdo->prepare("INSERT INTO user(nom , email)VALUES(:nom , :email)");
            $data -> execute([
                'nom'=>$nom,
                'email' => $email
            ]); 
        }catch(PDOException $e){
            echo "erreur in :".$e->getMessage();
        }
    }
    StokeElemnts($pdo , $nom , $email);
}



};

?>