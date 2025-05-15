<?php 
session_start();
if (isset($_SESSION['login_error'])) {
    echo '<p style="color:red; text-align:center;">' . $_SESSION['login_error'] . '</p>';
    unset($_SESSION['login_error']);
}
include('server.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Growth Grid 26 Affiliate Marketing</title>
    <style>
        .error-alert {
            background-color: #ffebee;
            border-left: 4px solid #f44336;
            padding: 10px 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .error-alert p {
            color: #d32f2f;
            margin: 5px 0;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .error {
            width: 92%; 
            margin: 0px auto; 
            padding: 10px; 
            color: red; 
            border-radius: 5px; 
            text-align: left;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            min-height: 100vh;
        }
        .left-section {
            background-color: #003366;
            color: white;
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .right-section {
            background-color: white;
            flex: 1;
            padding: 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .right-section h2 {
            margin-bottom: 20px;
        }
        .right-section form {
            display: flex;
            flex-direction: column;
        }
        .right-section input {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .right-section button {
            padding: 15px;
            background-color: #0066cc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .right-section button:hover {
            background-color: #00263b;
        }
        .testimonial-section {
            padding: 20px;
            background-color: #003554;
            color: white;
            text-align: center;
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .left-section, .right-section {
                padding: 30px;
                flex: 1;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left-section">
            <h1 id="typing-text">Your Internet Income Journey Starts Here</h1>
            <p>You are now only a few clicks away from unlocking your own home-based business.</p>
        </div>
        <div class="right-section">
            <h2>Welcome Back!</h2>
            <p>Don't have an Account sign up as venders <a href="register.php">Sign Up</a></p>
            
            <!-- Error Display Section -->
            <?php 
            if (isset($_SESSION['login_errors']) && !empty($_SESSION['login_errors'])) {
                echo '<div class="error-alert">';
                foreach ($_SESSION['login_errors'] as $error) {
                    echo '<p>'.$error.'</p>';
                }
                echo '</div>';
                unset($_SESSION['login_errors']);
            }
            ?>
            
            <form method="post" action="login.php">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
                
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                
                <button type="submit" name="login_user">Log In</button>
                
                <p><a href="#">Forgot Password? Click to Reset Password</a></p>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const typingText = document.getElementById('typing-text');
            const text = "Your Internet Income Journey Starts Here";
            let i = 0;

            function typeWriter() {
                if (i < text.length) {
                    typingText.innerHTML += text.charAt(i);
                    i++;
                    setTimeout(typeWriter, 100);
                }
            }

            typeWriter();
        });
    </script>
</body>
</html>