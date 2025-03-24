<?php
session_start();
include "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Fetch user from database
    $query = "SELECT id, name, password, role, is_active FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user && password_verify($password, $user['password'])) {
        // Check if the user is active
        if ($user['role'] === 'Doctor' && $user['is_active'] == 0) {
            echo "<script>alert('Your account is pending admin approval.'); window.location.href = 'login.php';</script>";
            exit();
        }

        // Login successful
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];

        // Redirect based on role
        switch ($user['role']) {
            case 'Admin':
                header("Location: /rm/admin/index.php");
                break;
            case 'Doctor':
                header("Location: /rm/doctor/index.php");
                break;
            case 'Patient':
                header("Location: /rm/index.php");
                break;
            default:
                header("Location: login.php");
                break;
        }
        exit();
    } else {
        echo "<script>alert('Invalid email or password.'); window.location.href = 'login.php';</script>";
    }
}
?>