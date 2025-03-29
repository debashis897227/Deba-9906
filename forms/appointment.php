<?php

ob_start(); // Start output buffering
include '../includes/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['user_id'])) {
        header('location:../auth/login.php');
        exit();
    }

    $patient_id = $_SESSION['user_id'];
    $doctor_id = isset($_POST['doctor']) ? intval($_POST['doctor']) : 0;
    $date = isset($_POST['date']) ? $_POST['date'] : '';
    $time = isset($_POST['time']) ? $_POST['time'] : '';
    $visit_fee = isset($_POST['visit_fee']) ? floatval($_POST['visit_fee']) : 0.00;

    $schedule = "$date $time";
    $payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : "UPI";
    $payment_status = isset($_POST['payment_status']) ? $_POST['payment_status'] : "Completed";
    $status = "Scheduled";

    if (empty($patient_id) || empty($doctor_id) || empty($date) || empty($time)) {
        die("All fields are required.");
    }

    $sql = "INSERT INTO appointments (patient_id, doctor_id, schedule, status, payment_method, payment_status, visit_fee) 
            VALUES ('$patient_id', '$doctor_id', '$schedule', '$status', '$payment_method', '$payment_status', '$visit_fee')";
$hh = mysqli_query($conn, $sql);
    if ($hh) {
        header("Location: ../products.php");
        exit(); // Ensure script stops execution after redirection
    } else {
        die("Database Error: " . mysqli_error($conn));
    }

    mysqli_close($conn);
} else {
    die("Invalid request.");
}
?>