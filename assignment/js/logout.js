function showPopup() {
    document.getElementById('logoutPopup').style.display = 'flex';
}

function closePopup() {
    document.getElementById('logoutPopup').style.display = 'none';
}

function logout() {
    // Function place for logout
    alert('Logged out!');
    closePopup();
}