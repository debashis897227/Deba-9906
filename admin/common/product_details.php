<?php
include "../includes/header.php";
include "../includes/nav.php";
include "../../includes/db.php";

// Check if 'id' is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid product ID.'); window.location.href = 'products.php';</script>";
    exit;
}

$product_id = mysqli_real_escape_string($conn, $_GET['id']);

// Fetch product details
$query = "SELECT * FROM products WHERE id = $product_id";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "<script>alert('Product not found.'); window.location.href = 'products.php';</script>";
    exit;
}
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Product Details</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/rm/admin/index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Product Details</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-box me-1"></i>
                Product Details - <?= htmlspecialchars($product['name']); ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> <?= htmlspecialchars($product['name']); ?></p>
                        <p><strong>Brand:</strong> <?= htmlspecialchars($product['brand']); ?></p>
                        <p><strong>Type:</strong> <?= htmlspecialchars($product['type']); ?></p>
                        <p><strong>Description:</strong> <?= htmlspecialchars($product['description']); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Stock Available:</strong> <?= htmlspecialchars($product['stock_available']); ?></p>
                        <p><strong>Area Available:</strong> <?= htmlspecialchars($product['area_available']); ?></p>
                        <p><strong>Original Price:</strong> <?= htmlspecialchars($product['original_price']); ?></p>
                        <p><strong>Selling Price:</strong> <?= htmlspecialchars($product['selling_price']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php"; ?>