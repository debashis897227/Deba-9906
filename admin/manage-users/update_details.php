<?php
include "../includes/header.php";
include "../includes/nav.php";
include "../../includes/db.php";

// Check if 'id' is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('Invalid user ID.'); window.location.href = 'index.php';</script>";
    exit;
}

$user_id = mysqli_real_escape_string($conn, $_GET['id']);

// Fetch user details along with related doctor/patient details
$query = "
    SELECT 
        u.id, u.name, u.email, u.mobile_number, u.address, u.pincode, u.dob, u.gender, u.is_active, u.role,
        p.disease AS patient_disease,
        d.qualification AS doctor_qualification, d.availability, d.visit_fee
    FROM users u
    LEFT JOIN patients p ON u.id = p.user_id
    LEFT JOIN doctors d ON u.id = d.user_id
    WHERE u.id = $user_id
";

$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "<script>alert('User not found.'); window.location.href = 'index.php';</script>";
    exit;
}

// Handle update form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);

    // Allow updates only if the user role is 'Admin'
    if ($user['role'] === 'Admin') {
        $update_query = "UPDATE users SET name = '$name', email = '$email', mobile_number = '$mobile_number', 
                        address = '$address', pincode = '$pincode', dob = '$dob', gender = '$gender'
                        WHERE id = $user_id";

        if (mysqli_query($conn, $update_query)) {
            echo "<script>alert('User details updated successfully!'); window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Error updating user: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('You can only update admin users.');</script>";
    }
}
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">User Details</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/rm/admin/index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php">Users</a></li>
            <li class="breadcrumb-item active">User Details</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user me-1"></i>
                User Details - <?= htmlspecialchars($user['name']); ?>
            </div>
            <div class="card-body">
                <form action="update_details.php?id=<?= $user_id ?>" method="POST">
                    <div class="mb-3">
                        <label class="form-label">User ID</label>
                        <input type="text" class="form-control" value="<?= $user['id']; ?>" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($user['name'] ?? ''); ?>" <?= ($user['role'] === 'Admin') ? '' : 'readonly'; ?> required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($user['email'] ?? ''); ?>" <?= ($user['role'] === 'Admin') ? '' : 'readonly'; ?> required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" name="mobile_number" value="<?= htmlspecialchars($user['mobile_number'] ?? ''); ?>" <?= ($user['role'] === 'Admin') ? '' : 'readonly'; ?> required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" value="<?= htmlspecialchars($user['address'] ?? ''); ?>" <?= ($user['role'] === 'Admin') ? '' : 'readonly'; ?>>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pincode</label>
                        <input type="text" class="form-control" name="pincode" value="<?= htmlspecialchars($user['pincode'] ?? ''); ?>" <?= ($user['role'] === 'Admin') ? '' : 'readonly'; ?>>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Date of Birth</label>
                        <input type="date" class="form-control" name="dob" value="<?= htmlspecialchars($user['dob'] ?? ''); ?>" <?= ($user['role'] === 'Admin') ? '' : 'readonly'; ?>>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <div>
                            <input type="radio" id="male" name="gender" value="Male" <?= ($user['gender'] === 'Male') ? 'checked' : ''; ?> <?= ($user['role'] === 'Admin') ? '' : 'disabled'; ?>>
                            <label for="male">Male</label>

                            <input type="radio" id="female" name="gender" value="Female" <?= ($user['gender'] === 'Female') ? 'checked' : ''; ?> <?= ($user['role'] === 'Admin') ? '' : 'disabled'; ?>>
                            <label for="female">Female</label>

                            <input type="radio" id="other" name="gender" value="Other" <?= ($user['gender'] === 'Other') ? 'checked' : ''; ?> <?= ($user['role'] === 'Admin') ? '' : 'disabled'; ?>>
                            <label for="other">Other</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Role</label>
                        <input type="text" class="form-control" value="<?= $user['role']; ?>" disabled>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <input type="text" class="form-control" value="<?= $user['is_active'] ? 'Active' : 'Inactive'; ?>" disabled>
                    </div>

                    <?php if ($user['role'] === 'Doctor') : ?>
                        <div class="mb-3">
                            <label class="form-label">Qualification</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($user['doctor_qualification'] ?? ''); ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Availability</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($user['availability'] ?? ''); ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Visit Fee</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($user['visit_fee'] ?? ''); ?>" disabled>
                        </div>
                    <?php endif; ?>

                    <?php if ($user['role'] === 'Patient') : ?>
                        <div class="mb-3">
                            <label class="form-label">Disease</label>
                            <input type="text" class="form-control" value="<?= htmlspecialchars($user['patient_disease'] ?? ''); ?>" disabled>
                        </div>
                    <?php endif; ?>

                    <?php if ($user['role'] === 'Admin') : ?>
                        <button type="submit" class="btn btn-primary">Update User</button>
                    <?php else : ?>
                        <p class="text-danger">Only admin users can be updated.</p>
                    <?php endif; ?>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php"; ?>