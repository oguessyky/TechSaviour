document.querySelector('.all-content').addEventListener('mousemove', function(e) {
    const rect = this.getBoundingClientRect();
    const x = e.clientX - rect.left - rect.width / 2;
    const y = e.clientY - rect.top - rect.height / 2;
    const rotateX = -y / 10; // Adjust the divisor to control the rotation intensity
    const rotateY = x / 10; // Adjust the divisor to control the rotation intensity

    this.style.transform = `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`;
});

document.querySelector('.all-content').addEventListener('mouseleave', function() {
    this.style.transform = 'rotateX(0deg) rotateY(0deg)'; // Reset to default rotation
});
