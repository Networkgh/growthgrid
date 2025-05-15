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

// Validate inputs
if ($amount === false || $amount <= 0) {
    die("Invalid amount specified");
}

if (!in_array($payment_method, ['bank', 'paypal', 'crypto'])) {
    die("Invalid payment method");
}

// Prepare the insert query
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

// Execute and handle result
if ($stmt->execute()) {
    // Update user's incoming_payout balance
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

$stmt->close();
$db->close();
exit();
?>