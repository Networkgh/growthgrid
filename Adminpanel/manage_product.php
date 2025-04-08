<?php
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, );

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle approval or rejection
if (isset($_GET['action']) && isset($_GET['product_id'])) {
    $action = $_GET['action'];
    $product_id = intval($_GET['product_id']);

    if ($action == 'approve') {
        // Update product status to approved
        $update_query = "UPDATE products SET status='approved' WHERE product_id=$product_id";
    } elseif ($action == 'reject') {
        // Update product status to rejected
        $update_query = "UPDATE products SET status='rejected' WHERE product_id=$product_id";
    }

    if (isset($update_query) && $conn->query($update_query) === TRUE) {
        $_SESSION['success'] = "Product status updated successfully.";
    } else {
        $_SESSION['error'] = "Error updating product status: " . $conn->error;
    }

    // Redirect back to the manage products page to prevent form resubmission
    header('Location: manage_product.php');
    exit();
}

// Fetch all pending products
$sql = "SELECT * FROM products WHERE status='pending'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Manage Products</h2>

    <!-- Display success or error messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success">
            <?php 
                echo $_SESSION['success']; 
                unset($_SESSION['success']);
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?php 
                echo $_SESSION['error']; 
                unset($_SESSION['error']);
            ?>
        </div>
    <?php endif; ?>

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Sales Page</th>
                <th>Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['product_id']; ?></td>
                        <td><?php echo $row['product_name']; ?></td>
                        <td><?php echo $row['product_description']; ?></td>
                        <td><?php echo $row['product_category']; ?></td>
                        <td><?php echo $row['sale_page_url']; ?></td>
                        <td>$<?php echo $row['price']; ?></td>
                        <td><?php echo ucfirst($row['status']); ?></td>
                            <td>
                            <!-- Ensure the URLs are correct, using relative or absolute paths -->
                            <a href="manage_product.php?action=approve&product_id=<?php echo $row['product_id']; ?>" class="btn btn-success btn-sm">Approve</a>
                            <a href="manage_product.php?action=reject&product_id=<?php echo $row['product_id']; ?>" class="btn btn-danger btn-sm">Reject</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10" class="text-center">No pending products found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Close the connection
$conn->close();
?>
