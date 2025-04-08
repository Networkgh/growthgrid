<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

$conn = new mysqli($servername, $username, $password, $dbname, );

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sucesss = array(); 

// Initialize and escape variables
$first_name = isset($_POST['first_name']) ? mysqli_real_escape_string($conn, $_POST['first_name']) : '';
$last_name = isset($_POST['last_name']) ? mysqli_real_escape_string($conn, $_POST['last_name']) : '';
$phone = isset($_POST['phone']) ? mysqli_real_escape_string($conn, $_POST['phone']) : '';
$country = isset($_POST['country']) ? mysqli_real_escape_string($conn, $_POST['country']) : '';
$website = isset($_POST['website']) ? mysqli_real_escape_string($conn, $_POST['website']) : '';
$company_name = isset($_POST['company_name']) ? mysqli_real_escape_string($conn, $_POST['company_name']) : '';
$payment_method = isset($_POST['payment_method']) ? mysqli_real_escape_string($conn, $_POST['payment_method']) : '';
$payment_details = isset($_POST['payment_details']) ? mysqli_real_escape_string($conn, $_POST['payment_details']) : '';
$how_hear = isset($_POST['how_hear']) ? mysqli_real_escape_string($conn, $_POST['how_hear']) : '';
$promotional_methods = isset($_POST['promotional_methods']) ? mysqli_real_escape_string($conn, $_POST['promotional_methods']) : '';
$affiliate_tracking_id = isset($_POST['affiliate_tracking_id']) ? mysqli_real_escape_string($conn, $_POST['affiliate_tracking_id']) : '';
$affiliate_earnings = isset($_POST['affiliate_earnings']) ? mysqli_real_escape_string($conn, $_POST['affiliate_earnings']) : '';
$number_of_sales = isset($_POST['number_of_sales']) ? mysqli_real_escape_string($conn, $_POST['number_of_sales']) : '';

// SQL query
$sql = "INSERT INTO affiliate (first_name, last_name, phone, country, website, company_name, payment_method, payment_details, how_hear, promotional_methods, affiliate_tracking_id, affiliate_earnings, number_of_sales)
 VALUES ('$first_name', '$last_name', '$phone', '$country', '$website', '$company_name', '$payment_method', '$payment_details', '$how_hear', '$promotional_methods', '$affiliate_tracking_id', '$affiliate_earnings', '$number_of_sales')";

if ($conn->query($sql) === TRUE) {
    array_push($sucesss, "information stored");

    header('Location: login.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
exit();
    
}

if (count($sucesss) > 0) {
    foreach ($sucesss as $sucesss) {
        echo "<p style='color: green;'>$sucesss</p>";
    }
}
$conn->close();
?>
