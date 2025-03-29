<?php
include "../includes/db.php";
include "../utils/email_util.php"; // Include the email utility file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash password
    $mobile_number = mysqli_real_escape_string($conn, $_POST['mobile_number']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
    $dob = mysqli_real_escape_string($conn, $_POST['dob']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Set is_active based on role
    $is_active = ($role === 'Patient') ? 1 : 0; // TRUE for Patients, FALSE for Doctors

    // Check if the email exists in the database
    $check_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE email='$email'"));
    if ($check_user > 0) {
        // Email already exists
        $_SESSION['error'] = "Email already registered.";
        header("Location: login.php"); // Redirect to login page
        exit();
    }

    // Check if the mobile number exists in the database
    $check_user = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM users WHERE mobile_number='$mobile_number'"));
    if ($check_user > 0) {
        // Mobile number already exists
        $_SESSION['error'] = "Mobile number already registered.";
        header("Location: register.php"); // Redirect to register page
        exit();
    }



    // Insert into users table
    $query = "INSERT INTO users (name, email, password, mobile_number, address, pincode, dob, gender, role, is_active)
              VALUES ('$name', '$email', '$password', '$mobile_number', '$address', '$pincode', '$dob', '$gender', '$role', $is_active)";
    if (mysqli_query($conn, $query)) {
        $user_id = mysqli_insert_id($conn); // Get the last inserted user ID

        // Insert into patients or doctors table based on role
        if ($role === 'Patient') {
            $disease = mysqli_real_escape_string($conn, $_POST['disease']);
            if ($disease == null) {
                $_SESSION['error'] = "Please enter required(*) fields";
                header("Location: register.php");
            }
            $query = "INSERT INTO patients (user_id, disease) VALUES ($user_id, '$disease')";
        } elseif ($role === 'Doctor') {
            $qualification = mysqli_real_escape_string($conn, $_POST['qualification']);
            $day = isset($_POST['day']) ? $_POST['day'] : []; // Ensure it's set
            $dayString = mysqli_real_escape_string($conn, implode(',', $day));
            $opening_time = mysqli_real_escape_string($conn, $_POST['opening_time']);
            $closing_time = mysqli_real_escape_string($conn, $_POST['closing_time']);

            $availability = $dayString . '/' . $opening_time . '/' . $closing_time;
            $visit_fee = mysqli_real_escape_string($conn, $_POST['visit_fee']);
            if ($qualification == null || $availability == null || $visit_fee == null) {
                $_SESSION['error'] = "Please enter required(*) fields";
                header("Location: register.php");
            }

            $query = "INSERT INTO doctors (user_id, qualification, availability, visit_fee)
                      VALUES ($user_id, '$qualification', '$availability', $visit_fee)";
        }
        if (mysqli_query($conn, $query)) {
            // Generate a 6-digit OTP
            $otp = rand(1000, 9999);

            // Save OTP in session
            $_SESSION['otp'] = $otp;
            $_SESSION['otp_email'] = $email;

            // Send OTP to the user's email using the send_email() function
            $subject = "Your OTP for Registration";
            $body = "Your OTP is: $otp";

            if (send_email($email, $subject, $body)) {
                echo "<script>alert('OTP sent to your email.'); window.location.href = 'verify_otp_register.php';</script>";
            } else {
                echo "<script>alert('Failed to send OTP. Please try again.'); window.location.href = 'register.php';</script>";
            }
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href = 'register.php';</script>";
        }
    } else {
        echo "<script>alert('Error: " . mysqli_error($conn) . "'); window.location.href = 'register.php';</script>";
    }
}
