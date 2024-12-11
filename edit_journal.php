<?php
// Include the connection file
include 'db/connection.php';

// Ensure an ID is provided for editing
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the existing data for this journal
    $query = "SELECT * FROM journals WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 0) {
        echo "Journal not found.";
        exit;
    }
    
    $journal = $result->fetch_assoc();
} else {
    echo "No ID provided.";
    exit;
}

// If the form is submitted, update the journal details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $journal_title = $_POST['journal_title'];
    $author = $_POST['author'];
    $publisher = $_POST['publisher'];
    $year_of_publication = $_POST['year_of_publication'];
    $issn_number = $_POST['issn_number'];

    // Update the journal record
    $updateQuery = "UPDATE journals SET journal_title = ?, author = ?, publisher = ?, year_of_publication = ?, issn_number = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param('sssisi', $journal_title, $author, $publisher, $year_of_publication, $issn_number, $id);

    if ($stmt->execute()) {
        // Redirect after update
        header("Location: publications_journals.php");
        exit;
    } else {
        echo "Error updating record: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Journal - Research Centre Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Edit Journal Entry</h1>

        <!-- Edit Form -->
        <form method="post">
            <div class="form-group">
                <label for="journal_title">Journal Title:</label>
                <input type="text" id="journal_title" name="journal_title" class="form-control" value="<?php echo htmlspecialchars($journal['journal_title']); ?>" required>
            </div>

            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" class="form-control" value="<?php echo htmlspecialchars($journal['author']); ?>" required>
            </div>

            <div class="form-group">
                <label for="publisher">Publisher:</label>
                <input type="text" id="publisher" name="publisher" class="form-control" value="<?php echo htmlspecialchars($journal['publisher']); ?>" required>
            </div>

            <div class="form-group">
                <label for="year_of_publication">Year of Publication:</label>
                <input type="number" id="year_of_publication" name="year_of_publication" class="form-control" value="<?php echo htmlspecialchars($journal['year_of_publication']); ?>" required>
            </div>

            <div class="form-group">
                <label for="issn_number">ISSN Number:</label>
                <input type="text" id="issn_number" name="issn_number" class="form-control" value="<?php echo htmlspecialchars($journal['issn_number']); ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>
</html>