<?php
session_start();
include "../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $otp = $_POST['otp'];

    // Check if the OTP matches
    if (isset($_SESSION['otp']) && $_SESSION['otp'] == $otp) {
        $email = $_SESSION['otp_email'];

        // Fetch user details
        $query = "SELECT id, name, role, is_active FROM users WHERE email = '$email'";
        $result = mysqli_query($conn, $query);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
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
            echo "<script>alert('User not found.'); window.location.href = 'register.php';</script>";
        }
    } else {
        echo "<script>alert('Invalid OTP.'); window.location.href = 'verify_otp_register.php';</script>";
    }
}
?>