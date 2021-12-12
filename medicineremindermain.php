<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>medicineremindermain</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">

    <script src="assets/js/all.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    

    <style>
        .buttonstyle{
            display: flex;
            justify-content: flex-end;
            margin-right: 25%;
            margin-top: 15px;
        }
    </style>

</head>
<body>
    <?php include_once "logout.php"?>
    <div>
        <div class="buttonstyle">
            <button type="button" class="btn btn-success"onclick="addmedicine()"> Add Medicine</button>
        </div>
        <div>
            <?php include_once "medicinedisplay.php"?>
        </div>  
    </div>

    
    

    <script>
        function addmedicine(){
            window.location="addmedicine.php";
        }
    </script>
</body>
</html>