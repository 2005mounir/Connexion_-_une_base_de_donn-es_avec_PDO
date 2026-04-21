<?php
require_once "db.php";
require_once "function.php";

$erreurs = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $prdName = trim($_POST['prdName'] ?? "");
    $price = trim($_POST['price'] ?? "");
    $quantity = trim($_POST['quantity'] ?? "");

    if (empty($prdName)) {
        $erreurs[] = "Name is empty!";
    }

    if (empty($price) || !is_numeric($price) || $price <= 0) {
        $erreurs[] = "Price invalid!";
    }

    if (empty($quantity) || !is_numeric($quantity) || $quantity < 0) {
        $erreurs[] = "Quantity invalid!";
    }

    if (empty($erreurs)) {
        Add_Products($pdo, $prdName, $price, $quantity);
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Product</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-body">

                    <h3 class="text-center mb-4">Add New Product</h3>

                    <?php if (!empty($erreurs)): ?>
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                <?php foreach($erreurs as $err): ?>
                                    <li><?= $err ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="prdName" class="form-control"
                                   value="<?= htmlspecialchars($_POST['prdName'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" name="price" class="form-control"
                                   value="<?= htmlspecialchars($_POST['price'] ?? '') ?>">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="text" name="quantity" class="form-control"
                                   value="<?= htmlspecialchars($_POST['quantity'] ?? '') ?>">
                        </div>

                        <div class="d-flex justify-content-between">

                            <a href="index.php" class="btn btn-secondary">
                                ← Back
                            </a>

                            <button type="submit" class="btn btn-success">
                                ➕ Add Product
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

</body>
</html>