<?php
session_start();

include 'includes/success.php';
// Check if the user is logged in and has the affiliate role
if (!isset($_SESSION['affiliate_username'])) {
    die("Unauthorized access.");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Variable declaration
$errors = array(); 
$_SESSION['success'] = "";

// Connect to database
$db = mysqli_connect($servername, $username, $password, $dbname, '3304');

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$affiliate_username = $_SESSION['affiliate_username'];
$payout_amount = $_POST['amount'];
$payout_date = date('Y-m-d');
$payout_status = 'pending'; // Initial status

// Begin transaction
mysqli_begin_transaction($db);

try {
    // Insert the payout request into the payouts table
    $query = "INSERT INTO affiliate_payouts (affiliate_username, payout_amount, payout_date, payout_status) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("sdss", $affiliate_username, $payout_amount, $payout_date, $payout_status);
    $stmt->execute();

    // Empty the `incoming_payout` column in the affiliates table
    $update_query = "UPDATE affiliates SET incoming_payout = 0 WHERE affiliate_username = ?";
    $update_stmt = $db->prepare($update_query);
    $update_stmt->bind_param("s", $affiliate_username);
    $update_stmt->execute();

    // Add the payout amount to the `total_earnings` column
    $add_to_earnings_query = "UPDATE affiliates SET total_earnings = total_earnings + ? WHERE affiliate_username = ?";
    $add_to_earnings_stmt = $db->prepare($add_to_earnings_query);
    $add_to_earnings_stmt->bind_param("ds", $payout_amount, $affiliate_username);
    $add_to_earnings_stmt->execute();

    // Commit the transaction
    mysqli_commit($db);

    // Redirect the user to the confirmation or affiliate dashboard page with a success parameter
    header("Location: affdash.php?success=1");
    exit();

} catch (Exception $e) {
    // Rollback the transaction in case of any error
    mysqli_rollback($db);
    die("Error processing the request: " . $e->getMessage());
}

$stmt->close();
$update_stmt->close();
$add_to_earnings_stmt->close();
$db->close();
?>
