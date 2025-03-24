<?php
include "../../includes/db.php";

$current_year = date('Y');
$query = "
    SELECT MONTH(schedule) AS month, COUNT(*) AS count
    FROM appointments
    WHERE YEAR(schedule) = $current_year
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