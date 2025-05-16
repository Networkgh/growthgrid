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
    <!-- [Rest of your head section remains the same] -->
      <style>
       body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
}

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

.container-split {
    display: flex;
    height: 100vh;
    flex-wrap: wrap; /* Allow wrapping on smaller screens */
}

.left-section {
    background-color:  #003366 ; /* Similar to the blue-green color in the screenshot */
    color: white;
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.left-section .content {
    max-width: 400px;
    text-align: left;
}

#typing-text {
    font-size: 2rem;
    margin-bottom: 20px;
}

.left-section p {
    font-size: 1.2rem;
}

.testimonial-container {
    margin-top: 30px;
    max-width: 100%;
    overflow: hidden;
}

.testimonial-slide {
    display: none;
    text-align: center;
    padding: 20px;
    color: #fff;
}

.testimonial-slide.active {
    display: block;
}

.testimonial-slide img {
    border-radius: 50%;
    width: 80px;
    height: 80px;
    margin-bottom: 15px;
}

.testimonial-slide blockquote {
    font-size: 1rem;
    line-height: 1.4;
}

.testimonial-slide footer {
    margin-top: 10px;
    font-size: 0.9rem;
}

.right-section {
    flex: 1;
    background-color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.form-container {
    max-width: 400px;
    width: 100%;
}

.form-container h2 {
    font-size: 1.8rem;
    margin-bottom: 10px;
}

.form-container p {
    font-size: 1rem;
    margin-bottom: 20px;
}

.form-container p a {
    color: #0066cc; /* A blue color for the link */
    text-decoration: none;
}

.form-container p a:hover {
    text-decoration: underline;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-size: 1rem;
}

.form-group input {
    width: 100%;
    padding: 10px;
    font-size: 1rem;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.cta-button {
    width: 100%;
    padding: 15px;
    background-color: #0066cc; /* Button color */
    color: white;
    font-size: 1rem;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.cta-button:hover {
    background-color:  rgba(2, 2, 16, 0.7); /* Darker blue for hover */
}

/* Responsive Design */
@media (max-width: 768px) {
    .container-split {
        flex-direction: column; /* Stack sections vertically on smaller screens */
        height: auto;
    }

    .left-section, .right-section {
        flex: 100%; /* Make each section take full width */
        padding: 40px 20px;
    }

    #typing-text {
        font-size: 1.5rem; /* Adjust font size for mobile */
        text-align: center;
    }

    .left-section p, .form-container p {
        font-size: 1rem; /* Adjust paragraph font size for mobile */
        text-align: center;
    }

    .testimonial-container {
        margin-top: 20px;
    }

    .testimonial-slide blockquote {
        font-size: 0.9rem;
    }

    .form-container h2 {
        font-size: 1.5rem; /* Adjust form title size for mobile */
        text-align: center;
    }

    .form-container {
        padding: 20px; /* Add padding for mobile */
    }

    .cta-button {
        font-size: 1rem; /* Adjust button size for mobile */
        padding: 12px;
    }
}

@media (max-width: 480px) {
    #typing-text {
        font-size: 1.2rem; /* Further adjust font size for smaller mobile screens */
    }

    .left-section p, .form-container p {
        font-size: 0.9rem; /* Adjust paragraph font size for smaller screens */
    }

    .form-container h2 {
        font-size: 1.2rem; /* Adjust form title size for smaller screens */
    }

    .cta-button {
        font-size: 0.9rem; /* Adjust button size for smaller screens */
        padding: 10px;
    }
}


.error {
	width: 90%; 
    
	margin: 0px auto; 
	padding: 10px; 
	color: red; 
	border-radius: 5px; 
	text-align: left;
}

        .password-strength-meter {
            height: 5px;
            background: #e0e0e0;
            border-radius: 3px;
            margin-bottom: 3px;
            overflow: hidden;
        }

        #password-strength-bar {
            height: 100%;
            width: 0;
            transition: width 0.3s ease, background 0.3s ease;
        }

        .password-feedback {
            font-size: 0.8rem;
            min-height: 1rem;
        }

        /* Strength level colors */
        .strength-0 { background: #ff4757; width: 20%; } /* Very Weak */
        .strength-1 { background: #ff6348; width: 40%; } /* Weak */
        .strength-2 { background: #ffa502; width: 60%; } /* Moderate */
        .strength-3 { background: #2ed573; width: 80%; } /* Strong */
        .strength-4 { background: #2ed573; width: 100%; } /* Very Strong */

        /* Feedback text colors */
        .feedback-weak { color: #ff4757; }
        .feedback-moderate { color: #ffa502; }
        .feedback-strong { color: #2ed573; }
    </style>
</head>
<body>
    
    
    <div class="container-split">
        <!-- Left Section: Content (unchanged) -->
<div class="left-section">
            <div class="content">
                <h1 id="typing-text"></h1>
                <p>You are now only a few clicks away from unlocking your own home-based business.</p>
                <!-- Testimonial Slideshow -->
                <div class="testimonial-container">
                    <div class="testimonial-slide">
                        <img src="testimonial1.jpg" alt="Person 1">
                        <blockquote>
                            <p>Growth Grid 26 has changed my life. I never thought I'd earn from home!</p>
                            <footer>- Alex Johnson</footer>
                        </blockquote>
                    </div>
                    <div class="testimonial-slide">
                        <img src="girl.jpg" alt="Person 2">
                        <blockquote>
                            <p>The support from the community is amazing. Highly recommend it!</p>
                            <footer>- Maria Garcia</footer>
                        </blockquote>
                    </div>
                    <div class="testimonial-slide">
                        <img src="testimonial3.jpg" alt="Person 3">
                        <blockquote>
                            <p>I started earning within the first week. Truly a game-changer.</p>
                            <footer>- Chris Lee</footer>
                        </blockquote>
                    </div>
                </div>
            </div>
        </div>


        <!-- Right Section: Registration Form -->
           <!-- Right Section: Registration Form -->
        <div class="right-section">
            <div class="form-container">
                <h2>Create Account</h2>
                <p>Already have an Account? <a href="login.php">Sign In</a></p>

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
            
                <form method="post" action="register.php">
          
                    <div class="form-group">
                        <label>Account Type</label>
                        <div style="display: flex; gap: 20px; margin-top: 10px;">
                            <label style="display: flex; align-items: center;">
                                <input type="radio" name="role" value="affiliate" checked style="margin-right: 5px;">
                                Affiliate
                            </label>
                            <label style="display: flex; align-items: center;">
                                <input type="radio" name="role" value="vendor" style="margin-right: 5px;">
                                Vendor
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="password_1">Password</label>
                        <input type="password" id="password_1" name="password_1" required 
                               oninput="checkPasswordStrength()">
                        <div class="password-strength-container">
                            <div class="password-strength-meter">
                                <div id="password-strength-bar"></div>
                            </div>
                            <div id="password-feedback" class="password-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="password_2">Confirm password</label>
                        <input type="password" id="password_2" name="password_2" required
                               oninput="checkPasswordMatch()">
                        <div id="password-match-feedback" class="password-feedback"></div>
                    </div>

                    <button type="submit" class="cta-button" name="reg_user" id="submit-btn">Create Account</button>
                </form>
                <!-- [Rest of your form remains the same] -->
            </div>
        </div>
    </div>
 <script>
        // Typing Effect (unchanged)
        document.addEventListener("DOMContentLoaded", function () {
            const text = "Your Internet Income Journey Starts Here";
            let index = 0;
            const speed = 100;

            function typeEffect() {
                if (index < text.length) {
                    document.getElementById("typing-text").innerHTML += text.charAt(index);
                    index++;
                    setTimeout(typeEffect, speed);
                }
            }
            typeEffect();

            // Testimonial Slideshow (unchanged)
            let slideIndex = 0;
            const slides = document.getElementsByClassName("testimonial-slide");
            function showSlides() {
                for (let i = 0; i < slides.length; i++) {
                    slides[i].classList.remove("active");
                }
                slideIndex++;
                if (slideIndex > slides.length) { slideIndex = 1; }
                slides[slideIndex - 1].classList.add("active");
                setTimeout(showSlides, 4000);
            }
            showSlides();
        });
        </script>
    <script>
        // Password Strength Checker
        function checkPasswordStrength() {
            const password = document.getElementById('password_1').value;
            const strengthBar = document.getElementById('password-strength-bar');
            const feedback = document.getElementById('password-feedback');
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            
            // Reset
            strengthBar.className = '';
            feedback.textContent = '';
            feedback.className = 'password-feedback';
            
            // Check if empty
            if (password.length === 0) {
                return;
            }
            
            // Check if password contains username or email
            const emailPrefix = email.split('@')[0].toLowerCase();
            if (password.toLowerCase().includes(username.toLowerCase()) || 
                password.toLowerCase().includes(emailPrefix)) {
                strengthBar.className = 'strength-0';
                feedback.textContent = '✖ Password should not contain your username or email';
                feedback.classList.add('feedback-weak');
                return;
            }
            
            // Calculate strength score (0-4)
            let strength = 0;
            
            // Length (max 2 points)
            if (password.length >= 8) strength += 1;
            if (password.length >= 12) strength += 1;
            
            // Character diversity (max 3 points)
            if (/[A-Z]/.test(password)) strength += 1; // Uppercase
            if (/[0-9]/.test(password)) strength += 1; // Numbers
            if (/[\W_]/.test(password)) strength += 1; // Special chars
            
            // Cap at 4 (our max strength level)
            strength = Math.min(strength, 4);
            
            // Visual feedback
            strengthBar.className = 'strength-' + strength;
            
            // Text feedback
            const messages = [
                'Very Weak - Add more characters and complexity',
                'Weak - Try adding numbers or special characters',
                'Moderate - Could be stronger',
                'Strong - Good password!',
                'Very Strong - Excellent password!'
            ];
            
            const messageClasses = [
                'feedback-weak',
                'feedback-weak',
                'feedback-moderate',
                'feedback-strong',
                'feedback-strong'
            ];
            
            feedback.textContent = messages[strength];
            feedback.classList.add(messageClasses[strength]);
            
            // Update confirm password check
            checkPasswordMatch();
        }
        
        // Password Match Checker
        function checkPasswordMatch() {
            const password1 = document.getElementById('password_1').value;
            const password2 = document.getElementById('password_2').value;
            const feedback = document.getElementById('password-match-feedback');
            const submitBtn = document.getElementById('submit-btn');
            
            if (password2.length === 0) {
                feedback.textContent = '';
                return;
            }
            
            if (password1 !== password2) {
                feedback.textContent = '✖ Passwords do not match';
                feedback.className = 'password-feedback feedback-weak';
                submitBtn.disabled = true;
                submitBtn.style.opacity = '0.7';
            } else {
                feedback.textContent = '✔ Passwords match';
                feedback.className = 'password-feedback feedback-strong';
                submitBtn.disabled = false;
                submitBtn.style.opacity = '1';
            }
        }
    </script>
    

    <!-- [Rest of your scripts remain the same] -->
</body>
</html>