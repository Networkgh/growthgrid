<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

$db = new mysqli($servername, $username, $password, $dbname);

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access. Please login first.");
}

// Get user input (sanitize and validate)
$amount = filter_input(INPUT_POST, 'amount', FILTER_VALIDATE_FLOAT);
$payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : '';
$account_details = isset($_POST['account_details']) ? $_POST['account_details'] : '';

// Normalize payment method (remove whitespace, lowercase)

// check if the account number is empty in database

// Check if user has a payment method set
$check_payment_query = "SELECT payment_method FROM users WHERE user_id = ?";
$check_stmt = $db->prepare($check_payment_query);
$check_stmt->bind_param("i", $_SESSION['user_id']);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows === 0) {
    echo "<div style='color: red; font-weight: bold; padding: 10px; border: 1px solid red; background-color: #ffe6e6; max-width: 400px; margin: 20px auto; text-align: center;'>
            User not found in the system.
          </div>";
    exit;
}

$row = $check_result->fetch_assoc();
if (empty($row['payment_method'])) {
    echo "<div style='color: red; font-weight: bold; padding: 10px; border: 1px solid red; background-color: #ffe6e6; max-width: 400px; margin: 20px auto; text-align: center;'>
            You have not set a payment method in your profile. Please update your payment settings before requesting a payout.
          </div>";
    exit;
}


// Check if user has sufficient balance
$query = "SELECT incoming_payout FROM users WHERE user_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("User not found.");
}
$user_data = $result->fetch_assoc();
$incoming_payout = $user_data['incoming_payout'] ?? 0;
if ($incoming_payout < $amount) {
    echo "<div style='color: red; font-weight: bold; padding: 10px; border: 1px solid red; background-color: #ffe6e6; max-width: 400px; margin: 20px auto; text-align: center;'>
            Insufficient balance for payout. Please check your earnings.
          </div>";
    exit;
}

// Validate payout amount
if ($amount <= 0 || !is_numeric($amount)) {
    echo "<div style='color: red; font-weight: bold; padding: 10px; border: 1px solid red; background-color: #ffe6e6; max-width: 400px; margin: 20px auto; text-align: center;'>
            Invalid payout amount. Please enter a valid positive number.
          </div>";
    exit;
}

if ($amount % 10 !== 0) {
    echo "<div style='color: red; font-weight: bold; padding: 10px; border: 1px solid red; background-color: #ffe6e6; max-width: 400px; margin: 20px auto; text-align: center;'>
            Payout amount must be a multiple of 10. Please adjust your request.
          </div>";
    exit;
}

// Payout limit
$max_payout = 1000;
if ($amount > $max_payout) {
    echo "<div style='color: red; font-weight: bold; padding: 10px; border: 1px solid red; background-color: #ffe6e6; max-width: 400px; margin: 20px auto; text-align: center;'>
            Payout amount exceeds the maximum limit of $max_payout. Please adjust your request.
          </div>";
    exit;
}

// Limit number of payout requests per month
$max_requests_per_month = 2;
$query = "SELECT COUNT(*) AS request_count 
          FROM payouts 
          WHERE user_id = ? 
          AND MONTH(request_date) = MONTH(NOW()) 
          AND YEAR(request_date) = YEAR(NOW())";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$request_count = $row['request_count'] ?? 0;

if ($request_count >= $max_requests_per_month) {
    echo "<div style='color: red; font-weight: bold; padding: 10px; border: 1px solid red; background-color: #ffe6e6; max-width: 400px; margin: 20px auto; text-align: center;'>
            You have reached the maximum number of payout requests for this month. Please try again next month.
          </div>";
    exit;
}

// Insert payout request
$query = "INSERT INTO payouts (
    user_id, 
    amount, 
    payment_method, 
    status, 
    account_details, 
    request_date
) VALUES (?, ?, ?, 'pending', ?, NOW())";

$stmt = $db->prepare($query);
$stmt->bind_param("idss", 
    $_SESSION['user_id'],
    $amount,
    $payment_method,
    $account_details
);

// Execute and update balance
if ($stmt->execute()) {
    $update_query = "UPDATE users 
                     SET incoming_payout = incoming_payout - ? 
                     WHERE user_id = ?";
    $update_stmt = $db->prepare($update_query);
    $update_stmt->bind_param("di", $amount, $_SESSION['user_id']);
    $update_stmt->execute();
    $update_stmt->close();

    $_SESSION['success'] = "Payout request submitted successfully!";
    header("Location: affdash.php");
} else {
    $_SESSION['error'] = "Error processing payout: " . $db->error;
    header("Location: request_payout.php");
}

// // set incoming payout to 0
// $query = "UPDATE users SET incoming_payout = 0 WHERE user_id = ?";
// $stmt = $db->prepare($query);

// $stmt->bind_param("i", $_SESSION['user_id']);
// $stmt->execute();
// if ($stmt->affected_rows > 0) {
//     echo "<div style='color: green; font-weight: bold; padding: 10px; border: 1px solid green; background-color: #e6ffe6; max-width: 400px; margin: 20px auto; text-align: center;'>
//             Incoming payout has been reset to zero.
//           </div>";
// } else {
//     echo "<div style='color: red; font-weight: bold; padding: 10px; border: 1px solid red; background-color: #ffe6e6; max-width: 400px; margin: 20px auto; text-align: center;'>
//             Error resetting incoming payout.
//           </div>";
// }






$stmt->close();
$db->close();
exit();
?>
