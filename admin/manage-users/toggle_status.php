<?php
include "../../includes/db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = intval($_POST['user_id']);

    // Fetch current status of the user
    $query = "SELECT is_active FROM users WHERE id = $user_id";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);

    if ($user) {
        $new_status = $user['is_active'] ? 0 : 1; // Toggle status
        $update_query = "UPDATE users SET is_active = $new_status WHERE id = $user_id";
        mysqli_query($conn, $update_query);
    }
}

// Redirect back to users page
header("Location: index.php");
exit;
?>
