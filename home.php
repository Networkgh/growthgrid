++<?php
// Start the session
session_start();
  
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






// Include your database connection file


// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Perform validation (e.g., check if fields are empty)
    if (empty($username) || empty($password)) {
        echo "Please enter both username and password.";
        exit;
    }

    // Query the database to check if the user exists
    $sql = "SELECT affiliate_id, password FROM affiliates WHERE username = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch the user data
        $user = $result->fetch_assoc();
        $db_password = $user['password'];
        $affiliate_id_from_db = $user['affiliate_id'];

        // Verify the password
        if (password_verify($password, $db_password)) {
            // If login is successful, set the affiliate_id in session
            $_SESSION['affiliate_id'] = $affiliate_id_from_db;

            // Redirect to the dashboard or desired page
            header('Location: affdash.php');
            exit;
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with that username.";
    }

    // Close statement and connection
    $stmt->close();
    $db->close();
}
?>
