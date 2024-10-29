<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $trackingNumber = $_POST['tracking_number'];

    // Check tracking details in the `order_tracking` table
    $query = "SELECT status, last_update FROM order_tracking WHERE tracking_number = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $trackingNumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $trackingInfo = $result->fetch_assoc();
        // Set the status message to be displayed below the button
        $statusMessage = "Order Status: " . $trackingInfo['status'] . "<br>" .
                         "Last Updated: " . $trackingInfo['last_update'];
    } else {
        $statusMessage = "Invalid tracking number.";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track your item</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
        <a href="index.php">Home</a>
    </header>

    <section>
        <h1>Track your item</h1>
<form action="track_order.php" method="POST">
    <input type="text" name="tracking_number" placeholder="Enter your tracking number" required>
    <button type="submit">Track Order</button>
</form>

<!-- Display the status message here, below the form -->
<?php if (!empty($statusMessage)): ?>
        <div style="margin-top: 20px; padding: 10px; border: 1px solid #ccc;">
            <?php echo $statusMessage; ?>
        </div>
    <?php endif; ?>
</body>
</html>

