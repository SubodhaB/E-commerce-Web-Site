<?php
include 'connection.php'; // Include the database connection
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin'])) {
    die("<script>alert('You must be an admin to access this page.');window.location.href = 'admin_login.php';</script>");
}

// Implement session timeout (auto logout after 30 minutes of inactivity)
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    // Last activity was more than 30 minutes ago
    session_unset(); // unset $_SESSION variable for the session
    session_destroy(); // destroy session data
    echo "<script>alert('Session timed out. Please log in again.');window.location.href = 'admin_login.php';</script>";
    exit;
}
$_SESSION['last_activity'] = time(); // update last activity timestamp

// Securely sanitize input data
function sanitize_input($data) {
    return htmlspecialchars(trim($data));
}

// Insert product
if (isset($_POST['add_product'])) {
    $name = sanitize_input($_POST['name']);
    $description = sanitize_input($_POST['description']);
    $price = sanitize_input($_POST['price']);
    $image = sanitize_input($_POST['image']);

    if (is_numeric($price) && $price > 0) {
        $query = "INSERT INTO products (name, description, price, image) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssds', $name, $description, $price, $image);

        if ($stmt->execute()) {
            echo "<script>alert('Product added successfully!');</script>";
        } else {
            echo "<script>alert('Error adding product.');</script>";
        }
    } else {
        echo "<script>alert('Invalid price.');</script>";
    }
}

// Delete product
if (isset($_POST['delete_product'])) {
    $product_id = sanitize_input($_POST['product_id']);

    if (is_numeric($product_id)) {
        $query = "DELETE FROM products WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $product_id);

        if ($stmt->execute()) {
            echo "<script>alert('Product deleted successfully!');</script>";
        } else {
            echo "<script>alert('Error deleting product.');</script>";
        }
    } else {
        echo "<script>alert('Invalid product ID.');</script>";
    }
}

// Update product
if (isset($_POST['update_product'])) {
    $product_id = sanitize_input($_POST['product_id']);
    $name = sanitize_input($_POST['name']);
    $description = sanitize_input($_POST['description']);
    $price = sanitize_input($_POST['price']);
    $image = sanitize_input($_POST['image']);

    if (is_numeric($price) && $price > 0 && is_numeric($product_id)) {
        $query = "UPDATE products SET name = ?, description = ?, price = ?, image = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('ssdsi', $name, $description, $price, $image, $product_id);

        if ($stmt->execute()) {
            echo "<script>alert('Product updated successfully!');</script>";
        } else {
            echo "<script>alert('Error updating product.');</script>";
        }
    } else {
        echo "<script>alert('Invalid data. Please check the product ID or price.');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Manage Products</title>
    <link rel="stylesheet" href="admin_styles.css">
</head>
<body>
    <h1>Admin Panel - Manage Products</h1>

    <!-- Insert Product Form -->
    <h2>Add New Product</h2>
    <form method="POST" action="">
        <label>Product Name:</label>
        <input type="text" name="name" required><br>
        <label>Description:</label>
        <textarea name="description" required></textarea><br>
        <label>Price:</label>
        <input type="number" step="0.01" name="price" required><br>
        <label>Image URL:</label>
        <input type="text" name="image" required><br>
        <button type="submit" name="add_product">Add Product</button>
    </form>

    <!-- Delete Product Form -->
    <h2>Delete Product</h2>
    <form method="POST" action="">
        <label>Product ID:</label>
        <input type="number" name="product_id" required><br>
        <button type="submit" name="delete_product">Delete Product</button>
    </form>

    <!-- Update Product Form -->
    <h2>Update Product</h2>
    <form method="POST" action="">
        <label>Product ID:</label>
        <input type="number" name="product_id" required><br>
        <label>Product Name:</label>
        <input type="text" name="name" required><br>
        <label>Description:</label>
        <textarea name="description" required></textarea><br>
        <label>Price:</label>
        <input type="number" step="0.01" name="price" required><br>
        <label>Image URL:</label>
        <input type="text" name="image" required><br>
        <button type="submit" name="update_product">Update Product</button>
    </form>

    <!-- Display All Products -->
    <h2>All Products</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
        </tr>
        <?php
        $query = "SELECT * FROM products";
        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['description']}</td>";
            echo "<td>\${$row['price']}</td>";
            echo "<td><img src='{$row['image']}' width='50'></td>";
            echo "</tr>";
        }
        ?>
    </table>
</body>
</html>
