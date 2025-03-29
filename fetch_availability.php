<?php
include "includes/db.php";

$doctor_id = $_POST['doctor_id'] ?? '';

if (!empty($doctor_id)) {
    $query = "SELECT * FROM doctors WHERE id = '$doctor_id'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $availability = $row['availability'];
        $visit_fee = $row['visit_fee'];

        // Extract days and timings
        list($days, $opening_time, $closing_time) = explode("/", $availability);
        $daysArray = explode(",", $days);

        // Map numeric days to JavaScript-compatible format (0=Sunday, 6=Saturday)
        $dayMap = ["1" => 0, "2" => 1, "3" => 2, "4" => 3, "5" => 4, "6" => 5, "7" => 6];
        $availableDays = array_map(fn($d) => $dayMap[$d], $daysArray);


        // print_r( $availableDays);
        // echo $opening_time;
        echo json_encode([
            "availableDays" => $availableDays,  
            "openingTime" => $opening_time,
            "closingTime" => $closing_time,
            "visit_fee" => $visit_fee
        ]);
    } else {
        echo json_encode(["error" => "No availability found"]);
    }
}
?>
