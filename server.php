<?php 
	session_start();
	
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "registration";
    
    // Variable declaration
    $errors = array(); 
    $_SESSION['success'] = "";
    
    // Connect to database
    $db = mysqli_connect($servername, $username, $password, $dbname,);
    
    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }




	// REGISTER USER
// REGISTER USER




if (isset($_POST['reg_user'])) {
    // Receive all input values from the form
    
    $affiliate_username = mysqli_real_escape_string($db, $_POST['affiliate_username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    // Form validation: ensure that the form is correctly filled
    if (empty($affiliate_username)) { array_push($errors, "Username is required"); }
    if (empty($email)) { array_push($errors, "Email is required"); }
    if (empty($password_1)) { array_push($errors, "Password is required"); }

    // Check password requirements: length, letters, numbers, special characters
    if (strlen($password_1) < 6) {
        array_push($errors, "Password must be at least 6 characters long");
    }
    if (!preg_match('/[A-Za-z]/', $password_1)) {
        array_push($errors, "Password must contain at least one letter");
    }
    if (!preg_match('/[0-9]/', $password_1)) {
        array_push($errors, "Password must contain at least one number");
    }
    if (!preg_match('/[@$%]/', $password_1)) {
        array_push($errors, "Password must contain at least one special character (@, $, %)");
    }

    if ($password_1 != $password_2) {
        array_push($errors, "Passwords do not match");
    }

    // Check if username or email already exists
    $user_check_query = "SELECT * FROM affiliates WHERE affiliate_username=? OR email=? LIMIT 1";
    $stmt = $db->prepare($user_check_query);
    $stmt->bind_param("ss", $affiliate_username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) { // If user exists
        if ($user['affiliate_username'] === $affiliate_username) {
            array_push($errors, "Username is not available, someone already exist with this username");
        }
        if ($user['email'] === $email) {
            array_push($errors, "User already exists with this email");
        }
    }

    // Register user if there are no errors in the form
    if (count($errors) == 0) {
        $password = md5($password_1); // Encrypt the password before saving in the database

        // Prepare the SQL query using prepared statements
        $stmt = $db->prepare("INSERT INTO affiliates (affiliate_username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $affiliate_username, $email, $password);

        if ($stmt->execute()) {
            $_SESSION['success'] = "affiliate registered successfully!";
            header('Location: login.php');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement and connection
        $stmt->close();
        $db->close();
    }

    // Optionally, display errors if any
    if (count($errors) > 0) {
        foreach ($errors as $error) {
           // echo "<p style='color: red;'>$error</p>";
        }
    }
}



	


//////*****************LOGIN USER**********************************************************/
//////*****************LOGIN USER**********************************************************/
//////*****************LOGIN USER**********************************************************/
//////*****************LOGIN USER**********************************************************/

// LOGIN USER
if (isset($_POST['login_user'])) {
    // Receive and sanitize input values from the form
    $affiliate_username = mysqli_real_escape_string($db, $_POST['affiliate_username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Form validation: ensure that the form is correctly filled
    if (empty($affiliate_username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // Check if there are no errors in the form
    if (count($errors) == 0) {
        // Encrypt the password
        $password = md5($password);

        // Prepare and execute the query
        $query = "SELECT * FROM affiliates WHERE affiliate_username='$affiliate_username' AND password='$password'";
        $results = mysqli_query($db, $query);

        // Check if user exists
        if (mysqli_num_rows($results) == 1) {
            // Set session variables
            $_SESSION['affiliate_username'] = $affiliate_username;
            $_SESSION['success'] = "You are now logged in";

            // Redirect to the affiliate registration page
            header('Location: dashboard/affiliate/affdash.php'); // Ensure correct path to your affiliate registration page
            exit(); // Ensure no further code is executed after redirection
        } else {
            // If no user is found, add an error message
            array_push($errors, "Invalid username or password");
        }
    }
}

// Optionally, display errors if any
if (count($errors) > 0) {
    foreach ($errors as $error) {
        //echo "<p style='color: red;'>$error</p>";
    }
}






///login vender   


if (isset($_POST['login_vendor'])) {
    // Receive and sanitize input values from the form
    $vendor_username = mysqli_real_escape_string($db, $_POST['vendor_username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    // Form validation: ensure that the form is correctly filled
    if (empty($vendor_username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }

    // Check if there are no errors in the form
    if (count($errors) == 0) {
        // Prepare and execute the query to fetch the user data
        $query = "SELECT * FROM vendors WHERE vendor_username=?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $vendor_username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the user exists
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();

            // Verify the password using password_verify
            if (password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['vendor_username'] = $vendor_username;
                $_SESSION['success'] = "You are now logged in";

                // Redirect to the vendor dashboard page
                header('Location: dashboard/vender/vendor_dashboard.php'); // Ensure the correct path to your vendor dashboard page
                exit(); // Ensure no further code is executed after redirection
            } else {
                // If the password is incorrect, add an error message
                array_push($errors, "Invalid username or password");
            }
        } else {
            // If no user is found, add an error message
            array_push($errors, "Invalid username or password");
        }

        $stmt->close();
    }
}

// Optionally, display errors if any
if (count($errors) > 0) {
    foreach ($errors as $error) {
        echo "<p style='color: red;'>$error</p>";
    }
}
?>
