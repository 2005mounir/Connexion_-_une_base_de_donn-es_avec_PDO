<?php
require "db.php";
require "function.php";

$errors = [];

/* STEP 1: get id from POST */
$id = $_POST['id'] ?? null;

if (!$id) {
    die("ID not found");
}

/* STEP 2: get product from DB */
$product = getProductById($pdo, $id);

if (!$product) {
    die("Product not found");
}

/* STEP 3: update data */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {

    $name = trim($_POST['prdName']);
    $price = trim($_POST['price']);
    $quantity = trim($_POST['quantity']);

    if (empty($name)) $errors[] = "Name is required";
    if (!is_numeric($price) || $price <= 0) $errors[] = "Invalid price";
    if (!is_numeric($quantity) || $quantity < 0) $errors[] = "Invalid quantity";

    if (empty($errors)) {
        updateProduct($pdo, $id, $name, $price, $quantity);
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="col-md-6 mx-auto">

        <div class="card shadow p-4">

            <h3 class="text-center mb-4">Edit Product</h3>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach($errors as $e): ?>
                        <div><?= $e ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <input type="hidden" name="id" value="<?= $product['id'] ?>">

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="prdName" class="form-control"
                           value="<?= htmlspecialchars($product['name']) ?>">
                </div>

                <div class="mb-3">
                    <label>Price</label>
                    <input type="text" name="price" class="form-control"
                           value="<?= $product['price'] ?>">
                </div>

                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="text" name="quantity" class="form-control"
                           value="<?= $product['quantity'] ?>">
                </div>

                <div class="d-flex justify-content-between">
                    <a href="index.php" class="btn btn-secondary">Back</a>

                    <button type="submit" name="update" class="btn btn-primary">
                        Update
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>