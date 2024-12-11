<?php
include 'db/connection.php';

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    $conn->query("DELETE FROM advisory_committee WHERE id = $id");
}
header("Location: admin.php");
?>
