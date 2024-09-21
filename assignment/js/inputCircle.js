const circularInput = document.getElementById('circularInput');
const maskFull = document.getElementById('maskFull');
const fill = document.getElementById('fill');
const valueDisplay = document.getElementById('value');

circularInput.addEventListener('input', (event) => {
    const value = event.target.value;
    const angle = (value / 100) * 360;
    if (angle <= 180) {
        maskFull.style.transform = `rotate(${angle}deg)`;
        fill.style.transform = 'rotate(180deg)';
    } else {
        maskFull.style.transform = 'rotate(180deg)';
        fill.style.transform = `rotate(${angle - 180}deg)`;
    }
    valueDisplay.textContent = value;
});
