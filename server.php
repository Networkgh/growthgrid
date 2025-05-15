<?php
	
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registration";
    $port ="3306";
    
    // Variable declaration
    $errors = array(); 
    $_SESSION['success'] = "";
    
    // Connect to database
    $db = mysqli_connect($servername, $username, $password, $dbname, 3306);
    
    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }




	// REGISTER USER
// REGISTER USER





 // Make sure this includes your $db = new mysqli(...) connection

// REGISTER USER
if (isset($_POST['reg_user'])) {
    $username   = trim($_POST['username']);
    $email      = trim($_POST['email']);
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $role       = isset($_POST['role']) ? $_POST['role'] : 'affiliate';

    $errors = [];

    // Basic validation
    if (empty($username)) array_push($errors, "Username is required");
    if (empty($email))    array_push($errors, "Email is required");
    if (empty($password_1)) array_push($errors, "Password is required");

    // Check password strength
    if (strtolower($password_1) === strtolower($username) || 
        strpos(strtolower($password_1), strtolower(explode('@', $email)[0])) !== false) {
        array_push($errors, "Password cannot contain your username or email name");
    }

    if (strlen($password_1) < 8) {
        array_push($errors, "Password must be at least 8 characters");
    }
    if (!preg_match('/[A-Z]/', $password_1)) {
        array_push($errors, "Password needs at least 1 uppercase letter");
    }
    if (!preg_match('/[a-z]/', $password_1)) {
        array_push($errors, "Password needs at least 1 lowercase letter");
    }
    if (!preg_match('/[0-9]/', $password_1)) {
        array_push($errors, "Password needs at least 1 number");
    }
    if (!preg_match('/[\W_]/', $password_1)) {
        array_push($errors, "Password needs at least 1 special character");
    }

    // Check for existing user
    $stmt = $db->prepare("SELECT * FROM users WHERE username=? OR email=? LIMIT 1");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user['username'] === $username) {
            array_push($errors, "Username already exists");
        }
        if ($user['email'] === $email) {
            array_push($errors, "Email already registered");
        }
    }

    // Proceed with registration if no errors
    if (count($errors) === 0) {
        $password_hash = password_hash($password_1, PASSWORD_BCRYPT);

        $stmt = $db->prepare("INSERT INTO users (username, email, password, role, registered_date) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $username, $email, $password_hash, $role);

        if ($stmt->execute()) {
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $role;
            $_SESSION['success'] = "Registration successful!";

           
                header('Location: login.php');
            
            exit();
        } else {
            array_push($errors, "Database error: " . $stmt->error);
        }
    }

    // If there were errors
    if (count($errors) > 0) {
        $_SESSION['errors'] = $errors;
        header('Location: register.php');
        exit();
    }
}

	


//////*****************LOGIN USER**********************************************************/
//////*****************LOGIN USER**********************************************************/
//////*****************LOGIN USER**********************************************************/
//////*****************LOGIN USER**********************************************************/

// Make sure this is at the VERY TOP of server.php (before any HTML output)

// LOGIN USER
if (isset($_POST['login_user'])) {
    // Initialize error array
    $errors = [];

    // Receive and sanitize input values
    $username = trim(mysqli_real_escape_string($db, $_POST['username']));
    $password = $_POST['password'];

    // Form validation
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    } elseif (strlen($password) < 6) {
        array_push($errors, "Password must be at least 6 characters");
    }

    // If no errors, proceed with login
    if (count($errors) == 0) {
        $query = "SELECT * FROM users WHERE username = ? LIMIT 1";
        $stmt = mysqli_prepare($db, $query);
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user = mysqli_fetch_assoc($result);

        if ($user) {
            // Check if account is banned before verifying password
            if (isset($user['account_status']) && $user['account_status'] === 'banned') {
                array_push($errors, "Your account has been banned. Please contact support.");
            } else {
                if (password_verify($password, $user['password'])) {
                    // Login successful - set session variables
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['role'] = $user['role'];
                    $_SESSION['account_status'] = $user['account_status'] ?? 'active';
                    $_SESSION['success'] = "You are now logged in";
                    session_regenerate_id(true);

                    // Redirect based on role
                    if ($user['role'] === 'vendor') {
                        header('Location: dashboard/vendor_dashboard.php');
                    } else {
                        header('Location: dashboard/affdash.php');
                    }
                    exit();
                } else {
                    array_push($errors, "Invalid username or password combination");
                }
            }
        } else {
            array_push($errors, "Invalid username or password combination");
        }
        mysqli_stmt_close($stmt);
    }

    // Store errors in session and redirect back
    $_SESSION['login_errors'] = $errors;
    header('Location: login.php');
    exit();
}

///login vender   


