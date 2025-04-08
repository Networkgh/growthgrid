<?php  include 'includes/success.php';?>

<?php
// Initialize the session
session_start();

// Include database connection file
    
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Variable declaration
$errors = array(); 
$_SESSION['success'] = "";

// Connect to database
$db = mysqli_connect($servername, $username, $password, $dbname,);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

if (!isset($_SESSION['affiliate_username'])) {
    header('Location: login.php');
    exit;
}

// Fetch the affiliate username from the session
$affiliate_username = $_SESSION['affiliate_username'];

// Get the form data from POST request
$payment_method = mysqli_real_escape_string($db, $_POST['payment_method']);
$bank_country = mysqli_real_escape_string($db, $_POST['bank_country']);
$bank_name = mysqli_real_escape_string($db, $_POST['bank_name']);
$account_number = mysqli_real_escape_string($db, $_POST['account_number']);
$account_name = mysqli_real_escape_string($db, $_POST['account_name']);

// Update the user details in the database
$query = "UPDATE affiliates SET payment_method=?, bank_country=?, bank_name=?, account_number=?, account_name=? WHERE affiliate_username=?";
$stmt = $db->prepare($query);
$stmt->bind_param('ssssss', $payment_method, $bank_country, $bank_name, $account_number, $account_name, $affiliate_username);

if ($stmt->execute()) {
    // Redirect to the account settings page with a success message
    $_SESSION['success'] = "Profile updated successfully!";
    header('Location: account_settings.php');
    exit();
} else {
    // Redirect to the account settings page with an error message
    $_SESSION['error'] = "Error updating profile: " . $stmt->error;
    header('Location: accountsettings.php');
    exit();
}

// Close the statement and connection
$stmt->close();
$db->close();

?>
