<?php
require "db.php";
require "function.php";

$products = getallData($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Products</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold">Product Management</h1>

        <a href="add.php">
<button type="submit" class="btn btn-outline-success">Add product</button>
        </a>
    </div>

    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach($products as $prdc): ?>
                    <tr>
                        <td><?= $prdc['id'] ?></td>
                        <td><?= htmlspecialchars($prdc['name']) ?></td>
                        <td class="text-success fw-bold">$<?= $prdc['price'] ?></td>
                        <td><?= $prdc['quantity'] ?></td>

                        <td>
                            <div class="d-flex justify-content-center gap-2">

                                <form action="edit.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $prdc['id'] ?>">
                                    <button type="submit" class="btn btn-outline-primary">edit</button>


                                </form>

                                <form action="delete.php" method="POST">
                                    <input type="hidden" name="id" value="<?= $prdc['id'] ?>">
                                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure?');">
                                        delete
                                    </button>

                                </form>

                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>

        </div>
    </div>

</div>

</body>
</html>