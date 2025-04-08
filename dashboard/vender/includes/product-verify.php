<?php

// Start session and get vendor username
session_start();
$vendor_username = $_SESSION['vendor_username'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form data
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_category = $_POST['product_category'];
    $product_type = $_POST['product_type'];
    $price = $_POST['price'];
    $commission = $_POST['commission'];
    $currency = $_POST['currency'];
    $sale_page_url = $_POST['sale_page'];
    $resources_page_url = $_POST['resource_page'];
    $thank_you_page_url = $_POST['thank_you_page'];

    // Retrieve vendor_id from session
    $vendor_username = $_SESSION['vendor_username'];

    // Handle file upload
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_name = $_FILES['product_image']['name'];
        $file_size = $_FILES['product_image']['size'];
        $file_tmp = $_FILES['product_image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        // Check file type and size
        if (in_array($file_ext, $allowed_types) && $file_size <= 2 * 1024 * 1024) { // 2MB limit
            // Ensure the uploads directory exists in the correct location inside the growthgrid folder
            $upload_dir = '../../uploads'; // Path relative to script
            if (!file_exists($upload_dir)) {
                echo "Upload directory does not exist. Trying to create it...";
                mkdir($upload_dir, 0777, true); // Create the uploads directory if it doesn't exist
            } else {
                echo "Upload directory exists.";
            }

            $upload_path = $upload_dir . '/' . basename($file_name);

            // Move the uploaded file
            if (move_uploaded_file($file_tmp, $upload_path)) {
                // Prepare the SQL statement for inserting product data
                $stmt = $conn->prepare("INSERT INTO products (product_image, product_name, product_description, product_category, product_type, price, commission, currency, sale_page_url, resources_page_url, thank_you_page_url, status, vendor_id, vendor_username) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?, ?)");

                // Check if preparation was successful
                if ($stmt === false) {
                    die('Prepare failed: ' . htmlspecialchars($conn->error));
                }

                // Bind parameters
                $stmt->bind_param("sssssssssssss", $upload_path, $product_name, $product_description, $product_category, $product_type, $price, $commission, $currency, $sale_page_url, $resources_page_url, $thank_you_page_url, $vendor_id, $vendor_username);

                // Execute the SQL statement
                if ($stmt->execute()) {
                    echo '<script>alert("Product submitted successfully! Waiting for approval.");</script>';
                } else {
                    echo "Error: " . $stmt->error;
                }

                // Close the statement
                $stmt->close();
            } else {
                echo "Error uploading the image file.";
            }
        } else {
            echo "Invalid file type or file too large.";
        }
    } else {
        echo "No file uploaded or error in file upload.";
    }
}

// Close the database connection
$conn->close();

?>
