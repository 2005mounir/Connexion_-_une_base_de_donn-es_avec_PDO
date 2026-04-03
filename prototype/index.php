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

<main class="container">
<?php
foreach($rqsData as $rs){
    echo '<div class="card">';
    echo '<img src="'.$rs['image'].'" alt="'.$rs['name'].'">';
    echo '<div class="card-content">';
    echo '<h1>'.$rs['name'].'</h1>';
    echo '<h4>'.$rs['category'].'</h4>';
    echo '<h4>'.$rs['prep_time'].'</h4>';
    echo '</div>'; // card-content
    echo '</div>'; // card
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