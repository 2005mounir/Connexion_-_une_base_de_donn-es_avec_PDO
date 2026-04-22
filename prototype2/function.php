<?php
require "db.php";

// function afichage data in index
function getallData($pdo){
    $sql = "SELECT * FROM products";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;
}


// function for delete data 
function deleteData($pdo,$id){
    $sql = "DELETE FROM products WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $result = $stmt->execute([$id]);
    return $result;
}



// function for add data to database
function  Add_Products($pdo, $prdName, $price, $quantity){
      $sql = "INSERT INTO products(name , price , quantity) VALUES(? , ? , ?)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute([$prdName , $price , $quantity]);
    
}



// function for get element by id
function getProductById($pdo, $id){
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id=?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


// function for update data 
function updateProduct($pdo, $id, $name, $price, $quantity){
    $stmt = $pdo->prepare("UPDATE products  SET name=?, price=?, quantity=?  WHERE id=?
    ");
    return $stmt->execute([$name, $price, $quantity, $id]);
}

?>