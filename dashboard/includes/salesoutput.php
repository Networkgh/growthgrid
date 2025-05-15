<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from the sales_info table
$sql = "SELECT product_name, customer_info, status, sale_time FROM sales_info";
$result = $conn->query($sql);

$sales_data = [];
if ($result->num_rows > 0) {
    // Fetch all results into an associative array
    while($row = $result->fetch_assoc()) {
        $sales_data[] = $row;
    }
} else {
    echo "No sales data found.";
}

$conn->close();
?>
