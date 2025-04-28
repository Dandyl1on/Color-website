<?php
session_start();
$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Color Palette</title>
        <link rel="stylesheet" href="css/colorpalette.css">
        <link rel="icon"  href="Image/PaletteIcon.png" type="image/png">
    </head>
    <body>
        <div class="banner">
            <img src="Image/MainColors.png">
        
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
            
                
                <div class="content">
                    <button type="button" onclick="document.location='generatorpage.php'">Get creating</button>
                </div>
        </div>    
        <div class="Palette-Example">
            <center>
            <a href="PalettePage.php"><h1>Explore Palettes</h1></a>
            <hr class="Line1">
            <br><br><br><br> 
            <a href="PalettePage.php"><img class="PaletteExamples" src="Image/FlowerPalette.png"></a> <br><br><br><br>
            <a href="PalettePage.php"><img class="PaletteExamples" src="Image/PeoplePalette.png"></a> <br><br><br><br>
            <a href="PalettePage.php"><img class="PaletteExamples" src="Image/SunsetPalette.png"></a> <br><br><br><br>
            <a href="PalettePage.php"><img class="PaletteExamples" src="Image/AirballonPalette.png"></a> <br><br><br><br>
            </center>
        </div>

        <footer id="foot">
            <img src="Image/PaletteIcon.png" class="icon"> <br><br><br><br><br>
            <span class="foot-name">Color palette creator</span><br><br><br><br><br>
                <p>colorcreator@gmail.com</p>
                <p>9000 Aalborg</p>
                <p>Rendsburggade 14</p>
                <p>Aalborg University</p>
        </footer>
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