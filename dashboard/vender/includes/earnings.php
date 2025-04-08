<?php


// Check if the user is logged in and has the vendor role
if (!isset($_SESSION['vendor_username'])) {
    die("Unauthorized access.");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname, );

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Assume the vendor's username is stored in the session after login
$vendor_username = $_SESSION['vendor_username'];

// Fetch the vendor's earnings, payout information, and number of sales
$query = "
    SELECT 
        v.total_earnings, 
        v.incoming_payout,
        (SELECT COUNT(*) 
         FROM sales s 
         JOIN products p ON s.product_id = p.product_id 
         WHERE p.vendor_username = v.vendor_username) AS number_of_sales
    FROM vendors v
    WHERE v.vendor_username = ?
";

$stmt = $db->prepare($query);
$stmt->bind_param("s", $vendor_username);
$stmt->execute();
$result = $stmt->get_result();
$vendor_data = $result->fetch_assoc();

$total_earnings = $vendor_data['total_earnings'];
$incoming_payout = $vendor_data['incoming_payout'];
$number_of_sales = $vendor_data['number_of_sales'];






$query = "SELECT COUNT(*) AS product_count FROM products WHERE vendor_username = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $vendor_username);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Get the count
$product_count = $row['product_count'];




$stmt->close();
$db->close();

// Define the function if not already defined
if (!function_exists('calculateNextPayoutDate')) {
    function calculateNextPayoutDate() {
        $currentDate = date('Y-m-d');
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
$nextPayoutDate = calculateNextPayoutDate();





?>
