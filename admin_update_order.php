<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_id = intval($_POST['order_id']);
    $new_status = $_POST['status'];

    // Update the order's status in the `orders` table
    $updateOrderQuery = "UPDATE orders SET status = ? WHERE id = ?";
    $stmt = $conn->prepare($updateOrderQuery);
    $stmt->bind_param('si', $new_status, $order_id);
    $stmt->execute();

    // Insert or update the order status in the `order_tracking` table
    $trackingNumber = uniqid('TOY-'); // Generate tracking number if it's a new status
    $updateTrackingQuery = "INSERT INTO order_tracking (order_id, tracking_number, status, last_update) 
                            VALUES (?, ?, ?, NOW()) 
                            ON DUPLICATE KEY UPDATE status = ?, last_update = NOW()";
    $stmt = $conn->prepare($updateTrackingQuery);
    $stmt->bind_param('isss', $order_id, $trackingNumber, $new_status, $new_status);
    $stmt->execute();

    echo "Order status updated successfully!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin update order - Toy Store</title>
    <link rel="stylesheet" href="admin_styles.css"> <!-- Use your existing stylesheet -->
</head>

<!-- Admin form for updating order status -->
<form method="POST" action="admin_update_order.php">
    <label for="order_id">Order ID:</label>
    <input type="number" name="order_id" required>
    
    <label for="status">Status:</label>
    <select name="status" required>
        <option value="Processing">Processing</option>
        <option value="Shipped">Shipped</option>
        <option value="Delivered">Delivered</option>
    </select>
    
    <input type="submit" value="Update Order Status">
</form>
