// script.js (Optional)
document.addEventListener("DOMContentLoaded", function() {
    const title = document.getElementById("title");
    title.style.width = `${title.offsetWidth}px`;
});

// script.js

let slideIndex = 0;
showSlides(slideIndex);

function showSlides(n) {
    let slides = document.getElementsByClassName("testimonial-slide");

    if (n >= slides.length) {
        slideIndex = 0;
    } else if (n < 0) {
        slideIndex = slides.length - 1;
    } else {
        slideIndex = n;
    }

    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");
    }

    slides[slideIndex].classList.add("active");
}

// Next/previous controls
document.querySelector(".next").addEventListener("click", () => {
    showSlides(slideIndex + 1);
});

document.querySelector(".prev").addEventListener("click", () => {
    showSlides(slideIndex - 1);
});
