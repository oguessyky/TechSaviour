const audio = document.getElementById('audio');
const canvas = document.getElementById('visualizer');
const ctx = canvas.getContext('2d');

// Set canvas size (adjust as needed)
canvas.width = window.innerWidth/2;
canvas.height = 500;

// Analyze audio data
const audioContext = new AudioContext();
const analyser = audioContext.createAnalyser();
const source = audioContext.createMediaElementSource(audio);
source.connect(analyser);
analyser.connect(audioContext.destination);

analyser.fftSize = 256;
const bufferLength = analyser.frequencyBinCount;
const dataArray = new Uint8Array(bufferLength);

// Function to draw bars based on dataArray values
function drawBars() {
    analyser.getByteFrequencyData(dataArray);

    // Clear the canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Customize bar appearance
    const barWidth = canvas.width / bufferLength;
    const barSpacing = 1;
    const maxBarHeight = canvas.height;

    for (let i = 0; i < bufferLength; i++) {
        const barHeight = dataArray[i] / 300 * maxBarHeight;
        const x = i * (barWidth + barSpacing);
        const y = canvas.height - barHeight;

        // Draw the bar
        ctx.fillStyle = 'rgba(135, 206, 235, 0.7)'; // Customize color
        ctx.fillRect(x, y, barWidth, barHeight);
    }

    requestAnimationFrame(drawBars);
}

// Start visualization when audio plays
audio.addEventListener('play', () => {
    audioContext.resume().then(() => {
        drawBars();
    });
});
