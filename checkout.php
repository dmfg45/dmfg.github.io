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
    <script src="https://checkout.stripe.com/checkout.js"></script>

    <script src="js/jquery-3.3.1.min.js"></script>

</head>
<body>

<?php include 'includes/top.php' ?>

<?php include "includes/navbar.php"; ?>

<div id="content"><!-- content -->
    <div class="container"><!-- container -->
        <div class="col-md-12"><!-- col-md-12 -->
            <?php if (!isset($_SESSION['customer_email'])){  ?>
            <ul class="breadcrumb"><!-- breadcrumb -->
                <li><a href="index.php">Home</a></li>
                <li>Login Details</li>
            </ul><!-- /breadcrumb -->
            <?php }else{ ?>
                <ul class="breadcrumb"><!-- breadcrumb -->
                    <li><a href="index.php">Home</a></li>
                    <li>Checkout Details</li>
                </ul><!-- /breadcrumb -->
                <nav class="checkout-breadcrumbs text-center">
                    <a href="cart.php">Shopping Cart</a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="checkout.php" class="active">Checkout Details</a>
                    <i class="fas fa-chevron-right"></i>
                    <a href="checkout.php">Order Complete</a>
                </nav>
            <?php } ?>
        </div><!-- /col-md-12 -->

        <div class="col-md-12"><!-- col-md-12 -->
            <?php
            if (!isset($_SESSION['customer_email'])) {
                include "customer/customerLogin.php";
            } else {
                include "reviewOrder.php";
            }
            ?>
        </div><!-- /col-md-12 -->

    </div><!-- /container -->
</div><!-- /content -->

<?php include "includes/footer.php" ?>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
