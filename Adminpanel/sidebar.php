<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel Sidebar</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #343a40;
            padding-top: 20px;
        }
        .sidebar a {
            color: #fff;
            padding: 15px 20px;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .sidebar .active {
            background-color: #007bff;
            color: #fff;
        }
        .sidebar .icon {
            font-size: 18px;
            margin-right: 15px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
            <a class="nav-link active" href="manage_product.php">
                    <i class="icon fas fa-box"></i><span>Dashboard</span>
                </a>
                <a class="nav-link active" href="manage_product.php">
                    <i class="icon fas fa-box"></i><span>Manage Products</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage_vendors.php">
                    <i class="icon fas fa-industry"></i><span>Manage Vendors</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage_affiliates.php">
                    <i class="icon fas fa-user-friends"></i><span>Manage Affiliates</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="payment_status.php">
                    <i class="icon fas fa-credit-card"></i><span>Payment Status</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="manage_users.php">
                    <i class="icon fas fa-users"></i><span>Manage Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="view_reports.php">
                    <i class="icon fas fa-chart-line"></i><span>View Reports</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="payout.php">
                    <i class="icon fas fa-chart-line"></i><span>Payouts</span>
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="payout.php">
                    <i class="icon fas fa-chart-line"></i><span></span>
                </a>
            </li>



            <li class="nav-item">
                <a class="nav-link" href="settings.php">
                    <i class="icon fas fa-cogs"></i><span>Settings</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Bootstrap and FontAwesome JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
