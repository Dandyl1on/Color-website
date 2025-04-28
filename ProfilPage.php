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
                <div class="topnav">
                    <!--<a href="ColorPaletteHomePage.php"><img src="Image/PaletteIcon.png" id="logo" span class="span-logo"/></a>-->
                    <a class="active" href="Index.html">Color palette creator</a>
                        <div class="topnav-right">
                            <a class="active" href="Index.php">Home</a>
                            <a class="active" href="generatorpage.php">Color creator</a>
                            <a class="active" href="palettepage.php">Palettes</a>
                            <a class="active" href="profilpage.php">Profil</a>
                            <a class="active" id="login">Login</a>
                            <!--<img src="Image/user.png" alt="Profil" id="profil" span class="span-profil"/>
                            <img src="Image/menu-bar.png" alt="Menu" id="menu" span class="span-menu"/>-->
                        </div>
                </div>


<script>
    // Check if user is logged in
    let isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
    const logout = document.getElementById('login');

    // If logged in, add a logout "link"
    if (isLoggedIn) {
        logout.textContent = "Logout";
        logout.href="Logout.php";
        localStorage.removeItem('isLoggedIn')
        console.log(isLoggedIn)
        }
        else{
        logout.textContent = "Login";
        logout.href="loginpage.html";
        console.log(isLoggedIn)
        }
</script>
    </body>
</html>