<?php
 // Start the session

require('../includes/db.php'); // Include database connection
require('../utils/email_util.php'); // Include email utility functions

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Generate OTP
    $otp = rand(1111, 9999);
    $_SESSION['EMAIL_OTP'] = $otp; // Store OTP in session
    $_SESSION['EMAIL'] = $email; // Store email in session for verification

    // Prepare email content
    $subject = "Your OTP for Verification";
    $body = "$otp is your OTP for verification.";

    // Send email
    if (send_email($email, $subject, $body)) {
        // Email sent successfully
        $_SESSION['success']="OTP send successfully";
        header("Location: verify_otp.php"); // Redirect to OTP verification page
        exit();
    } else {
        // Failed to send email
        $_SESSION['error'] = "Failed to send OTP. Please try again.";
        header("Location: login.php"); // Redirect to login page
        exit();
    }
} else {
    // Invalid request method
    $_SESSION['error'] = "Invalid request method.";
    header("Location: login.php"); // Redirect to login page
    exit();
}
?>