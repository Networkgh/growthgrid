<?php
session_start();

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";


// Create connection
$db = mysqli_connect($servername, $username, $password, $dbname,);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize errors array
$errors = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Receive and sanitize input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Debug: Output sanitized input values
   /* echo "Username: $username<br>";
    echo "Password: $password<br>";*/

    // Form validation: ensure that the form is correctly filled
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // Check if there are no errors in the form
    if (count($errors) == 0) {
        // Prepare and execute the query
        $query = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);

        if (!$results) {
            die("Error in query: " . mysqli_error($db));
        }

        // Check if user exists
        if (mysqli_num_rows($results) == 1) {
            // Set session variables
            $_SESSION['username'] = $username;
            $_SESSION['success'] = "You are now logged in";

            // Debug: User is found
            echo "User found. Redirecting...";

            // Redirect to the admin dashboard page
            header('Location: home.php'); // Ensure correct path to your admin dashboard page
            exit(); // Ensure no further code is executed after redirection
        } else {
            // If no user is found, add an error message
            array_push($errors, "Invalid username or password");
        }
    }
}

// Optionally, display errors if any
if (count($errors) > 0) {
    foreach ($errors as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
}

// Close the connection
$db->close();
?>
