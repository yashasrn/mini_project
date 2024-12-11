<?php include 'db/connection.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin - Research Centre Management</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .admin-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            flex-wrap: wrap;
        }
        .admin-section {
            flex: 1;
            min-width: 300px; /* Adjust as needed */
            border: 1px solid #ddd;
            padding: 15px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1);
        }
        .admin-section h2 {
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
    <h1>Admin Panel</h1>
    <div class="admin-container">

        <!-- Doctorates Section -->
        <div class="admin-section">
            <h2>Doctorates</h2>
            <form method="post" action="save_doctorate.php">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="department">Department:</label>
                <input type="text" id="department" name="department" required>
                <button type="submit">Save</button>
            </form>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Action</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * FROM doctorates");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['department']) . "</td>
                            <td>
                                <a href='edit_doctorate.php?id=" . $row['id'] . "'>Edit</a> | 
                                <a href='delete_doctorate.php?id=" . $row['id'] . "'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </table>
        </div>

        <!-- Supervisors Section -->
        <div class="admin-section">
            <h2>Supervisors</h2>
            <form method="post" action="save_supervisor.php">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="usn">USN:</label>
                <input type="text" id="usn" name="usn" required>
                <label for="guide">Guide:</label>
                <input type="text" id="guide" name="guide" required>
                <button type="submit">Save</button>
            </form>
            <table>
                <tr>
                    <th>Name</th>
                    <th>USN</th>
                    <th>Guide</th>
                    <th>Action</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * FROM supervisors");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['usn']) . "</td>
                            <td>" . htmlspecialchars($row['guide']) . "</td>
                            <td>
                                <a href='edit_supervisor.php?id=" . $row['id'] . "'>Edit</a> | 
                                <a href='delete_supervisor.php?id=" . $row['id'] . "'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </table>
        </div>

        <!-- Advisory Committee Section -->
        <div class="admin-section">
            <h2>Advisory Committee</h2>
            <form method="post" action="save_advisory_committee.php">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
                <label for="post">Post:</label>
                <input type="text" id="post" name="post" required>
                <button type="submit">Save</button>
            </form>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Post</th>
                    <th>Action</th>
                </tr>
                <?php
                $result = $conn->query("SELECT * FROM advisory_committee");
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['name']) . "</td>
                            <td>" . htmlspecialchars($row['post']) . "</td>
                            <td>
                                <a href='edit_advisory_committee.php?id=" . $row['id'] . "'>Edit</a> | 
                                <a href='delete_advisory_committee.php?id=" . $row['id'] . "'>Delete</a>
                            </td>
                          </tr>";
                }
                ?>
            </table>
        </div>

    </div>
    <a href="index.php" class="button">Back to Home</a>
</body>
</html>
