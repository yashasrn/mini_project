<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit();
}

// Check if the user is a viewer
$is_viewer = isset($_SESSION['user_type']) && $_SESSION['user_type'] === 'viewer';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Research Centre Management System</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('About.jpg'); /* Replace with the path to your image */
            background-size: cover;
            background-position: center;
            font-family: 'Arial', sans-serif;
            color: #fff;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .container {
    text-align: center;
    background: rgba(0, 0, 0, 0.8); /* Adjust the last value for transparency (0 is fully transparent, 1 is fully opaque) */
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}


        h1 {
            margin-bottom: 30px;
            font-size: 2em;
        }

        .buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }

        .button {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%; /* Full width inside the container */
            max-width: 400px; /* Set a maximum width */
            height: 60px; /* Increase height */
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.2em;
            font-weight: bold;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            text-transform: uppercase;
        }

        .button:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        .button:active {
            transform: translateY(2px);
        }

        .disabled {
            pointer-events: none;
            opacity: 0.5;
        }

        .logout-button {
            background-color: #dc3545;
        }

        .logout-button:hover {
            background-color: #c82333;
        }

        .sub-buttons {
            display: none; /* Initially hidden */
            flex-direction: column;
            gap: 10px; /* Space between sub-buttons */
            margin-top: -10px; /* Reduce the gap above for visual grouping */
        }

        .sub-buttons.active {
            display: flex; /* Show when active */
        }

        @media (max-width: 768px) {
            .button {
                width: 100%; /* Full width for smaller screens */
                height: auto;
                font-size: 1em;
                padding: 10px;
            }

            h1 {
                font-size: 1.5em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Research Centre Management System<br>PESITM, Shivamogga</h1>
        
        <!-- Main Buttons Section -->
        <div class="buttons">
            <!-- Research Centre Button -->
            <a href="#" class="button" onclick="toggleButtons()">Research Centre</a>
            
            <!-- Sub Buttons for Admin and Viewer -->
            <div id="sub-buttons" class="sub-buttons">
                <a href="admin.php" class="button <?php echo $is_viewer ? 'disabled' : ''; ?>">Admin</a>
                <a href="viewer.php" class="button">Viewer</a>
            </div>

            <!-- Other Main Buttons -->
            <a href="publications.php" class="button">Publications</a>
            <a href="patents.php" class="button">Patents</a>
            <a href="grants.php" class="button">Grants Received</a>
            <a href="logout.php" class="button logout-button">Logout</a>
        </div>
    </div>

    <script>
        function toggleButtons() {
            const subButtons = document.getElementById('sub-buttons');
            subButtons.classList.toggle('active');
        }
    </script>
</body>
</html>
