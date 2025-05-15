<?php
session_start();
include 'includes/navbar.php';

// Ensure the vendor is logged in
if (!isset($_SESSION['vendor_username'])) {
    die("Access denied. Please log in.");
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Connect to the database
$db = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize variables for the product
$product_id = $product_name = $product_description = $product_category = $product_type = $price = $commission = $currency = $sale_page_url = $resources_page_url = $thank_you_page_url = $status = $product_image = "";

// Check if product ID is passed in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // SQL query to fetch product details
    $sql = 'SELECT product_image, product_name, product_description, product_category, product_type, price, commission, currency, sale_page_url, resources_page_url, thank_you_page_url, status
            FROM products
            WHERE product_id = ? AND vendor_username = ?';

    if ($stmt = mysqli_prepare($db, $sql)) {
        mysqli_stmt_bind_param($stmt, 'is', $product_id, $_SESSION['vendor_username']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $product_name = htmlspecialchars($row['product_name']);
            $product_category = htmlspecialchars($row['product_category']);
            $product_type = htmlspecialchars($row['product_type']);
            $price = htmlspecialchars($row['price']);
            $commission = htmlspecialchars($row['commission']);
            $currency = htmlspecialchars($row['currency']);
            $sale_page_url = htmlspecialchars($row['sale_page_url']);
            $resources_page_url = htmlspecialchars($row['resources_page_url']);
            $thank_you_page_url = htmlspecialchars($row['thank_you_page_url']);
            $status = htmlspecialchars($row['status']);
            $product_image = htmlspecialchars($row['product_image']);
            $product_description = htmlspecialchars($row['product_description']);
        } else {
            die("Product not found or you do not have permission to edit this product.");
        }
    } else {
        die("Failed to prepare statement: " . mysqli_error($db));
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $product_name = $_POST['product_name'];
    $product_category = $_POST['product_category'];
    $product_type = $_POST['product_type'];
    $price = $_POST['price'];
    $commission = $_POST['commission'];
    $currency = $_POST['currency'];
    $sale_page_url = $_POST['sale_page_url'];
    $resources_page_url = $_POST['resources_page_url'];
    $thank_you_page_url = $_POST['thank_you_page_url'];
    $status = 'pending'; // Set status to pending when updated
    $product_description = $_POST['product_description'];

    // Handle image upload
    if (!empty($_FILES['product_image']['name'])) {
        $target_dir = "../../uploads/";  // Correct the path to growthgrid/uploads
        $target_file = $target_dir . basename($_FILES["product_image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["product_image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["product_image"]["size"] > 500000) {
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // If everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $target_file)) {
                $product_image = basename($_FILES["product_image"]["name"]);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // SQL query to update product details
    $update_sql = "UPDATE products 
                   SET product_name = ?, product_category = ?, product_type = ?, price = ?, commission = ?, currency = ?, sale_page_url = ?, resources_page_url = ?, thank_you_page_url = ?, status = ?, product_description = ?, product_image = ? 
                   WHERE product_id = ? AND vendor_username = ?";
    
    if ($stmt = mysqli_prepare($db, $update_sql)) {
        mysqli_stmt_bind_param($stmt, 'ssssssssssssss', $product_name, $product_category, $product_type, $price, $commission, $currency, $sale_page_url, $resources_page_url, $thank_you_page_url, $status, $product_description, $product_image, $product_id, $_SESSION['vendor_username']);
        
        if (mysqli_stmt_execute($stmt)) {
            echo '<script>alert("Product updated successfully! Waiting for approval.");</script>';
        } else {
            echo "Error updating product: " . mysqli_error($db);
        }
    } else {
        die("Failed to prepare statement: " . mysqli_error($db));
    }
}

mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Styles as you provided */
    </style>
</head>
<body>
    <main class="content">
        <h1>Edit Product</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <!-- Image Section -->
            <div class="form-group">
                <label for="product_image">Product Image:</label>
                <input type="file" id="product_image" name="product_image" onchange="previewImage()">
                <?php if (!empty($product_image)): ?>
                    <img id="preview" src="../../uploads/<?php echo $product_image; ?>" alt="Product Image">
                <?php else: ?>
                    <img id="preview" src="#" alt="New Product Image" style="display: none;">
                <?php endif; ?>
            </div>

            <!-- Name -->
            <div class="form-group">
                <label for="product_name">Product Name:</label>
                <input type="text" id="product_name" name="product_name" value="<?php echo $product_name; ?>" required>
            </div>

            <!-- Category -->
            <div class="form-group">
                <label for="product_category">Category:</label>
                <input type="text" id="product_category" name="product_category" value="<?php echo $product_category; ?>" required>
            </div>

            <!-- Product Type -->
            <div class="form-group">
                <label for="product_type">Product Type:</label>
                <input type="text" id="product_type" name="product_type" value="<?php echo $product_type; ?>" required>
            </div>

            <!-- Price -->
            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" value="<?php echo $price; ?>" required>
            </div>

            <!-- Commission -->
            <div class="form-group">
                <label for="commission">Commission:</label>
                <input type="number" id="commission" name="commission" step="0.01" value="<?php echo $commission; ?>" required>
            </div>

            <!-- Currency -->
            <div class="form-group">
                <label for="currency">Currency:</label>
                <input type="text" id="currency" name="currency" value="<?php echo $currency; ?>" required>
            </div>

            <!-- Sale Page URL -->
            <div class="form-group full-width">
                <label for="sale_page_url">Sale Page URL:</label>
                <input type="url" id="sale_page_url" name="sale_page_url" value="<?php echo $sale_page_url; ?>" required>
            </div>

            <!-- Resources Page URL -->
            <div class="form-group full-width">
                <label for="resources_page_url">Resources Page URL:</label>
                <input type="url" id="resources_page_url" name="resources_page_url" value="<?php echo $resources_page_url; ?>" required>
            </div>

            <!-- Thank You Page URL -->
            <div class="form-group full-width">
                <label for="thank_you_page_url">Thank You Page URL:</label>
                <input type="url" id="thank_you_page_url" name="thank_you_page_url" value="<?php echo $thank_you_page_url; ?>" required>
            </div>

            <!-- Description -->
            <div class="form-group full-width">
                <label for="product_description">Description:</label>
                <textarea id="product_description" name="product_description" rows="5" required><?php echo $product_description; ?></textarea>
            </div>

            <!-- Buttons -->
            <div class="btn-group full-width">
                <button type="submit">Update Product</button>
                <button type="button" class="cancel-btn" onclick="window.location.href='my-products.php';">Cancel</button>
            </div>
        </form>
    </main>
    <script>
        function previewImage() {
            const file = document.getElementById("product_image").files[0];
            const reader = new FileReader();
            reader.onloadend = function() {
                const preview = document.getElementById("preview");
                preview.src = reader.result;
                preview.style.display = "block";
            };
            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</body>
</html>
