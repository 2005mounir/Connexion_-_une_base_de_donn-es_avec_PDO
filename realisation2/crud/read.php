<?php
require "../db.php";
require "../functions.php";

$data = getData($pdo);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des Recettes</title>
    <!-- Google font for a professional look -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>


<!-- Full-width header (visual only; PHP logic unchanged) -->
<header class="app-header">
    <div class="header-inner">
        <div class="brand">
            <div class="logo">🍽️</div>
            <div>
                <div class="site-title">Recettes Pro</div>
                <div class="site-sub">Des idées simples et délicieuses</div>
            </div>
        </div>
        <nav class="header-controls">
            <a href="../index.php" class="btn secondary">🏠 Accueil</a>
            <a href="#" class="nav-link">À propos</a>
            <a href="#" class="nav-link">Contact</a>
            <a href="#" class="nav-link login-btn">Se connecter</a>
        </nav>
    </div>
</header>

<div class="container">
    <div class="content-inner">

    <h2>📖 Liste des Recettes</h2>

    <a href="create.php" class="btn">➕ Ajouter une recette</a>

    <br><br>

    <div class="table-responsive">
    <table class="recipes-table" cellpadding="10" cellspacing="0" width="100%">

        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Catégorie</th>
            <th>Temps</th>
            <th>Actions</th>
        </tr>

        <?php foreach ($data as $row): ?>
            <tr>

                <!-- Image -->
                <td>
                    <img src="../images/<?= htmlspecialchars($row['image']) ?>" class="recipe-img" alt="<?= htmlspecialchars($row['name']) ?>">
                </td>

                <!-- Name -->
                <td>
                    <?= htmlspecialchars($row['name']) ?>
                </td>

                <!-- Category -->
                <td>
                    <?= htmlspecialchars($row['category_name']) ?>
                </td>

                <!-- Prep time -->
                <td>
                    <?= $row['prep_time'] ?> min
                </td>

                <!-- Actions -->
                <td>

                          <a href="update.php?id=<?= $row['id'] ?>" class="action-btn edit">✏️ Modifier</a>

                          <a href="delete.php?id=<?= $row['id'] ?>" class="action-btn delete" 
                              onclick="return confirm('Are you sure?')">
                              ❌ Supprimer
                          </a>

                </td>

            </tr>
        <?php endforeach; ?>

    </table>

    </div> <!-- .table-responsive -->

    </div> <!-- .content-inner -->

</div> <!-- .container -->

    <!-- Footer: fully-coded HTML footer with styled links -->
    <footer class="app-footer" role="contentinfo">
        <div class="footer-inner">
            <div class="footer-left">
                <div class="logo-small">🍽️</div>
                <div class="footer-brand">
                    <p class="footer-title">Recettes Pro</p>
                    <p class="footer-sub small">© <?= date('Y') ?> — Tous droits réservés</p>
                </div>
            </div>
            <nav class="footer-right" aria-label="Footer navigation">
                <a href="../index.php" class="footer-link">Accueil</a>
                <a href="#" class="footer-link">Contact</a>
                <a href="#" class="footer-link">Aide</a>
            </nav>
        </div>
    </footer>

</body>
</html>