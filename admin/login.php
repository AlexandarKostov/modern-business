<?php
    session_start();

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    include_once('include/mysql.php');
    include_once('include/functions.php');

    if (isLogged()) { redirect("dashboard"); }

    $mode = mysqli_query($SQL, "SELECT Mode FROM server");
    $serverMode = mysqli_fetch_assoc($mode);

    if ($serverMode["Mode"] == 0)
    {
        redirect("dashboard");
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Force Sign In - Modern Business Template by Code4You</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSS, main.js, Assets, Bootstrap Icnos, jQuery -->
        <link rel="stylesheet" href="css/style-custom.css">
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="main.js"></script>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <style>
            html,
            body {
              height: 100%;
            }

            body {
              display: flex;
              align-items: center;
              padding-top: 40px;
              padding-bottom: 40px;
              background-color: #f5f5f5;
            }

            .form-signin {
              width: 100%;
              max-width: 330px;
              padding: 15px;
              margin: auto;
            }

            .form-signin .checkbox {
              font-weight: 400;
            }

            .form-signin .form-floating:focus-within {
              z-index: 2;
            }

            .form-signin input[type="email"] {
              margin-bottom: -1px;
              border-bottom-right-radius: 0;
              border-bottom-left-radius: 0;
            }

            .form-signin input[type="password"] {
              margin-bottom: 10px;
              border-top-left-radius: 0;
              border-top-right-radius: 0;
            }
        </style>    
    </head>
    <body>
        <div class="alert-load"></div>

        <main class="form-signin text-center">
            <form>
                <div class="form-floating mb-3">
                    <input class="form-control" id="email" type="email" placeholder="name@example.com" />
                    <label for="email">Email address</label>
                </div>
                <div class="form-floating mb-3">
                    <input class="form-control" id="password" type="password" placeholder="Password" />
                    <label for="password">Enter password</label>
                </div>
                <button type="submit" id="btnSignIn" class="btn btn-primary btn-custom">Sign In</button>
            </form>
        </main>
    <?php include 'elements/scripts.php'; ?>
    </body>
</html>
