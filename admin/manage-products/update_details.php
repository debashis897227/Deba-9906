<?php
include "../includes/header.php";
include "../includes/nav.php";
include "../../includes/db.php";

// Check if 'id' is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid product ID.'); window.location.href = 'index.php';</script>";
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

// Handle update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $stock_available = intval($_POST['stock_available']);
    $area_available = mysqli_real_escape_string($conn, $_POST['area_available']);
    $original_price = floatval($_POST['original_price']);
    $selling_price = floatval($_POST['selling_price']);

    // Update product details
    $update_query = "UPDATE products SET 
                     name = '$name', 
                     brand = '$brand', 
                     type = '$type', 
                     description = '$description', 
                     stock_available = $stock_available, 
                     area_available = '$area_available', 
                     original_price = $original_price, 
                     selling_price = $selling_price 
                     WHERE id = $product_id";

    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Product updated successfully!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Error updating product: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Update Product</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/rm/admin/index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php">Products</a></li>
            <li class="breadcrumb-item active">Update Product</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-box me-1"></i>
                Update Product - <?= htmlspecialchars($product['name']); ?>
            </div>
            <div class="card-body">
                <form action="update_details.php?id=<?= $product_id ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Product ID</label>
                        <input type="text" class="form-control" value="<?= $product['id']; ?>" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($product['name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Brand</label>
                        <input type="text" class="form-control" name="brand" value="<?= htmlspecialchars($product['brand']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Type</label>
                        <input type="text" class="form-control" name="type" value="<?= htmlspecialchars($product['type']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description</label>
                        <textarea class="form-control" name="description" rows="3" required><?= htmlspecialchars($product['description']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Stock Available</label>
                        <input type="number" class="form-control" name="stock_available" value="<?= $product['stock_available']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Area Available</label>
                        <input type="text" class="form-control" name="area_available" value="<?= htmlspecialchars($product['area_available']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Original Price</label>
                        <input type="number" step="0.01" class="form-control" name="original_price" value="<?= $product['original_price']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Selling Price</label>
                        <input type="number" step="0.01" class="form-control" name="selling_price" value="<?= $product['selling_price']; ?>" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Product</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php"; ?>