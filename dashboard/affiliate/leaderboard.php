<?php
session_start();
include 'includes/navbar.php';
include 'includes/downnav.php';
include 'includes/ads.php';


if (!isset($_SESSION['affiliate_username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";


// Connect to the database
$db = mysqli_connect($servername, $username, $password, $dbname,);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// SQL query to get the top affiliates with their positions, levels, sales, and total amount
$query = "
    SELECT 
        a.affiliate_username,
        a.affiliate_username,
         
        COUNT(s.sale_id) AS number_of_sales,
       
        RANK() OVER (ORDER BY COUNT(s.sale_id) DESC) AS position
    FROM 
        affiliates a
    JOIN 
        sales s ON a.affiliate_username = s.affiliate_username
    GROUP BY 
        a.affiliate_username
    ORDER BY 
        number_of_sales DESC
    LIMIT 10;  /* Adjust the LIMIT based on how many affiliates you want to display */
";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Dashboard</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        
        .header {
            background-color:whitesmoke;
            padding: 1rem;
            color: black;
            text-align: center;
            font-size: 1.5rem;
        }
        .container {
            max-width: 100%;
            margin: 20px auto;
            overflow-x: auto;
            white-space: nowrap;
            position: relative;
        }

        .leaderboard-table {
            border-collapse: collapse;
            width: 100%;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
        }

        .leaderboard-table th, .leaderboard-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .leaderboard-table th {
            background-color: #eaf4fe;
            color: #333;
        }

        .leaderboard-table td {
            white-space: nowrap;
        }

        .drag-arrow {
            display: none;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: #fff;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
        }

        .drag-arrow.left {
            left: 10px;
        }

        .drag-arrow.right {
            right: 10px;
        }

        @media only screen and (max-width: 768px) {
            .drag-arrow {
                display: block;
            }

            .header {
                font-size: 1.2rem;
            }
        }


        @media (max-width: 480px) {
            
            .header {
                font-size: 1rem;
            }
        }








        
/* General styling for the banner */
.dashboard-banner {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: #f5f5f5;
    border-radius: 8px;
    padding: 20px;
    margin: 20px 0;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Banner content styling */
.banner-content {
    flex: 1;
    padding: 10px;
}

.banner-content h2 {
    font-size: 24px;
    color: #333;
    margin-bottom: 10px;
}

.banner-content p {
    font-size: 16px;
    color: #555;
    margin-bottom: 20px;
}

.banner-content .btn-upgrade {
    background-color: #007bff;
    color: #fff;
    padding: 10px 20px;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
}

/* Banner image styling */
.banner-image img {
    max-width: 300px;
    height: auto;
    border-radius: 8px;
}

/* Responsive styles for tablets */
@media (max-width: 768px) {
    .dashboard-banner {
        flex-direction: column;
        text-align: center;
    }

    .banner-image img {
        max-width: 200px;
        margin-top: 15px;
    }
}

/* Responsive styles for mobile */
@media (max-width: 480px) {
    .banner-content h2 {
        font-size: 20px;
    }

    .banner-content p {
        font-size: 14px;
    }

    .banner-image img {
        max-width: 150px;
    }
}

    </style>
</head>
<body>


<body>
    

    <div class="container">
        <h1 class="lead">#Leaderboard</h1>
        <button class="drag-arrow left" onclick="scrollLeft()">←</button>
        <button class="drag-arrow right" onclick="scrollRight()">→</button>
        
        <?php
        $result = mysqli_query($db, $query);

// Check if there are results
if ($result && mysqli_num_rows($result) > 0) {
    echo '<table class="leaderboard-table">
            <thead>
                <tr>
                    <th>Position</th>
                    <th>Affiliate Details</th>
                   
                    <th>Sales</th>
                    
                </tr>
            </thead>
            <tbody>';

    // Fetch and display each row of affiliate data
    while ($row = mysqli_fetch_assoc($result)) {
        // Determine the stakecut award based on rank or sales (example logic)
       
        echo '<tr>';
        echo '<td>#' . $row['position'] . '</td>';
        echo '<td>' . htmlspecialchars($row['affiliate_username']) . '</td>';
        
        echo '<td>' . $row['number_of_sales'] . '</td>';
       
        echo '</tr>';
    }

    echo '</tbody></table>';
} else {
    echo "<p>No sales data available.</p>";
}

// Close the connection
mysqli_close($db);
   
?>
    <script>
        function scrollLeft() {
            document.querySelector('.container').scrollBy({
                top: 0,
                left: -200,
                behavior: 'smooth'
            });
        }

        function scrollRight() {
            document.querySelector('.container').scrollBy({
                top: 0,
                left: 200,
                behavior: 'smooth'
            });
        }
    </script>
</body>
</html>













