<?php
include "connect.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
       
        $email = mysqli_real_escape_string($conn , $_POST['email']);
        $password = mysqli_real_escape_string($conn , $_POST['password']);
        
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);
        if ($result->num_rows >0){
            $user = $result->fetch_assoc();
            
            if(password_verify($password,$user['password'])){
                echo "Login successful!, welcome " . $user['fullname'];
                
                header("Location: HomePage.html");
            }
            else{
                echo "Wrong password";
            }
        }
        else{
            echo "No user with that email";
        }
    }

?>