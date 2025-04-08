
<?php
session_start();
include 'includes/success.php';
include 'includes/navbar.php';
include 'includes/downnav.php';
include 'includes/ads.php';
?>

<?php
// Initialize the session


// Include database connection file
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registration";
    
    // Variable declaration
    $errors = array(); 
    $_SESSION['success'] = "";
    
    // Connect to database
    $db = mysqli_connect($servername, $username, $password, $dbname);
    
    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }



// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['affiliate_username'])) {
    header('Location: login.php');
    exit;
}

// Fetch user details from the database using the affiliate_username


// Initialize the session

// Include database connection file


// Check if the user is logged in; if not, redirect to login page
if (!isset($_SESSION['affiliate_username'])) {
    header('Location: login.php');
    exit;
}

// Fetch user details from the database using the affiliate_username
$affiliate_username = $_SESSION['affiliate_username'];
$query = "SELECT affiliate_username, first_name, last_name, email, phone_number, country_of_residence, payment_method,bank_country, bank_name,account_number, account_name  FROM affiliates WHERE affiliate_username=?";
$stmt = $db->prepare($query);
$stmt->bind_param('s', $affiliate_username);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Initialize variables for user details
$username = $user['affiliate_username'];
$first_name = $user['first_name'];
$last_name = $user['last_name'];
$full_name = $first_name . ' ' . $last_name; // Combine first and last name
$email = $user['email'];
$telephone = $user['phone_number']; // Assuming this is stored as phone_number
$country_of_residence = $user['country_of_residence'];
$payment_method = $user['payment_method'];
$bank_country = $user['bank_country'];
$bank_name = $user['bank_name'];
$account_number= $user['account_number'];
$account_name = $user['account_name'];

$db->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        

        .container {
            width: 100%;
            max-width: 1400px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            align-items: center;
            margin-right: 0%;
        }

        header {
            text-align: center;
            background-color: #007bff;
            color: #ffffff;
            padding: 20px 15px;
        }

        header h1 {
            font-size: 1.5em;
            margin: 0;
            font-weight: 600;
        }

        nav {
            display: flex;
            justify-content: space-around;
            background-color: #f7faff;
            padding: 10px 0;
        }

        nav a {
            color: #007bff;
            text-decoration: none;
            font-weight: 600;
            padding: 10px 15px;
            border-radius: 20px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        nav a.active,
        nav a:hover {
            background-color: #007bff;
            color: #ffffff;
        }

        .profile-info {
            padding: 20px;
            text-align: left;
        }

        .profile-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }

        .badge {
            background-color: #ffc107;
            color: #ffffff;
            padding: 12px 16px;
            border-radius: 50%;
            margin-right: 10px;
            font-weight: bold;
            font-size: 1.2em;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        .profile-header h2 {
            margin: 0;
            font-size: 1.4em;
            font-weight: 600;
            color: #333;
        }

        .info-card {
            background-color: #e9f0fa;
            padding: 20px;
            border-radius: 8px;
            position: relative;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .info-card h3 {
            margin-top: 0;
            font-size: 1.1em;
            font-weight: 600;
            color: #333;
        }

        #edit-btn {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 8px 12px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background-color 0.3s ease;
        }

        #edit-btn1 {
            position: absolute;
            top: 20px;
            right: 20px;
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 8px 12px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 0.9em;
            transition: background-color 0.3s ease;
        }

        #edit-btn:hover {
            background-color: #0056b3;
        }

        #edit-btn1:hover {
            background-color: #0056b3;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 0.95em;
        }

        table th,
        table td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #007bff;
            color: white;
            font-weight: 600;
        }

        table td {
            color: #333;
        }

        .hidden {
            display: none;
        }


/* Popup Form Styles */
.popup-form {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            max-width: 500px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .popup-form label {
            display: block;
            margin-bottom: 5px;
        }

        .popup-form input, .popup-form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .popup-form button {
            background-color: #28a745;
        }

        .popup-form button:hover {
            background-color: #218838;
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 500;
        }

        .overlay.active, .popup-form.active {
            display: block;
        }

        .close-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .close-btn:hover {
            background-color: #c82333;
        }

        @media (max-width: 600px) {
            .container {
                width: 95%;
            }

            table th, 
            table td {
                padding: 8px;
            }

            .edit-btn {
                padding: 6px 10px;
            }

            .profile-header h2 {
                font-size: 1.2em;
            }
        }





        .popup-form1 {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            max-width: 500px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            z-index: 1000;
        }

        .popup-form1 label {
            display: block;
            margin-bottom: 5px;
        }

        .popup-form1 input, .popup-form1 select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .popup-form1 button {
            background-color: #28a745;
        }

        .popup-form1 button:hover {
            background-color: #218838;
        }

        .overlay1 {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 500;
        }

        .overlay1.active, .popup-form1.active {
            display: block;
        }

        .close-btn1 {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .close-btn1:hover {
            background-color: #c82333;
        }

        @media (max-width: 600px) {
            .container {
                width: 100%;
            }

            table th, 
            table td {
                padding: 8px;
            }

            .edit-btn1 {
                padding: 6px 10px;
            }

            .profile-header h2 {
                font-size: 1.2em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>User Profile</h1>
        </header>
        
        <nav>
            <a href="#" class="active" id="personal-info-tab">Personal Information</a>
            <a href="#" id="bank-details-tab">Banking Details</a>
        </nav>

        <section class="profile-info">
            <div id="personal-info-section">
                <div class="profile-header">
                    <div class="badge">1</div>
                    <h2><?php echo strtoupper (htmlspecialchars($full_name)); ?></h2>
                </div>
                <div class="info-card">
                    <h3>Personal Information</h3>
                    <button id="edit-btn">Edit</button>
                    <table>
                        <tr>
                            <th>Field</th>
                            <th>Details</th>
                        </tr>
                        <tr>
                            <td><strong>Username</strong></td>
                            <td> <?php echo htmlspecialchars($username); ?></td>
                        </tr>

                        <tr>
                            <td><strong>Full Name</strong></td>
                            <td> <?php echo htmlspecialchars($full_name); ?></td>
                        </tr>

                        <tr>
                            <td><strong>Email</strong></td>
                            <td><?php echo htmlspecialchars($email); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Phone Number (Primary)</strong></td>
                            <td><?php echo htmlspecialchars($telephone); ?></td>
                        </tr>
                        
                        <tr>
                            <td><strong>Country</strong></td>
                            <td><?php echo htmlspecialchars($country_of_residence); ?></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div id="bank-details-section" class="hidden">
                <div class="profile-header">
                    <div class="badge">2</div>
                    <h2><?php echo strtoupper(htmlspecialchars($full_name)); ?></h2>
                </div>
                <div class="info-card">
                    <h3>Bank Account Information</h3>
                    <button id="edit-btn1">Edit</button>
                    <table>
                        <tr>
                            <th>Field</th>
                            <th>Details</th>
                        </tr>
                        <tr>
                            <td><strong>Payment Method</strong></td>
                            <td><?php echo htmlspecialchars($payment_method); ?></td>
                        </tr>

                        <tr>
                            <td><strong>Bank Country</strong></td>
                            <td><?php echo htmlspecialchars($bank_country); ?></td>
                        </tr>

                        <tr>
                            <td><strong>Bank Name</strong></td>
                            <td><?php echo htmlspecialchars($bank_name); ?></td>
                        </tr>

                        <tr>
                            <td><strong>Account Number</strong></td>
                            <td><?php echo htmlspecialchars($account_number); ?></td>
                        </tr>
                        <tr>
                            <td><strong>Account name</strong></td>
                            <td><?php echo htmlspecialchars($account_name); ?></td>
                        </tr>
                        
                    </table>
                </div>
            </div>
        </section>
    </div>

    <div class="overlay" id="overlay"></div>
    <div class="popup-form" id="popupForm">
        <button class="close-btn" id="closeBtn">X</button>
        <h2>Edit Details</h2>
        <form method="post" action="update_profile.php">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" required>

            <label for="telephone">Telephone:</label>
            <input type="tel" id="telephone" name="telephone" value="<?php echo htmlspecialchars($telephone); ?>" required>

            <label for="country_of_residence">Country of Residence:</label>
            <input type="text" id="country_of_residence" name="country_of_residence" value="<?php echo htmlspecialchars($country_of_residence); ?>" required>

            <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">

            <button type="submit">Save Changes</button>
        </form>
    </div>



    <div class="overlay1" id="overlay1"></div>
    <div class="popup-form1" id="popupForm1">
        <button class="close-btn1" id="closeBtn1">X</button>
        <h2>Bank Account Information</h2>
        <form method="post" action="update_bank.php">

        <label for="payment_method">Payment Method:</label>
        <select id="payment_method" name="payment_method" onchange="updatePaymentOptions()" value="<?php echo htmlspecialchars($payment_method); ?>" required>
        <option value="">Select Payment Method</option>
                <option value="mobile_money">Mobile Money</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
           

            <label for="country">Bank Country:</label>
            <select id="bank_country" name="bank_country" onchange="updateBanks()" value="<?php echo htmlspecialchars($bank_country); ?>" required>
                <option value="">Select a country</option>
                <option value="Ghana">Ghana</option>
                <option value="USA">USA</option>
                <option value="UK">UK</option>
                <option value="Germany">Germany</option>
                <option value="Other">Other</option>
                <!-- Add more countries as needed -->
            </select>

            <label for="bank_name" class="hidden" id="bank_name_label">Bank Name:</label>
            <select id="bank_name" name="bank_name" class="hidden"  value="<?php echo htmlspecialchars($bank_name); ?>" >
                <option value="">Select a bank</option>
                <!-- Banks will be populated here -->
            </select>

          


            <label for="last_name">Account Nunber:</label>
            <input type="text" id="account_number" name="account_number" value="<?php echo htmlspecialchars($account_number); ?>" required>
            
            <label for="last_name">Account Name:</label>
            <input type="text" id="account_name" name="account_name" value="<?php echo htmlspecialchars($account_name); ?>" required>

            <input type="hidden" name="username" value="<?php echo htmlspecialchars($username); ?>">

            <button type="submit">Save Changes</button>
        </form>
    </div>



    <script>
        // Example data source for banks by country
        const banksByCountry = {
            "USA": ["Bank of America", "Chase", "Wells Fargo"],
            "UK": ["HSBC", "Barclays", "Lloyds"],
            "Germany": ["Deutsche Bank", "Commerzbank", "DZ Bank"]
        };

        function updateBanks() {
            const country = document.getElementById('bank_country').value;
            const bankSelect = document.getElementById('bank_name');
            const bankNameLabel = document.getElementById('bank_name_label');
            const otherBankName = document.getElementById('other_bank_name');
            const otherBankNameLabel = document.getElementById('other_bank_name_label');
            const otherBankCountry = document.getElementById('bank_country');
            const otherBankCountryLabel = document.getElementById('other_bank_country_label');

            // Clear existing options
            bankSelect.innerHTML = '<option value="">Select a bank</option>';

            // Show or hide bank selection based on the country
            if (country === 'Ghana') {
                bankNameLabel.classList.add('hidden');
                bankSelect.classList.add('hidden');
                otherBankNameLabel.classList.add('hidden');
                otherBankName.classList.add('hidden');
                otherBankCountryLabel.classList.add('hidden');
                otherBankCountry.classList.add('hidden');
            } else if (country === 'Other') {
                bankNameLabel.classList.add('hidden');
                bankSelect.classList.add('hidden');
                otherBankNameLabel.classList.remove('hidden');
                otherBankName.classList.remove('hidden');
                otherBankCountryLabel.classList.remove('hidden');
                otherBankCountry.classList.remove('hidden');
            } else if (banksByCountry[country]) {
                // Add new options based on selected country
                banksByCountry[country].forEach(bank => {
                    const option = document.createElement('option');
                    option.value = bank;
                    option.textContent = bank;
                    bankSelect.appendChild(option);
                });

                bankNameLabel.classList.remove('hidden');
                bankSelect.classList.remove('hidden');
                otherBankNameLabel.classList.add('hidden');
                otherBankName.classList.add('hidden');
                otherBankCountryLabel.classList.add('hidden');
                otherBankCountry.classList.add('hidden');
            } else {
                bankNameLabel.classList.add('hidden');
                bankSelect.classList.add('hidden');
                otherBankNameLabel.classList.add('hidden');
                otherBankName.classList.add('hidden');
                otherBankCountryLabel.classList.add('hidden');
                otherBankCountry.classList.add('hidden');
            }
        }

        function updatePaymentOptions() {
            const paymentMethod = document.getElementById('payment_method').value;
            const countrySelect = document.getElementById('country');

            if (paymentMethod === 'mobile_money' && countrySelect.value !== 'Ghana') {
                alert("Mobile Money is only available for Ghanaian users.");
                document.getElementById('payment_method').value = '';
            }
        }
    </script>


    <script>
        document.getElementById('edit-btn1').addEventListener('click', function() {
            document.getElementById('overlay1').classList.add('active');
            document.getElementById('popupForm1').classList.add('active');
        });

        document.getElementById('closeBtn1').addEventListener('click', function() {
            document.getElementById('overlay1').classList.remove('active');
            document.getElementById('popupForm1').classList.remove('active');
        });

        document.getElementById('overlay1').addEventListener('click', function() {
            document.getElementById('overlay1').classList.remove('active');
            document.getElementById('popupForm1').classList.remove('active');
        });
    </script>

    <script>
        document.getElementById('edit-btn').addEventListener('click', function() {
            document.getElementById('overlay').classList.add('active');
            document.getElementById('popupForm').classList.add('active');
        });

        document.getElementById('closeBtn').addEventListener('click', function() {
            document.getElementById('overlay').classList.remove('active');
            document.getElementById('popupForm').classList.remove('active');
        });

        document.getElementById('overlay').addEventListener('click', function() {
            document.getElementById('overlay').classList.remove('active');
            document.getElementById('popupForm').classList.remove('active');
        });
    </script>
</body>


    <script>
        // Get elements
        const personalInfoTab = document.getElementById('personal-info-tab');
        const bankDetailsTab = document.getElementById('bank-details-tab');
        const personalInfoSection = document.getElementById('personal-info-section');
        const bankDetailsSection = document.getElementById('bank-details-section');

        // Event listeners for tab clicks
        personalInfoTab.addEventListener('click', function() {
            personalInfoSection.classList.remove('hidden');
            bankDetailsSection.classList.add('hidden');
            personalInfoTab.classList.add('active');
            bankDetailsTab.classList.remove('active');
        });

        bankDetailsTab.addEventListener('click', function() {
            bankDetailsSection.classList.remove('hidden');
            personalInfoSection.classList.add('hidden');
            bankDetailsTab.classList.add('active');
            personalInfoTab.classList.remove('active');
        });
    </script>
</body>
</html>
