<?php
include "../includes/header.php";
include "../includes/nav.php";
include "../../includes/db.php";

// Check if 'id' is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid order ID.'); window.location.href = 'index.php';</script>";
    exit;
}

$order_id = mysqli_real_escape_string($conn, $_GET['id']);

// Fetch order details
$query = "
    SELECT o.id, o.status, o.payment_method, o.payment_status, o.price, o.expected_delivery_date,
           u.name AS patient_name, p.name AS product_name, o.patient_id, o.product_id
    FROM orders o
    JOIN patients pa ON o.patient_id = pa.id
    JOIN users u ON pa.user_id = u.id
    JOIN products p ON o.product_id = p.id
    WHERE o.id = $order_id
";
$result = mysqli_query($conn, $query);
$order = mysqli_fetch_assoc($result);

if (!$order) {
    echo "<script>alert('Order not found.'); window.location.href = 'index.php';</script>";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Update order status
    $update_query = "UPDATE orders SET status = '$status' WHERE id = $order_id";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Order status updated successfully!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Error updating order status: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Update Order Status</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/rm/admin/index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php">Orders</a></li>
            <li class="breadcrumb-item active">Update Order Status</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-edit me-1"></i>
                Update Order Status - ID: <?= $order['id']; ?>
            </div>
            <div class="card-body">
                <form action="update_details.php?id=<?= $order_id; ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Order ID</label>
                        <input type="text" class="form-control" value="<?= $order['id']; ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Patient Name</label>
                        <a href="/rm/admin/common/patient_doctor_details.php?id=<?= $order['patient_id']; ?>&type=patient" class="form-control text-primary">
                            <?= htmlspecialchars($order['patient_name']); ?>
                        </a>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Product Name</label>
                        <a href="/rm/admin/common/product_details.php?id=<?= $order['product_id']; ?>" class="form-control text-primary">
                            <?= htmlspecialchars($order['product_name']); ?>
                        </a>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($order['payment_method']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Status</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($order['payment_status']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Price</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($order['price']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Expected Delivery Date</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($order['expected_delivery_date']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="Pending" <?= $order['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="Shipped" <?= $order['status'] === 'Shipped' ? 'selected' : ''; ?>>Shipped</option>
                            <option value="Delivered" <?= $order['status'] === 'Delivered' ? 'selected' : ''; ?>>Delivered</option>
                            <option value="Cancelled" <?= $order['status'] === 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php"; ?>