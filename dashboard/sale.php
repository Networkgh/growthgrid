
<?php 
session_start();
include 'includes/vender-navbar.php' ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Dashboard</title>
    <link rel="stylesheet" href="styles.css">

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

        .header h1{
            font-size: 50px;
        }


/* Content Styling */
.content {
    padding: 1rem;
}

.content h1{
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
}




</style>


</head>
<body>

    <main class="content">
        <h1>#Ongoing Contest</h1>
        <div class="table-container">
            <table>
                <thead>

                
                    <tr>
                        <th>Product Name</th>
                        <th>Customer info</th>
                        
                        <th>Status</th>
                        <th>Time</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php if (!empty($sales_data)): ?>
                    <?php foreach ($sales_data as $sale): ?>
                    <tr>
                    <td>
                        <?php echo htmlspecialchars($sale['product_name']); ?></td>
                        <td><?php echo htmlspecialchars($sale['customer_info']); ?></td>
                        <td><?php echo htmlspecialchars($sale['status']); ?></td>
                        <td><?php echo htmlspecialchars($sale['sale_time']); ?></td>
                    </tr>
                    <?php endforeach; ?>
            <?php else: ?>


                <tr>

                <td colspan="4">No sales data available.</td>
                </tr>
                <?php endif; ?>
                    <!-- Repeat for other rows as needed -->
                </tbody>
            </table>
        </div>
    </main>



    <script>
document.addEventListener("DOMContentLoaded", function() {
    fetch('fetch_sales_data.php')  // This PHP script will return JSON data
        .then(response => response.json())
        .then(data => {
            let tableBody = document.querySelector('tbody');
            data.forEach(sale => {
                let row = `<tr>
                             <td>${sale.product_name}</td>
                             <td>${sale.customer_info}</td>
                             <td>${sale.status}</td>
                             <td>${sale.sale_time}</td>
                           </tr>`;
                tableBody.innerHTML += row;
            });
        })
        .catch(error => console.error('Error fetching sales data:', error));
});


    </script>
</body>
</html>












