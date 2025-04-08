<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// If you want to destroy the session completely, also delete the session cookie.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();

// Redirect to the login page or home page
header("Location: ../../login.php"); // Replace 'login.php' with your desired page
exit;
?>



<div class="logout">
    <a href="logout.php" onclick="return confirm('Are you sure you want to log out?');">
        <i class="fas fa-sign-out-alt"></i>
    </a>
</div>


<div class="logout">
    <a href="logout.php"><i class="fas fa-sign-out-alt"></i></a>
</div>
