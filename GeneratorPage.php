<?php
session_start();
$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'];
$user = isset($_SESSION['user_id']) && $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Color Palette</title>
    <link rel="stylesheet" href="css/colorpalette.css">
    <link rel="stylesheet" href="css/forgenerating.css">
    <link rel="icon" href="Image/PaletteIcon.png" type="image/png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
</head>
<body>
    <div class="pageWrapper">
    <div class="topnav">
        <a class="active" href="Index.php">Color palette creator</a>
        <div class="topnav-right">
            <a class="active" href="Index.php">Home</a>
            <a class="active" href="generatorpage.php">Color creator</a>
            <a class="active" href="palettepage.php">Palettes</a>
            <a class="active" href="profilpage.php">Profil</a>
            <a class="active" id="login">Login</a>
        </div>
    </div>

    <div class="colorContainer" id="colorContainer"></div>

    <center>
        <div class="generate">
            <button onclick="generateColors()">Generate Palette</button>
        </div>
    </center>

    <p id="copyMessage" class="animate__animated" style="text-align:center; font-weight:bold;"></p>
    </div>

    
    <script>
                    let isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
                    const logout = document.getElementById('login');
        
                    if (isLoggedIn) {
                        logout.textContent = "Logout";
                        logout.href="Logout.php";
                    }
                    else{
                        logout.textContent = "Login";
                        logout.href="loginpage.html";
                        console.log(isLoggedIn)
                    }
                    
                    function hexToRgb(hex) {
                        let bigint = parseInt(hex.slice(1), 16);
                        let r = (bigint >> 16) & 255;
                        let g = (bigint >> 8) & 255;
                        let b = bigint & 255;
                        return `${r}, ${g}, ${b}`;
                    }
                    
                    let colors = [];
                    
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
                    
    </script>
</body>
</html>