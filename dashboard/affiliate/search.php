<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch approved products from the database (assuming 'status' column for approval)
$sql = "SELECT product_name, price, commission, product_image, product_id FROM products WHERE status = 'approved'";
$result = $conn->query($sql);

// Check if there are any approved products
if ($result->num_rows > 0) {
    // Loop through and display each approved product
    while($product = $result->fetch_assoc()) {
        echo '<div class="product-card">';
        echo '<h3>' . htmlspecialchars($product['product_name']) . '</h3>';
        echo '<p>Price: $' . htmlspecialchars($product['price']) . '</p>';
        echo '<p>Commission: ' . htmlspecialchars($product['commission']) . '%</p>';
        
        // Adding product image
        if (!empty($product['product_image'])) {
            echo '<img src="../../uploads/' . htmlspecialchars($product['product_image']) . '" alt="Product Image">';
        } else {
            echo '<p>No image available.</p>';
        }

        echo '<a href="product_details.php?product_id=' . $product['product_id'] . '" class="btn">View Details</a>';
        echo '</div>';
    }
} else {
    echo "No approved products found.";
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contest Information</title>
    <style>
         
</body>
</html>