<?php
    include "config.php";

    
    $ID = $_GET['id'];

    $query = "DELETE FROM `reminders` WHERE `Id` = $ID";
    if(mysqli_query($conn, $query)){
        $query2 = "INSERT INTO `deleted` (`Task Name`) VALUES ('$ID')";
        if(mysqli_query($conn, $query2)){
            echo "<script> alert('Record deleted successfully') </script>";
            echo "<script> window.location='medicinedisplay.php' </script>";
        }
        else{
            echo "<script> alert('Error occured') </script>";
        }
        // $cmd1 = "Unregister-ScheduledTask -TaskName ". "\"".$ID."\""; // needs string array
        // echo $cmd1;
        // $taskPath = '\Microsoft\Windows\*';
        // $check = Shell_Exec("powershell.exe -executionpolicy bypass -NoProfile -TaskPath " . $taskPath. " -Command " . $cmd1 . " -Confirm:\$false -verb runAS;");
        // echo "\n".$check;
        // powershell.exe -executionpolicy bypass -NoProfile -Command Unregister-ScheduledTask -TaskName "27";Y;

        
       // 
    }
    else{
        echo "<script> alert('Error occured') </script>";
    }
    

    
?>

<!-- delete query -->