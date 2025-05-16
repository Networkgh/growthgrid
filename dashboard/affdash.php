<?php
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['login_error'] = "Please login first.";
    header('Location: ../login.php');
    exit();
}


//est of your dashboard code

include 'includes/affiliate-navbar.php';
include 'payout.php';
include 'includes/user-count.php';

include 'includes/earnings.php';
include 'includes/ads.php';




// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

$db = new mysqli($servername, $username, $password, $dbname);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Fetch payout records for the logged-in user
$payouts = [];
$query = "SELECT payout_id, amount AS payout_amount, request_date AS payout_date, status AS payout_status 
          FROM payouts 
          WHERE user_id = ? 
          ORDER BY request_date DESC";

$stmt = $db->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $payouts[] = $row;
}

$stmt->close();
$db->close();
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Affiliate Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">


    <style>


body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f9fa;
    
}

.header1 {
   background-color: #2c3e50;
   
            padding: 1rem;
            color: white;
            text-align: center;
            font-size: 1.5rem;
        }

        .header1 h2{
            font-size: 20px;
            font-style: italic;
        }


.logo {
    font-size: 1.5em;
    font-weight: bold;
}

.user-info {
    display: flex;
    align-items: center;
}

.user-name {
    margin-right: 10px;
}

.user-icon {
    width: 40px;
    height: 40px;
    border-radius: 50%;
}

.dashboard {
    padding: 20px;
}

.dashboard-overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.card {
    background-color: #fff;
    border-radius: 8px;
    padding: 40px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
}
.card p{
    color: #2ecc71;
}


.affiliate-rank {
    background-color: #000;
    color: #fff;
}

.btn-request-payout {
    background-color: #28a745;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
}

.recent-transactions {
    background-color: #fff;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.recent-transactions h3 {
    margin-bottom: 10px;
}

.recent-transactions ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.recent-transactions li {
    padding: 10px 0;
    border-bottom: 1px solid #eee;
}

.view-all {
    display: block;
    text-align: right;
    margin-top: 10px;
    color: #007bff;
    text-decoration: none;
}

.promo-banner {
    background-color: #f3f4f6;
    padding: 20px;
    border-radius: 8px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.promo-content h3 {
    margin: 0 0 10px 0;
}

.promo-content p {
    margin: 0;
}


@media (max-width: 768px) {
    .dashboard-overview {
        grid-template-columns: 1fr;
    }

    .header{
                font-size: 1.2rem;
            }

   
}


@media (max-width: 480px) {
            
            
        }


        .payouts-table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
    text-align: left;
}

.payouts-table th, .payouts-table td {
    padding: 12px;
    border: 1px solid #ddd;
}

.payouts-table th {
    background-color: #f4f4f4;
    font-weight: bold;
}

.payouts-table td {
    background-color: #fff;
}

.payouts-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.payouts-table tr:hover {
    background-color: #f1f1f1;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
    .payouts-table, .payouts-table thead, .payouts-table tbody, .payouts-table th, .payouts-table td, .payouts-table tr {
        display: block;
    }
 
    .payouts-table thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
    }

    .payouts-table tr {
        margin: 0 0 20px 0;
    }

    .payouts-table td {
        border: none;
        position: relative;
        padding-left: 50%;
        text-align: right;
    }

    .payouts-table td:before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 45%;
        padding-left: 15px;
        font-weight: bold;
        text-align: left;
        white-space: nowrap;
    }
}

/* For smaller devices (Mobile, below 480px) */
@media screen and (max-width: 480px) {
    .payouts-table td {
        font-size: 14px;
        padding-left: 40%;
    }

    .payouts-table td:before {
        font-size: 14px;
    }
}






/* Base style for all statuses */
.payouts-table td {
    padding: 12px;
    text-align: left;
}

/* Status-specific colors */
.status-pending {
    background-color: #ffecb3; /* Light yellow */
    color: #c79100;
    font-weight: bold;
}

.status-rejected {
    background-color: #ffcccb; /* Light red */
    color: red;
    font-weight: bold;
}

.status-completed {
    background-color: #d4edda; /* Light green */
    color: #155724;
    font-weight: bold;
}

/* Responsive table styles (for smaller devices) */
@media screen and (max-width: 768px) {
    .payouts-table, .payouts-table thead, .payouts-table tbody, .payouts-table th, .payouts-table td, .payouts-table tr {
        display: block;
    }

    .payouts-table thead tr {
        position: absolute;
        top: -9999px;
        left: -9999px;
    }

    .payouts-table tr {
        margin: 0 0 20px 0;
    }

    .payouts-table td {
        border: none;
        position: relative;
        padding-left: 50%;
        text-align: right;
    }

    .payouts-table td:before {
        content: attr(data-label);
        position: absolute;
        left: 0;
        width: 45%;
        padding-left: 15px;
        font-weight: bold;
        text-align: left;
        white-space: nowrap;
    }
}

/* For smaller devices (Mobile, below 480px) */
@media screen and (max-width: 480px) {
    .payouts-table td {
        font-size: 14px;
        padding-left: 40%;
    }

    .payouts-table td:before {
        font-size: 14px;
    }
}


    </style>
</head>
<body>
   

    

    <main class="dashboard">
        <div class="dashboard-overview">
            <div class="card">
                <h3>Total Earnings</h3>
                <br>
                <p>$<?php echo number_format($total_earnings, 2); ?> </p>                <br>
                <br>

                <small>Updated few mins ago</small>
            </div>
            <div class="card">
                <h3>Number of Sales</h3>                <br>

                 <p><?php echo number_format($number_of_sales); ?></p>                <br>
                 <br>

                <small>Updated few mins ago</small>
            </div>
            <div class="card affiliate-rank">
                <h3>Incoming Payout </h3>                <br>

                <p><?php echo date("F j, Y", strtotime($nextPayoutDate)); ?></p>
                <p>Amount:<br><?php echo number_format($incoming_payout, 2); ?> USD</p>
                
               <form id="requestPayoutForm" action="request_payout.php" method="post">
               <input type="hidden" name="amount" value="<?php echo $incoming_payout; ?>">
               <button type="submit" class="btn-request-payout">Request Payout</button>
               </form>
            </div>
            <div class="card">
                <h3>Number of Users</h3>                <br>

                <p><?php echo $userCount; ?></p>                <br>
                <br>

                <small>Updated few mins ago</small>
            </div>
        </div>
    </main>

    <table class="payouts-table">
    <thead>
        <tr>
            <th>Payout ID</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
    <tbody>
    <?php if (count($payouts) > 0): ?>
        <?php foreach ($payouts as $payout): ?>
            <?php
            // Determine the class based on the payout status
            $status_class = '';
            switch ($payout['payout_status']) {
                case 'pending':
                    $status_class = 'status-pending';
                    break;
                case 'rejected':
                    $status_class = 'status-rejected';
                    break;
                case 'completed':
                    $status_class = 'status-completed';
                    break;
                default:
                    $status_class = '';
                    break;
            }
            ?>
            <tr>
                <td data-label="Payout ID"><?php echo $payout['payout_id']; ?></td>
                <td data-label="Amount"><?php echo number_format($payout['payout_amount'], 2); ?> USD</td>
                <td data-label="Date"><?php echo date('d M Y', strtotime($payout['payout_date'])); ?></td>
                <td data-label="Status" class="<?php echo $status_class; ?>">
                    <?php echo ucfirst($payout['payout_status']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="4">No payout requests found.</td>
        </tr>
    <?php endif; ?>
</tbody>

    </tbody>
</table>





</body>
</html>
