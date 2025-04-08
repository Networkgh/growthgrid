<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar with Profile Picture</title>
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Global Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        /* Navbar Styles */
        .navbar {
            background-color: #003366;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        /* Custom Logo */
        .logo {
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .logo .letters {
            display: flex;
            align-items: center;
            font-size: 24px;
            font-weight: bold;
            color: #f4a261;
        }

        .logo .divider {
            width: 4px;
            height: 40px;
            background-color: #e76f51;
            position: relative;
            margin: 0 5px;
        }

        .logo .divider:before {
            content: '';
            position: absolute;
            width: 6px;
            height: 6px;
            border: 2px solid white;
            border-radius: 50%;
            background-color: #e76f51;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .logo .text {
            font-size: 20px;
            font-weight: bold;
            color: white;
        }

        .logo .text span {
            color: #e76f51;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar ul li {
            margin-left: 20px;
        }

        .navbar ul li a {
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
        }

        .navbar ul li a:hover {
            background-color: #00509e;
            border-radius: 5px;
            color: #d4e8ff;
        }

        /* Mobile View */
        @media (max-width: 768px) {
            .navbar ul {
                display: none;
                flex-direction: column;
                position: fixed;
                top: 0;
                left: -250px;
                width: 250px;
                height: 100%;
                background-color: #333;
                transition: left 0.3s ease-in-out;
                z-index: 999;
                box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
                padding-top: 60px;
            }

           
            /* Style the hamburger icon */
.menu-icon {
    font-size: 30px; /* Adjust the size of the icon */
    color: #f4a261; /* Change the icon color */
    cursor: pointer; /* Make it look clickable */
    transition: transform 0.3s ease, color 0.3s ease; /* Add smooth transitions for hover effects */
}

/* Change color and slightly rotate the icon when hovered */
.menu-icon:hover {
    color: #e76f51; /* Change color on hover */
    transform: rotate(360deg); /* Add a slight rotation */
}

/* Center-align the icon for better appearance */
.menu-icon {
    display: flex;
    align-items: right;
    justify-content: right;
    height: 40px;
    width: 40px;
    background-color: #003366; /* Optional background color */
    border-radius: 50%; /* Make it circular */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2); /* Add a shadow for depth */
}


            .navbar ul.active {
                left: 0;
                display: flex;
            }

            /* Profile Picture */
            .profile-pic {
                width: 100%;
                height: 150px;
                background: url('logo.png') no-repeat center center/cover;
                display: none;
            }

            .navbar ul.active .profile-pic {
                display: block;
            }

            .navbar ul li {
                margin: 0;
                padding: 15px;
                border-bottom: 1px solid #555;
            }

            .navbar ul li a {
                color: white;
                text-align: left;
            }

            .navbar .menu-icon {
                display: block;
                margin-right: 20px;
            }

            /* Edit Profile Button */
            .navbar ul li.edit-profile a {
                background-color: #f4a261;
                color: #333;
                text-align: center;
                border-radius: 5px;
                margin: 15px auto;
                width: 90%;
                font-weight: bold;
                transition: all 0.3s ease-in-out;
            }

            .navbar ul li.edit-profile a:hover {
                background-color: #e76f51;
                color: white;
            }
        }

        /* Hide menu icon on large screens */
        @media (min-width: 769px) {
            .navbar .menu-icon {
                display: none;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <!-- Custom Logo -->
    <a href="#" class="logo">
        <div class="letters">
            <span>E</span>
            <div class="divider"></div>
            <span>E</span>
        </div>
        <span class="text">EMMAK<span>ZONE</span></span>
    </a>
    <ul id="nav-menu">
        <!-- Profile Picture -->
        <div class="profile-pic"></div>

        <li><a href="vendor_dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="my-products.php"><i class="fas fa-store"></i> My product</a></li>
        <li><a href="sale.php"><i class="fas fa-chart-line"></i> Sales</a></li>

        <li class="edit-profile"><a href="account_settings.php"><i class="fas fa-user-cog"></i> Edit Profile</a></li>
    </ul>
    <div class="menu-icon" onclick="toggleMenu()">☰</div>
</div>

<script>
    function toggleMenu() {
        const navMenu = document.getElementById('nav-menu');
        navMenu.classList.toggle('active');
    }
</script>

</body>
</html>
