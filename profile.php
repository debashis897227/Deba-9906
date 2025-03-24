<?php

include "includes/db.php"; 


if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


$sql = "SELECT name, email, address, role FROM users WHERE id = '$user_id'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - RoyMedical</title>
    <link href="/rm/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/rm/assets/css/main.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">User Profile</h2>
        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <td><?php echo ($user['name']); ?></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo ($user['email']); ?></td>
            </tr>
            <tr>
                <th>Address</th>
                <td><?php echo ($user['address']); ?></td>
            </tr>
            <tr>
                <th>Role</th>
                <td><?php echo ($user['role']); ?></td>
            </tr>
        </table>
        <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
        <a href="auth/logout.php" class="btn btn-danger">Logout</a>
    </div>
</body>
</html>
