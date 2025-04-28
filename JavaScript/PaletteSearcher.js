const images = {
    pink: [
        "Image/pink/p1.jpg",
        "Image/pink/p2.jpg",
        "Image/pink/p3.jpg",
        "Image/pink/p4.jpg"
    ],
    red: [
        "Image/red/r1.jpg",
        "Image/red/r2.jpg",
        "Image/red/r3.jpg",
        "Image/red/r4.jpg",
        "Image/red/r5.png",
        "Image/red/r6.png",
        "Image/red/r7.png"
    ],
    purple: [
        "Image/purple/pu1.jpg",
        "Image/purple/pu2.jpg",
        "Image/purple/pu3.jpg",
        "Image/purple/pu4.jpg",
        "Image/purple/pu5.jpg"
    ],
    green: [
        "Image/green/g1.jpg",
        "Image/green/g2.jpg",
        "Image/green/g3.jpg",
        "Image/green/g4.jpg"
    ],
    orange: [
        "Image/orange/o1.jpg",
        "Image/orange/o2.jpg",
        "Image/orange/o3.jpg",
        "Image/orange/o4.jpg",
        "Image/orange/o5.png"
    ],
    teal: [
        "Image/teal/t1.jpg",
        "Image/teal/t2.jpg",
        "Image/teal/t3.jpg",
        "Image/teal/t4.jpg",
        "Image/teal/t5.jpg"
    ]
};

// Lytter på farve-kvadraterne
document.querySelectorAll('.color-square').forEach(square => {
    square.addEventListener('click', function() {
        const color = this.getAttribute('data-color');
        showImages(color);
    });
});

// Funktion til at vise billeder efter farve
function showImages(color) {
    const display = document.getElementById('palette-display');
    display.innerHTML = ''; // Ryd det gamle indhold

    if (images[color]) {
        images[color].forEach(imgPath => {
            const img = document.createElement('img');
            img.src = imgPath;
            img.className = 'color-image';
            img.crossOrigin = "anonymous"; 
            img.addEventListener('click', function() {
                extractColors(this);
            });
            display.appendChild(img);
        });
    }
}

// Vis alle billeder fra start
window.onload = function() {
    showAllImages();
};

function showAllImages() {
    const display = document.getElementById('palette-display');
    display.innerHTML = '';
    for (let color in images) {
        images[color].forEach(imgPath => {
            const img = document.createElement('img');
            img.src = imgPath;
            img.className = 'color-image';
            img.crossOrigin = "anonymous"; 
            img.addEventListener('click', function() {
                extractColors(this);
            });
            display.appendChild(img);
        });
    }
}

// Funktion til at hente farver fra billede
function extractColors(imgElement) {
    const colorThief = new ColorThief();
    
    if (imgElement.complete) {
        showColors(imgElement, colorThief.getPalette(imgElement, 5));
    } else {
        imgElement.addEventListener('load', function() {
            showColors(imgElement, colorThief.getPalette(imgElement, 5));
        });
    }
}

// Funktion til at vise billede + farver
function showColors(imgElement, palette) {
    const display = document.getElementById('palette-display');
    display.innerHTML = ''; // Ryd det gamle indhold

    // Opret billede og placer det øverst
    const selectedImage = document.createElement('img');
    selectedImage.src = imgElement.src;
    selectedImage.className = 'selected-image'; // Klasse til styling

    // Opret farvepaletten og placer den under billedet
    const colorsDiv = document.createElement('div');
    colorsDiv.className = 'color-palette';

    palette.forEach(color => {
        const hex = rgbToHex(color[0], color[1], color[2]);
        const colorBox = document.createElement('div');
        colorBox.className = 'color-box';
        colorBox.style.backgroundColor = hex;
        colorBox.innerHTML = `<p>${hex}</p>`;
        colorsDiv.appendChild(colorBox);
    });

    // Opret "Back"-knappen og placer den under farverne
    const backButton = document.createElement('button');
    backButton.textContent = "Back";
    backButton.onclick = showAllImages;
    backButton.className = 'back-button';

    // Tilføj billedet og farverne til displayet
    display.appendChild(selectedImage);
    display.appendChild(colorsDiv);
    display.appendChild(backButton);
}


// Funktion til at lave RGB om til HEX
function rgbToHex(r, g, b) {
    return "#" + [r, g, b].map(x => {
        const hex = x.toString(16);
        return hex.length === 1 ? '0' + hex : hex;
    }).join('').toUpperCase();;
}
