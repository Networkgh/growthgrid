<?php
session_start();

// Check if the vendor is logged in
if (!isset($_SESSION['vendor_username'])) {
    die("Access denied. Please log in.");
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";


// Connect to the database
$db = mysqli_connect($servername, $username, $password, $dbname, );

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if product ID is passed in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // SQL query to update the product status to 'pending'
    $update_sql = "UPDATE products SET status = 'pending' WHERE product_id = ?";
    $update_stmt = mysqli_prepare($db, $update_sql);
    mysqli_stmt_bind_param($update_stmt, 'i', $product_id);
    
    if (mysqli_stmt_execute($update_stmt)) {
        // Redirect back to the vendor's product page with a success message
        $_SESSION['success'] = "Product has been successfully activated.";
        header('Location: my-products.php');
        exit();
    } else {
        echo "Error activating product: " . mysqli_error($db);
    }

} else {
    die("Invalid request.");
}

mysqli_close($db);
?>
