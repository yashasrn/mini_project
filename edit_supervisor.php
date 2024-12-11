<?php
include 'db/connection.php';

$id = $_GET['id']; // Get the ID from the URL
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update the record
    $name = $_POST['name'];
    $usn = $_POST['usn'];
    $guide = $_POST['guide'];

    $stmt = $conn->prepare("UPDATE supervisors SET name=?, usn=?, guide=? WHERE id=?");
    $stmt->bind_param('sssi', $name, $usn, $guide, $id);
    $stmt->execute();

    header('Location: admin.php'); // Redirect back to admin page
    exit;
}

// Fetch the existing record
$stmt = $conn->prepare("SELECT * FROM supervisors WHERE id=?");
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();
$supervisor = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Supervisor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 20px 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 400px;
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        label {
            display: block;
            text-align: left;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .back-button {
            margin-top: 20px;
            display: inline-block;
            background-color: #6c757d;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
        }

        .back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Edit Supervisor</h1>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($supervisor['name']); ?>" required>
            
            <label for="usn">USN:</label>
            <input type="text" id="usn" name="usn" value="<?php echo htmlspecialchars($supervisor['usn']); ?>" required>
            
            <label for="guide">Guide:</label>
            <input type="text" id="guide" name="guide" value="<?php echo htmlspecialchars($supervisor['guide']); ?>" required>
            
            <button type="submit">Save Changes</button>
        </form>
        <a href="admin.php" class="back-button">Back to Admin</a>
    </div>
</body>
</html>
