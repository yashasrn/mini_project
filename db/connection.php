<?php
// Enable error reporting for development (remove or disable in production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection details
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "research_centre";

// Create the connection using mysqli with error handling
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    // Use a more descriptive message and exit the script
    die("Connection failed: " . $conn->connect_error);
}

// Set the character set to UTF-8 for proper encoding
if (!$conn->set_charset("utf8")) {
    // Handle potential error in setting the charset
    die("Error setting UTF-8 charset: " . $conn->error);
}
?>
