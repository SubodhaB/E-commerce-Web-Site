<?php
session_start(); // Start session to handle admin login state

// Process login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if admin credentials are correct
    // You should replace this with a secure database check in real-world applications
    if ($username == 'admin' && $password == 'adminpassword') { // Example hardcoded credentials
        $_SESSION['admin'] = $username; // Set admin session
        header('Location: admin_panel.php'); // Redirect to admin panel
        exit;
    } else {
        echo "<script>alert('Invalid credentials. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Wonder Land</title>
    <link rel="stylesheet" href="admin_styles.css"> <!-- Use your existing stylesheet -->
</head>
<body>
    <h1>Admin Login - Wonder Land</h1>
    <form method="POST">
        <label>Username:</label>
        <input type="text" name="username" required><br>

        <label>Password:</label>
        <input type="password" name="password" required><br>

        <button type="submit">Login</button>
    </form>
</body>
</html>
