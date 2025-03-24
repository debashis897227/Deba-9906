<?php
include "../includes/header.php";
include "../includes/nav.php";
include "../../includes/db.php";

// Check if 'id' is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid appointment ID.'); window.location.href = 'index.php';</script>";
    exit;
}

$appointment_id = mysqli_real_escape_string($conn, $_GET['id']);

// Fetch appointment details
$query = "
    SELECT a.id, a.status, a.schedule, a.payment_method, a.payment_status, a.visit_fee,
           pu.name AS patient_name, du.name AS doctor_name, a.patient_id, a.doctor_id
    FROM appointments a
    JOIN patients p ON a.patient_id = p.id
    JOIN users pu ON p.user_id = pu.id
    JOIN doctors d ON a.doctor_id = d.id
    JOIN users du ON d.user_id = du.id
    WHERE a.id = $appointment_id
";
$result = mysqli_query($conn, $query);
$appointment = mysqli_fetch_assoc($result);

if (!$appointment) {
    echo "<script>alert('Appointment not found.'); window.location.href = 'index.php';</script>";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Update appointment status
    $update_query = "UPDATE appointments SET status = '$status' WHERE id = $appointment_id";
    if (mysqli_query($conn, $update_query)) {
        echo "<script>alert('Appointment status updated successfully!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Error updating appointment status: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Update Appointment Status</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/rm/admin/index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php">Appointments</a></li>
            <li class="breadcrumb-item active">Update Appointment Status</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-edit me-1"></i>
                Update Appointment Status - ID: <?= $appointment['id']; ?>
            </div>
            <div class="card-body">
                <form action="update_details.php?id=<?= $appointment_id; ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Appointment ID</label>
                        <input type="text" class="form-control" value="<?= $appointment['id']; ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Patient Name</label>
                        <a href="/rm/admin/common/patient_doctor_details.php?id=<?= $appointment['patient_id']; ?>&type=patient" class="form-control text-primary">
                            <?= htmlspecialchars($appointment['patient_name']); ?>
                        </a>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Doctor Name</label>
                        <a href="/rm/admin/common/patient_doctor_details.php?id=<?= $appointment['doctor_id']; ?>&type=doctor" class="form-control text-primary">
                            <?= htmlspecialchars($appointment['doctor_name']); ?>
                        </a>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Schedule</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($appointment['schedule']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Method</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($appointment['payment_method']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Payment Status</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($appointment['payment_status']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Visit Fee</label>
                        <input type="text" class="form-control" value="<?= htmlspecialchars($appointment['visit_fee']); ?>" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="Scheduled" <?= $appointment['status'] === 'Scheduled' ? 'selected' : ''; ?>>Scheduled</option>
                            <option value="Completed" <?= $appointment['status'] === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                            <option value="Cancelled" <?= $appointment['status'] === 'Cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Status</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php"; ?>