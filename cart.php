<?php
include 'connection.php'; // Include your database connection
session_start(); // Start the session

// Initialize the cart if not already done
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

// Handle adding items to the cart
if (isset($_GET['action']) && $_GET['action'] == 'add') {
    $product_id = intval($_GET['id']); // Use 'id' instead of 'add'
    if ($product_id > 0) {
        // Add product to cart or increment quantity
        $_SESSION['cart'][$product_id] = isset($_SESSION['cart'][$product_id]) ? $_SESSION['cart'][$product_id] + 1 : 1;
        echo "<script>alert('Product added to cart successfully!');</script>";
    } else {
        echo "<script>alert('Invalid product ID.');</script>";
    }
}

// Handle removing items from the cart
if (isset($_GET['action']) && $_GET['action'] == 'remove') {
    $product_id = intval($_GET['id']); // Get the product ID to remove
    if (array_key_exists($product_id, $_SESSION['cart'])) {
        unset($_SESSION['cart'][$product_id]); // Remove the item from the cart
        echo "<script>alert('Product removed from cart.');</script>";
    }
}

// Handle increasing item quantity
if (isset($_GET['action']) && $_GET['action'] == 'increase') {
    $product_id = intval($_GET['id']);
    if ($product_id > 0 && isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id] += 1;
        //echo "<script>alert('Product quantity increased!');</script>";
    }
}

// Handle decreasing item quantity
if (isset($_GET['action']) && $_GET['action'] == 'decrease') {
    $product_id = intval($_GET['id']);
    if ($product_id > 0 && isset($_SESSION['cart'][$product_id]) && $_SESSION['cart'][$product_id] > 1) {
        $_SESSION['cart'][$product_id] -= 1;
        //echo "<script>alert('Product quantity decreased!');</script>";
    } elseif (isset($_SESSION['cart'][$product_id]) && $_SESSION['cart'][$product_id] == 1) {
        unset($_SESSION['cart'][$product_id]); // Remove item if quantity reaches 0
        echo "<script>alert('Product removed from cart.');</script>";
    }
}

// Display the cart below this point
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Toy Store</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <a href="index.php">Home</a>
        <?php if (isset($_SESSION['username'])): ?>
            <div class="user-info" style="float: right;">
                <span>Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span>
                <a href="logout.php">Logout</a>
            </div>
        <?php else: ?>
            <a href="login.php">Login</a>
        <?php endif; ?>
    </header>

    <!-- Main Section -->
    <section>
        <h1>Your Cart</h1>
        <ul>
            <?php
            $total = 0; // Initialize the total cost variable
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $quantity) {
                    $query = "SELECT name, price FROM products WHERE id = ?"; // Ensure this matches your table name
                    if ($stmt = $conn->prepare($query)) {
                        $stmt->bind_param('i', $id);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        if ($result && $result->num_rows > 0) {
                            $product = $result->fetch_assoc();
                            echo "<li>{$product['name']} - 
                                  <a href='cart.php?action=decrease&id=$id' style='padding: 5px;'>-</a> 
                                  $quantity 
                                  <a href='cart.php?action=increase&id=$id' style='padding: 5px;'>+</a> - " . 
                                  number_format($product['price'], 2) . " USD 
                                  <a href='cart.php?action=remove&id=$id' style='color: white; background-color: red; padding: 5px; border: 0.5px solid black; border-radius: 5px;'>Remove</a></li>";
                            $total += $product['price'] * $quantity;
                        } else {
                            echo "<li>Invalid cart item: ID $id</li>";
                        }
                        $stmt->close();
                    } else {
                        echo "<li>Error fetching product details.</li>";
                    }
                }
                echo "<h3>Total: " . number_format($total, 2) . " USD</h3>";
            } else {
                echo "<p>Your cart is empty!</p>";
            }
            ?>
        </ul>
        <a href="checkout.php">Proceed to Checkout</a>
    </section>
</body>
</html>
