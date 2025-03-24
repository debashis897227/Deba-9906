<?php
include "../includes/header.php";
include "../includes/nav.php";
include "../../includes/db.php";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $brand = mysqli_real_escape_string($conn, $_POST['brand']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $stock_available = intval($_POST['stock_available']);
    $area_available = mysqli_real_escape_string($conn, $_POST['area_available']);
    $original_price = floatval($_POST['original_price']);
    $selling_price = floatval($_POST['selling_price']);

    // Insert new product
    $query = "INSERT INTO products (name, brand, type, description, stock_available, area_available, original_price, selling_price) 
              VALUES ('$name', '$brand', '$type', '$description', $stock_available, '$area_available', $original_price, $selling_price)";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Product added successfully!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Error adding product: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Add Product</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/rm/admin/index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php">Products</a></li>
            <li class="breadcrumb-item active">Add Product</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-box me-1"></i>
                Add Product
            </div>
            <div class="card-body">
                <form action="add.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand" required>
                    </div>

                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" class="form-control" id="type" name="type" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="stock_available" class="form-label">Stock Available</label>
                        <input type="number" class="form-control" id="stock_available" name="stock_available" required>
                    </div>

                    <div class="mb-3">
                        <label for="area_available" class="form-label">Area Available</label>
                        <input type="text" class="form-control" id="area_available" name="area_available" required>
                    </div>

                    <div class="mb-3">
                        <label for="original_price" class="form-label">Original Price</label>
                        <input type="number" step="0.01" class="form-control" id="original_price" name="original_price" required>
                    </div>

                    <div class="mb-3">
                        <label for="selling_price" class="form-label">Selling Price</label>
                        <input type="number" step="0.01" class="form-control" id="selling_price" name="selling_price" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php"; ?>