<?php
session_start();
$isLoggedIn = isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn'];
$fullname = $_SESSION['fullname']
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Color Palette</title>
        <link rel="stylesheet" href="css/colorpalette.css">
        <link rel="stylesheet" href="css/profilpage.css">
        <link rel="icon"  href="Image/PaletteIcon.png" type="image/png">
    </head>
    <body>
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
                <center>
                <div class="profilcon">
                    <h1 id="username">Guest</h1>
                    <p id="colortext">Login for at se hvilken farve du er</p>
                    <div class="colorday"></div>
                </div>
                </center>


<script>
                    let isLoggedIn = <?php echo $isLoggedIn ? 'true' : 'false'; ?>;
                    const logout = document.getElementById('login');
                    
                    const daytext = document.getElementById('colortext');
                    
                    const colorDayDiv = document.querySelector('.colorday');
                    
                    let fullname = "<?php echo htmlspecialchars($fullname) ?>";
                    const UserName = document.getElementById('username');
                    
                    if (isLoggedIn) {
                        logout.textContent = "Logout";
                        logout.href="Logout.php";
                        
                        UserName.textContent = fullname;
                          
                                             
                        daytext.textContent = "Dette er din farve i dag";
                        const randomColor = getRandomColor();
                        
                        colorDayDiv.style.backgroundColor = getRandomColor();
                    }
                    else{
                        logout.textContent = "Login";
                        logout.href="loginpage.html";
                        console.log(isLoggedIn)
                    }
                    
                    
                    
                    function getRandomColor() {
                            const letters = '0123456789ABCDEF';
                            let color = '#';
                            for (let i = 0; i < 6; i++) {
                                color += letters[Math.floor(Math.random() * 16)];
                            }
                            return color;
                        }
                        
                     
                    </script>
    </body>
</html>