<?php
include 'db/connection.php';

// Handle adding a new publication
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_publication'])) {
    $title = $_POST['title'];
    $author = $_POST['author'];
    $publication_date = $_POST['publication_date'];

    $stmt = $conn->prepare("INSERT INTO publications (title, author, publication_date) VALUES (?, ?, ?)");
    $stmt->bind_param('sss', $title, $author, $publication_date);
    $stmt->execute();
}

// Handle deleting a publication
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $stmt = $conn->prepare("DELETE FROM publications WHERE id = ?");
    $stmt->bind_param('i', $delete_id);
    $stmt->execute();

    header('Location: publication_admin.php');
    exit;
}

// Fetch all publications
$result = $conn->query("SELECT * FROM publications");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Publication Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f4f4f4;
        }

        form {
            margin-top: 20px;
        }

        input, button {
            padding: 10px;
            margin: 5px 0;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Publication Admin</h1>

    <table>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Publication Date</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['author']); ?></td>
            <td><?php echo htmlspecialchars($row['publication_date']); ?></td>
            <td>
                <a href="publication_edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                <a href="publication_admin.php?delete_id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <h2>Add New Publication</h2>
    <form method="POST">
        <input type="text" name="title" placeholder="Title" required>
        <input type="text" name="author" placeholder="Author" required>
        <input type="date" name="publication_date" required>
        <button type="submit" name="add_publication">Add Publication</button>
    </form>
</body>
</html>
