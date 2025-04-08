<?php include('server.php') ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Growth Grid 26 - Register</title>
    <link rel="stylesheet" href="style.css">


    <style>


body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f0f2f5;
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

    </style>
</head>
<body>
    <div class="container-split">
        <!-- Left Section: Content -->
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
        <div class="right-section">
            <div class="form-container">
                <h2>Create Account As Affiliate</h2>
                <p>Already have an Account? <a href="login.php">Sign In</a></p>
                <form method="post" action="register.php">
				<?php include('errors.php'); ?>
				<section id="registration-form">
                    <div class="form-group">
                        <label for="affiliate_username">Username</label>
                        <input type="text" id="affiliate_username" name="affiliate_username"   required   >
                    </div>
                    
					

                     <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" required> 

                    </div>

                    <div class="form-group">
      	            <label>Password</label>
      	             <input type="password" name="password_1">
      	           </div> 

                     <div class="form-group">
      	            <label>Confirm password</label>
      	             <input type="password" name="password_2">
      	           </div> 

                    
                     <p>Do you  have your own product to sell? <a href="vender.php">Clich here</a></p>

                    <button type="submit" class="cta-button" name="reg_user">Create my free Account</button>
                </form>
              </section>
            </div>
        </div>
    </div>

    <script>
		document.addEventListener("DOMContentLoaded", function () {
    // Typing Effect
    const text = "Your Internet Income Journey Starts Here";
    let index = 0;
    const speed = 100; // Adjust typing speed (milliseconds)

    function typeEffect() {
        if (index < text.length) {
            document.getElementById("typing-text").innerHTML += text.charAt(index);
            index++;
            setTimeout(typeEffect, speed);
        }
    }

    typeEffect();

    // Testimonial Slideshow
    let slideIndex = 0;
    const slides = document.getElementsByClassName("testimonial-slide");

    function showSlides() {
        for (let i = 0; i < slides.length; i++) {
            slides[i].classList.remove("active");
        }
        slideIndex++;
        if (slideIndex > slides.length) { slideIndex = 1; }
        slides[slideIndex - 1].classList.add("active");
        setTimeout(showSlides, 4000); // Change slide every 4 seconds
    }

    showSlides();
});

	</script>
</body>
</html>
