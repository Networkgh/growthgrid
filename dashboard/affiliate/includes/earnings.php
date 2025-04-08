<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname,);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user data
$sql = "SELECT * FROM affiliates";
$result = $db->query($sql);

// Check if the user is logged in and has the affiliate role
if (!isset($_SESSION['affiliate_username'])) {
    die("Unauthorized access.");
}

// Assume the affiliate's username is stored in the session after login
$affiliate_username = $_SESSION['affiliate_username'];

// Fetch the affiliate's earnings, payout information, and number of sales
$query = "
    SELECT 
        a.total_earnings, 
        a.next_payout, 
        a.incoming_payout,
        (SELECT COUNT(*) FROM sales WHERE affiliate_username = a.affiliate_username) AS number_of_sales
    FROM affiliates a
    WHERE a.affiliate_username = ?
";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $affiliate_username);
$stmt->execute();
$result = $stmt->get_result();
$affiliate_data = $result->fetch_assoc();

$total_earnings = $affiliate_data['total_earnings'];
$next_payout = $affiliate_data['next_payout'];
$incoming_payout = $affiliate_data['incoming_payout'];
$number_of_sales = $affiliate_data['number_of_sales'];

$stmt->close();
$db->close();

// Define the function if not already defined
if (!function_exists('calculateNextPayoutDate')) {
    function calculateNextPayoutDate($next_payout) {
        $currentDate = date('Y-m-d');

        // If the next payout is already set and after today's date, return that
        if (strtotime($next_payout) > strtotime($currentDate)) {
            return $next_payout;
        }

        $currentMonth = date('m');
        $currentYear = date('Y');
        $currentDay = date('d');

        // Calculate the next payout date based on the current day
        if ($currentDay < 25) {
            $nextPayoutDate = "$currentYear-$currentMonth-25";
        } else {
            // Move to the next month
            $nextMonth = $currentMonth == 12 ? 1 : $currentMonth + 1;
            $nextYear = $currentMonth == 12 ? $currentYear + 1 : $currentYear;
            $nextPayoutDate = "$nextYear-" . str_pad($nextMonth, 2, '0', STR_PAD_LEFT) . "-25";
        }

        return $nextPayoutDate;
    }
}

// Calculate next payout date
$nextPayoutDate = calculateNextPayoutDate($next_payout);
?>

