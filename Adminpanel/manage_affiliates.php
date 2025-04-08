<?php
session_start();
include 'success.php';

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
if (isset($_GET['action']) && isset($_GET['affiliate_id'])) {
    $action = $_GET['action'];
    $affiliate_id = intval($_GET['affiliate_id']);

    if ($action == 'deactivate') {
        // Update product status to approved
        $update_query = "UPDATE affiliates SET account_status='deactivate' WHERE affiliate_id=$affiliate_id";
    } elseif ($action == 'ban') {
        // Update product status to rejected
        $update_query = "UPDATE affiliates SET account_status='Banned' WHERE affiliate_id=$affiliate_id";
    }

    if (isset($update_query) && $conn->query($update_query) === TRUE) {
        $_SESSION['success'] = "payout status updated successfully.";
    } else {
        $_SESSION['error'] = "Error updating product status: " . $conn->error;
    }

    // Redirect back to the manage products page to prevent form resubmission
    header('Location: manage_affiliates.php');
    exit();
}


$sql = "SELECT affiliate_id,affiliate_username, payment_method, bank_country, country_of_residence, bank_name, phone_number, account_number, account_name, incoming_payout ,account_status
        FROM affiliates";

// Execute the query
$result = $conn->query($sql)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Affiliate</title>
    <!-- Bootstrap CSS -->
    <!--<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">-->

<style>
/* General container styles */
.container {
    margin-top: 20px;
    padding: 20px;
    max-width: 100%;
    overflow-x: auto; /* Enable horizontal scrolling */
}

/* General table styles */
.table {
    width: 100%;
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    margin-top: 20px;
}

.table thead {
    background-color: #007bff;
    color: white;
    text-align: left;
}

.table th, .table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
}

.table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Hover effect for table rows */
.table tbody tr:hover {
    background-color: #f1f1f1;
}

/* Header cell styling */
.table th {
    text-transform: uppercase;
    font-weight: 600;
}

/* Action buttons styling */
.table a.btn {
    padding: 5px 10px;
    font-size: 12px;
    text-transform: uppercase;
    border-radius: 5px;
    text-decoration: none;
    margin-right: 5px;
}

.table a.btn-sm {
    padding: 5px 15px;
}

.table a.btn-success {
    background-color: #28a745;
    color: white;
}

.table a.btn-danger {
    background-color: #dc3545;
    color: white;
}

/* Add hover effects for buttons */
.table a.btn:hover {
    opacity: 0.8;
}

/* Optional: Styling for "No affiliate found" */
.table td.text-center {
    text-align: center;
    color: #6c757d;
    font-weight: bold;
}

/* Responsive design for mobile devices */
@media (max-width: 768px) {
    .table, .table thead, .table tbody, .table th, .table td, .table tr {
        display: block;
        width: 100%;
    }
    .table tr {
        margin-bottom: 10px;
        display: block;
    }
    .table th {
        position: relative;
        padding-left: 50%;
        white-space: nowrap;
    }
    .table th::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        font-weight: bold;
        text-transform: uppercase;
    }
    .table td {
        position: relative;
        padding-left: 50%;
    }
    .table td::before {
        content: attr(data-label);
        position: absolute;
        left: 15px;
        font-weight: bold;
        text-transform: uppercase;
    }
}
</style>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Manage Affiliate</h2>

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

    <div class="table-responsive">
        <table class="table table-bordered table-striped mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Payment Method</th>
                    <th>Bank Country</th>
                    <th>Country</th>
                    <th>Bank Name</th>
                    <th>Full Name</th>
                    <th>Account Number</th>
                    <th>Account Name</th>
                    <th>Next Payout</th>
                    <th>Account Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['affiliate_id']; ?></td>
                            <td><?php echo $row['affiliate_username']; ?></td>
                            <td><?php echo $row['payment_method']; ?></td>
                            <td><?php echo $row['bank_country']; ?></td>
                            <td><?php echo $row['country_of_residence']; ?></td>
                            <td><?php echo $row['bank_name']; ?></td>
                            
                            <td><?php echo $row['account_number']; ?></td>
                            <td><?php echo $row['account_name']; ?></td>
                            <td>$<?php echo $row['incoming_payout']; ?></td>
                            <td><?php echo $row['account_status']; ?></td>
                            <td>
                                <!-- Ensure the URLs are correct, using relative or absolute paths -->
                                <a href="manage_affiliates.php?action=deactivate&affiliate_id=<?php echo $row['affiliate_id']; ?>" class="btn btn-success btn-sm">Deactivate</a>
                                <a href="manage_affiliates.php?action=ban&affiliate_id=<?php echo $row['affiliate_id']; ?>" class="btn btn-danger btn-sm">Ban</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="12" class="text-center">No affiliate found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
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
