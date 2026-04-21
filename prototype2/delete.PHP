<?php
require_once "db.php";
require_once "function.php";  

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = isset($_POST['id']) ? trim($_POST['id']) : "";

// cheking if id is not emmpty
    if(!empty($id)){
        deleteData($pdo, $id);
        header("Location: index.php");
        exit();
    }
    
}
?>





























