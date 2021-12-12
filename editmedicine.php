<?php 
    include_once "config.php";
    $ID = $_GET['id'];

    $query = "SELECT * FROM `reminders` WHERE `Id` = $ID";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>editmedicine</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/all.css">

    <script src="assets/js/all.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    

    <style>
        .formstyle{
            display: flex;
            flex-direction: column;
            border: black solid thin;
            margin-left: 25%;
            margin-right: 25%;
            padding: 20px;
            margin-top: 2%;
            background-color: #87b0f3;
        }

        label{
            text-decoration: underline;
        }

        .notestyle{
            display: flex;
            flex-direction: column;
            margin-left: 5%;
            margin-top: 15px;
        }
    </style>

    
</head>
<body>
    <div>
        <?php include_once "logout.php" ?>
        <div class="notestyle">
            <h3 style="text-decoration: underline;">Medicine Reminder</h3>

            <pre>Note: If you want to change times or change dates,
      you will have to delete the reminder and start a new reminder.<pre>


        </div>
        <form action="medicineupdate.php?id=<?php echo $ID ?>" method="post" class="formstyle" id="mainform">
        <div class="mb-3">
            <h3 style="text-decoration: underline;"> Edit Medicine</h3>
        </div>
        <div class="mb-3">
            <label for="medname" class="form-label">Medicine Name</label>
            <input type="text" class="form-control" id="medname" name="medname" value="<?php echo $row['Medicine Name']?>">

        </div>
        <div class="mb-3">
            <label for="medtype" class="form-label">Medicine Type</label>
            <input type="text" class="form-control" id="medtype" name="medtype" value="<?php echo $row['Medicine Type']?>">
        </div>
        <div class="mb-3">
            <label for="dosage" class="form-label">Dosage</label>
            <input type="text" class="form-control" id="dosage" name="dosage" value="<?php echo $row['Medicine Dosage']?>">
        </div>
        <div>
        <button type="submit" name="submit" class="btn btn-success">Submit</button>
        </div>

    </form>
    </div>
    
</body>
</html>