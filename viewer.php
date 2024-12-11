<?php include 'db/connection.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Research Centre Management - Viewer</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }
        .viewer-section {
            flex: 1;
            min-width: 300px; /* Adjust as needed */
            border: 1px solid #ddd;
            padding: 15px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .viewer-section h2 {
            margin-top: 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .button {
            display: block;
            margin: 20px auto;
            padding: 10px 15px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            cursor: pointer;
        }
        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Research Centre Management - Viewer</h1>
    <div class="container">

        <!-- Doctorates Section -->
        <div class="viewer-section">
            <h2>Doctorates</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * FROM doctorates");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['department']) . "</td>
                          </tr>";
                }
                ?>
            </table>
        </div>

        <!-- Supervisors Section -->
        <div class="viewer-section">
            <h2>Supervisors</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>USN</th>
                    <th>Guide</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * FROM supervisors");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['usn']) . "</td>
                            <td>" . htmlspecialchars($row['guide']) . "</td>
                          </tr>";
                }
                ?>
            </table>
        </div>

        <!-- Advisory Committee Section -->
        <div class="viewer-section">
            <h2>Advisory Committee</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Post</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * FROM advisory_committee");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['post']) . "</td>
                          </tr>";
                }
                ?>
            </table>
        </div>

    </div>
    <a href="index.php" class="button">Back to Home</a>
</body>
</html>
