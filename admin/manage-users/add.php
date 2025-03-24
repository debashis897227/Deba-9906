<?php
include "../includes/header.php";
include "../includes/nav.php";
include "../../includes/db.php";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hashing password
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);

    // Insert new admin user
    $query = "INSERT INTO users (name, email, password, mobile_number, role, is_active) 
              VALUES ('$name', '$email', '$password', '$mobile_number', 'Admin', 1)";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Admin added successfully!'); window.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Error adding admin: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<main>
    <div class="container-fluid px-4">
        <h1 class="mt-4">Add Admin</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="/rm/admin/index.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="index.php">Users</a></li>
            <li class="breadcrumb-item active">Add Admin</li>
        </ol>

        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-user-plus me-1"></i>
                Add Admin
            </div>
            <div class="card-body">
                <form action="add.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="mobile_number" class="form-label">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile_number" name="mobile_number" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Admin</button>
                </form>
            </div>
        </div>
    </div>
</main>

<?php include "../includes/footer.php"; ?>