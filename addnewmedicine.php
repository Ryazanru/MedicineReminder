<?php
    include_once "config.php";
    session_start();
    $USER = $_SESSION['loggedinuser'];
    $EMAIL = $_SESSION['loggedinemail'];

    // $_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit'])
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['submit'])){
        $NAME = $_POST['medname'];
        $TYPE = $_POST['medtype'];
        $DOSAGE = $_POST['dosage'];
        $FREQUENCY = $_POST['selecttype'];
        $DATE = $_POST['time']; // '2021-11-23T19:10 ' single date view. space included
        // '2021-11-25T22:19 2021-11-29T22:19 2021-11-23T22:19 '  multiple date view. space included
        // echo $DATE; 
        $WEEKDAYS = $_POST['weekdays'];
        echo $WEEKDAYS;
        
        
        if($FREQUENCY == "1"){
            // -Argument 'Arg1 Arg2'
            
            $query = "INSERT INTO `reminders` (`Username`, `Email`, `Medicine Name`, `Medicine Type`, `Medicine Dosage`, `Frequency`) VALUES ('$USER', '$EMAIL', '$NAME', '$TYPE', '$DOSAGE', 'Once')";
            if(mysqli_query($conn, $query)){
                $query2 = "SELECT * FROM `reminders` ORDER BY `Id` DESC LIMIT 1";
                $result = mysqli_query($conn, $query2);
                $row = mysqli_fetch_array($result);
                $ID = $row['Id'];
                echo $ID;

                echo "/test";
            $time1 = $DATE;
            $mailcmd = 'C:\xampp\php\php.exe'; // command
            $arguments = 'C:\xampp\htdocs\medicinereminder2\mail.php '.$ID;
            $cmd1 = '$Sta = New-ScheduledTaskAction -Execute '.$mailcmd. ' -Argument \''.$arguments.'\''; // execute
            echo $cmd1;
            //$cmd2 = '$trigger = @($(New-ScheduledTaskTrigger -Once -At '. $time1 .'))'; // when
            $cmd2 = '$trigger = New-ScheduledTaskTrigger -Once -At '. $time1;
            $cmd3 = 'Register-ScheduledTask '.$ID.' -Action $Sta -Trigger $trigger'; // create task
            $check = Shell_Exec("powershell.exe -executionpolicy bypass -NoProfile -Command " . $cmd1 . ";" . $cmd2 . ";". $cmd3 . ";");
            // run on Powershell for TaskManager
            echo "\n".$check;

            echo "<script> alert('Reminder set!') </script>";
            echo "<script> window.location='medicinedisplay.php' </script>";

            }
            else{
                echo "<script> alert('Error ocurred') </script>";
            }
            
        }
        if($FREQUENCY == "2"){
            $query = "INSERT INTO `reminders` (`Username`, `Email`, `Medicine Name`, `Medicine Type`, `Medicine Dosage`, `Frequency`) VALUES ('$USER', '$EMAIL', '$NAME', '$TYPE', '$DOSAGE', 'Multiple days')";
            if(mysqli_query($conn, $query)){
                $query2 = "SELECT * FROM `reminders` ORDER BY `Id` DESC LIMIT 1";
                $result = mysqli_query($conn, $query2);
                $row = mysqli_fetch_array($result);
                $ID = $row['Id'];

                $arr = explode(" ", $DATE);
            // $cmd2 = '$trigger = @( $(New-ScheduledTaskTrigger -Once -At '. $time1 .'), $(New-ScheduledTaskTrigger -Once -At 21:00), $(New-ScheduledTaskTrigger -Once -At 22:00))';
            $mailcmd = 'C:\xampp\php\php.exe'; // command
            $arguments = 'C:\xampp\htdocs\medicinereminder2\mail.php '.$ID;
            $cmd1 = '$Sta = New-ScheduledTaskAction -Execute '.$mailcmd. ' -Argument \''.$arguments.'\''; // execute
            echo $cmd1;
            $cmd2 = '$trigger = @( $(New-ScheduledTaskTrigger -Once -At '. $arr[0];
            $add = '), $(New-ScheduledTaskTrigger -Once -At ';
            for($i = 1; $i < sizeof($arr) - 1; $i++){
                $cmd2 = $cmd2.$add.$arr[$i];
                
            }
            
            $cmd2 = $cmd2.'))'; 
            echo $cmd2;
            $cmd3 = 'Register-ScheduledTask '.$ID.' -Action $Sta -Trigger $trigger'; // create task
            $check = Shell_Exec("powershell.exe -executionpolicy bypass -NoProfile -Command " . $cmd1 . ";" . $cmd2 . ";". $cmd3 . ";");
            echo "\n".$check;

            echo "<script> alert('Reminder set!') </script>";
            echo "<script> window.location='medicinedisplay.php' </script>";
            }  
            else{
                echo "<script> alert('Error ocurred') </script>";
            }
            
            
            
            // generate $cmd2 which should have tiggers as per $DATE using $time variables
            // loop over $DATE array and for each element append a tasktrigger to $cmd2
        }
        
        if($FREQUENCY == "3"){
            $query = "INSERT INTO `reminders` (`Username`, `Email`, `Medicine Name`, `Medicine Type`, `Medicine Dosage`, `Frequency`) VALUES ('$USER', '$EMAIL', '$NAME', '$TYPE', '$DOSAGE', 'Days per Week')";
            if(mysqli_query($conn, $query)){
                $query2 = "SELECT * FROM `reminders` ORDER BY `Id` DESC LIMIT 1";
                $result = mysqli_query($conn, $query2);
                $row = mysqli_fetch_array($result);
                $ID = $row['Id'];

                $dayofweek = explode(" ", $WEEKDAYS);
                echo $DATE;

                // 'Monday, Tuesday, Saturday' needs "'Monday','Tuesday','Saturday'"
                // run for loop to apend each day seperatly.
                

                $mailcmd = 'C:\xampp\php\php.exe'; // command
            $arguments = 'C:\xampp\htdocs\medicinereminder2\mail.php '.$ID;
            $cmd1 = '$Sta = New-ScheduledTaskAction -Execute '.$mailcmd. ' -Argument \''.$arguments.'\''; // execute
            
            $cmd2 = '$trigger = New-ScheduledTaskTrigger -Weekly -At '.$DATE. ' -DaysOfWeek ';
            for($i = 0; $i < sizeof($dayofweek) -2; $i++){
                
                $cmd2 = $cmd2.$dayofweek[$i].", ";
            }
            $add = $dayofweek[sizeof($dayofweek) - 2];
            // $dayofweek[Monday, Tuesday, Sunday, ""];
            // $dayofweek[0]
            // $cmd2+Monday,
            // $dayofweek[1]
            // $cmd2+Monday,+Tuesday,
            // $cmd2+Monday,+Tuesday,+$dayofweek[Sunday]
            $cmd2 = $cmd2.$add;
            echo $cmd2;
            $cmd3 = 'Register-ScheduledTask '.$ID.' -Action $Sta -Trigger $trigger'; // create task
            $check = Shell_Exec("powershell.exe -executionpolicy bypass -NoProfile -Command " . $cmd1 . ";" . $cmd2 . ";". $cmd3 . ";");
            // run on Powershell for TaskManager
            echo "\n".$check;    

            echo "<script> alert('Reminder set!') </script>";
            echo "<script> window.location='medicinedisplay.php' </script>";
            }
            else{
                echo "<script> alert('Error ocurred') </script>";
            }
        }
        if($FREQUENCY == "4"){
            $query = "INSERT INTO `reminders` (`Username`, `Email`, `Medicine Name`, `Medicine Type`, `Medicine Dosage`, `Frequency`) VALUES ('$USER', '$EMAIL', '$NAME', '$TYPE', '$DOSAGE', 'Daily')";
            if(mysqli_query($conn, $query)){
                $query2 = "SELECT * FROM `reminders` ORDER BY `Id` DESC LIMIT 1";
                $result = mysqli_query($conn, $query2);
                $row = mysqli_fetch_array($result);
                $ID = $row['Id'];
                echo $ID;

                $time1 = $DATE; // 0000-00-00T19:10
                $arr = explode("T", $DATE);
                
            $mailcmd = 'C:\xampp\php\php.exe'; // command
            $arguments = 'C:\xampp\htdocs\medicinereminder2\mail.php '.$ID;
            $cmd1 = '$Sta = New-ScheduledTaskAction -Execute '.$mailcmd. ' -Argument \''.$arguments.'\''; // execute
            echo $cmd1;
            //$cmd2 = '$trigger = @($(New-ScheduledTaskTrigger -Once -At '. $time1 .'))'; // when
            $cmd2 = '$trigger = New-ScheduledTaskTrigger -Daily -At '. $arr[1];
            $cmd3 = 'Register-ScheduledTask '.$ID.' -Action $Sta -Trigger $trigger'; // create task
            $check = Shell_Exec("powershell.exe -executionpolicy bypass -NoProfile -Command " . $cmd1 . ";" . $cmd2 . ";". $cmd3 . ";");
            // run on Powershell for TaskManager
            echo "\n".$check;

            echo "<script> alert('Reminder set!') </script>";
            echo "<script> window.location='medicinedisplay.php' </script>";
            }    
            else{
                echo "<script> alert('Error ocurred') </script>";
            }
        }

        
        
        //$mailcmd = 'C:\xampp\php\php.exe C:\xampp\htdocs\medicinereminder\mail.php';
        // first code listed is primary command, rest are arguments.
        

        
        
        

         
        
        
    }

?>