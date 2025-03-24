<?php include "includes/header.php" ?>
<?php include "includes/nav.php" ?>
<?php include "../includes/db.php" ?>

<?php
// Check if 'id' is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid appointment ID.'); window.location.href = 'appointment_list.php';</script>";
    exit;
}

$appointment_id = mysqli_real_escape_string($conn, $_GET['id']);

// Fetch appointment details
$query = "
    SELECT a.id, a.schedule, a.status, a.payment_status, u.name AS patient_name, p.id AS patient_id
    FROM appointments a
    JOIN patients p ON a.patient_id = p.id
    JOIN users u ON p.user_id = u.id
    WHERE a.id = $appointment_id
";
$result = mysqli_query($conn, $query);
$appointment = mysqli_fetch_assoc($result);

if (!$appointment) {
    echo "<script>alert('Appointment not found.'); window.location.href = 'appointment_list.php';</script>";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $payment_status = mysqli_real_escape_string($conn, $_POST['payment_status']);

    // Update appointment status and payment status
    $update_query = "UPDATE appointments SET status = '$status', payment_status = '$payment_status' WHERE id = $appointment_id";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Appointment updated successfully!'); window.location.href = 'appointment_list.php?id=$appointment_id';</script>";
    } else {
        echo "<script>alert('Error updating appointment: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Appointment Details</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="appointment_list.php">Appointment List</a></li>
            <li class="breadcrumb-item active">Appointment Details</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-edit me-1"></i>
                Appointment Details - ID: <?= $appointment['id']; ?>
            </div>
            <div class="card-body">
                <form action="appointment_details.php?id=<?= $appointment_id; ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Appointment ID</label>
                        <input type="text" class="form-control" value="<?= $appointment['id']; ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Patient Name</label>
                        <a href="patient_details.php?id=<?= $appointment['patient_id']; ?>" class="form-control text-primary">
                            <?= htmlspecialchars($appointment['patient_name']); ?>
                        </a>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Schedule</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($appointment['schedule']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="Scheduled" <?= $appointment['status'] === 'Scheduled' ? 'selected' : ''; ?>>Scheduled</option>
                            <option value="Completed" <?= $appointment['status'] === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                            <option value="Cancelled" <?= $appointment['status'] === 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Status</label>
                        <select class="form-control" name="payment_status" required>
                            <option value="Pending" <?= $appointment['payment_status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                            <option value="Completed" <?= $appointment['payment_status'] === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                            <option value="Failed" <?= $appointment['payment_status'] === 'Failed' ? 'selected' : ''; ?>>Failed</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Appointment</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include "includes/footer.php" ?>