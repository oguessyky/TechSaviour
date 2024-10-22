document.addEventListener('DOMContentLoaded', () => {
    const charts = document.querySelectorAll('.chart');
    charts.forEach(chart => {
        const percent = chart.getAttribute('data-percent');
        let currentPercent = -1;
        const interval = setInterval(() => {
            if (currentPercent < percent) {
                currentPercent++;
                chart.style.setProperty('--percent', currentPercent);
                chart.querySelector('span').textContent = `${currentPercent}%`;
            } else {
                clearInterval(interval);
            }
        }, 20);
    });
});