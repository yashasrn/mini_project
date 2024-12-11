<?php
session_start();
include 'db/connection.php'; // Ensure the path is correct and the file exists

// Check if the user is logged in and has the right permissions
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Check if the user is a viewer
$isViewer = (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'viewer');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conferences - Publications</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        h1 {
            text-align: center;
            color: #007bff;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn {
            margin-top: 10px;
        }
        .read-only {
            pointer-events: none;
            opacity: 0.6;
        }
        table {
            margin-top: 20px;
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s ease;
        }
        .action-links {
            display: flex;
            gap: 5px;
        }
        .action-links a {
            text-decoration: none;
            color: #007bff;
        }
        .action-links a:hover {
            text-decoration: underline;
        }
        .back-button {
            display: block;
            width: auto;
            margin: 20px auto;
            padding: 10px 20px;
            text-align: center;
            background-color: #28a745;
            color: white;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Conferences</h1>

        <!-- Display the form only if the user is not a viewer -->
        <?php if (!$isViewer): ?>
            <!-- Form for adding a new conference -->
            <form method="post" action="save_conference.php" class="mb-4">
                <div class="form-group">
                    <label for="title">Title of the Paper:</label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="author">Name of the Author:</label>
                    <input type="text" id="author" name="author" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="national_international">National/International:</label>
                    <select id="national_international" name="national_international" class="form-control" required>
                        <option value="National">National</option>
                        <option value="International">International</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="year">Year of Publication:</label>
                    <input type="number" id="year" name="year" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="details">Details of the Article:</label>
                    <input type="text" id="details" name="details" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </form>
        <?php else: ?>
            <!-- Read-only message for viewers -->
            <p class="text-center">You have read-only access. You cannot add or modify records.</p>
        <?php endif; ?>

        <!-- Table for displaying existing conferences -->
        <h2>Existing Conferences</h2>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Title of the Paper</th>
                    <th>Author</th>
                    <th>National/International</th>
                    <th>Year of Publication</th>
                    <th>Details of the Article</th>
                    <?php if (!$isViewer): ?>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $result = $conn->query("SELECT * FROM conferences");
                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['title']) . "</td>
                                <td>" . htmlspecialchars($row['author']) . "</td>
                                <td>" . htmlspecialchars($row['national_international']) . "</td>
                                <td>" . htmlspecialchars($row['year_of_publication']) . "</td>
                                <td>" . htmlspecialchars($row['details']) . "</td>";
                        if (!$isViewer) {
                            echo "<td class='action-links'>
                                    <a href='edit_conference.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete_conference.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this record?')\">Delete</a>
                                  </td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='" . ($isViewer ? "5" : "6") . "' class='text-center'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Back button -->
        <div class="text-center">
            <a href="publications.php" class="back-button">Back to Publications</a>
        </div>
    </div>
</body>
</html>
