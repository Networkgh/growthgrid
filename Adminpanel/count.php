<?php
// Database connection
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

// Single query to get all user statistics
$sql = "SELECT 
            COUNT(*) as total_users,
            SUM(role = 'vendor') as total_vendors,
            SUM(role = 'affiliate') as total_affiliates,
            SUM(CASE WHEN role = 'affiliate' THEN total_earnings ELSE 0 END) as total_affiliates_earnings,
            SUM(CASE WHEN role = 'vendor' THEN total_earnings ELSE 0 END) as total_vendors_earnings
        FROM users";

$result = $conn->query($sql);

// Initialize all variables
$total_users = 0;
$total_vendors = 0;
$total_affiliates = 0;
$total_affiliates_earnings = 0;
$total_vendors_earnings = 0;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_users = $row['total_users'] ?? 0;
    $total_vendors = $row['total_vendors'] ?? 0;
    $total_affiliates = $row['total_affiliates'] ?? 0;
    $total_affiliates_earnings = $row['total_affiliates_earnings'] ?? 0;
    $total_vendors_earnings = $row['total_vendors_earnings'] ?? 0;
}

// Calculate combined earnings
$total_combined_earnings = $total_affiliates_earnings + $total_vendors_earnings;

// Close connection
$conn->close();
?>