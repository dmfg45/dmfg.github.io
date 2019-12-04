<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 20/01/2019
 * Time: 01:31
 */

session_start();
include_once 'includes/db.php';
include 'functions/functions.php';

?>


<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Store</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
          crossorigin="anonymous">

</head>
<body>

<?php include 'includes/top.php' ?>

<?php include "includes/navbar.php"; ?>

<div id="content"><!-- content -->
    <div class="container"><!-- container -->
        <div class="col-md-12"><!-- col-md-12 -->
            <ul class="breadcrumb"><!-- breadcrumb -->
                <li><a href="index.php">Home</a></li>
                <li>Register</li>
            </ul><!-- /breadcrumb -->
        </div><!-- /col-md-12 -->

        <div class="col-md-12"><!-- col-md-12 -->
            <div class="box">
                <div class="box-header">
                    <div class="text-center">
                        <h3>Enter your Email Below, We will send you a Password</h3>
                    </div>
                </div>
                <div class="text-center">
                    <form action="" method="post">
                        <input type="email" class="form-control" name="customerEmail" placeholder="Enter your email please">
                        <br>
                        <input type="submit" name="forgotPassw" class="btn btn-primary" value="Submit">
                    </form>
                </div>
            </div>
        </div><!-- /col-md-12 -->

    </div><!-- /container -->
</div><!-- /content -->

<?php include "includes/footer.php" ?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>

<?php

if (isset($_POST['forgotPassw'])){
    $customerEmail = $_POST['customerEmail'];

    $getCustomer = "select * from onlinestore.customers where customer_email = '$customerEmail'";
    $query = mysqli_query($connection,$getCustomer);

    if ($countCustomers = mysqli_num_rows($query) == 0){ ?>
        <script>alert("You do not have an account in our Website\nPlease Register")</script>

    <?php }else{
        $customerRow = mysqli_fetch_array($query);
        $customerName = $customerRow['customer_name'];
        $customerPassw = $customerRow['customer_pass'];

        $message = "
                        <h1 class='text-center'>Your Password has been sent to you</h1>
                        <h2 class='text-center'>Dear $customerName </h2>
                        <h3 class='text-center'>
                            Your password is : <span><b>$customerPassw</b></span>
                        </h3>
                        <h3 class='text-center'>Click &xrArr;&nbsp;<a href='localhost/onlinestore/checkout.php'>here</a> to login in your account</h3>
                        <br>
                    ";

        $from = "andre.graca.45@gmail.com";
        $subject = "Password Recovery";
        $headers = "From: $from\r\n";
        $headers .= "Content-type: text/html\r\n";

        mail($customerEmail,$subject,$message,$headers);
        ?>
        <script>alert('Your Password has been sent\nCheck your inbox')</script>
        <script>window.open("checkout.php","_self")</script>
<?php
    }



}
