<?php
    include_once "config.php";

    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit'])){
       $NAME = $_POST['medname'];
       $TYPE = $_POST['medtype'];
       $DOSAGE = $_POST['dosage'];
       $ID = $_GET['id'];
       

       $query = "UPDATE `reminders` SET `Medicine Name` = '$NAME', `Medicine Type` = '$TYPE', `Medicine Dosage` = '$DOSAGE' WHERE `Id` = '$ID'";
       if(mysqli_query($conn, $query)){
           echo "<script> alert('Medicine updated successfully') </script>";
           echo "<script> window.location='medicineremindermain.php' </script>";
       }
       else{
            echo "<script> alert('Error occured') </script>";
       }
    }
?>