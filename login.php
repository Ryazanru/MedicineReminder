<?php
    include_once "config.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>

    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/all.css">
    <link rel="stylesheet" href="assets/css/fontawesome.css">


    <script src="assets/js/all.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <style>
    .loginbox {
        display: flex;
        flex-direction: column;
        margin: 35%;
        border: black solid 1px;
        padding: 28px;
        margin-top: 0%;
        margin-bottom: 0%;
    }

    .logintitle {
        text-decoration: underline;
        text-align: center;
        margin-top: 8%;
    }

    .registerlink {
        margin-left: 53%;
        margin-top: 10px;
    }
    </style>

</head>

<body>

    <form action="logincheck.php" method="post">

        <div>
            <div class="logintitle">
                <h2> Med Database Login</h2>
            </div>
            <div class="loginbox">

                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" id="username" aria-describedby="emailHelp">

                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>

                <button type="submit" name="submit" class="btn btn-primary">Login</button>



            </div>
            <div class="registerlink">
                <p> Dont have an account? <a href="register.php"> Register</a></p>
            </div>

        </div>


    </form>





</body>

</html>