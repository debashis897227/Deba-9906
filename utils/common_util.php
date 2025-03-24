<?php

function get_safe_value($con, $input) {
    if ($input != '') {
        $input = trim($input); // Remove whitespace
        $input = stripslashes($input); // Remove backslashes
        $input = htmlspecialchars($input); // Convert special characters to HTML entities
        return mysqli_real_escape_string($con, $input); // Escape special characters for SQL
    }
    return '';
}
?>