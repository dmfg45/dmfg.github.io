<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 18/03/2019
 * Time: 16:53
 */
?>

<?php

session_start();

include "includes/db.php";

?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Login</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>

    <div class="container">
        <form action="" method="post" class="form-login">
            <h2 class="form-login-heading">Admin Login</h2>
            <input type="text" class="form-control" name="admin_email" placeholder="Enter email address" required>
            <br>
            <input type="password" class="form-control" name="admin_passw" placeholder="Enter Password" required>
            <br>
            <button type="submit" name="login" class="btn btn-lg btn-primary btn-block">Log in</button>
        </form>
    </div>

    </body>
    </html>

<?php


if (isset($_POST['login'])) {
    $adminEmail = mysqli_real_escape_string($connection, $_POST['admin_email']);
    $adminPassword = mysqli_real_escape_string($connection, $_POST['admin_passw']);

    $query = "SELECT * FROM onlinestore.admins where admin_email = '$adminEmail'";

    $admins = mysqli_query($connection, $query);

    $adminRow = mysqli_fetch_array($admins);
    $hashPass = $adminRow['admin_password'];
    $decryptPass = password_verify($adminPassword, $hashPass);

    if ($decryptPass != 0){
        $_SESSION['admin_email'] = $adminEmail;
        ?>
        <script>alert("You are logged in into the admin Panel")</script>
        <script>window.open('index.php?dashboard', '_self')</script>
        <?php
    }else {
        ?>
        <script>alert("Email or Password are wrong")</script>
        <?php
    }

}