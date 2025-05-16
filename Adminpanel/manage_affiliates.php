<?php
session_start();
include 'success.php';

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle account status changes
if (isset($_GET['action']) && isset($_GET['user_id'])) {
    $action = $_GET['action'];
    $user_id = intval($_GET['user_id']);
    $new_status = '';
    $success_message = '';

    // Determine the new status based on action
    switch ($action) {
        case 'ban':
            $new_status = 'Banned';
            $success_message = "Account banned successfully.";
            break;
        case 'unban':
            $new_status = 'Active';
            $success_message = "Account unbanned successfully.";
            break;
        case 'suspend':
            $new_status = 'Suspended';
            $success_message = "Account suspended successfully.";
            break;
        case 'unsuspend':
            $new_status = 'Active';
            $success_message = "Account unsuspended successfully.";
            break;
        case 'deactivate':
            $new_status = 'Deactivated';
            $success_message = "Account deactivated successfully.";
            break;
        case 'activate':
            $new_status = 'Active';
            $success_message = "Account activated successfully.";
            break;
    }

    if (!empty($new_status)) {
        $update_query = "UPDATE users SET account_status='$new_status' WHERE user_id=$user_id";
        
        if ($conn->query($update_query) === TRUE) {
            $_SESSION['success'] = $success_message;
        } else {
            $_SESSION['error'] = "Error updating account status: " . $conn->error;
        }
    }

    header('Location: manage_affiliates.php');
    exit();
}

// Modified query to combine firstname and lastname as full_name
$sql = "SELECT 
            user_id,
            CONCAT(first_name, ' ', last_name) AS full_name,
            username, 
            payment_method, 
            bank_country, 
            country_of_residence, 
            bank_name, 
            phone_number, 
            account_number, 
            account_name, 
            incoming_payout,
            account_status
        FROM users";

// Execute the query
$result = $conn->query($sql);

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Affiliate</title>
    <style>
        .suspend {
            background-color: #ffc107;
            color: white;
        }
        
        .unsuspend {
            background-color: #17a2b8;
            color: white;
        }
        
        .ban {
            background-color: #dc3545;
            color: white;
        }
        
        .unban {
            background-color: #28a745;
            color: white;
        }
        
        .deactivate {
            background-color: #6c757d;
            color: white;
        }
        
        .activate {
            background-color: #007bff;
            color: white;
        }
        
        /* General container styles */
        .container {
            margin-top: 20px;
            padding: 20px;
            max-width: 100%;
            overflow-x: auto;
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
            display: inline-block;
            margin-bottom: 5px;
        }

        .table a.btn-sm {
            padding: 5px 15px;
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
                            <td><?php echo $row['user_id']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['payment_method']; ?></td>
                            <td><?php echo $row['bank_country']; ?></td>
                            <td><?php echo $row['country_of_residence']; ?></td>
                            <td><?php echo $row['bank_name']; ?></td>
                            <td><?php echo $row['full_name']; ?></td>
                            <td><?php echo $row['account_number']; ?></td>
                            <td><?php echo $row['account_name']; ?></td>
                            <td>$<?php echo $row['incoming_payout']; ?></td>
                            <td><?php echo $row['account_status']; ?></td>
                            <td>
                                <?php if ($row['account_status'] == 'Deactivated'): ?>
                                    <a href="manage_affiliates.php?action=activate&user_id=<?php echo $row['user_id']; ?>" class="btn activate">Activate</a>
                                <?php else: ?>
                                    <a href="manage_affiliates.php?action=deactivate&user_id=<?php echo $row['user_id']; ?>" class="btn deactivate">Deactivate</a>
                                <?php endif; ?>
                                
                                <?php if ($row['account_status'] == 'Banned'): ?>
                                    <a href="manage_affiliates.php?action=unban&user_id=<?php echo $row['user_id']; ?>" class="btn unban">Unban</a>
                                <?php else: ?>
                                    <a href="manage_affiliates.php?action=ban&user_id=<?php echo $row['user_id']; ?>" class="btn ban">Ban</a>
                                <?php endif; ?>
                                
                                <?php if ($row['account_status'] == 'Suspended'): ?>
                                    <a href="manage_affiliates.php?action=unsuspend&user_id=<?php echo $row['user_id']; ?>" class="btn unsuspend">Unsuspend</a>
                                <?php else: ?>
                                    <a href="manage_affiliates.php?action=suspend&user_id=<?php echo $row['user_id']; ?>" class="btn suspend">Suspend</a>
                                <?php endif; ?>
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
</body>
</html>