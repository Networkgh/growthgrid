<?php
session_start(); 
    
      if (!isset($_SESSION['username'])) {
      	$_SESSION['msg'] = "You must log in first";
      	//header('location: login.php');
      }
      if (isset($_GET['logout'])) {
      	session_destroy();
      	unset($_SESSION['username']);
      	header("location: login.php");
      }
    ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Growth Grid 26 Affiliate Marketing</title>
    <link rel="stylesheet" href="./assets/index.css">
</head>
<body>
    <div class="video-background">
        <video autoplay muted loop id="background-video">
            <source src="background.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>

    <div class="overlay"></div>

    <div class="container">
        <div class="content">
            <h1 id="title">Growth Grid26 Affiliate Marketing Home</h1>
            <p>Join our network of successful affiliates and start earning today!</p>
            <a href="register.php" class="cta-button">Get Started</a>
        </div>

        <div class="why-choose-us">
            <h2>Why Choose Us?</h2>
            <ul>
                <li>High Commissions and Fast Payouts</li>
                <li>Comprehensive Training and Support</li>
                <li>Access to High-Quality Products</li>
                <li>Real-Time Tracking and Analytics</li>
            </ul>
        </div>

        <div class="testimonials">
            <h2>What Our Affiliates Say</h2>
            <div class="testimonial-slideshow">
                <div class="testimonial-slide active">
                    <img src="./img/girl.jpg" alt="Alex G.">
                    <p>"Growth Grid 26 has completely transformed my income stream. The platform is easy to use, and the commissions are amazing!"</p>
                    <h4>- Alex G.</h4>
                </div>
                <div class="testimonial-slide">
                    <img src="maria.jpg" alt="Maria T.">
                    <p>"The support team is always there to help. I've learned so much, and my earnings have increased significantly."</p>
                    <h4>- Maria T.</h4>
                </div>
            </div>
            <div class="slideshow-controls">
                <span class="prev">❮</span>
                <span class="next">❯</span>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
