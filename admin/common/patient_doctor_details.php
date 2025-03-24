<?php
include "../includes/header.php";
include "../includes/nav.php";
include "../../includes/db.php";

// Check if 'id' and 'type' are provided in the URL
if (!isset($_GET['id']) || empty($_GET['id']) || !isset($_GET['type']) || empty($_GET['type'])) {
    echo "<script>alert('Invalid request.'); window.location.href = 'index.php';</script>";
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$type = mysqli_real_escape_string($conn, $_GET['type']);

// Fetch details based on type (patient or doctor)
if ($type === 'patient') {
    $query = "
        SELECT u.id, u.name, u.email, u.mobile_number, u.address, u.pincode, u.dob, u.gender, p.disease
        FROM users u
        JOIN patients p ON u.id = p.user_id
        WHERE p.id = $id
    ";
    $title = "Patient Details";
} elseif ($type === 'doctor') {
    $query = "
        SELECT u.id, u.name, u.email, u.mobile_number, u.address, u.pincode, u.dob, u.gender, d.qualification, d.availability, d.visit_fee
        FROM users u
        JOIN doctors d ON u.id = d.user_id
        WHERE d.id = $id
    ";
    $title = "Doctor Details";
} else {
    echo "<script>alert('Invalid type.'); window.location.href = 'index.php';</script>";
    exit;
}

$result = mysqli_query($conn, $query);
$details = mysqli_fetch_assoc($result);

if (!$details) {
    echo "<script>alert('Details not found.'); window.location.href = 'index.php';</script>";
    exit;
}
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4"><?= $title; ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/rm/admin/index.php">Dashboard</a></li>
            <li class="breadcrumb-item active"><?= $title; ?></li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user me-1"></i>
                <?= $title; ?> - <?= htmlspecialchars($details['name']); ?>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Name:</strong> <?= htmlspecialchars($details['name']); ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($details['email']); ?></p>
                        <p><strong>Mobile Number:</strong> <?= htmlspecialchars($details['mobile_number']); ?></p>
                        <p><strong>Address:</strong> <?= htmlspecialchars($details['address']); ?></p>
                        <p><strong>Pincode:</strong> <?= htmlspecialchars($details['pincode']); ?></p>
                        <p><strong>Date of Birth:</strong> <?= htmlspecialchars($details['dob']); ?></p>
                        <p><strong>Gender:</strong> <?= htmlspecialchars($details['gender']); ?></p>
                    </div>
                    <div class="col-md-6">
                        <?php if ($type === 'patient') : ?>
                            <p><strong>Disease:</strong> <?= htmlspecialchars($details['disease']); ?></p>
                        <?php elseif ($type === 'doctor') : ?>
                            <p><strong>Qualification:</strong> <?= htmlspecialchars($details['qualification']); ?></p>
                            <p><strong>Availability:</strong> <?= htmlspecialchars($details['availability']); ?></p>
                            <p><strong>Visit Fee:</strong> <?= htmlspecialchars($details['visit_fee']); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php"; ?>