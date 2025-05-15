<?php
session_start();
include 'includes/affiliate-navbar.php';

include 'includes/ads.php';

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}

// Include the navbar and start the session if necessary


// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname, );

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Initialize variables
$search_query = '';
$products = [];

// Handle search
if (isset($_POST['search']) && !empty($_POST['search'])) {
    $search_query = trim($_POST['search']);
}

// Fetch approved products based on the search query
$sql = "SELECT product_id, 
               UPPER(product_name) AS product_name, 
               price, 
               commission, 
               product_image 
        FROM products 
        WHERE status='approved' AND product_name LIKE ?";
$stmt = $conn->prepare($sql);
$search_term = "%" . $search_query . "%";
$stmt->bind_param("s", $search_term);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #2c3e50;
            padding: 10px 20px;
            color: #fff;
            text-align: center;
            
            top: 0;
            z-index: 1000;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 0 20px;
        }

        .search-bar {
            margin: 20px 0;
            text-align: right;
        }

        .search-bar input[type="text"] {
            width: 300px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .search-bar button {
            padding: 10px 20px;
            background-color: #00b894;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .search-bar button:hover {
            background-color: #019d7f;
        }

        @media (max-width: 768px) {
    .search-bar {
        justify-content: space-between; /* Push input to the left and button to the right */
    }

    .search-bar input[type="text"] {
        flex-grow: 1; /* Make the input take up available space */
        width: auto; /* Reset width for flexibility */
        margin-right: auto; /* Push input to the left */
    }

    .search-bar button {
        margin-left: auto; /* Push button to the right */
    }
}
 
        .product-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }



        
        .product-card h3 {
            margin: 0 0 10px;
            font-size: 18px;
        }

        .product-card button {
            background-color: #00b894;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }


        /* Compact Promote button */
.btn.btn-primary {
    background-color: #00b894; /* Greenish color */
    color: white;
    padding: 10px 70px; /* Reduced left and right padding */
    border: none;
    border-radius: 4px; /* Slightly smaller border radius */
    font-size: 14px; /* Maintain smaller font size */
    text-decoration: none; /* Remove underline from the link */
    display: inline-block;
    cursor: pointer;
    text-align: center;

    margin-left: 10; /* Remove margin from the left */
    margin-right: 10; /* Remove margin from the right */
}

.btn.btn-primary:hover {
    background-color: #019d7f; /* Darker green for hover */
}

.btn.btn-primary:active {
    background-color: #018c6d; /* Even darker green when clicked */
}

        .products-grid .btnbtn-primary{
          background-color: blue;
        }

        .product-card button:hover {
            background-color: #019d7f;
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        @media screen and (max-width: 768px) {
            .search-bar {
                text-align: center;
            }

            .header {
                font-size: 2rem;
            }

            .search-bar input[type="text"] {
                max-width: 100%;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }
        }

        @media screen and (min-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media screen and (min-width: 1024px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 480px) {
            .header {
                font-size: 1rem;
            }
        }

        .pagination {
            display: flex;
            list-style-type: none;
            padding: 0;
            justify-content: center;
            margin: 20px 0;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination a {
            text-decoration: none;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #333;
        }

        .pagination a.active {
            background-color: #00b894;
            color: white;
        }

        .pagination a:hover {
            background-color: #019d7f;
            color: white;
        }
    </style>
</head>
<body>

   




<div class="container">
    <!-- Search Bar -->
    <div class="search-bar">
        <form method="POST" action="">
            <input type="text" name="search" placeholder="Search available items..." value="<?php echo htmlspecialchars($search_query); ?>">
            <button type="submit">Search</button>
        </form>
    </div>

        <h2>Top #3 Product Of The Day</h2>

        <div class="products-grid" id="product-list">
    <!-- PHP to HTML rendering -->
    <?php if (count($products) > 0): ?>
        <?php foreach ($products as $product): ?>
            <div class="product-card">
                <h3><?php echo htmlspecialchars($product['product_name']); ?></h3>
                <p>Price: $ <?php echo htmlspecialchars($product['price']); ?></p>
                <p>Commission: <?php echo htmlspecialchars($product['commission']); ?>%</p>
                <!-- Adding product image -->
                <?php if (!empty($product['product_image'])): ?>
                    <img src="uploads/<?php echo htmlspecialchars($product['product_image']); ?>" alt="Product Image" style="max-width: 100%; height: auto;">
                <?php else: ?>
                    <p>No image available</p>
                <?php endif; ?>
                <!-- Update button to link to product_details.php -->
                <a href="product_details.php?product_id=<?php echo htmlspecialchars($product['product_id']); ?>" class="btn btn-primary">Promote</a>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No products found matching your search.</p>
    <?php endif; ?>
</div>


        <!-- Pagination Controls -->
        <div class="pagination" id="pagination-controls"></div>

        <script>
            const itemsPerPage = 6; // Number of items per page
            const products = <?php echo json_encode($products); ?>; // Encode PHP products array to JS

            let currentPage = 1;

            function displayProducts(page) {
                const start = (page - 1) * itemsPerPage;
                const end = start + itemsPerPage;
                const pageProducts = products.slice(start, end);

                const productList = document.getElementById('product-list');
                productList.innerHTML = pageProducts.map(product => `
                    <div class="product-card">
                        <h3>${product.product_name}</h3>
                        <p>Price:$ ${product.price}</p>
                        <p>Commission: ${product.commission}%</p>
                        <a href="product_details.php?product_id=${product.product_id}" class="btn btn-primary">Promote</a>
                    </div>
                `).join('');
            }

            function setupPagination() {
                const pageCount = Math.ceil(products.length / itemsPerPage);
                const paginationControls = document.getElementById('pagination-controls');
                paginationControls.innerHTML = '';

                for (let i = 1; i <= pageCount; i++) {
                    const pageLink = document.createElement('a');
                    pageLink.href = '#';
                    pageLink.textContent = i;
                    pageLink.className = i === currentPage ? 'active' : '';
                    pageLink.addEventListener('click', (e) => {
                        e.preventDefault();
                        currentPage = i;
                        displayProducts(currentPage);
                        setupPagination();
                    });

                    const listItem = document.createElement('li');
                    listItem.appendChild(pageLink);
                    paginationControls.appendChild(listItem);
                }
            }

            displayProducts(currentPage);
            setupPagination();
        </script>
    </div>

</body>
</html>
