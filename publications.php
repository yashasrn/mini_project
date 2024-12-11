<?php
// Include any necessary PHP logic or database connection here
include 'db/connection.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Publications - Research Centre Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .tabs {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .tab {
            padding: 15px 30px;
            margin: 0 5px;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1.1em;
            transition: background-color 0.3s;
        }

        .tab:hover {
            background-color: #0056b3;
        }

        .tab.active {
            background-color: #0056b3;
            font-weight: bold;
        }

        .content {
            margin: 20px auto;
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h2 {
            margin-top: 0;
            color: #007bff;
        }

        .back-button {
            display: block;
            width: 150px;
            margin: 20px auto;
            text-align: center;
            padding: 10px;
            background-color: #6c757d;
            color: #fff;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .back-button:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center; color: #007bff;">Publications</h1>
    <div class="tabs">
        <a href="publications_books.php" class="tab <?php echo basename($_SERVER['PHP_SELF']) == 'publications_books.php' ? 'active' : ''; ?>">Books</a>
        <a href="publications_book_chapters.php" class="tab <?php echo basename($_SERVER['PHP_SELF']) == 'publications_book_chapters.php' ? 'active' : ''; ?>">Book Chapters</a>
        <a href="publications_journals.php" class="tab <?php echo basename($_SERVER['PHP_SELF']) == 'publications_journals.php' ? 'active' : ''; ?>">Journals</a>
        <a href="publications_conferences.php" class="tab <?php echo basename($_SERVER['PHP_SELF']) == 'publications_conferences.php' ? 'active' : ''; ?>">Conferences</a>
    </div>
    <div class="content">
        <p>Select a category above to manage or view publications.</p>
    </div>
    <!-- Back to home button -->
    <div class="text-center">
        <a href="index.php" class="back-button">Back to Home</a>
    </div>
</body>
</html>
