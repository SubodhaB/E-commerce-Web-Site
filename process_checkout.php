<?php
include 'connection.php';
session_start();

$customer_id = $_SESSION['customer_id'];
$total_price = 100; // Calculate this from the cart data

// Insert order into the orders table
$orderQuery = "INSERT INTO orders (user_id, total_price, order_date, status) VALUES (?, ?, NOW(), 'Processing')";
$stmt = $conn->prepare($orderQuery);
$stmt->bind_param('id', $customer_id, $total_price);
$stmt->execute();
$orderID = $stmt->insert_id;

// Insert into order_tracking
$trackingNumber = uniqid('TOY-');
$insertTrackingQuery = "INSERT INTO order_tracking (order_id, tracking_number, status, last_update) 
                        VALUES (?, ?, 'Processing', NOW())";
$stmt = $conn->prepare($insertTrackingQuery);
$stmt->bind_param('is', $orderID, $trackingNumber);
$stmt->execute();

echo "Order placed successfully! Your tracking number is: " . $trackingNumber;
?>
