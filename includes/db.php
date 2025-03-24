<?php
// Start session to manage user roles and authentication
session_start();

// Database credentials
$host = "localhost";  // Change if your database is hosted remotely
$username = "root";   // Your MySQL username
$password = "";       // Your MySQL password
$database = "rm"; // Replace with your actual database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Set UTF-8 encoding for better compatibility
$conn->set_charset("utf8");

// Optional: Error reporting for debugging (Disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>
