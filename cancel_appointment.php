<?php
include 'includes/db.php'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $appointment_id = isset($_POST['appointment_id']) ? intval($_POST['appointment_id']) : 0;

    if ($appointment_id > 0) {
        // Update the appointment status to "Cancelled"
        $sql = "UPDATE appointments SET status = 'Cancelled' WHERE id = $appointment_id";
        $res = mysqli_query($conn, $sql);

        if ($res) {
            header("Location: my_appointments.php?message=Appointment cancelled successfully");
            exit();
        } else {
            echo "Error cancelling appointment: " . mysqli_error($conn);
        }
    }
} else {
    die("Invalid request.");
}

mysqli_close($conn);
?>
