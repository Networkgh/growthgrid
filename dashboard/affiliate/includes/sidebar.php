

<?php
date_default_timezone_set('Africa/Accra'); // Set timezone to Ghana
$current_date = date('F j, Y'); // Format: Month Day, Year (e.g., August 16, 2024)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Dashboard with Hamburger Menu</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* General styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
        }

        .navbar {
            width: calc(100% - 250px); /* Adjust width for sidebar */
            margin-left: 250px; /* Make space for sidebar */
            padding: 10px;
            background-color: #333;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fix;
            top: 0;
            z-index: 1;
        }

        .navbar-left {
            flex: 1;
            text-align: center;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .navbar-center {
            flex: 1;
            text-align: left;
            margin-left: auto;
            padding-left: 10px;
        }

        .navbar-right {
            flex: 1;
            text-align: right;
            margin-right: 20px;
            position: fixed;
            top: 10px;
            right: 10px;
        }

        .logout-button {
            color: black;
            text-decoration: none;
            font-size: 18px;
        }

        #current-time {
            font-size: 16px;
            color: white;
        }

        /* Sidebar styles */
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: #2d2f33;
            color: white;
            display: flex;
            flex-direction: column;
            padding-top: 20px;
            transition: transform 0.3s ease;
            z-index: 2;
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 1.5em;
        }

        .sidebar nav {
            display: flex;
            flex-direction: column;
            padding-left: 20px;
        }

        .sidebar nav a {
            text-decoration: none;
            color: white;
            padding: 10px 0;
            font-size: 1.1em;
            display: flex;
            align-items: center;
            transition: background-color 0.3s ease;
        }

        .sidebar nav a:hover {
            background-color: #575757;
            padding-left: 30px;
        }

        .sidebar nav a i {
            margin-right: 10px;
        }

        /* Hamburger menu styles */
        .hamburger {
            display: none;
            font-size: 24px;
            cursor: pointer;
            position: fixed;
            left: 10px;
            top: 10px;
            z-index: 3;
        }

        /* Mobile styles */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                align-items: center;
                width: 100%;
                margin-left: 0;
            }

            .navbar-left {
                order: 1;
                text-align: center;
                position: relative;
                top: 30px;
                left: 50%;
                transform: translateX(-50%);
                font-size: 10px;
                margin-right: 20px;
            }

            .navbar-left #current-time{
                font-size: 10px;
            }

            .navbar-center {
                order: 3;
                text-align: center;
                position: relative;
                font-size: 14px;
                padding-top: 10px;
                margin-left: 0;
            }

            .navbar-right {
                order: 2;
                text-align: right;
                width: 100%;
                position: fixed;
                top: 10px;
                right: 10px;
            }

            /* Show hamburger menu */
            .hamburger {
                display: block;
            }

            /* Hide sidebar by default on mobile */
            .sidebar {
                transform: translateX(-250px);
            }

            /* When sidebar is open */
            .sidebar.open {
                transform: translateX(0);
            }

            /* When sidebar is open, shift the navbar */
            .navbar.open {
                margin-left: 250px;
            }
        }
    </style>
</head>
<body>
    <!-- Hamburger Menu -->
    <div class="hamburger">
        <i class="fas fa-bars"></i>
    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Affiliate</h2>
        <nav>
            <a href="affdash.php"><i class="fas fa-tachometer-alt"></i> Affiliate Dashboard</a>
            <a href="accountsettings.php"><i class="fas fa-cog"></i> Account Settings</a>
            <a href="recentsales.php"><i class="fas fa-dollar-sign"></i> Recent Sales</a>
            <a href="marketplace.php"><i class="fas fa-store"></i> Market Place</a>
            <a href="leaderboard.php"><i class="fas fa-chart-line"></i> Top Affiliates</a>
            <a href="contest.php"><i class="fas fa-flag"></i> Find Contest</a>
            <a href="analytics.php"><i class="fas fa-chart-bar"></i> Analytics</a>
            <a href="community.php"><i class="fas fa-users"></i> Community</a>
            <a href="#"><i class="fas fa-envelope"></i> Join Telegram</a>
        </nav>
        <div>
            <a href="vender-dashboard.php">Switch to Vendor Dashboard</a>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-left">
            <p id="current-time"></p>
           <?php echo "<p> $current_date</p>";?>
        </div>
        <div class="navbar-center">
            <p>Welcome, User</p>
        </div>
        <div class="navbar-right">
            <a href="logout.php" class="logout-button" title="Logout">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
    </nav>

    <script>
        // Function to update the current time every second
        function updateTime() {
            const options = { timeZone: 'Africa/Accra', hour12: true };
            const timeString = new Date().toLocaleString('en-US', {
                ...options, hour: 'numeric', minute: 'numeric', second: 'numeric'
            });
            document.getElementById('current-time').textContent = timeString;
        }

        // Update the time immediately and then every second
        updateTime();
        setInterval(updateTime, 1000);

        // Toggle sidebar visibility on hamburger click
        const hamburger = document.querySelector('.hamburger');
        const sidebar = document.querySelector('.sidebar');
        const navbar = document.querySelector('.navbar');

        hamburger.addEventListener('click', () => {
            sidebar.classList.toggle('open');
            navbar.classList.toggle('open');
        });
    </script>
</body>
</html>
