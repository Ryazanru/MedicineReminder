<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>medicinedisplay</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/base.css"> <!-- will pull from css base folder and use properties for web display styling-->
    

    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/all.js"></script>

    <style>
        th, td{
            padding:4px;
            text-align:center;
            text-decoration: underline;
        }
        table{
            border-spacing:0px;
            width: 50% !important;
            background: white;
        }
    </style>
</head>

<body style="background: bisque;">
    <div>
        <div style="display: flex;
                    align-items: center;
                    flex-direction: column;">
    <h3 style="text-decoration: underline;">Medicine Reminders</h3>
        <table class="table" border="1">
  
        <tr>
            <th>Name</th>
            <th>Medicine Name</th>
            <th>Medicine Type</th>
            <th>Dosage</th>
            <th>Frequency</th>
            <th colspan = "2">Actions</th>
        </tr>
        <?php include "config.php"; 
              session_start();
              $USERNAME = $_SESSION['loggedinuser'];  
        ?>

        <?php
            $query = "SELECT * FROM `reminders` WHERE `Username` = '$USERNAME'";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) == 0){ // if number of rows are 0
                echo "<tr><td>No Current Reminders</td></tr>";
            }
            else{
                while($row = mysqli_fetch_array($result)){
                    $ID = $row['Id'];
                    $NAME = $row['Username'];
                    $MEDNAME = $row['Medicine Name'];
                    $MEDTYPE = $row['Medicine Type'];
                    $DOSAGE = $row['Medicine Dosage'];
                    $FREQ = $row['Frequency'];

                    echo "<tr>";
                    echo "<td>" . $NAME .  "</td>";
                    echo "<td>" . $MEDNAME . "</td>";
                    echo "<td>" . $MEDTYPE . "</td>";
                    echo "<td>" . $DOSAGE . "</td>";
                    echo "<td>" . $FREQ . "</td>";
                    echo '<td> <button type="button" class="btn btn-primary" onclick="editmeds(\''.$ID.'\')"> Edit </button>';
                    echo '<td> <button type="button" class="btn btn-danger" onclick="deletemeds(\''.$ID.'\')"> Delete </button>'; 
                    echo "</tr>";


                }
            }
        ?>

        
        
  
  
        </table>
        </div>
    </div>

    <script>
        function editmeds(ID){
            window.location=`editmedicine.php?id=${ID}`;
        }
        function deletemeds(ID){
            window.location=`deletemedicine.php?id=${ID}`;
        }
    </script>
    
</body>
</html>