function getTextColor(hex) {
    const r = parseInt(hex.slice(1, 3), 16);
    const g = parseInt(hex.slice(3, 5), 16);
    const b = parseInt(hex.slice(5, 7), 16);

    // Calculate luminance (perceived brightness)
    const luminance = 0.299 * r + 0.587 * g + 0.114 * b;
    return luminance > 150 ? "black" : "white"; // threshold ~150 works well
}

// Funktion: HEX til RGB
function hexToRgb(hex) {
    let bigint = parseInt(hex.slice(1), 16);
    let r = (bigint >> 16) & 255;
    let g = (bigint >> 8) & 255;
    let b = bigint & 255;
    return `${r}, ${g}, ${b}`;
}

let colors = [];

// Funktion: Generér nye farver
function generateColors() {
    colors = [];
    for (let i = 0; i < 5; i++) {
        colors.push({
            hex: getRandomHexColor(),
            locked: false
        });
    }
    renderColorCards();
}

function getRandomHexColor() {
    return "#" + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0').toUpperCase();
}

// Funktion: Render farvekort
function renderColorCards() {
    const container = document.getElementById("colorContainer");
    container.innerHTML = "";

    colors.forEach((color, index) => {
        const card = document.createElement("div");
        card.className = "color-card";
        card.style.backgroundColor = color.hex;
        card.draggable = true;
        const textColor = getTextColor(color.hex);

        card.innerHTML = `
            <div class="colorValues" style="color: ${textColor}" !important">
                <div class="buttons">
                    <button onclick="toggleLock(${index})">${color.locked ? '🔒' : '🔓'}</button>
                    <button onclick="copyToClipboard('${color.hex}')">
                        <img src="Image/HashtagCopyIcon.png" alt="Copy HEX">
                    </button>
                    <button onclick="copyToClipboard('${hexToRgb(color.hex)}')">
                        <img src="Image/RGBCopyIcon.png" alt="Copy RGB">
                    </button>
                </div>
                <p>${hexToRgb(color.hex)}</p>
                <p>${color.hex}</p>
            </div>
        `;

        // Drag-and-drop events
        card.addEventListener("dragstart", e => {
            e.dataTransfer.setData("text/plain", index);
        });

        card.addEventListener("dragover", e => {
            e.preventDefault();
        });

        card.addEventListener("drop", e => {
            const fromIndex = e.dataTransfer.getData("text/plain");
            const toIndex = index;
            [colors[fromIndex], colors[toIndex]] = [colors[toIndex], colors[fromIndex]];
            renderColorCards();
        });

        container.appendChild(card);
    });
}

function toggleLock(index) {
    colors[index].locked = !colors[index].locked;
    renderColorCards();
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        const msg = document.getElementById("copyMessage");
        msg.innerText = `${text} copied!`;
        msg.classList.add("animate__fadeIn");
        setTimeout(() => {
            msg.classList.remove("animate__fadeIn");
            msg.innerText = "";
        }, 2000);
    });
}

document.addEventListener("keydown", (e) => {
    if (e.code === "Space") {
        e.preventDefault();
        colors = colors.map(color => (
            color.locked ? color : { ...color, hex: getRandomHexColor() }
        ));
        renderColorCards();
    }
});

document.addEventListener("DOMContentLoaded", () => {
    generateColors();
});
