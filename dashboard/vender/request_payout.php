<?php
session_start();

include 'includes/success.php';
// Check if the user is logged in and has the vendor role
if (!isset($_SESSION['vendor_username'])) {    
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
$db = mysqli_connect($servername, $username, $password, $dbname, );

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$vendor_username = $_SESSION['vendor_username'];
$payout_amount = $_POST['amount'];
$payout_date = date('Y-m-d');
$payout_status = 'pending'; // Initial status

// Begin transaction
mysqli_begin_transaction($db);

try {
    // Insert the payout request into the payouts table
    $query = "INSERT INTO vendor_payouts (vendor_username, payout_amount, payout_date, payout_status) VALUES (?, ?, ?, ?)";
    $stmt = $db->prepare($query);
    $stmt->bind_param("sdss", $vendor_username, $payout_amount, $payout_date, $payout_status);
    $stmt->execute();

    // Empty the `incoming_payout` column in the vendors table
    $update_query = "UPDATE vendors SET incoming_payout = 0 WHERE vendor_username = ?";
    $update_stmt = $db->prepare($update_query);
    $update_stmt->bind_param("s", $vendor_username);
    $update_stmt->execute();

    // Add the payout amount to the `total_earnings` column
    $add_to_earnings_query = "UPDATE vendors SET total_earnings = total_earnings + ? WHERE vendor_username = ?";
    $add_to_earnings_stmt = $db->prepare($add_to_earnings_query);
    $add_to_earnings_stmt->bind_param("ds", $payout_amount, $vendor_username);
    $add_to_earnings_stmt->execute();

    // Commit the transaction
    mysqli_commit($db);

    // Redirect the user to the confirmation or affiliate dashboard page with a success parameter
    header("Location: vendor_dashboard.php?success=1");
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
