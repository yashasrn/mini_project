<?php
include 'db/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $post = $conn->real_escape_string($_POST['post']);
    $conn->query("INSERT INTO advisory_committee (name, post) VALUES ('$name', '$post')");
    header("Location: admin.php");
}
?>
