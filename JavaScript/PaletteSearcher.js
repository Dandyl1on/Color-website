const palettes = {
    red: [
        ["#FF6F61", "#FFB88C", "#FFD3B6"],
        ["#FF6F61", "#C94C4C", "#FF9A8B"]
    ],
    purple: [
        ["#6B5B95", "#B8A9C9", "#EEE3F0"],
        ["#6B5B95", "#83677B", "#B497BD"]
    ],
    green: [
        ["#88B04B", "#A8E6CF", "#DCEDC1"],
        ["#88B04B", "#6B8E23", "#9ACD32"]
    ],
    orange: [
        ["#FFA500", "#FFD580", "#FFB347"],
        ["#FFA500", "#FF7F50", "#FF6F61"]
    ],
    teal: [
        ["#009688", "#4DB6AC", "#B2DFDB"],
        ["#009688", "#00796B", "#48C9B0"]
    ]
};

document.querySelectorAll('.color-square').forEach(square => {
    square.addEventListener('click', function() {
        const color = this.getAttribute('data-color');
        showPalettes(color);
    });
});

function showPalettes(color) {
    const display = document.getElementById('palette-display');
    display.innerHTML = ''; // Clear previous palettes
    if (palettes[color]) {
        palettes[color].forEach(palette => {
            const paletteDiv = document.createElement('div');
            paletteDiv.className = 'palette';
            palette.forEach(colorCode => {
                const colorBlock = document.createElement('div');
                colorBlock.className = 'palette-color';
                colorBlock.style.backgroundColor = colorCode;
                paletteDiv.appendChild(colorBlock);
            });
            display.appendChild(paletteDiv);
        });
    }
}
