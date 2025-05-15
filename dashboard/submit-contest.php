<?php
session_start();

// Check if the user is logged in and has the vendor role
if (!isset($_SESSION['vendor_username'])) {
    die("Unauthorized access.");
}

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";


// Connect to the database
$db = mysqli_connect($servername, $username, $password, $dbname, );

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get vendor username
$vendor_username = $_SESSION['vendor_username'];

// Collect form data
$contest_name = $_POST['contest_name'];
$contest_description = $_POST['contest_description'];
$contest_url = $_POST['contest_url'];
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$prize_details = $_POST['prize_details'];
$criteria = $_POST['criteria'];
$product_id = $_POST['product_id'];

// Handle file upload
$flyer = '';
if (isset($_FILES['flyer']) && $_FILES['flyer']['error'] == UPLOAD_ERR_OK) {
    $max_file_size = 2 * 1024 * 1024; // 2MB in bytes
    $upload_dir = 'uploads/';
    $tmp_name = $_FILES['flyer']['tmp_name'];
    $file_name = basename($_FILES['flyer']['name']);
    $upload_file = $upload_dir . $file_name;
    $file_size = $_FILES['flyer']['size'];

    // Check file size
    if ($file_size > $max_file_size) {
        die("File size exceeds 2MB limit.");
    }

    // Move the file to the upload directory
    if (move_uploaded_file($tmp_name, $upload_file)) {
        $flyer = $file_name;
    } else {
        die("File upload failed.");
    }
}

// Insert contest data into the database
$query = "INSERT INTO contests (contest_name, contest_description, contest_url, start_date, end_date, prize_details, criteria, flyer, vendor_username, product_id) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $db->prepare($query);
$stmt->bind_param("sssssssssi", $contest_name, $contest_description, $contest_url, $start_date, $end_date, $prize_details, $criteria, $flyer, $vendor_username, $product_id);

if ($stmt->execute()) {
    // Redirect to the page showing the list of contests
    header("Location: set-contest.php?success=1");
    exit;
} else {
    die("Error inserting contest: " . $stmt->error);
}

// Close the statement and database connection
$stmt->close();
$db->close();
?>
