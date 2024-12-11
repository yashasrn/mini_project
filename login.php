<?php
// Include the database connection file
include 'db/connection.php';

// Start the session
session_start();

// Initialize error message
$error_message = "";

// Check for form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['viewer_login'])) {
        // Viewer login - No password required
        $_SESSION['logged_in'] = true;
        $_SESSION['user_type'] = 'viewer';

        // Redirect to index.php
        header('Location: index.php');
        exit();
    }

    if (isset($_POST['login'])) {
        // Admin login logic
        $username = trim($_POST['username']);
        $password = md5(trim($_POST['password'])); // Hash the password using MD5

        // Check if username and password are not empty
        if (!empty($username) && !empty($password)) {
            // Validate against database
            $query = "SELECT * FROM users WHERE username = ? AND password = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("ss", $username, $password);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Successful login
                $_SESSION['logged_in'] = true;
                $_SESSION['user_type'] = 'admin';
                header('Location: index.php');
                exit();
            } else {
                // Invalid credentials
                $error_message = "Invalid username or password.";
            }
        } else {
            // Empty fields error
            $error_message = "Please fill in both fields.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - PESITM CSE, Research Centre Management System</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('About.jpg'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #fff; /* Keep white text for contrast */
        }

        .container {
            background: rgba(0, 0, 0, 0.8); /* Darker background for better contrast */
            padding: 40px 60px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            text-align: center;
            width: 100%;
            max-width: 400px;
            opacity: 0.95;
        }

        h1 {
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
            font-size: 1em;
            color: #333; /* Keep the text color inside inputs dark */
        }

        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }

        .button {
            padding: 12px 25px;
            background: linear-gradient(90deg, #007bff, #0056b3); /* Gradient effect */
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-size: 1.1em;
            display: inline-block;
            width: 100%;
            margin-top: 10px;
            border: none;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s, transform 0.3s;
        }

        .button:hover {
            background: linear-gradient(90deg, #0056b3, #003f7f); /* Darker gradient on hover */
            transform: scale(1.05); /* Slightly enlarge the button */
        }

        .error-message {
            color: #e74c3c; /* Red for error */
            margin-bottom: 15px;
            font-size: 1em;
            padding: 10px;
            border: 2px solid #e74c3c;
            border-radius: 5px;
            background-color: rgba(231, 76, 60, 0.1); /* Light red background */
            animation: shake 0.5s ease-in-out, fadeIn 1s ease;
        }

        @keyframes shake {
            0% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            50% { transform: translateX(10px); }
            75% { transform: translateX(-10px); }
            100% { transform: translateX(10px); }
        }

        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }

        .viewer-login {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>PESITM CSE, Research Centre Management System</h1>

        <!-- Display error message if any -->
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <!-- Admin login form -->
        <form method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login" class="button">Login as Admin</button>
        </form>

        <!-- Viewer login button -->
        <form method="post" class="viewer-login">
            <button type="submit" name="viewer_login" class="button">Login as Viewer</button>
        </form>
    </div>
</body>
</html>
