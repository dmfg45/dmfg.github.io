<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 04/12/2018
 * Time: 18:24
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
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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

            <div class="col-md-3"><!-- col-md-3 -->
                <?php include "includes/sidebar.php" ?>
            </div><!-- /col-md-3 -->

            <div class="col-md-9"><!-- col-md-9 -->
                <div class="box"><!-- box -->
                    <div class="box-header"><!-- box-header -->
                        <div class="text-center">
                            <h2>Register New Account</h2>
                            <p class="text-muted">
                                If you have any questions feel free to contact us, our customer service center is
                                working for you 24/7
                            </p>
                        </div>
                    </div><!-- /box-header -->
                    <form action="customerRegister.php" method="post" enctype="multipart/form-data"><!-- form -->
                        <div class="form-group"><!-- form-group -->
                            <label for=""> Customer Name</label>
                            <input type="text" class="form-control" name="c_name" required>
                        </div><!-- /form-group -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="c_email" required>
                        </div><!-- /form-group -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="c_password" required>
                        </div><!-- /form-group -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">Country</label>
                            <input type="text" class="form-control" name="c_country" required>
                        </div><!-- /form-group -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">City</label>
                            <input type="text" class="form-control" name="c_city" required>
                        </div><!-- /form-group -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">Contact</label>
                            <input type="text" class="form-control" name="c_contact" required>
                        </div><!-- /form-group -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="c_address" required>
                        </div><!-- /form-group -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">Image Profile</label>
                            <input type="file" class="form-control" name="c_image" required>
                        </div><!-- /form-group -->
                        <div class="text-center"><!-- text-center -->
                            <button type="submit" name="register" class="btn btn-primary">
                                <i class="fas fa-user-md"></i> Register
                            </button>
                        </div><!-- /text-center -->
                    </form><!-- /form -->
                </div><!-- /box -->
            </div><!-- /col-md-9 -->

        </div><!-- /container -->
    </div><!-- /content -->

    <?php include "includes/footer.php" ?>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>
    </html>

<?php

global $connection;

if (isset($_POST['register'])) {
    $customerName = $_POST['c_name'];
    $customerEmail = $_POST['c_email'];
    $customerPassw = $_POST['c_password'];
    $customerCountry = $_POST['c_country'];
    $customerCity = $_POST['c_city'];
    $customerContact = $_POST['c_contact'];
    $customerAdd = $_POST['c_address'];
    $customerIp = getUserIpAddress();

    $customerImage = $_FILES['c_image']['name'];
    $temp_name = $_FILES['c_image']['temp_name'];

    move_uploaded_file($temp_name,"customer/customer_images/$customerImage");

    $insertCustomer = "INSERT INTO onlinestore.customers
  (customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, customer_address, customer_image, customer_ip)
   VALUES ('$customerName','$customerEmail','$customerPassw','$customerCountry','$customerCity','$customerContact','$customerAdd','$customerImage','$customerIp')";

    $query = mysqli_query($connection, $insertCustomer);

    $selectCart = "select * from onlinestore.cart where ip_add = '$customerIp'";

    $cartQuery = mysqli_query($connection, $selectCart);

    $checkCart = mysqli_num_rows($cartQuery);

    if ($checkCart > 0) {
        $_SESSION['customer_email'] = $customerEmail;

        ?>

        <script>alert("You have been Registered Successfully")</script>
        <script>window.open("checkout.php", "_self")</script>

        <?php

    } else {
        $_SESSION['customer_email'] = $customerEmail;

        ?>

        <script>alert("You have been Registered Successfully")</script>
        <script>window.open("checkout.php", "_self")</script>


        <?php

    }

}