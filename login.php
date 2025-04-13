<?php
session_start();
include_once 'config.php';

// If the user is already logged in, redirect to the main page.
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$message = ""; // for error messages

// Process the form submission on POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize inputs
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $message = "Both username and password are required.";
    } else {
        // Prepare a statement to select user record by username.
        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            // Check if a user exists with that username
            if ($stmt->num_rows == 1) {
                $stmt->bind_result($id, $usernameFromDB, $hashedPassword);
                $stmt->fetch();

                // Verify the provided password against the stored hash
                if (password_verify($password, $hashedPassword)) {
                    // Password is valid—store the data in session and redirect
                    $_SESSION['user_id'] = $id;
                    $_SESSION['username'] = $usernameFromDB;
                    header("Location: index.php");
                    exit;
                } else {
                    $message = "Invalid username or password.";
                }
            } else {
                $message = "Invalid username or password.";
            }
            $stmt->close();
        } else {
            $message = "An error occurred. Please try again later.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Neptune Aerotech</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Simple inline styling for the login form */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .login-container {
            width: 350px;
            margin: 100px auto;
            background: #fff;
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .login-container h2 {
            text-align: center;
        }
        .login-container .error {
            color: red;
            text-align: center;
            margin-bottom: 15px;
        }
        .login-container label {
            display: block;
            margin-top: 10px;
        }
        .login-container input[type="text"],
        .login-container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        .login-container button {
            background-color: #007BFF;
            color: #fff;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
        }
        .login-container button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <?php if (!empty($message)): ?>
            <div class="error"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        <form method="post" action="login.php">
            <label for="username">Username:</label>
            <input type="text" name="username" placeholder="Enter your username" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter your password" required>
            
            <button type="submit">Login</button>
            <hr>
            <button id="test-login" type="button">Test Login</button>
        </form>
    </div>
</body>
<script>
    $('body').on('click', '#test-login', function(){
        $('input[name=username]').val('wasim@admin.com')
        $('input[name=password]').val('12345678')
        $('form').submit();
    })
</script>
</html>