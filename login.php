<?php
session_start();
include "connect.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
       
        $email = mysqli_real_escape_string($conn , $_POST['email']);
        $password = mysqli_real_escape_string($conn , $_POST['password']);
        
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows >0){
            $user = $result->fetch_assoc();
            
                if (password_verify($password, $user['password'])) {
                    // Successful login - redirect with JavaScript
                    $_SESSION['isLoggedIn'] = true;
                    $_SESSION['fullname'] = $user['fullname'];
                  
                    echo "<script>
                      
                        alert('Login successful! Welcome {$user['fullname']}');
                        window.location.href = 'profilpage.php';
                    </script>";
                } else {
                    // Wrong password - show popup
                    echo "<script>
                        alert('Wrong password!');
                        window.history.back();
                    </script>";
                }
            } else {
                // No user found - show popup
                echo "<script>
                    alert('No user with that email!');
                    window.history.back();
                </script>";
            }
    }

?>