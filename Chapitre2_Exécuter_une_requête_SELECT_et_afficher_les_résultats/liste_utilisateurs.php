<?php

require "connection.php";

//query;

/*
try{
$sql ='select * from item';
 $stmt = $pdo ->query($sql);
 $data = $stmt ->fetchAll(PDO::FETCH_ASSOC);

 echo '<table border="1">';
  echo '<tr>';
    echo '<th>ID</th>';
     echo '<th>NOM</th>';
    echo '<th>EMAIL</th>';
  echo '</tr>';
 foreach($data as $dt){
  echo '<tr>';
    echo '<td>'.$dt['id'].'</td>';
     echo '<td>'.$dt['nom'].'</td>';
    echo '<td>'.$dt['email'].'</td>';
  echo '</tr>';
 }
echo '</table>';
}catch(PDOException $e){
    echo "erreur in :"." ". $e ->getMessage();
}
*/


//prepare()&&execute();


try{
$sql ='select * from item where id = ?';
 $stmt = $pdo ->prepare($sql);
 $stmt ->execute([1]);
 $data = $stmt ->fetchAll(PDO::FETCH_ASSOC);

 echo '<table border="1">';
  echo '<tr>';
    echo '<th>ID</th>';
     echo '<th>NOM</th>';
    echo '<th>EMAIL</th>';
  echo '</tr>';
 foreach($data as $dt){
  echo '<tr>';
    echo '<td>'.$dt['id'].'</td>';
     echo '<td>'.$dt['nom'].'</td>';
    echo '<td>'.$dt['email'].'</td>';
  echo '</tr>';
 }
echo '</table>';
}catch(PDOException $e){
    echo "erreur in :"." ". $e ->getMessage();
};
























?>