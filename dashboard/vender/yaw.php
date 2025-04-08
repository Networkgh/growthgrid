<?php
session_start();
include('db_connection.php');

// Ensure the user is logged in and has the vendor role
if (!isset($_SESSION['vendor_username'])) {
    die("Unauthorized access.");
}

$vendor_username = $_SESSION['vendor_username'];

// Fetch contests created by this vendor
$query = "SELECT contest_name, contest_description, start_date, end_date, prize_details, criteria, flyer FROM contests WHERE vendor_username = ?";
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #ff5722;
            color: white;
        }

        .flyer {
            max-width: 100px;
            height: auto;
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
    </style>
</head>
<body>

<div class="container">
    <h1>My Contests</h1>

    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Contest Name</th>
                    <th>Description</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Prize Details</th>
                    <th>Criteria</th>
                    <th>Flyer</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['contest_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['contest_description']); ?></td>
                        <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                        <td><?php echo htmlspecialchars($row['prize_details']); ?></td>
                        <td><?php echo htmlspecialchars($row['criteria']); ?></td>
                        <td>
                            <?php if ($row['flyer']): ?>
                                <img src="uploads/<?php echo htmlspecialchars($row['flyer']); ?>" alt="Contest Flyer" class="flyer">
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p class="no-contests">No contests found. You can create your first contest now!</p>
    <?php endif; ?>

    <a href="#" id="openFormBtn" class="create-contest-button">Create Contest</a>
</div>

<!-- Modal for contest form -->
<div id="contestFormModal" style="display:none;">
    <div style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);">
        <h2>Create Contest</h2>
        <form id="contestForm" action="submit-contest.php" method="post" enctype="multipart/form-data">
            <label for="contest_name">Contest Name:</label>
            <input type="text" name="contest_name" id="contest_name" required><br><br>
            <label for="contest_description">Contest Description:</label>
            <textarea name="contest_description" id="contest_description" required></textarea><br><br>
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" required><br><br>
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" required><br><br>
            <label for="prize_details">Prize Details:</label>
            <textarea name="prize_details" id="prize_details" required></textarea><br><br>
            <label for="criteria">Criteria:</label>
            <textarea name="criteria" id="criteria" required></textarea><br><br>
            <label for="product_id">Select Product:</label>
            <select name="product_id" id="product_id" required>
                <?php
                // Fetch vendor's products
                $product_query = "SELECT product_id, product_name FROM products WHERE vendor_username = ?";
                $product_stmt = $db->prepare($product_query);
                $product_stmt->bind_param("s", $vendor_username);
                $product_stmt->execute();
                $product_result = $product_stmt->get_result();
                while ($product_row = $product_result->fetch_assoc()) {
                    echo '<option value="' . $product_row['product_id'] . '">' . htmlspecialchars($product_row['product_name']) . '</option>';
                }
                $product_stmt->close();
                ?>
            </select><br><br>
            <label for="flyer">Upload Flyer (Max 2MB):</label>
            <input type="file" name="flyer" id="flyer" accept="image/*"><br><br>
            <button type="submit">Submit Contest</button>
            <button type="button" id="closeFormBtn">Cancel</button>
        </form>
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

</body>
</html>

<?php
$stmt->close();
$db->close();
?>
