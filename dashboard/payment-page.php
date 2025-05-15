<?php
session_start();



// Include the navbar and start the session if necessary
include 'includes/navbar.php';


// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, '3304');

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Capture the `product_id` and `affiliate_username` from the URL
$product_id = isset($_GET['product_id']) ? $_GET['product_id'] : null;
$affiliate_username = isset($_GET['affiliate_username']) ? $_GET['affiliate_username'] : null;

// Validate input
if (!$product_id || !$affiliate_username) {
    die("Invalid request. Product ID and Affiliate Username are required.");
}

// Store the affiliate username in the session for later use
$_SESSION['affiliate_username'] = $affiliate_username;

// Fetch product details from the database
$query = "SELECT * FROM products WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

if (!$product) {
    die("Product not found.");
}

// Extract product details
$product_name = $product['product_name'];
$price = $product['price'];
$currency = $product['currency'];

// Display product information and initiate payment
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
</head>
<body>
    <h1>Buy Now: <?php echo htmlspecialchars($product_name); ?></h1>
    <p>Price: <?php echo htmlspecialchars($currency . ' ' . $price); ?></p>
    <button id="pay-now">Pay Now</button>

    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        document.getElementById('pay-now').addEventListener('click', function() {
            var handler = PaystackPop.setup({
                key: 'YOUR_PUBLIC_KEY', // Replace with your Paystack public key
                email: 'customer@example.com', // Replace with the customer's email
                amount: <?php echo $price * 100; ?>, // Amount in kobo
                currency: '<?php echo $currency; ?>',
                ref: 'PS_' + Math.floor((Math.random() * 1000000000) + 1), // Generate a unique reference
                callback: function(response) {
                    // Redirect to the verification page
                    window.location.href = 'verify_transaction.php?reference=' + response.reference;
                },
                onClose: function() {
                    alert('Transaction was not completed.');
                }
            });
            handler.openIframe();
        });
    </script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
