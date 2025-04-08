<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registration";

// Initialize error variables and error array
$firstname_error = $lastname_error = $vendor_username_error = $email_error = $password_error = $confirm_password_error = "";
$errors = [];

// Connect to the database
$db = mysqli_connect($servername, $username, $password, $dbname, );

// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $vendor_username = $_POST['vendor_username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validation logic
    if (empty($firstname)) {
        $firstname_error = 'First name is required.';
        $errors[] = $firstname_error;
    }
    
    if (empty($lastname)) {
        $lastname_error = 'Last name is required.';
        $errors[] = $lastname_error;
    }
    
    if (empty($vendor_username)) {
        $vendor_username_error = 'Username is required.';
        $errors[] = $vendor_username_error;
    }
    
    if (empty($email)) {
        $email_error = 'Email is required.';
        $errors[] = $email_error;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = 'Invalid email format.';
        $errors[] = $email_error;
    }
    
    if (empty($password)) {
        $password_error = 'Password is required.';
        $errors[] = $password_error;
    }
    
    if ($password !== $confirm_password) {
        $confirm_password_error = 'Passwords do not match.';
        $errors[] = $confirm_password_error;
    }

    // Check if username or email already exists in the database
    if (empty($errors)) {
        $email_check_query = "SELECT * FROM vendors WHERE vendor_username = ? OR email = ? LIMIT 1";
        $stmt = $db->prepare($email_check_query);
        $stmt->bind_param("ss", $vendor_username, $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($result->num_rows > 0) {
            if ($user && $user['vendor_username'] === $vendor_username) {
                $username_error = "Username is not available, someone already exists with this username.";
                $errors[] = $vendor_username_error;
            }
            if ($user && $user['email'] === $email) {
                $email_error = 'Email already exists. Please use a different email.';
                $errors[] = $email_error;
            }
        }

        $stmt->close();
    }

    // Password validation
    if (empty($password)) {
        $password_error = 'Password is required.';
        $errors[] = $password_error;
    } elseif (strlen($password) <= 6) {
        $password_error = 'Password must be more than 6 characters long.';
        $errors[] = $password_error;
    } elseif (!preg_match('/[A-Za-z]/', $password) || !preg_match('/[0-9]/', $password)) {
        $password_error = 'Password must contain both letters and numbers.';
        $errors[] = $password_error;
    } elseif (!preg_match('/[@$%&]/', $password)) {
        $password_error = 'Password must contain at least one special character (@, $, %, &).';
        $errors[] = $password_error;
    }

    // Confirm password validation
    if ($password !== $confirm_password) {
        $confirm_password_error = 'Passwords do not match.';
        $errors[] = $confirm_password_error;
    }

    // If no errors, proceed with registration
    if (empty($errors)) {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Prepare the SQL statement for inserting the vendor data
        $stmt = $db->prepare("INSERT INTO vendors (firstname, lastname, vendor_username, email, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $vendor_username, $email, $hashed_password);

        // Execute the statement
        if ($stmt->execute()) {
            // If registration is successful, set a success message
            $_SESSION['success'] = "Vendor registered successfully!";
            // Redirect to the login page
            echo '<script>alert("Vendor registered successfully!"); window.location.href="loginven.php";</script>';
            exit();
        } else {
            $errors[] = 'Error: ' . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the database connection
$db->close();
?>
