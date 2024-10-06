document.addEventListener('DOMContentLoaded', function() {
    const navIcons = document.querySelectorAll('nav a.navIcon');
    const activeIcon = document.querySelector('nav a.navIcon.active');

    navIcons.forEach(icon => {
        icon.addEventListener('mouseover', () => {
            if (activeIcon && !icon.classList.contains('active')) {
                activeIcon.classList.add('inactive');
            }
        });

        icon.addEventListener('mouseout', () => {
            if (activeIcon) {
                activeIcon.classList.remove('inactive');
            }
        });

        icon.addEventListener('mouseover', () => {
            if (icon.classList.contains('active')) {
                icon.classList.remove('active');
                void icon.offsetWidth; // Trigger reflow to restart the animation
                icon.classList.add('active');
            }
        });
    });
});
