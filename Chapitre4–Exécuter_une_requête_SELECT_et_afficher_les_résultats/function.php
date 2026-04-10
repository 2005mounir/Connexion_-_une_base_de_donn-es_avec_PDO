(<?php

require_once "connecton.php";
require_once "index.php";



// function Valide Nom
function ValidNom($nom){
    if($nom =="" || strlen($nom) > 50){
        echo "le nom pas valide "."<br>";
        exit;
    }
    elseif(preg_match('/[0-9]/',$nom)){
      echo 'please just a chars in nom'."<br>";
      exit;
    }
}





// function valide email
function validEmail($email){
  if($email == "" || strlen($email) > 60){
    echo 'email is empty or is to big';
  }

   $specilchars = ['!' , '*' , '$' , '%' , '&' , '>' , '<'];
   $splitEmail = str_split($email);
   foreach($specilchars as $spc){
        foreach($splitEmail as $splt){
           if($spc == $splt){
            echo 'you have a specialchars in email';
           } 
        }
    }
}






// add data to databases;
function addData($pdo , $nom , $email){
 $sql = "INSERT INTO user( nom , email) VALUES( :nom , :email)";
try{
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute([
      'nom' => $nom,
      'email' => $email,
   ]);
   echo "data  in database now";

}catch(PDOException $erreur2){
  $logFile = __DIR__ . '/erreurs.log';
     $message = "[" . date('Y-m-d H:i:s') . "] " . $erreur2->getMessage() . PHP_EOL;
     file_put_contents($logFile, $message, FILE_APPEND);
     die();
   }
}





// function for update database;
function updateData($pdo){
   $sql = "UPDATE user SET nom =:nom WHERE id = :id";
   try{
    $stmt = $pdo -> prepare($sql);
    $stmt -> execute([
      'nom' => 'maimouni',
      'id' => 1,
    ]);
  }catch(PDOException $erreur3){
    $logFile2 = __DIR__ . '/erreurs.log';
      $message = "[" . date('Y-m-d H:i:s') . "] " . $erreur3->getMessage() . PHP_EOL;
      file_put_contents($logFile2, $message, FILE_APPEND);
      die();
    }
}





// function for delete data 
function deletData($pdo){
  try{
    $sql = "DELETE FROM user  WHERE id = :id";
      $delete = $pdo->prepare($sql);
      $delete->execute([
      'id' => 13,
    ]);
}catch(PDOException $erreur4){
  $logFile3 = __DIR__ . '/erreurs.log';
     $message = "[" . date('Y-m-d H:i:s') . "] " . $erreur4->getMessage() . PHP_EOL;
     file_put_contents($logFile3, $message, FILE_APPEND);
     die();
   }
}




// function for getelement from databases;
function getData($pdo){
    $sql = "SELECT * FROM user";
   try{
    $data = $pdo ->query($sql);
    $dataAll = $data ->fetchAll(PDO::FETCH_ASSOC);
    
    foreach($dataAll as $dt){
        echo $dt['nom'] ." ". $dt['email']."<br>";;
    }
   }catch(PDOException $erreur){
    $logFile = __DIR__ . '/erreurs.log';
     $message = "[" . date('Y-m-d H:i:s') . "] " . $erreur->getMessage() . PHP_EOL;
     file_put_contents($logFile, $message, FILE_APPEND);
     die();
   }

}




?>)