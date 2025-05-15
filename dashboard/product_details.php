<?php
session_start();

// Include the navbar and ads
include 'includes/affiliate-navbar.php';
include 'includes/ads.php';

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

// Check if the product ID is provided
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Fetch product details from the database
    $sql = "SELECT product_name, price, commission, product_description, product_image, sale_page_url, resources_page_url FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if the product exists
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();

        // Check if the user is logged in
        if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
            $user_id = $_SESSION['user_id'];
            $affiliate_username = $_SESSION['username'];
            
            // Generate the affiliate link with domain, product ID, user ID, and username
            $domain = "https://www.yourdomain.com"; // Replace with your actual domain
            $affiliate_link = $domain . "/product.php?product_id=" . urlencode($product_id) . 
                              "&aff_id=" . urlencode($user_id) . 
                              "&ref=" . urlencode($affiliate_username);
        } else {
            echo "Please log in to generate your affiliate link.";
            exit;
        }
    } else {
        echo "Product not found.";
        exit;
    }
} else {
    echo "Invalid product ID.";
    exit;
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .product-image-container {
            flex: 1;
            max-width: 40%;
            text-align: center;
        }

        .product-image-container img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .product-details-container {
            flex: 2;
            max-width: 60%;
            padding: 20px;
        }

        h1, h3 {
            margin: 10px 0;
            color: #333;
        }

        h1 {
            text-transform: uppercase;
        }

        p {
            margin: 5px 0;
            color: #555;
        }

        .affiliate-link {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 4px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .affiliate-link input {
            flex: 1;
            border: none;
            background: transparent;
            padding: 5px;
            font-size: 14px;
            margin-right: 10px;
            color: #333;
            min-width: 200px;
        }

        .btn {
            background-color: #00b894;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            text-align: center;
            margin: 10px 0;
            display: inline-block;
            width: 100%;
            max-width: 200px;
        }

        .btn:hover {
            background-color: #019d7f;
        }

        .btn-secondary {
            background-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .link-info {
            background-color: #e7f5ff;
            padding: 10px;
            border-radius: 4px;
            margin: 10px 0;
            font-size: 14px;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                padding: 10px;
            }

            .product-image-container,
            .product-details-container {
                max-width: 100%;
            }

            .affiliate-link {
                flex-direction: column;
                gap: 10px;
            }

            .btn {
                max-width: 100%;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            h1 {
                font-size: 20px;
            }

            .product-image-container img {
                max-height: 200px;
            }

            .btn {
                font-size: 14px;
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Product Image Section -->
        <div class="product-image-container">
            <?php if (!empty($product['product_image'])): ?>
                <img src="../../uploads/<?php echo htmlspecialchars($product['product_image']); ?>" alt="Product Image">
            <?php else: ?>
                <p>No product image available.</p>
            <?php endif; ?>
        </div>

        <!-- Product Details Section -->
        <div class="product-details-container">
            <h1><?php echo htmlspecialchars($product['product_name']); ?></h1>
            <p><strong>Price:</strong> $<?php echo htmlspecialchars($product['price']); ?></p>
            <p><strong>Commission:</strong> <?php echo htmlspecialchars($product['commission']); ?>%</p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($product['product_description']); ?></p>

            <h3>Your Affiliate Link</h3>
            <div class="link-info">
                Share this link to earn <?php echo htmlspecialchars($product['commission']); ?>% commission on every sale!
            </div>
            <div class="affiliate-link">
                <input type="text" value="<?php echo htmlspecialchars($affiliate_link); ?>" id="affiliate-link" readonly>
                <button onclick="copyAffiliateLink()" class="btn-secondary">Copy Link</button>
            </div>

            <h3>Sales and Resources</h3>
            <a href="<?php echo htmlspecialchars($product['sale_page_url']); ?>" class="btn" target="_blank">View Sales Page</a>
            <a href="<?php echo htmlspecialchars($product['resources_page_url']); ?>" class="btn" target="_blank">Access Resources Page</a>
            
            <!-- Social sharing buttons -->
            <h3>Share Your Link</h3>
            <div class="social-sharing">
                <button onclick="shareOnFacebook()" class="btn" style="background-color: #3b5998;">Share on Facebook</button>
                <button onclick="shareOnTwitter()" class="btn" style="background-color: #1da1f2;">Share on Twitter</button>
                <button onclick="shareViaEmail()" class="btn" style="background-color: #6c757d;">Share via Email</button>
            </div>
        </div>
    </div>

    <script>
        function copyAffiliateLink() {
            var copyText = document.getElementById("affiliate-link");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            document.execCommand("copy");
            
            // Show a nice notification
            var originalText = copyText.value;
            copyText.value = "Copied to clipboard!";
            setTimeout(function() {
                copyText.value = originalText;
            }, 2000);
        }
        
        function shareOnFacebook() {
            var link = encodeURIComponent(document.getElementById("affiliate-link").value);
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${link}`, '_blank');
        }
        
        function shareOnTwitter() {
            var link = encodeURIComponent(document.getElementById("affiliate-link").value);
            var text = encodeURIComponent("Check out this amazing product: ");
            window.open(`https://twitter.com/intent/tweet?text=${text}&url=${link}`, '_blank');
        }
        
        function shareViaEmail() {
            var link = encodeURIComponent(document.getElementById("affiliate-link").value);
            var subject = encodeURIComponent("Amazing product you might like");
            var body = encodeURIComponent(`Hi,\n\nI thought you might be interested in this product:\n\n${link}\n\nBest regards,`);
            window.location.href = `mailto:?subject=${subject}&body=${body}`;
        }

       // https://www.yourdomain.com/product.php?product_id=62&aff_id=16&ref=Nathaniel
    </script>
</body>
</html>