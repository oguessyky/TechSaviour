let currentIndex = 0;
const slides = document.querySelectorAll('.slides img');
const totalSlides = slides.length;
const dots = document.querySelectorAll('.dot');
let slideInterval = setInterval(showNextSlide, 8000); // Change slide every 8 seconds

function showNextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    updateSlider();
}

function currentSlide(index) {
    currentIndex = index;
    updateSlider();
}

function updateSlider() {
    const slidesContainer = document.querySelector('.slides');
    slidesContainer.style.transition = 'transform 2s ease'; // Apply transition timing
    slidesContainer.style.transform = `translateX(-${currentIndex * 100}%)`;
    dots.forEach((dot, index) => {
        dot.classList.toggle('active', index === currentIndex);
    });
}

// Add event listeners for the dots
dots.forEach((dot, index) => {
    dot.addEventListener('click', () => currentSlide(index));
});

// Initialize the slider
updateSlider();

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
