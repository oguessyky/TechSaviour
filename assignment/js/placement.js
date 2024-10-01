window.addEventListener('load', () => {
    const allContents = document.querySelectorAll('.all-content');
    let maxWidth = 0;
    let maxHeight = 0;

    // Calculate the maximum width and height
    allContents.forEach(content => {
        const rect = content.getBoundingClientRect();
        if (rect.width > maxWidth) maxWidth = rect.width;
        if (rect.height > maxHeight) maxHeight = rect.height;
    });

    // Apply the maximum width and height to all elements
    allContents.forEach(content => {
        content.style.width = `${maxWidth}px`;
        content.style.height = `${maxHeight}px`;
    });
});
