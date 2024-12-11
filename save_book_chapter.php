<?php
include '../db/connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $chapter_title = $_POST['chapter_title'];
    $book_title = $_POST['book_title'];
    $author = $_POST['author'];

    $query = "INSERT INTO book_chapters (chapter_title, book_title, author) VALUES ('$chapter_title', '$book_title', '$author')";
    if ($conn->query($query)) {
        echo "Book Chapter added successfully.";
    } else {
        echo "Error: " . $conn->error;
    }
    header("Location: publications_book_chapters.php");
    exit;
}
?>
