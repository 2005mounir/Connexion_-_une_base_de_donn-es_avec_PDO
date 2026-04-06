<?php
require "db.php";


 // Sélectionner les données de la base de données et stocker les erreurs dans un autre fichier ;
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



  
// fonction de recherche;
function searchRecipes( $pdo , $inptSearch){
  $srch = $pdo -> prepare("SELECT * FROM recipes WHERE name like :mysearsh");
  $srch -> execute(['mysearsh' => "%$inptSearch%"]);

 $result = $srch -> fetchAll(PDO::FETCH_ASSOC);
 return $result;

}






// Catégorie de filtre par fonction
 function filterByCategory($pdo , $category){
   if($category ==""){
     return RqsDatda($pdo);
   }else{
     $stmt = $pdo -> prepare("SELECT * FROM recipes WHERE category = :category ");
     $stmt->execute(['category' => $category]);
   }
   return $stmt->fetchAll(PDO::FETCH_ASSOC);  

 }




 


 // function  trier par temps;
 function sortbytime($pdo , $sort){
   
    $srt = $pdo -> prepare("SELECT * FROM recipes ORDER BY prep_time $sort ");
    $srt ->execute();
    return $srt->fetchAll(PDO::FETCH_ASSOC);
 }





    







?>