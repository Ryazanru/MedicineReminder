<?php
    include_once "config.php";
    

    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit'])){
        $USERNAME = $_POST['username'];
        $EMAIL = $_POST['email'];
        $PASSWORD = md5($_POST['password']); // encryption for password.
        

        $query = "INSERT INTO `credentials` (`Username`, `Email`, `Password`) VALUES ('$USERNAME', '$EMAIL', '$PASSWORD')";
        if(mysqli_query($conn, $query)){
            echo "<script> alert('Registration successful!') </script>";
            echo "<script> window.location='medicineremindermain.php' </script>";
        }
        else{
            echo "<script> alert('Registration error occured') </script>";
        }
    }

?>