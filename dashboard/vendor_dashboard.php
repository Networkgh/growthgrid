 <?php
session_start();


if (!isset($_SESSION['username'])) {
    echo "Unauthorized access. Please log in.";
    exit();
}
// Include necessary files
include 'includes/vender-navbar.php';
include 'includes/earnings.php';
include 'payout.php';

include 'includes/user-count.php';




?>
<?php
// Rest of your dashboard code
include 'includes/user-count.php';


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .dashboard-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px;
            margin-top:50px;
        }
        .card {
            flex: 1 1 45%;
            background-color: #ECF0F1;
            margin: 10px;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .payout-section {
            background-color: #34495E;
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 10px;
        }
        .payout-section button {
            background-color: #1ABC9C;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        @media (max-width: 768px) {
            .navbar .links {
                display: none;
            }
            .navbar .menu {
                display: block;
                cursor: pointer;
            }
            .dashboard-container {
                flex-direction: column;
            }
            .card, .payout-section {
                flex: 1 1 100%;
            }
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
    
    
    <div class="dashboard-container">
        
        <div class="card">
        <h3>Total Earnings</h3>                <br>

        <p>$<?php echo number_format($total_earnings, 2); ?> </p>
           
        </div>
        <div class="card">
            <h3>Number of Sales</h3>                <br>

            <p><?php echo number_format($number_of_sales); ?></p>
        </div>
        <div class="card">
            <h3>Number of Products</h3>                <br>

            <p><?php echo number_format($product_count); ?></p>
           
        </div>
        <div class="card">
            <h3>Number of Affiliates</h3>                <br>

            <p>0</p>
        </div>
        <div class="payout-section">
        <h3>Incoming Payout </h3>                <br>

                <p><?php echo date("F j, Y", strtotime($nextPayoutDate)); ?></p>
                <p>Amount:<br><?php echo number_format($incoming_payout, 2); ?> USD</p>
                
                <form id="requestPayoutForm" action="request_payout.php" method="post">
               <input type="hidden" name="amount" value="<?php echo $incoming_payout; ?>">
               <button type="submit" class="btn-request-payout">Request Payout</button>
               </form>
        </div>
    </div>



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
