<?php
 require "../db.php";
 require "../functions.php";

   

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
     //get name and perpare time from the form
        $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
        $prep_time = isset($_POST['prep_time']) ? htmlspecialchars(trim($_POST['prep_time'])) : '';
        $category_id = isset($_POST['category_id']) ? htmlspecialchars(trim($_POST['category_id'])) : ""; 
        $imageFile = $_FILES['image'] ?? null;

  

    //function erreurs;
        $erreurs = getErreurs($name, $prep_time, $imageFile, $category_id);


        if (empty($erreurs)) {

    // upload image 
         $image = uploadImage($imageFile, "../images/");

            if (!$image){
                $erreurs[] = "Image upload failed";
           }else{
            
     // storaage data in data bases;
             insertData($pdo, $name, $prep_time, $image, $category_id);
             header("Location: read.php");
             exit;
          }
     }
 }
?>




<!DOCTYPE html>
<html>
<head>
    <title>Ajouter Recette</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="form-container">
 
<!-- afichage erreurs-->
 <?php if (!empty($erreurs)): ?>
    <div class="errors">
        <ul>
        <?php foreach ($erreurs as $error): ?>
            <li><?= htmlspecialchars($error) ?></li>
        <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>


    <h2>➕ Ajouter une recette</h2>

    
    <form action=""  method="POST" enctype="multipart/form-data">

        <!-- Nom -->
        <label>Nom de la recette</label>
        <input type="text" name="name" placeholder="Ex: Pizza" >

        <!-- Temps -->
        <label>Temps de préparation (minutes)</label>
        <input type="number" name="prep_time" placeholder="Ex: 30" >

        <!-- Image -->
        <label>Image</label>
        <input type="file" name="image" accept="image/png, image/jpeg" >

        <!-- Catégorie -->
        <label>Catégorie</label>
        <select name="category_id" >
            <option value="">-- Choisir une catégorie --</option>
            <?php 
               // get categories
                 $categories = getCategories($pdo);
            ?>

            <?php    foreach($categories as $cat): ?>
               <option value="<?= $cat['id'] ?>">
                  <?= htmlspecialchars($cat['name'])?>
               </option>
            <?php endforeach; ?>

        </select>
      
        <!-- Button -->
        <button type="submit">Ajouter</button>

    </form>

    <br>
    <a href="read.php">⬅ Retour</a>

</div>

</body>
</html>