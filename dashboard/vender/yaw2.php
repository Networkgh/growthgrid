<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";
$port = "3304";

// Connect to the database
$db = mysqli_connect($servername, $username, $password, $dbname, $port);

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}


// Assume the vendor's username is stored in the session after login
$vendor_username = $_SESSION['vendor_username'];

// Fetch contests created by this vendor, including product name
$query = "SELECT c.contest_name, c.contest_description, c.start_date, c.end_date, c.prize_details, c.criteria, p.product_name 
          FROM contests c 
          JOIN products p ON c.product_id = p.product_id 
          WHERE c.vendor_username = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("s", $vendor_username);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Contests</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #ff5722;
        }

        .contest-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .contest-table th, .contest-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .contest-table th {
            background-color: #ff5722;
            color: white;
        }

        .contest-table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .create-contest-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #ff5722;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 20px;
        }

        .create-contest-button:hover {
            background-color: #e64a19;
        }

        .no-contests {
            text-align: center;
            font-size: 18px;
            color: #555;
        }

       

        .modal {
            display: none; /* Hidden by default */
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 600px;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-group input, 
        .form-group textarea, 
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .form-group textarea {
            resize: vertical;
        }

        .form-group button {
            background-color: #ff5722;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .form-group button:hover {
            background-color: #e64a19;
        }




    </style>
</head>
<body>

<div class="container">
    <h1>My Contests</h1>

    <?php if ($result->num_rows > 0): ?>
        <table class="contest-table">
            <tr>
                <th>Contest Name</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Prize Details</th>
                <th>Criteria</th>
                <th>Product Name</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['contest_name']); ?></td>
                    <td><?php echo htmlspecialchars($row['contest_description']); ?></td>
                    <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['prize_details']); ?></td>
                    <td><?php echo htmlspecialchars($row['criteria']); ?></td>
                    <td><?php echo htmlspecialchars($row['product_name']); ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p class="no-contests">No contests found. You can create your first contest now!</p>
    <?php endif; ?>
    <button class="create-contest-button" id="openFormBtn">Create Contest</button>
    <div id="contestFormModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeFormBtn">&times;</span>
            <h2>Create New Contest</h2>
            <form id="contestForm" action="submit_contest.php" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="contest_name">Contest Name</label>
                    <input type="text" id="contest_name" name="contest_name" required>
                </div>
                <div class="form-group">
                    <label for="contest_description">Contest Description</label>
                    <textarea id="contest_description" name="contest_description" required></textarea>
                </div>
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" id="end_date" name="end_date" required>
                </div>
                <div class="form-group">
                    <label for="product_id">Select Product</label>
                    <select id="product_id" name="product_id" required>
                        <?php
                        // Populate product options
                        $product_query = "SELECT product_id, product_name FROM products WHERE vendor_username = ?";
                        $product_stmt = $conn->prepare($product_query);
                        $product_stmt->bind_param("s", $vendor_username);
                        $product_stmt->execute();
                        $product_result = $product_stmt->get_result();

                        while ($product = $product_result->fetch_assoc()) {
                            echo '<option value="' . htmlspecialchars($product['product_id']) . '">' . htmlspecialchars($product['product_name']) . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="prize_details">Prize Details</label>
                    <textarea id="prize_details" name="prize_details" required></textarea>
                </div>
                <div class="form-group">
                    <label for="criteria">Contest Criteria</label>
                    <select id="criteria" name="criteria" required>
                        <option value="most_sales">Most Sales</option>
                        <option value="highest_revenue">Highest Revenue</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="flyer">Upload Flyer</label>
                    <input type="file" id="flyer" name="flyer" accept="image/*" required>
                </div>
                <div class="form-group">
                    <button type="submit">Create Contest</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // Get modal and button elements
    var modal = document.getElementById("contestFormModal");
    var openFormBtn = document.getElementById("openFormBtn");
    var closeFormBtn = document.getElementById("closeFormBtn");

    // Open the modal when the button is clicked
    openFormBtn.onclick = function() {
        modal.style.display = "block";
    }

    // Close the modal when the close button is clicked
    closeFormBtn.onclick = function() {
        modal.style.display = "none";
    }

    // Close the modal when clicking outside the modal content
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>
<?php
$stmt->close();
$db->close();
?>