<?php

session_start();

include 'includes/affiliate-navbar.php';

include 'includes/ads.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Sales Dashboard</title>
    <style>
        /*General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .header {
            background-color: #2c3e50;
            padding: 1rem;
            color: white;
            text-align: center;
            font-size: 1.5rem;
        }

        .container {
            padding: 1rem;
            max-width: 100%;
            overflow-x: auto;
        }

        .sales-table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            min-width: 600px; /* Ensure the table is never too narrow */
        }

        .sales-table th, .sales-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }

        .sales-table th {
            background-color: #f1f1f1;
            font-weight: 500;
        }

        .sales-table td {
            font-size: 0.9rem;
            color: #495057;
        }

        .sales-table .status.pending {
            color: #ffc107;
            font-weight: 700;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sales-table th, .sales-table td {
                padding: 0.5rem;
            }
            .header {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 480px) {
           
            .header {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>

    
    <div class="container">
        <table class="sales-table">
            <thead>
                <tr>
                    <th>Vendor</th>
                    <th>Customer Info</th>
                    <th>Amount/Comm</th>
                    <th>Amount Earned</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Lucrative Ecommerce Business</td>
                    <td>Emmanuel Kyere</td>
                    <td>$25</td>
                    <td>$0</td>
                    <td class="status pending">pending</td>
                </tr>
                <tr>
                    <td>Digital Real Estate Academy</td>
                    <td>Emmanuel Kyere</td>
                    <td>$25</td>
                    <td>$0</td>
                    <td class="status pending">pending</td>
                </tr>
                <tr>
                    <td>The Remote Job Mastery</td>
                    <td>Emmanuel Kyere</td>
                    <td>$21.5</td>
                    <td>$0</td>
                    <td class="status pending">pending</td>
                </tr>
                <tr>
                    <td>FULL PACK SMARTPHONE VIDEOS</td>
                    <td>Emmanuel Robert</td>
                    <td>$5</td>
                    <td>$0</td>
                    <td class="status pending">pending</td>
                </tr>
                <tr>
                    <td>FULL PACK SMARTPHONE VIDEOS</td>
                    <td>Emmanuel Robert</td>
                    <td>$5</td>
                    <td>$0</td>
                    <td class="status pending">pending</td>
                </tr>
            </tbody>
        </table>
    </div>

</body>
</html>
