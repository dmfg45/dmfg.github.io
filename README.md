# Final Multimedia Engineering Degree Project

## Ecommerce Store 

Code Based in HTML/CSS/JavaScript, jQuery, Bootstrap, for the frontend of the web app and complementing with php 5.6, Ajax and Mysql for the backend of the project, also used Paypal Api to process the checkout payment, integrating it in the checkout form.

Web ecommerce Store, which the main objective was to provide the users to choose the type of products they want to buy and also giving the choice of selling two kinds of products for hte owners, physical products and/or downlodable content.

### Project Database file 
#### => motostashDatabase.sql


## Code 
### Connection To the Datbase

```
$db["host"] = "localhost";
$db["user"] = "root";
$db["pass"] = "Server45Server7AGCD";
$db["database"] = "onlinestore";

foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(HOST, USER, PASS, DATABASE);


if (!$connection){
    die('Error douchebag => '.mysqli_error($connection));
}

```

### Admin Login Page

```

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

```

## Technologies Used:

  ### JetBrains PhpStorm
  JetBrains IDE that allows full php support as it is completely dedicated to the language, providing a html, css, javascript text editor with real-time code analysis, which allows analysis of possible errors, in the code.

### HTML
  Programming language used for site structure building, based on tags that identify the different areas of the site, which can therefore be identified by browsers.

  ### CSS3
  Programming language that lets you style html by changing attributes, calling, html tags, classes, or id's.

  ### Javascript
  Script language, which allows you to define the behavior of html elements, such as css, by referencing tags, classes, or id's, you can alert the user, redirect, among others.

  ### Php 5.6
  Programming language used to develop server-side web applications that have the ability to dynamically manage content.

  ### Jquery
  Javascript library, which contains various functions, to facilitate or simplify scripts interpreted by browsers.


  ### Font-Awesome 
  Set of fonts and icons, based on Css and Less, can be used with bootstrap.

 ###  Bootstrap 
 Framework used for developing front end and interface components for websites and web applications. It uses html, css and javascript, based on design templates, to improve user experience by making the site responsive.


  ### Sql
  Standard declarative search language for relational databases.

  ### Paypal Api
  PHP tool for system integration, giving the developer the ability to add online payments to their project.

  ### Visa Api
  PHP tool for integrating with systems, enabling developers to add online payments to their project.

  ### Master Card Api
  PHP tool for integrating with systems, giving the developer the ability to add online payments to their project.
