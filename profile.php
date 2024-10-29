<?php
include 'connection.php'; // Include database connection
session_start(); // Start session

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    die("<script>alert('You need to be logged in to view your profile.');window.location.href = 'login.php';</script>");
}

// Get the customer ID from the session
$customer_id = $_SESSION['customer_id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Purchase History</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <a href="index.php">Home</a>
        <a href="cart.php">Cart</a>
        <a href="logout.php">Logout</a>
    </header>

    <!-- Profile Section -->
    <section>
        <h1>Your Purchase History</h1>

        <?php
        // Query to get all orders for the logged-in user
        $orderQuery = "SELECT * FROM orders WHERE user_id = ? ORDER BY order_date DESC";
        $stmt = $conn->prepare($orderQuery);
        $stmt->bind_param('i', $customer_id);
        $stmt->execute();
        $orders = $stmt->get_result();

        if ($orders->num_rows > 0) {
            // Loop through each order
            while ($order = $orders->fetch_assoc()) {
                $orderID = $order['id'];
                $orderDate = $order['order_date'];
                $totalPrice = number_format($order['total_price'], 2);
                $status = $order['status'];

                echo "<div class='order'>";
                echo "<h3>Order #{$orderID}</h3>";
                echo "<p>Order Date: {$orderDate}</p>";
                echo "<p>Status: {$status}</p>";
                echo "<p>Total Price: {$totalPrice} USD</p>";

                // Query to get order details for each order
                $orderDetailsQuery = "
                    SELECT od.quantity, p.name, p.price 
                    FROM order_details od 
                    JOIN products p ON od.product_id = p.id 
                    WHERE od.order_id = ?";
                $stmtDetails = $conn->prepare($orderDetailsQuery);
                $stmtDetails->bind_param('i', $orderID);
                $stmtDetails->execute();
                $orderDetails = $stmtDetails->get_result();

                if ($orderDetails->num_rows > 0) {
                    echo "<ul>";
                    // Display each product in the order
                    while ($item = $orderDetails->fetch_assoc()) {
                        $productName = $item['name'];
                        $quantity = $item['quantity'];
                        $productPrice = number_format($item['price'], 2);
                        $itemTotal = number_format($item['price'] * $quantity, 2);

                        echo "<li>{$productName} - {$quantity} x {$productPrice} USD = {$itemTotal} USD</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No items found for this order.</p>";
                }
                echo "</div><hr>";
            }
        } else {
            echo "<p>You have no purchase history.</p>";
        }
        ?>
    </section>
</body>
</html>
