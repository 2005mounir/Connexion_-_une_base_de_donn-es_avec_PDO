<?php
require "function.php";


// Affichage des données
$rqsData = RqsDatda($pdo);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<header class="site-header">
    <div class="site-header__inner">

        <a href="#" class="site-header__logo">
            Mes<span>Recettes</span>
        </a>

        <nav>
            <a href="#" class="active">Accueil</a>
            <a href="#">Recettes</a>
            <a href="#">Catégories</a>
            <a href="#">Contact</a>
        </nav>

    </div>
</header>






<!-- Formulaire -->
 <form action="index.php" method="GET">
    <input type="text" name="inptSearch" placeholder="searc...">

    <select name="category">
        <option value="" selected>category</option>
        <option value="Entree">Entree</option>
        <option value="plat">plat</option>
        <option value="Dessert">Dessert</option>
    </select>

    <select name="sort" >
        <option value="" selected>Sort</option>
        <option value="ASC">ASC</option>
        <option value="DESC">DESC</option>
    </select>

    <button type="submit">send</button>
 </form>







 <!-- valid data-->
  <?php
   if($_SERVER['REQUEST_METHOD'] ==='GET'){
    
    // get data from form;
       $inptSearch = isset($_GET['inptSearch']) ? htmlspecialchars(trim($_GET['inptSearch'])) : "";

       $category = isset($_GET['category']) ? $_GET['category'] : "";
       
       $sort = isset($_GET['sort']) ?  $_GET['sort'] : "";

      $recipes = RqsDatda($pdo);
    
     
    // Sélectionner la fonction
    if(!empty($inptSearch)){
       $recipes  = searchRecipes( $pdo , $inptSearch);
    }
    elseif(!empty($category)){
       $recipes  = filterByCategory($pdo , $category);
    }
    elseif(!empty($sort)){
       $recipes  = sortbytime($pdo , $sort);
    }

    
         
    
  
   }
  
  ?>





<main class="container">
<?php

if(empty($recipes)){
    echo "No recipe found";
}else{
    foreach($recipes as $sr){
        echo '<div class="card">';
        echo '<img src="'.$sr['image'].'" alt="'.$sr['name'].'">';
        echo '<div class="card-content">';
        echo '<h1>'.$sr['name'].'</h1>';
        echo '<h4>'.$sr['category'].'</h4>';
        echo '<h4>'.$sr['prep_time'].'</h4>';
        echo '</div>';
        echo '</div>';
    }
}

?>
</main>





<footer class="site-footer">
    <p>&copy; 2026 Site de Recettes. Tous droits réservés.</p>
</footer>




<!-- code js for change background of nav onclick-->
<script>
    const navLinks = document.querySelectorAll('.site-header nav a');

    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>

</body>
</html>