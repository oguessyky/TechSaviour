const laptopButton = document.querySelector('.laptopDatabase');
const userButton = document.querySelector('.userDatabase');
const searchBar = document.getElementById('searchBar');

laptopButton.addEventListener('click', () => {
    toggleActiveClass(laptopButton, userButton);
});
userButton.addEventListener('click', () => {
    toggleActiveClass(userButton, laptopButton);
});
laptopButton.addEventListener('mouseover', () => {
    temporarilyRemoveActiveClass(userButton, laptopButton);
});
laptopButton.addEventListener('mouseout', () => {
    restoreActiveClass(userButton, laptopButton);
});
userButton.addEventListener('mouseover', () => {
    temporarilyRemoveActiveClass(laptopButton, userButton);
});
userButton.addEventListener('mouseout', () => {
    restoreActiveClass(laptopButton, userButton);
});
function toggleActiveClass(activeElement, inactiveElement) {
    activeElement.classList.add('active');
    inactiveElement.classList.remove('active');
    searchBar.style.display = 'flex';
}
function temporarilyRemoveActiveClass(elementToRemove, elementToCheck) {
    if (elementToRemove.classList.contains('active') && !elementToCheck.classList.contains('active')) {
        elementToRemove.classList.add('temp-active');
        elementToRemove.classList.remove('active');
    }
}
function restoreActiveClass(elementToRestore, elementToCheck) {
    if (elementToRestore.classList.contains('temp-active') && !elementToCheck.classList.contains('active')) {
        elementToRestore.classList.add('active');
        elementToRestore.classList.remove('temp-active');
    }
}