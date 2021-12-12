<?php

    include_once "config.php";

    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit'])){
        $USERNAME = $_POST['username'];
        $PASSWORD = md5($_POST['password']);
        // if user password is 1234, md5(1234) = ZVEK(randomized)
        
        $query = "SELECT * FROM `credentials` WHERE `Username` = '$USERNAME' and `Password` = '$PASSWORD'";
        $result = mysqli_query($conn, $query);
        if($row = mysqli_fetch_array($result)){ // if a row is returned.
            
            session_start();
            $_SESSION['loggedinuser'] = $USERNAME;
            $_SESSION['loggedinemail'] = $row['Email'];
            echo "<script> alert('login successful!') </script>";
            echo "<script> window.location='medicineremindermain.php' </script>";
            
        }
        else{
            echo "<script> alert('Improper credentials') </script>";
        }
    }

?>