<?php
session_start();
$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Color Palette</title>
        <link rel="stylesheet" href="css/ColorPalette.css">
        <link rel="stylesheet" href="css/PaletteSearch.css">
        <link rel="icon"  href="Image/PaletteIcon.png" type="image/png">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.2/color-thief.umd.js"></script>
    </head>
    <body>
        <div class="topnav">
            <a class="active" href="Index.php">Color palette creator</a>
                <div class="topnav-right">
                    <a class="active" href="Index.php">Home</a>
                    <a class="active" href="GeneratorPage.php">Color creator</a>
                    <a class="active" href="PalettePage.php">Palettes</a>
                    <a class="active" href="ProfilPage.php">Profil</a>
                    <a class="active" id="login">Login</a>
                </div>
        </div>

        <div class="color-selector">
            <div class="color-square" style="background-color: #E4AFCE;" data-color="pink"></div>
            <div class="color-square" style="background-color: #FF6F61;" data-color="red"></div>
            <div class="color-square" style="background-color: #6B5B95;" data-color="purple"></div>
            <div class="color-square" style="background-color: #88B04B;" data-color="green"></div>
            <div class="color-square" style="background-color: #FFA500;" data-color="orange"></div>
            <div class="color-square" style="background-color: #009688;" data-color="teal"></div>
        </div>
        
        <div id="palette-display"></div>

        <footer id="foot">
            <img src="Image/PaletteIcon.png" class="icon"> <br><br><br><br><br>
            <span class="foot-name">Color palette creator</span><br><br><br><br><br>
                <p>colorcreator@gmail.com</p>
                <p>9000 Aalborg</p>
                <p>Rendsburggade 14</p>
                <p>Aalborg University</p>
        </footer>

        <script src="JavaScript/palettesearcher.js"></script>
        <script>
                            // Check if user is logged in
                            let isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
                            const logout = document.getElementById('login');
                
                            // If logged in, add a logout "link"
                            if (isLoggedIn) {
                                logout.textContent = "Logout";
                                logout.href="Logout.php";
                            }
                            else{
                                logout.textContent = "Login";
                                logout.href="loginpage.html";
                                console.log(isLoggedIn)
                            }
                        </script>
    </body>
</html>