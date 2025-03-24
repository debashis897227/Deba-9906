<?php include "../includes/header.php" ?>
<?php include "../includes/nav.php" ?>
<?php include "../../includes/db.php" ?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Products</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/rm/admin/index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Products</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <i class="fas fa-table me-1"></i>
                        Products
                    </div>
                    <div class="col-6">
                        <a href="add.php" class="btn btn-secondary btn-sm float-end">Add Product</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                <?php
                // Fetch products from the database
                $query = "SELECT id, name, brand, type, stock_available, original_price, selling_price FROM products";
                $result = mysqli_query($conn, $query);
                ?>

                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Type</th>
                            <th>Stock Available</th>
                            <th>Original Price</th>
                            <th>Selling Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                            <tr>
                                <td>
                                    <a href="update_details.php?id=<?= $row['id']; ?>" class="text-primary">
                                        <?= $row['id']; ?>
                                    </a>
                                </td>
                                <td><?= $row['name']; ?></td>
                                <td><?= $row['brand']; ?></td>
                                <td><?= $row['type']; ?></td>
                                <td><?= $row['stock_available']; ?></td>
                                <td><?= $row['original_price']; ?></td>
                                <td><?= $row['selling_price']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php" ?>