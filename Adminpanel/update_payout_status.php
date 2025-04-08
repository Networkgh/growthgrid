<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration"; // Replace with your actual database name

// Create connection
$db = new mysqli($servername, $username, $password, $dbname,);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Han

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $payout_id = $_POST['payout_id'];
    $new_status = $_POST['new_status'];

    // Update the payout status in the database
    $query = "UPDATE affiliate_payouts SET payout_status = ? WHERE payout_id = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("si", $new_status, $payout_id);

    if ($stmt->execute()) {
        // Redirect back to the admin dashboard with a success message
        header("Location: home.php?status_updated=1");
        exit;
    } else {
        die("Error updating payout status: " . mysqli_error($db));
    }
}
?>
