<?php
include 'db/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve data from form submission
    $name = $conn->real_escape_string($_POST['name']);
    $usn = $conn->real_escape_string($_POST['usn']);
    $guide = $conn->real_escape_string($_POST['guide']);

    // Insert data into the supervisors table
    $query = "INSERT INTO supervisors (name, usn, guide) VALUES ('$name', '$usn', '$guide')";

    if ($conn->query($query) === TRUE) {
        echo "New supervisor added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }

    // Redirect back to the admin page
    header("Location: admin.php");
    exit();
}
?>
