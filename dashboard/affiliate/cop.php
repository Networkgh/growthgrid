<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Create connection
$db = new mysqli($servername, $username, $password, $dbname,'3304');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Fetch contest data
$query = "SELECT 
c.contest_id,
            c.contest_name, 
            p.product_name, 
            c.vendor_username, 
            c.start_date, 
            c.end_date, 
            c.status
          FROM 
            contests c
          JOIN 
            products p ON c.product_id = p.product_id";

$result = $db->query($query);

if ($result->num_rows > 0) {
    echo "<table border='1'>
            <tr>
                <th>Contest Name</th>
                <th>Product Name</th>
                <th>Vendor Username</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['contest_name']}</td>
                <td>{$row['product_name']}</td>
                <td>{$row['vendor_username']}</td>
                <td>{$row['start_date']}</td>
                <td>{$row['end_date']}</td>
                <td>{$row['status']}</td>
                <td><a href='edit_contest.php?id={$row['contest_id']}'>Edit</a> | <a href='delete_contest.php?id={$row['contest_id']}'>Delete</a></td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No contests found.";
}

// Close database connection
$db->close();
?>
