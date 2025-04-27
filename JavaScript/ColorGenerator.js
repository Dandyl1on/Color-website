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

// Function to generate a random hex color
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

        card.innerHTML = `
            <div class="colorValues">
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

// Space key to regenerate colors
document.addEventListener("keydown", (e) => {
    if (e.code === "Space") {
        e.preventDefault();
        colors = colors.map(color => (
            color.locked ? color : { ...color, hex: getRandomHexColor() }
        ));
        renderColorCards();
    }
});

// Initial color generation on page load
document.addEventListener("DOMContentLoaded", () => {
    generateColors();
});




// Simulerer login status - du kan sætte dette op med rigtig session senere
let isLoggedIn = localStorage.getItem('isLoggedIn') === 'true'; // Sæt til true hvis brugeren er logget ind (skal selvfølgelig være dynamisk i virkeligheden)

// Funktion til at gemme paletten
function savePalette() {
    if (isLoggedIn) {
        // Hvis logget ind, send farverne til server (eller localStorage for nu)
        const palette = colors.map(c => c.hex);

        // Eksempel på "gem" - her logger vi det bare, men du kan sende til server
        console.log("Gemmer palette:", palette);

        // Hvis du har en server route kunne du sende med fetch:
        /*
        fetch('/savePalette', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ palette })
        }).then(res => res.json()).then(data => {
            alert('Palette saved successfully!');
        }).catch(err => {
            alert('Error saving palette.');
        });
        */
        alert('Palette saved!');
    } else {
        // Hvis ikke logget ind, vis popup
        showLoginPopup();
        console.log(isLoggedIn);

    }
}

// Funktion til at vise login/registrerings pop-up
function showLoginPopup() {
    // Laver en simpel popup (kan styles meget pænere)
    const popup = document.createElement("div");
    popup.style.position = "fixed";
    popup.style.top = "0";
    popup.style.left = "0";
    popup.style.width = "100%";
    popup.style.height = "100%";
    popup.style.backgroundColor = "rgba(0,0,0,0.5)";
    popup.style.display = "flex";
    popup.style.justifyContent = "center";
    popup.style.alignItems = "center";
    popup.style.zIndex = "1000";

    popup.innerHTML = `
        <div style="background: white; padding: 40px; border-radius: 12px; text-align: center;">
            <h2>You need to log in</h2>
            <button onclick="location.href='LoginPage.html'" style="margin: 10px; font-size: 20px;">Login</button>
            <button onclick="location.href='RegisterPage.html'" style="margin: 10px; font-size: 20px;">Register</button>
            <br><br>
            <button onclick="closePopup()" style="margin-top: 20px; font-size: 16px;">Close</button>
        </div>
    `;

    document.body.appendChild(popup);
}

// Funktion til at lukke pop-up
function closePopup() {
    const popup = document.querySelector("body > div[style*='position: fixed']");
    if (popup) {
        popup.remove();
    }
}
