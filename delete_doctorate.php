<?php
include 'db/connection.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $conn->query("DELETE FROM doctorates WHERE id = $id");
}
header("Location: admin.php");
?>
