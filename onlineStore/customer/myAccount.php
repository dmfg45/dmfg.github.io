<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 04/12/2018
 * Time: 21:15
 */
session_start();

if (!isset($_SESSION["customer_email"])){

    echo "<script>window.open('../checkout.php','_self')</script>";

}else{

include_once 'includes/db.php';
include '../functions/functions.php';

?>



<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Store</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

</head>
<body>

<?php include 'includes/top.php' ?>

<?php include "includes/navbar.php";?>

<div id="content"><!-- content -->
    <div class="container"><!-- container -->
        <div class="col-md-12"><!-- col-md-12 -->
            <ul class="breadcrumb"><!-- breadcrumb -->
                <li><a href="index.php">Home</a></li>
                <li>My Account</li>
            </ul><!-- /breadcrumb -->
        </div><!-- /col-md-12 -->

        <div class="col-md-3"><!-- col-md-3 -->
            <?php include "includes/sidebar.php" ?>
        </div><!-- /col-md-3 -->

        <div class="col-md-9"><!-- col-md-9 -->
            <div class="box"><!-- box -->
                <?php if (isset($_GET['myOrders'])){
                    include 'myOrders.php';
                }elseif (isset($_GET['payOffline'])){
                    include 'payOffline.php';
                }elseif (isset($_GET['editAccount'])){
                    include 'editAccount.php';
                }elseif (isset($_GET['changePass'])){
                    include 'changePass.php';
                }elseif (isset($_GET['delAccount'])){
                  if (isset($_SESSION['customer_email'])){
                    include 'delAccount.php';
                  }
                }?>
            </div><!-- /box -->
        </div><!-- /col-md-9 -->

    </div><!-- /container -->
</div><!-- /content -->

<?php include "includes/footer.php" ?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>

<?php }