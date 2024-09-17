<?php
if (session_id() == ""){
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>PHP Session and Cookies in Login form</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>
        <div class="header">
            <div class="menu">
                <a href="index.php">Home</a>
                <?php
                if (isset($_SESSION['name'])){ ?>
                    <a href="dashboard.php">Dashboard</a>
                    <div class="float-end">
                        <span style="color:aquamarine;">Welcome <?= $_SESSION['name']?></span><a href="logout.php">Logout</a>
                    </div>
                     
                <?php }
                else { ?>
                    <a href="login.php">Login</a>
               <?php } ?>

            </div>
        </div>
