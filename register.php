<?php
include "connect.php";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $fullname = mysqli_real_escape_string($conn , $_POST['fullname']);
        $email = mysqli_real_escape_string($conn , $_POST['email']);
        $password = mysqli_real_escape_string($conn , $_POST['password']);

        $checkEmail = "SELECT * FROM users WHERE email= '$email'";
        $result = $conn->query($checkEmail);
        $_SESSION['isLoggedIn'] = true;
        echo "<script>
            localStorage.setItem('isLoggedIn', 'true');
            alert('Account created successful! Welcome {$user['fullname']}');
            window.location.href = 'Index.html';
            </script>";

        if($result->num_rows > 0){
            echo "Email already has an account";
        }
        else{
            $hashed_password = password_hash($password , PASSWORD_BCRYPT);
        
            $sql = "INSERT INTO users(fullname, email, password) VALUES('$fullname', '$email', '$hashed_password')";
            if($conn->query($sql)===TRUE){
                header("Location: Index.html");
            }else{
                echo "Error" .$sql.$conn->error;
            }
        }
    }

?>