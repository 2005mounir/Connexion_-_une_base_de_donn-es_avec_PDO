<?php
require_once "../functions.php";
require "../db.php";



//get id from read.php
 $id = $_GET['id'] ?? null;
 

 if($id){
    // get function delete
     delete($pdo , $id);
}
header("Location: read.php");
exit;

?>