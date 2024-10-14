let currentIndex = 0;
const slides = document.querySelectorAll('.slides img');
const totalSlides = slides.length;
const dots = document.querySelectorAll('.dot');
let slideInterval = setInterval(showNextSlide, 7000); // Change slide every 7 seconds

function showNextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    updateSlider();
}

function currentSlide(index) {
    currentIndex = index;
    updateSlider();
    clearInterval(slideInterval); // Stop the automatic sliding
    setTimeout(() => {
        slideInterval = setInterval(showNextSlide, 8000); // Restart the automatic sliding after 20 seconds
    }, 20000); // 20 seconds
}

function updateSlider() {
    document.querySelector('.slides').style.transform = `translateX(-${currentIndex * 100}%)`;
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentIndex);
    });
}

dots.forEach((dot, index) => {
    dot.addEventListener('click', () => currentSlide(index));
});

updateSlider(); // Initialize the slider

// Zoom in functionality
slides.forEach((slide) => {
    slide.addEventListener('click', () => {
        const modal = document.getElementById('myModal');
        const modalImg = document.getElementById('modalImage');
        modal.style.display = 'flex';
        modalImg.src = slide.src;
    });
});

function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}