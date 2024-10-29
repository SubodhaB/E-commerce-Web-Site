<?php
session_start(); // Start the session
include 'connection.php'; // Include the database connection

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and secure form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Ensure both fields are filled
    if (!empty($username) && !empty($password)) {
        // Query to check if the user exists in the database
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $username); // Bind the username as a string
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result && $result->num_rows > 0) {
            // Fetch user data from the database
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Store user info in the session and redirect
                $_SESSION['customer_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];

                header("Location: index.php"); // Redirect to home page after login
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        } else {
            $error = "Invalid username or password.";
        }
        $stmt->close();
    } else {
        $error = "Please fill out both fields.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Toy Store</title>
    <link rel="stylesheet" href="styles.css">

    <style>
        /* Style for the pop-up ad */
        .popup-ad {
            position: fixed;
            left: 20px;
            bottom: 50px;
            width: 250px;
            background-color: #f9f9f9;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
            padding: 15px;
            z-index: 1000;
            opacity: 0; /* Hidden state */
            transform: translateY(50px); /* Move it down initially */
            transition: opacity 1s ease-in-out, transform 1s ease-in-out;
        }

        .popup-ad.show {
            opacity: 1; /* Visible state */
            transform: translateY(0); /* Original position */
        }

        .popup-ad img {
            width: 100%;
            height: auto;
        }

        .popup-ad .close-btn {
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
            font-size: 18px;
        }

        /* Style the Register link */
.register-link {
    display: inline-block;
    padding: 10px 20px;
    background-color: #8bc224; /* Light green background */
    color: white; /* Text color */
    text-decoration: none;
    font-weight: bold;
    border-radius: 5px;
    transition: background-color 0.3s ease; /* Smooth transition for hover */
}

/* Hover effect */
.register-link:hover {
    background-color: #5e8d07; /* Slightly darker green on hover */
    color: white; /* Change text color to white on hover */
}

    </style>

</head>
<body>
    <header>
        <a href="index.php">Home</a>
    </header>

    <section>
        <h1>Login</h1>

        <!-- Display error message if it exists -->
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>

        <form action="login.php" method="POST">
            <label for="username">Username:</label>
            <input type="text" name="username" required>

            <label for="password">Password:</label>
            <input type="password" name="password" required>

            <button type="submit">Login</button>

            <p>Don't have an account? <a href="register.php" class="register-link">Register here</a>.</p>
        </form>
    </section>

    <!-- Pop-up Ad Section -->
    <div class="popup-ad" id="popupAd">
        <span class="close-btn" id="closeAd">&times;</span>
        <img src="images/ad2.jpg" alt="Advertisement">
        <p>Check out our special offers!</p>
        <a href="https://www.blood-strike.com/" class="btn">See Offers</a>
        <p>
        <img src="images/ad3.jpg" alt="Advertisement"></p>
    </div>

    <script>
        // Display the pop-up ad after a short delay
        setTimeout(function() {
            const popupAd = document.getElementById('popupAd');
            popupAd.classList.add('show'); // Show the popup
        }, 500); // 0.5-second delay

        // Close the pop-up ad when the close button is clicked
        document.getElementById('closeAd').onclick = function() {
            const popupAd = document.getElementById('popupAd');
            popupAd.classList.remove('show'); // Hide the popup
        };
    </script>
</body>
</html>
