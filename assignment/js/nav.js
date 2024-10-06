document.addEventListener('DOMContentLoaded', function() {
    // Select both a and button elements with the class navIcon
    const navIcons = document.querySelectorAll('nav a.navIcon, nav button.navIcon');
    const activeIcon = document.querySelector('nav a.navIcon.active, nav button.navIcon.active');

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

        icon.addEventListener('click', () => {
            // Reset active class for all icons
            navIcons.forEach(i => i.classList.remove('active'));
            
            // Add active class to clicked icon
            icon.classList.add('active');
        });
    });
});
