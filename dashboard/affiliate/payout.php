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
$affiliate_username = $_SESSION['affiliate_username'];

// Fetch the payout data for the logged-in affiliate
$query = "SELECT payout_id, payout_amount, payout_date, payout_status FROM affiliate_payouts WHERE affiliate_username = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $affiliate_username);
$stmt->execute();
$result = $stmt->get_result();

$payouts = [];
while ($row = $result->fetch_assoc()) {
    $payouts[] = $row;
}

$stmt->close();
$db->close();
?>
