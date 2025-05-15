<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Check if the user is logged in
if (!isset($_SESSION['username']) || !isset($_SESSION['user_id'])) {
    die("Unauthorized access. Please login first.");
}

// Get the logged-in user's details
$current_username = $_SESSION['username'];
$user_id = $_SESSION['user_id'];

// Fetch the user's earnings and sales data
$query = "
    SELECT 
        u.total_earnings, 
        u.incoming_payout,
        (SELECT COUNT(*) FROM sales WHERE user_id = u.user_id) AS number_of_sales
    FROM users u
    WHERE u.user_id = ? AND u.username = ?
";

$stmt = $db->prepare($query);
$stmt->bind_param("is", $user_id, $current_username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("User data not found.");
}

$user_data = $result->fetch_assoc();

$total_earnings = $user_data['total_earnings'] ?? 0;
$incoming_payout = $user_data['incoming_payout'] ?? 0;
$number_of_sales = $user_data['number_of_sales'] ?? 0;

$stmt->close();

// Calculate next payout date (25th of current or next month)
function calculateNextPayoutDate() {
    $currentDay = date('d');
    $currentMonth = date('m');
    $currentYear = date('Y');
    
    if ($currentDay < 25) {
        return date('Y-m-25');
    } else {
        $nextMonth = $currentMonth == 12 ? 1 : $currentMonth + 1;
        $nextYear = $currentMonth == 12 ? $currentYear + 1 : $currentYear;
        return date('Y-m-25', strtotime("$nextYear-$nextMonth-01"));
    }
}

$nextPayoutDate = calculateNextPayoutDate();

$db->close();
?>