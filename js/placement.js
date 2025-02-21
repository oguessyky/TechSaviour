document.addEventListener('DOMContentLoaded', () => {
    const allContents = document.querySelectorAll('.all-content');
    const progressElements = document.querySelectorAll('progress');
    let maxWidth = 0;
    let maxHeight = 0;

    // Calculate the maximum width and height
    allContents.forEach(content => {
        const rect = content.getBoundingClientRect();
        maxWidth = Math.max(maxWidth, rect.width);
        maxHeight = Math.max(maxHeight, rect.height);
    });

    // Apply the maximum width and height to all elements
    allContents.forEach(content => {
        content.style.width = `${maxWidth}px`;
        content.style.height = `${maxHeight}px`;
    });
});
