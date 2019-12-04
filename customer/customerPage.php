<?php
include_once 'includes/connection.php';
include '../functions/functions.php';
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

<?php include "../includes/top.php" ?>

<?php include "includes/cNavbar.php"; ?>

<div id="content"><!-- content -->
    <div class="container-fluid"><!-- container -->
        <div class="col-md-12"><!-- col-md-12 -->
            <ul class="breadcrumb"><!-- breadcrumb -->
                <li><a href="index.php">Home</a></li>
                <li>My Account</li>
            </ul><!-- /breadcrumb -->
        </div><!-- /col-md-12 -->

        <div class="col-md-12"><!-- col-md-12 -->
            <?php

            $customerEmail = $_SESSION['customer_email'];
            $getCustomer = "select * from onlinestore.customers where customer_email = '$customerEmail'";
            $query = mysqli_query($connection, $getCustomer);
            $customerRow = mysqli_fetch_array($query);
            $customerConCode = $customerRow['customer_confirm_code'];
            $customerName = $customerRow['customer_name'];

            if (!empty($customerConCode)) {
                ?>
                <div class="alert alert-danger fade-in-out">
                    <strong>Warning</strong> Please Confirm your Email and if you did not received it click <a
                            href="myAccount.php?send_email" class="alert-link">HERE</a>
                </div>
                <?php
            }
            ?>
        </div><!-- /col-md-12 -->

        <div class="col-md-3"><!-- col-md-3 -->
            <?php include "includes/cSidebar.php" ?>
        </div><!-- /col-md-3 -->

        <div class="col-md-9"><!-- col-md-9 -->
            <div class="box"><!-- box -->
                <?php
                if (isset($_GET[$customerConCode])) {
                    $updateConfrimCode = "update onlinestore.customers set customer_confirm_code = '' where customer_confirm_code = $customerConCode";
                    $confQuery = mysqli_query($connection, $updateConfrimCode);
                    ?>
                    <script>alert('Your Email has been Confirmed')</script>
                    <script>window.open("myAccount.php?myOrders", "_self")</script>
                    <?php
                }

                if (isset($_GET['send_email'])) {

                    $subject = "Email Confirmation Message";
                    $from = "andre.graca.45@gmail.com";
                    $message = "
                                        <h2>Account Register Confirmation By OnlineStore.com $customerName</h2>
                                        <a href='localhost/onlinestore/customer/myAccount.php?$customerConCode'>Click Here to confirm the Email registration</a>
                                    ";
                    $headers = "From: $from \r\n";
                    $headers .= "Content-type: text/html\r\n";

                    mail($customerEmail, $subject, $message, $headers);
                    ?>
                    <script>alert('Your Email has been Re-sent')</script>
                    <script>window.open("myAccount.php?myOrders", "_self")</script>
                    --><?php
                }

                ?>
                <?php

                if (isset($_GET['myOrders'])) {
                    include 'myOrders.php';
                } elseif (isset($_GET['payOffline'])) {
                    include 'payOffline.php';
                } elseif (isset($_GET['editAccount'])) {
                    include 'editAccount.php';
                } elseif (isset($_GET['changePass'])) {
                    include 'changePass.php';
                } elseif (isset($_GET['delAccount'])) {
                    if (isset($_SESSION['customer_email'])) {
                        include 'delAccount.php';
                    }
                } elseif (isset($_GET['myWishList'])) {
                    include "myWishList.php";
                } elseif (isset($_GET['myWishList'])) {
                    include "myWishList.php";
                } elseif (isset($_GET['deleteWishList'])) {
                    $wishId = $_GET['deleteWishList'];
                    $deleteWishList = "delete from onlinestore.wishlist where wishlist_id = $wishId";
                    $deleteQuery = mysqli_query($connection, $deleteWishList);
                    if ($deleteQuery) {
                        ?>
                        <script>alert("The product has been removed from your WishList")</script>
                        <script>window.open("myAccount.php?myWishList","_self")</script>
                        <?php
                    }
                }
                ?>
            </div><!-- /box -->
        </div><!-- /col-md-9 -->

    </div><!-- /container -->
</div><!-- /content -->

<?php include "includes/cFooter.php" ?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
