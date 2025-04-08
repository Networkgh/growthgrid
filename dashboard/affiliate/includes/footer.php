@extends('layouts.app')

@section('content')

<style>
    /* Basic Reset */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    /* Video Background */
    .video-background {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        z-index: -1;
    }

    #background-video {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Overlay */
    .overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        z-index: -1;
    }

    /* Container Styling */
    .container {
        text-align: center;
        color: white;
        padding: 80px 40px;
        border-radius: 15px;
        background-color: rgba(0, 0, 0, 0.8);
        max-width: 90%;
        margin: 5px auto;
    }

    /* Content Styling */
    #title {
        font-size: 3.5rem;
        margin-bottom: 25px;
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        border-right: 0.15em solid orange;
        width: 0;
        animation: typing 3.5s steps(40, end) forwards, blink-caret 0.75s step-end infinite;
    }

    @keyframes typing {
        from { width: 0; }
        to { width: 100%; }
    }

    @keyframes blink-caret {
        from, to { border-color: transparent; }
        50% { border-color: orange; }
    }

    .content p {
        font-size: 1.5rem;
        margin-bottom: 40px;
    }

    /* Button Styling */
    .cta-button {
        text-decoration: none;
        color: #ffffff;
        background: #ff4b2b;
        padding: 18px 35px;
        border-radius: 50px;
        font-size: 1.5rem;
        transition: background 0.3s ease, transform 0.3s ease;
    }

    .cta-button:hover {
        background: #ff416c;
        transform: scale(1.1);
    }

    /* Why Choose Us Section */
    .why-choose-us {
        margin-top: 70px;
    }

    .why-choose-us h2 {
        font-size: 3rem;
        margin-bottom: 25px;
    }

    .why-choose-us ul {
        list-style-type: none;
        font-size: 1.5rem;
        text-align: left;
        max-width: 700px;
        margin: 0 auto;
    }

    .why-choose-us ul li {
        margin: 15px 0;
    }

    /* Testimonials Section */
    .testimonials {
        margin-top: 70px;
        position: relative;
    }

    .testimonials h2 {
        font-size: 3rem;
        margin-bottom: 25px;
    }

    .testimonial-slide {
        display: none;
        text-align: center;
        font-size: 1.5rem;
        background: rgba(255, 255, 255, 0.1);
        padding: 30px;
        border-radius: 10px;
        max-width: 80%;
        margin: auto;
    }

    .testimonial-slide.active {
        display: block;
    }

    .testimonial-slide img {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        margin-bottom: 15px;
    }

    /* Slideshow Controls */
    .slideshow-controls {
        position: absolute;
        top: 50%;
        width: 100%;
        display: flex;
        justify-content: space-between;
        transform: translateY(-50%);
        padding: 0 20px;
    }

    .slideshow-controls span {
        cursor: pointer;
        font-size: 2.5rem;
        color: white;
    }

    /* Responsive Design */
    @media screen and (max-width: 768px) {
        #title {
            font-size: 2.5rem;
        }
    }

    @media screen and (max-width: 480px) {
        #title {
            font-size: 2rem;
        }

        .cta-button {
            padding: 12px 25px;
            font-size: 1.2rem;
        }
    }
</style>

<div class="video-background">
    <video autoplay muted loop id="background-video">
        <source src="{{ asset('assets/background.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
</div>

<div class="overlay"></div>

<div class="container">
    <div class="content text-center">
        <h1 id="title">Growth Grid26 Affiliate Marketing Home</h1>
        <p>Join our network of successful affiliates and start earning today!</p>
        <a href="{{ route('register') }}" class="cta-button">Get Started</a>
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
        <div class="testimonial-slide active">
            <img src="{{ asset('assets/img/girl.jpg') }}" alt="Alex G.">
            <p>"Growth Grid 26 has completely transformed my income stream. The platform is easy to use, and the commissions are amazing!"</p>
            <h4>- Alex G.</h4>
        </div>
    </div>
</div>

<script>
    let slideIndex = 0;
    showSlides(slideIndex);

    function showSlides(n) {
        let slides = document.getElementsByClassName("testimonial-slide");
        if (n >= slides.length) slideIndex = 0;
        else if (n < 0) slideIndex = slides.length - 1;
        else slideIndex = n;

        for (let slide of slides) slide.classList.remove("active");
        slides[slideIndex].classList.add("active");
    }
</script>

@endsection
