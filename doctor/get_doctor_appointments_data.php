<?php
include "../includes/db.php";

// Hardcoded user ID (replace with logged-in user's ID later)
$user_id = $_GET['user_id'] ?? 2;

// Fetch doctor ID based on user ID
$query = "SELECT id FROM doctors WHERE user_id = $user_id";
$result = mysqli_query($conn, $query);
$doctor = mysqli_fetch_assoc($result);
$doctor_id = $doctor['id'];

$current_year = date('Y');
$query = "
    SELECT MONTH(schedule) AS month, COUNT(*) AS count
    FROM appointments
    WHERE YEAR(schedule) = $current_year AND doctor_id = $doctor_id
    GROUP BY MONTH(schedule)
";
$result = mysqli_query($conn, $query);

$labels = [];
$values = [];

for ($i = 1; $i <= 12; $i++) {
    $labels[] = date('F', mktime(0, 0, 0, $i, 10)); // Full month name
    $values[] = 0; // Initialize with 0
}

while ($row = mysqli_fetch_assoc($result)) {
    $month = (int)$row['month'];
    $values[$month - 1] = (int)$row['count'];
}

echo json_encode([
    'labels' => $labels,
    'values' => $values
]);
?>