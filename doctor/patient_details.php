<?php include "includes/header.php" ?>
<?php include "includes/nav.php" ?>
<?php include "../includes/db.php" ?>

<?php
// Check if 'id' is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid patient ID.'); window.location.href = 'appointment_list.php';</script>";
    exit;
}

$patient_id = mysqli_real_escape_string($conn, $_GET['id']);

// Fetch patient details
$query = "
    SELECT u.name, u.email, u.mobile_number, u.address, u.pincode, u.dob, u.gender, p.disease
    FROM patients p
    JOIN users u ON p.user_id = u.id
    WHERE p.id = $patient_id
";
$result = mysqli_query($conn, $query);
$patient = mysqli_fetch_assoc($result);

if (!$patient) {
    echo "<script>alert('Patient not found.'); window.location.href = 'appointment_list.php';</script>";
    exit;
}
?>

<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">Patient Details</h3>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="appointment_list.php">Appointment List</a></li>
            <li class="breadcrumb-item active">Patient Details</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user me-1"></i>
                Patient Details - <?= htmlspecialchars($patient['name']); ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> <?= htmlspecialchars($patient['name']); ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($patient['email']); ?></p>
                        <p><strong>Mobile Number:</strong> <?= htmlspecialchars($patient['mobile_number']); ?></p>
                        <p><strong>Address:</strong> <?= htmlspecialchars($patient['address']); ?></p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>Pincode:</strong> <?= htmlspecialchars($patient['pincode']); ?></p>
                        <p><strong>Date of Birth:</strong> <?= htmlspecialchars($patient['dob']); ?></p>
                        <p><strong>Gender:</strong> <?= htmlspecialchars($patient['gender']); ?></p>
                        <p><strong>Disease:</strong> <?= htmlspecialchars($patient['disease']); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "includes/footer.php" ?>