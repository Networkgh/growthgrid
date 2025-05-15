<?php
// Start session and include database connection



// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration"; // Replace with your actual database name

// Create connection
$db = new mysqli($servername, $username, $password, $dbname, );

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




// Assume the affiliate's username is stored in the session after login
$username = $_SESSION['username'];

// Fetch the payout data for the logged-in affiliate
$query = "SELECT payout_id, amount, request_date, status FROM payouts WHERE user_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$payouts = [];
while ($row = $result->fetch_assoc()) {
    $payouts[] = $row;
}

$stmt->close();
$db->close();
?>
