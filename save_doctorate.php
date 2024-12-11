<?php
include 'db/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $department = $conn->real_escape_string($_POST['department']);
    $conn->query("INSERT INTO doctorates (name, department) VALUES ('$name', '$department')");
    header("Location: admin.php");
}
?>
