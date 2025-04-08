
<?php
 include 'includes/product-verify.php' ;

include 'includes/navbar.php' ;


?>
<?php  include 'includes/downnav.php';?>

<?php


// Ensure the vendor is logged in
if (!isset($_SESSION['vendor_username'])) {
    die("Access denied. Please log in.");
}

// Get vendor username from session
$vendor_username = $_SESSION['vendor_username'];

// Debugging: Check the vendor's username


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

// SQL query to fetch products linked to the vendor username directly from the products table
$sql = 'SELECT product_name, product_category, price, status, product_id
        FROM products
        WHERE vendor_username = ?';

// Prepare the statement
if ($stmt = mysqli_prepare($db, $sql)) 
    // Bind the vendor_username parameter to the prepared statement
    mysqli_stmt_bind_param($stmt, 's', $vendor_username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (!$result) {
        die('Query failed: ' . mysqli_error($db)); // Debugging output for query errors
    }

    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  

<style>

/* Basic Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    color: #333;
}


/**********HEADER */
  
        .header {
            background-color: #4CAF50;
            padding: 4rem;
            color: white;
            text-align: center;
            font-size: 1.5rem;
        }

        .header h1 {
            font-size: 50px;
        }

        /* Content Styling */
        .content {
            padding: 1rem;
            margin-top: 60px;
        }

        .content h1 {
            padding-left: 20px;
        }

        h1 {
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        /* Table Styling */
        .table-container {
            width: 100%;
            overflow-x: auto;
            background-color: white;
            padding: 1rem;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 60px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 0.75rem;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f0f0f0;
        }

        .status-active {
            color: #28a745;
            font-weight: bold;
        }

        .view-btn {
            background-color: #007bff;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .view-btn:hover {
            background-color: #0056b3;
        }

        .add-btn {
            background-color: #28a745;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 1rem;
        }

        .add-btn:hover {
            background-color: #218838;
        }

        /* Popup Form Styling */
        .popup-form {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            width: 90%;
            max-width: 500px;
            max-height: 80vh; /* Adjust the max-height */
            overflow-y: auto; /* Enable vertical scrolling */
        }

        .popup-form input,
        .popup-form textarea,
        .popup-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 1rem;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .popup-form button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .popup-form button:hover {
            background-color: #45a049;
        }

        .close-btn {
            background-color: white;
            color: red;
            border: none;
            padding: 0.5rem 1rem;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
            border-radius: 50%;
        }

        /* Overlay for Popup */
        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 500;
        }

        .status-red {
        color: red;
        font-weight: bold;
    }
    .status-green {
        color: green;
        font-weight: bold;
    }
    .status-orange {
        color: orange;
        font-weight: bold;
    }
    .status-default {
        color: black;
        font-weight: normal;
    }
        /* Responsive Design */
        @media (max-width: 768px) {
            .nav-links {
                display: none;
            }

            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .content {
                padding: 0.5rem;
            }

            h1 {
                font-size: 1.2rem;
            }

            th, td {
                font-size: 0.9rem;
                padding: 0.5rem;
            }

            .view-btn {
                padding: 0.25rem 0.5rem;
            }

            .add-btn {
                padding: 0.25rem 0.5rem;
            }
        }

        @media (max-width: 480px) {
            .navbar {
                padding: 0.5rem;
            }

            .logo {
                font-size: 1.2rem;
            }

            .logout button {
                padding: 0.5rem;
                font-size: 0.9rem;
            }

            th:nth-child(3), td:nth-child(3) {
                display: none;
            }

            .view-btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.8rem;
            }

            .add-btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.8rem;
            }
        }



        .guidelines {
            background-color: #f9f9f9;
            padding: 1rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            max-height: 250px;
            overflow-y: auto; /* Add scroll for lengthy text */
        }

        .guidelines h2 {
            color: #333;
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }

        .guidelines ul {
            list-style-type: disc;
            margin-left: 1.5rem;
        }

        .guidelines ul li {
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>
  
    

    <!-- HTML Structure for Displaying Products -->
    <main class="content">
        <button class="add-btn" onclick="openForm()">Add Product</button>
        <h1>#My Products</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th>Price</th>
                        <th>Action</th>
                        <th>Unpublish</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($result) > 0) {
                        while ($product = mysqli_fetch_assoc($result)) {

                            $statusClass = '';
                            $buttonText = '';
                            $actionFunction = '';

                            switch (strtolower($product['status'])) {
                                case 'deactivated':
                                    $statusClass = 'status-red';
                                    $buttonText = 'Activate';
                                    $actionFunction = 'activateProduct';
                                    break;
                                case 'approved':
                                    $statusClass = 'status-green';
                                    $buttonText = 'Unpublish';
                                    $actionFunction = 'unpublishProduct';
                                    break;
                                case 'pending':
                                    $statusClass = 'status-orange';
                                    $buttonText = 'Unpublish';
                                    $actionFunction = 'unpublishProduct';
                                    break;

                                    case 'rejected':
                                        $statusClass = 'status-red';
                                        $buttonText = 'Appeal';
                                        $actionFunction = 'appealproduct';
                                        break;
                                default:
                                    $statusClass = 'status-default'; // Default class if needed
                                    break;
                            }

                            echo '<tr>
                                    <td>' . htmlspecialchars($product['product_name']) . '</td>
                                    <td>' . htmlspecialchars($product['product_category']) . '</td>
                                    <td><span class="' . $statusClass . '">' . htmlspecialchars($product['status']) . '</span></td>
                                    <td>$' . htmlspecialchars($product['price']) . '</td>
                                    <td><button class="view-btn" onclick="editProduct(' . $product['product_id'] . ')">Edit</button></td>
                                    <td><button class="view-btn" onclick="' . $actionFunction . '(' . $product['product_id'] . ')">' . $buttonText . '</button></td>
                                  
                                  </tr>';
                        }
                    } else {
                        echo '<tr><td colspan="6">No products found for this vendor.</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    
    

    <!-- Popup Form -->
<div class="overlay" id="overlay"></div>
<div class="popup-form" id="popup-form">
    <button class="close-btn" onclick="closeForm()">Close</button>
    <h2>Add New Product</h2>
    
    <!-- Requirements Section -->
    <div id="requirements" style="background-color: #f9f9f9; padding: 1rem; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 1rem;">
        <h3 style="color: #333;">Important Product Requirements</h3>
        <ul style="list-style: disc; margin-left: 1.5rem; color: #555; font-size: 0.9rem;">
            <li>Your product must have a professionally designed sales page with excellent sales copy.</li>
            <li>Provide valuable educational video content that is original and created by you.</li>
            <li>Video content should be in HD (1920x1080) with a 16:9 aspect ratio, clear audio, and no background noise.</li>
            <li>The course must be pre-recorded and hosted on an LMS or webpage (not live).</li>
            <li>At least 30 minutes of video content with a minimum of 5 lessons.</li>
            <li>Provide JV promotional materials for affiliates (e.g., banners, email swipes).</li>
            <li>Include a sales page, thank-you page, and JV page for your product.</li>
            <li>Ensure your promotional materials comply with ethical marketing guidelines.</li>
        </ul>
    </div>

    <!-- Product Form -->
    <form action="my-products.php" method="POST" enctype="multipart/form-data">
        <label for="product_image">Product Image:</label>
        <input type="file" id="product_image" name="product_image" accept="image/*" required onchange="previewImage(event)">

        <!-- Image Preview Container -->
        <div id="image-preview" style="text-align: center; margin-bottom: 1rem;">
            <img id="preview" src="" alt="Image Preview" style="max-width: 100%; display: none;" />
        </div>

        <label for="product_name">Product Name:</label>
        <input type="text" id="product_name" name="product_name" required>

        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description" rows="4" required></textarea>

        <label for="product_category">Product Category:</label>
        <select id="product_category" name="product_category" required>
            <option value="tech">Tech</option>
            <option value="ecommerce">Ecommerce</option>
            <option value="internet_marketing">Internet Marketing</option>
            <option value="affiliate_marketing">Affiliate Marketing</option>
            <option value="personal_development">Personal Development</option>
            <option value="software">Software</option>
            <option value="education">Education</option>
            <option value="training">Training</option>
            <option value="employment">Employment</option>
            <option value="sales_marketing">Sales Marketing</option>
            <option value="religious">Religious & Spirituality</option>
            <option value="health">Health</option>
            <option value="parenting">Parenting</option>
            <option value="arts_entertainment">Arts & Entertainment</option>
            <option value="business_finance">Business & Finance</option>
            <option value="household">Household</option>
            <option value="travel">Travel</option>
        </select>

        <label for="product_type">Product Type:</label>
        <select id="product_type" name="product_type" required>
            <option value="">Select Product Type</option>
            <option value="digital">Digital</option>
            <option value="services">Services</option>
            <option value="physical">Physical</option>
        </select>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="commission">Commission for Affiliate (%):</label>
        <input type="number" id="commission" name="commission" step="0.01" required>

        <label for="currency">Currency:</label>
        <select id="currency" name="currency" required>
            <option value="USD">USD - US Dollar</option>
        </select>

        <label for="sale_page">Sales Page URL:</label>
        <input type="url" id="sale_page" name="sale_page" required>

        <label for="resource_page">Product Resource Page:</label>
        <input type="url" id="resource_page" name="resource_page" required>

        <label for="thank_you_page">Thank You Page URL:</label>
        <input type="url" id="thank_you_page" name="thank_you_page" required>

        <button type="submit">Add Product</button>
    </form>
</div>


    <script>
// JavaScript function to confirm deactivation and redirect
function unpublishProduct(productId) {
    var confirmAction = confirm("Do you want to deactivate this product?");
    if (confirmAction) {
        window.location.href = 'deactivate_product.php?id=' + productId; // Redirect to PHP script for deactivation
    }
}

// JavaScript function to confirm activation and redirect
function activateProduct(productId) {
    var confirmAction = confirm("Do you want to activate this product?");
    if (confirmAction) {
        window.location.href = 'activate_product.php?id=' + productId; // Redirect to PHP script for activation
    }
}


function appealproduct(productId) {
    var confirmAction = confirm("Do you want to appeal this product?");
    if (confirmAction) {
        window.location.href = 'appeal_product.php?id=' + productId; // Redirect to PHP script for activation
    }
}

function openForm() {
    // Implement functionality to open form for adding a product
}

function editProduct(productId) {
    window.location.href = 'edit_product.php?id=' + productId;
}
</script>



<script>
        // JavaScript for popup form display
        function openForm() {
            document.getElementById('popup-form').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function closeForm() {
            document.getElementById('popup-form').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }

        // JavaScript for image preview
        function previewImage(event) {
            var file = event.target.files[0];
            
            // Check if the file size exceeds 2MB (2MB = 2 * 1024 * 1024 bytes)
            if (file.size > 2 * 1024 * 1024) {
                alert("The image size should not exceed 2MB. Please upload a smaller image.");
                event.target.value = ""; // Clear the input
                return;
            }

            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('preview');
                output.src = reader.result;
                output.style.display = 'block'; // Show the image preview
            };
            reader.readAsDataURL(file);
        }


        
    </script>


</body>
</html>

   








