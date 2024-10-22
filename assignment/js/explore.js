document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll('.circle-button-explore');
    buttons.forEach(button => {
        const initialValue = parseInt(button.getAttribute('data-initial'));
        const maxValue = parseInt(button.getAttribute('data-max'));
        const color = button.getAttribute('data-color');
        button.style.setProperty('--color', color);
        button.style.setProperty('--percent', (initialValue / maxValue) * 100);
        button.querySelector('.number-explore').textContent = initialValue;
    });
});

function buttonClick(element) {
    let numberElement = element.querySelector('.number-explore');
    let initialValue = parseInt(element.getAttribute('data-initial'));
    let maxValue = parseInt(element.getAttribute('data-max'));
    let currentValue = parseInt(numberElement.textContent);
    let input = element.querySelector('.noShow');
    currentValue = (currentValue + 1) % (maxValue + 1);
    input.value = currentValue;
    numberElement.textContent = currentValue;
    element.style.setProperty('--percent', (currentValue / maxValue) * 100);
}