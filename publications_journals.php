<?php
session_start();
include 'db/connection.php';

// Check if the user is logged in and has the right permissions
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

// Check if the user is a viewer
$isViewer = (isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'viewer');

// Handle form submission for adding new journal entries
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !$isViewer) {
    $journal_title = htmlspecialchars($_POST['journal_title']);
    $author = htmlspecialchars($_POST['author']);
    $publisher = htmlspecialchars($_POST['publisher']);
    $year_of_publication = intval($_POST['year_of_publication']);
    $issn_number = htmlspecialchars($_POST['issn_number']);

    // Prepare an SQL statement for inserting the data
    $stmt = $conn->prepare("INSERT INTO journals (journal_title, author, publisher, year_of_publication, issn_number) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $journal_title, $author, $publisher, $year_of_publication, $issn_number);

    if ($stmt->execute()) {
        $success_message = "Journal added successfully!";
    } else {
        $error_message = "Error adding journal: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Journals - Research Centre Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn {
            margin-top: 10px;
        }
        .btn-back {
            background-color: #28a745;
            color: #ffffff;
            width: 100%;
            padding: 10px;
            font-size: 1.1rem;
            border-radius: 5px;
            text-align: center;
        }
        .btn-back:hover {
            background-color: #218838;
            text-decoration: none;
        }
        .alert {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Journals</h1>

        <!-- Display notification messages -->
        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
        <?php elseif (!empty($error_message)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>

        <!-- Display the form only if the user is not a viewer -->
        <?php if (!$isViewer): ?>
            <form method="post" action="">
                <div class="form-group">
                    <label for="journal_title">Journal Title:</label>
                    <input type="text" id="journal_title" name="journal_title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="author">Name of the Author:</label>
                    <input type="text" id="author" name="author" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="publisher">Publisher:</label>
                    <input type="text" id="publisher" name="publisher" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="year_of_publication">Year of Publication:</label>
                    <input type="number" id="year_of_publication" name="year_of_publication" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="issn_number">ISSN Number:</label>
                    <input type="text" id="issn_number" name="issn_number" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </form>
        <?php else: ?>
            <p>You have read-only access. You cannot add or modify records.</p>
        <?php endif; ?>

        <!-- Display existing journals -->
        <h2 class="mt-4">Existing Journals</h2>
        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th>Journal Title</th>
                    <th>Author</th>
                    <th>Publisher</th>
                    <th>Year of Publication</th>
                    <th>ISSN Number</th>
                    <?php if (!$isViewer): ?>
                        <th>Action</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->prepare("SELECT * FROM journals");
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['journal_title']) . "</td>
                                <td>" . htmlspecialchars($row['author']) . "</td>
                                <td>" . htmlspecialchars($row['publisher']) . "</td>
                                <td>" . htmlspecialchars($row['year_of_publication']) . "</td>
                                <td>" . htmlspecialchars($row['issn_number']) . "</td>";
                        if (!$isViewer) {
                            echo "<td>
                                    <a href='edit_journal.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a>
                                    <a href='delete_journal.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                                  </td>";
                        }
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='" . ($isViewer ? "5" : "6") . "' class='text-center'>No records found</td></tr>";
                }
                $stmt->close();
                ?>
            </tbody>
        </table>
        
        <!-- Redirect to publications page button -->
        <div class="text-center mt-4">
            <a href="publications.php" class="btn btn-back">Back to Publications</a>
        </div>
    </div>
</body>
</html>
