<?php
include 'connection.php'; // Include the database connection
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['customer_id'])) {
    die("<script>alert('You need to be logged in to place an order.');window.location.href = 'login.php?redirect=checkout.php';</script>");
}

// Get the customer ID from the session
$customer_id = $_SESSION['customer_id'];

// Check if the cart is not empty
if (empty($_SESSION['cart'])) {
    die("<script>alert('Your cart is empty!');window.location.href = 'cart.php';</script>");
}

// If form is submitted, process the order
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get address and card details from the form
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $card_name = $_POST['card_name'];
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    // Calculate the total price dynamically based on cart contents
    $total_price = 0;
    foreach ($_SESSION['cart'] as $product_id => $quantity) {
        $productQuery = "SELECT price FROM products WHERE id = ?";
        $stmt = $conn->prepare($productQuery);
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $product = $result->fetch_assoc();
            $total_price += $product['price'] * $quantity;
        } else {
            die("<script>alert('Error fetching product details for product ID: $product_id');window.location.href = 'cart.php';</script>");
        }
    }

    // Insert the order into the `orders` table
    $orderQuery = "INSERT INTO orders (user_id, total_price, order_date, status, address, city, zip) VALUES (?, ?, NOW(), 'Processing', ?, ?, ?)";
    $stmt = $conn->prepare($orderQuery);
    $stmt->bind_param('idsss', $customer_id, $total_price, $address, $city, $zip);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $orderID = $stmt->insert_id;

        $trackingNumber = uniqid('TOY-');
        $trackingQuery = "INSERT INTO order_tracking (order_id, tracking_number, status, last_update) VALUES (?, ?, 'Processing', NOW())";
        $stmt = $conn->prepare($trackingQuery);
        $stmt->bind_param('is', $orderID, $trackingNumber);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            unset($_SESSION['cart']);
            echo "<script>alert('Order placed successfully! Your tracking number is: " . $trackingNumber . "');</script>";
            echo "<script>window.location.href = 'order_confirmation.php?tracking=" . $trackingNumber . "';</script>";
        } else {
            die("Error inserting tracking information: " . $stmt->error);
        }
    } else {
        die("Error inserting order: " . $stmt->error);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Toy Store</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .checkout-container {
    max-width: 600px;
    margin: auto;
    padding: 20px;
}

.payment-form label {
    display: block;
    margin: 10px 0 5px;
}

.payment-form input {
    width: 100%;
    padding: 8px;
    margin-bottom: 10px;
}

.payment-form button {
    padding: 10px 20px;
    background-color: #333;
    color: white;
    border: none;
    cursor: pointer;
}
</style>
</head>
<body>
    <h1>Checkout</h1>

    <form action="checkout.php" method="post" class="checkout-form">
        <h3>Shipping Address</h3>
        
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="city">City:</label>
        <input type="text" id="city" name="city" required>

        <label for="zip">ZIP Code:</label>
        <input type="text" id="zip" name="zip" required>

        <h3>Card Payment Details</h3>
        
        <label for="card_name">Name on Card:</label>
        <input type="text" id="card_name" name="card_name" required>

        <label for="card_number">Card Number:</label>
        <input type="text" id="card_number" name="card_number" maxlength="16" required>

        <label for="expiry_date">Expiry Date:</label>
        <input type="month" id="expiry_date" name="expiry_date" required>

        <label for="cvv">CVV:</label>
        <input type="password" id="cvv" name="cvv" maxlength="3" required>

        <button type="submit">Place Order</button>
    </form>
</body>
</html>
