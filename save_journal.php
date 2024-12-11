<?php
// Start the session and include the database connection
session_start();
include 'db/connection.php'; // Ensure the path is correct and the file exists

// Verify if the user is logged in and has the correct permissions
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Check if the form data is set and process it
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and validate input data
    $journal_title = isset($_POST['journal_title']) ? $conn->real_escape_string($_POST['journal_title']) : '';
    $author = isset($_POST['author']) ? $conn->real_escape_string($_POST['author']) : '';
    $publisher = isset($_POST['publisher']) ? $conn->real_escape_string($_POST['publisher']) : '';
    $year_of_publication = isset($_POST['year_of_publication']) ? (int)$_POST['year_of_publication'] : 0;
    $issn_number = isset($_POST['issn_number']) ? $conn->real_escape_string($_POST['issn_number']) : '';

    // Check for empty fields (optional validation)
    if (empty($journal_title) || empty($author) || empty($publisher) || empty($year_of_publication) || empty($issn_number)) {
        die("<p style='color: red;'>All fields are required.</p>");
    }

    // Insert data into the 'journals' table
    $sql = "INSERT INTO journals (journal_title, author, publisher, year_of_publication, issn_number) 
            VALUES ('$journal_title', '$author', '$publisher', $year_of_publication, '$issn_number')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>New record created successfully.</p>";
    } else {
        echo "<p style='color: red;'>Error: " . $conn->error . "</p>";
    }
}
?>
