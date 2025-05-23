
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
    $db = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['affiliate_username'])) {
    header('Location: login.php');
    exit;
}

// Fetch the affiliate username from the session
$affiliate_username = $_SESSION['affiliate_username'];

// Get the form data from POST request
$first_name = mysqli_real_escape_string($db, $_POST['first_name']);
$last_name = mysqli_real_escape_string($db, $_POST['last_name']);
$telephone = mysqli_real_escape_string($db, $_POST['telephone']);
$country_of_residence = mysqli_real_escape_string($db, $_POST['country_of_residence']);

// Update the user details in the database
$query = "UPDATE affiliates SET first_name=?, last_name=?, phone_number=?, country_of_residence=? WHERE affiliate_username=?";
$stmt = $db->prepare($query);
$stmt->bind_param('sssss', $first_name, $last_name, $telephone, $country_of_residence, $affiliate_username);

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
