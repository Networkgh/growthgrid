<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to count total affiliates
$sql = "SELECT COUNT(*) as total_affiliates FROM affiliates";
$result = $conn->query($sql);

// Fetch the result
$total_affiliates = 0;
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $total_affiliates = $row['total_affiliates'];
}



$sql_vendors = "SELECT COUNT(*) as total_vendors FROM vendors";
$result_vendors = $conn->query($sql_vendors);

// Fetch the result for vendors
$total_vendors = 0;
if ($result_vendors->num_rows > 0) {
    $row = $result_vendors->fetch_assoc();
    $total_vendors = $row['total_vendors'];
}



// Query to get the total earnings for affiliates
$sql_affiliates_earnings = "SELECT SUM(total_earnings) as total_affiliates_earnings FROM affiliates";
$result_affiliates_earnings = $conn->query($sql_affiliates_earnings);

// Fetch the result for affiliates' earnings
$total_affiliates_earnings = 0;
if ($result_affiliates_earnings->num_rows > 0) {
    $row = $result_affiliates_earnings->fetch_assoc();
    $total_affiliates_earnings = $row['total_affiliates_earnings'];
}

// Query to get the total earnings for vendors
$sql_vendors_earnings = "SELECT SUM(total_earnings) as total_vendors_earnings FROM vendors";
$result_vendors_earnings = $conn->query($sql_vendors_earnings);

// Fetch the result for vendors' earnings
$total_vendors_earnings = 0;
if ($result_vendors_earnings->num_rows > 0) {
    $row = $result_vendors_earnings->fetch_assoc();
    $total_vendors_earnings = $row['total_vendors_earnings'];
}

// Calculate the combined total earnings
$total_combined_earnings = $total_affiliates_earnings + $total_vendors_earnings;
?>




?>