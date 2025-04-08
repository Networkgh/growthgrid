<?php 

include 'count.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Add icons (optional) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<style>

/* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f7fc;
}

.container {
    display: flex;
    height: 100vh;
}

/* Sidebar Styles */
.sidebar {
    background-color: #2c3e50;
    width: 250px;
    height: 100vh;
    color: white;
    position: fixed;
    left: 0;
    top: 0;
}

.sidebar-header {
    padding: 20px;
    text-align: center;
    background-color: #1a252f;
}

.sidebar-header h2 {
    margin: 0;
    color: #ecf0f1;
}

.sidebar-nav ul {
    list-style: none;
    padding: 0;
}

.sidebar-nav ul li {
    padding: 15px 20px;
    border-bottom: 1px solid #34495e;
}

.sidebar-nav ul li a {
    color: white;
    text-decoration: none;
    display: flex;
    align-items: center;
}

.sidebar-nav ul li a i {
    margin-right: 10px;
}

/* Main Content Styles */
.main-content {
    margin-left: 250px;
    padding: 20px;
    width: calc(100% - 250px);
    background-color: #f4f7fc;
}

/* Header Styles */
.header {
    background-color: #ffffff;
    padding: 20px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
}

.header-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header-actions {
    display: flex;
    align-items: center;
}

.date-time {
    margin-right: 20px;
    color: #7f8c8d;
}

.btn-logout {
    background-color: #e74c3c;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
}

.btn-logout:hover {
    background-color: #c0392b;
}

/* Overview Cards Styles */
.overview {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 20px;
}

.card {
    background-color: #ffffff;
    padding: 20px;
    border-radius: 5px;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.card h3 {
    margin-bottom: 10px;
    color: #34495e;
}

.card p {
    font-size: 24px;
    color: #2ecc71;
    font-weight: bold;
}

/* Dashboard Content (Table) */
.dashboard-content h2 {
    margin-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

table thead {
    background-color: #2c3e50;
    color: white;
}

table th, table td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

/* Responsive Design */
@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        height: auto;
        position: relative;
    }
    .main-content {
        margin-left: 0;
        width: 100%;
    }
    .overview {
        grid-template-columns: 1fr;
    }
}



</style>


</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Panel</h2>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li><a href="#"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li><a href="manage_product.php"><i class="fas fa-box"></i> Manage Products</a></li>
                    <li><a href="#"><i class="fas fa-users"></i> Manage Users</a></li>
                    <li><a href="manage_affiliates.php"><i class="fas fa-tags"></i> Manage Affiliates</a></li>
                    <li><a href="#"><i class="fas fa-cogs"></i> Settings</a></li>
                    <li><a href="#"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="main-content">
            <!-- Header -->
            <header class="header">
                <div class="header-content">
                    <h1>Admin Dashboard</h1>
                    <div class="header-actions">
                        <span class="date-time">September 6, 2024</span>
                        <a href="#" class="btn-logout">Logout</a>
                    </div>
                </div>
            </header>

            <!-- Dashboard Overview -->
            <div class="overview">
                <div class="card">
                    <h3>Total Affiliates</h3>
                    <p><?php echo $total_affiliates; ?></p>
                </div>
                <div class="card">
                    <h3>Total Vendors</h3>
                    <p><?php echo $total_vendors; ?></p>
                </div>
                <div class="card">
                    <h3>New Orders</h3>
                    <p>56</p>
                </div>
                <div class="card">
                    <h3>Total Revenue</h3>
                    <p>$<?php echo number_format($total_combined_earnings, 2); ?></p>
                </div>
            </div>
            

            <!-- Dashboard Content (tables, graphs, etc.) -->
            <div class="dashboard-content">
                <h2>Recent Activities</h2>
                <!-- Add your table or chart content here -->
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Action</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>John Doe</td>
                            <td>Logged In</td>
                            <td>Sept 6, 2024</td>
                        </tr>
                        <!-- More rows -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
