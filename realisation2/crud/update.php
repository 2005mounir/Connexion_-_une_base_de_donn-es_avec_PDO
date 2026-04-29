<?php
  require "../db.php";
  require "../functions.php";

  //get id from table after click modify;
  $id = $_GET['id'] ?? null;


  //check id;
  if(!$id){
    die("invalid id");
  }


  // get recipe
  $recipe = getUpdatedata($pdo, $id);


 // get categories
 $categories = getCategories($pdo);



if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $id = $_POST['id'];
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) :"";
    $prep_time = isset($_POST['prep_time']) ? htmlspecialchars(trim($_POST['prep_time'])) :"";
    $category_id = $_POST['category_id'];
    $imageFile = $_FILES['image'] ?? null;

    // erreurs
    $erreurs = getErreurs($name, $prep_time, $imageFile, $category_id);

    if(empty($erreurs)){

        if ($imageFile && $imageFile['error'] === 0){
             $image = uploadImage($imageFile, '../images/');
          
             //update image in folder images;
             if (!empty($recipe['image'])) {
                $oldPath = "../images/" . $recipe['image'];

            //delete old image from folder images
                if (file_exists($oldPath)) {
                    unlink($oldPath);
             }
           }
       }else {
            $image = $recipe['image'];
        }

          // update data in data base
          updateRecipe($pdo, $id, $name, $prep_time, $image, $category_id);

          header("Location: read.php");
          exit;


    }
}
?>










<!DOCTYPE html>
<html>
<head>
    <title>Modifier Recette</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="form-container">

    <h2>✏️ Modifier la recette</h2>

    <form method="POST" enctype="multipart/form-data">

        <input type="hidden" name="id" value="<?= $recipe['id'] ?>">

        <!-- Name -->
        <label>Nom de la recette</label>
        <input type="text" name="name"
               value="<?= htmlspecialchars($recipe['name']) ?>">

        <!-- Prep time -->
        <label>Temps de préparation (minutes)</label>
        <input type="number" name="prep_time"
               value="<?= $recipe['prep_time'] ?>">

        <!-- Current image -->
        <label>Image actuelle</label>
        <br>
        <img src="../images/<?= htmlspecialchars($recipe['image']) ?>"
             width="120"
             style="border-radius:10px; margin-bottom:10px;">

        <!-- New image -->
        <label>Changer l'image (optionnel)</label>
        <input type="file" name="image" accept="image/png, image/jpeg">

        <!-- Category -->
        <label>Catégorie</label>
        <select name="category_id">

            <?php foreach ($categories as $cat): ?>
                <option value="<?= $cat['id'] ?>"
                    <?= $cat['id'] == $recipe['category_id'] ? 'selected' : '' ?>>

                    <?= htmlspecialchars($cat['name']) ?>

                </option>
            <?php endforeach; ?>

        </select>

        <!-- Button -->
        <button type="submit"> Enregistrer</button>

    </form>

    <br>
    <a href="read.php">⬅ Retour</a>

</div>

</body>
</html>