<?php
require_once "db.php";

// A function to fetch categories  for use in form create;
 function getCategories($pdo){
   $sql = "SELECT * FROM categories";
   $stmt = $pdo->query($sql);
   $categories = $stmt->fetchAll();
  return $categories;
}





//function erreurs
 function getErreurs($name, $prep_time, $image, $category_id) {

    $erreurs = [];

    // name check
    if (empty($name)) {
        $erreurs[] = "Please fill name";
        
    }
    elseif (preg_match('/[0-9]/', $name)) {
        $erreurs[] = " Please don't add numbers in name";
        
    }

    // prep_time check
    if (empty($prep_time) || $prep_time <= 0) {
        $erreurs[] = " Invalid preparation time";
       
    }

    // category check
    if (empty($category_id)) {
        $erreurs[] = " Please select a category";
        
    }

    // image check
    if (empty($image)) {
        $erreurs[] = " Image is required";
        
    }
    return $erreurs;
}






// Function to protect input files
function uploadImage($file, $folder = '../images/') {

    if ($file['error'] !== 0) return false;

    $allowedMime = ['image/jpeg', 'image/png', 'image/jpg'];

    $info = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($info, $file['tmp_name']);
    finfo_close($info);

    if (!in_array($mime, $allowedMime)) return false;

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);

    $newName = bin2hex(random_bytes(10)) . "." . $ext;

    $target = $folder . $newName;

    if (move_uploaded_file($file['tmp_name'], $target)) {
        return $newName;
    }

    return false;
}






// insert data to database
  function insertData($pdo, $name, $prep_time, $image, $category_id) {

    $sql = "INSERT INTO recipes (name, prep_time, image, category_id)
            VALUES (?, ?, ?, ?)";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $name,
            $prep_time,
            $image,
            $category_id
        ]);
 
       
    } catch (Exception $e) {
        $file = __DIR__ . "/erreurs.log";
        $date = date("Y-m-d H:i:s");
        $log = "[$date] ERROR: " . $e->getMessage() . PHP_EOL;
        file_put_contents($file, $log, FILE_APPEND);
    }
}





// function get data from database
function getData($pdo) {

    $sql = "SELECT 
                recipes.*, 
                categories.name AS category_name
            FROM recipes
            LEFT JOIN categories 
            ON recipes.category_id = categories.id
            ORDER BY recipes.created_at DESC";

    try {

        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (Exception $e) {
            $file = __DIR__ . "/erreurs.log";
            $date = date("Y-m-d H:i:s");
            $log = "[$date] ERROR: " . $e->getMessage() . PHP_EOL;
            file_put_contents($file, $log, FILE_APPEND);
    }

 }





 // function delete data from database
function delete($pdo , $id){

   try{

    //get image from database;
        $sql1 =" SELECT image FROM recipes WHERE id = ?";
        $stmt1 = $pdo->prepare($sql1);
        $stmt1->execute([$id]);
        $recipe = $stmt1->fetch(PDO::FETCH_ASSOC);

        if($recipe){
            $imagePath = "../images/" .$recipe['image'];

     //delete from database   
        $sql2 = "DELETE FROM recipes WHERE id = ? ";
        $stmt = $pdo->prepare($sql2);
        $stmt->execute([$id]);

     //delete image from folder
       if(file_exists($imagePath)){
          unlink($imagePath);
       }

   }
   }catch(PDOException $erreur){
        $file = __DIR__ . "/erreurs.log";
        $date = date("Y-m-d H:i:s");
        $log = "[$date] ERROR: " . $erreur->getMessage() . PHP_EOL;
        file_put_contents($file, $log, FILE_APPEND);
   }
}



//function get data for update
function getUpdatedata($pdo,$id){
    $sql = "SELECT * from recipes WHERE id = ?";
    try{

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }catch(PDOException $erreur){
        $file = __DIR__ . "/erreurs.log";
        $date = date("Y-m-d H:i:s");
        $log = "[$date] ERROR: " . $erreur->getMessage() . PHP_EOL;
        file_put_contents($file, $log, FILE_APPEND);
    }
}






// function update 
function updateRecipe($pdo, $id, $name, $prep_time, $image, $category_id){

    $sql = "UPDATE recipes 
            SET name = ?, prep_time = ?, image = ?, category_id = ?, edited_at = NOW()
            WHERE id = ?";

    try{

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $prep_time, $image, $category_id, $id]);

    }catch(PDOException $erreur){

        $file = __DIR__ . "/erreurs.log";
        $date = date("Y-m-d H:i:s");

        $log = "[$date] ERROR: " . $erreur->getMessage() . PHP_EOL;

        file_put_contents($file, $log, FILE_APPEND);
    }
}


?>