<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname,);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve user data
$sql = "SELECT * FROM affiliates";
$result = $conn->query($sql);

// Check if query was successful

if ($result->num_rows > 0) {
    // Process user data
    $userData = array();
    while($row = $result->fetch_assoc()) {
        $userData[] = array('affiliate_username' => $row['affiliate_username'], 'email' =>$row['email'], 'role' =>$row['role']);
    }
    $userCount = count($userData);
} else {
    $userCount = 0;
}

// Close connection
$conn->close();
?>





