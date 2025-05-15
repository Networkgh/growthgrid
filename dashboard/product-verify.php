<?php


// Ensure user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    die("You must be logged in to submit a product.");
}

$username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

// Database connection
$servername = "localhost";
$db_user = "root";
$db_password = "";
$dbname = "registration";

$conn = new mysqli($servername, $db_user, $db_password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capture form fields
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

    // Handle file upload
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === 0) {
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_name = $_FILES['product_image']['name'];
        $file_tmp = $_FILES['product_image']['tmp_name'];
        $file_size = $_FILES['product_image']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (in_array($file_ext, $allowed_types) && $file_size <= 2 * 1024 * 1024) {
            $upload_dir = '../../uploads';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            $upload_path = $upload_dir . '/' . basename($file_name);
            if (move_uploaded_file($file_tmp, $upload_path)) {
                // Insert product into database
                $stmt = $conn->prepare("INSERT INTO products (product_image, product_name, product_description, product_category, product_type, price, commission, currency, sale_page_url, resources_page_url, thank_you_page_url, status, user_id, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', ?, ?)");

                if (!$stmt) {
                    die("Prepare failed: " . $conn->error);
                }

                $stmt->bind_param("sssssssssssss", $upload_path, $product_name, $product_description, $product_category, $product_type, $price, $commission, $currency, $sale_page_url, $resources_page_url, $thank_you_page_url, $user_id, $username);

                if ($stmt->execute()) {
                    echo '<script>alert("Product submitted successfully! Waiting for approval.");</script>';
                } else {
                    echo "Error inserting product: " . $stmt->error;
                }

                $stmt->close();
            } else {
                echo "Failed to upload image.";
            }
        } else {
            echo "Invalid file type or file too large.";
        }
    } else {
        echo "No image uploaded or upload error.";
    }
}

$conn->close();
?>
