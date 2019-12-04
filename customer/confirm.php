<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 05/12/2018
 * Time: 03:11
 */
?>
<?php
session_start();

if (!isset($_SESSION["customer_email"])) {

    echo "<script>window.open('../checkout.php','_self')</script>";

} else {

    include "../includes/db.php";
    include "../functions/functions.php";

    if (isset($_GET['order_id'])) {
       $order_id = $_GET['order_id'];
    }

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

    <?php include '../includes/top.php' ?>

    <div class="navbar navbar-default" id="navbar"><!-- navbar -->
        <div class="container-fluid"><!-- container -->
            <div class="navbar-header"><!-- navbarHeader -->
                <a href="index.php" class="navbar-brand home"><!-- navbarBrand -->
                    <img src="images/logo.png" alt="Default Logo" width="125" height="49" class="hidden-xs">
                    <img src="images/logoSmall.png" alt="Small Logo" class="visible-xs">
                </a><!-- /navbarBrand -->
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                    <span class="sr-only">Toggle Navigation</span>
                    <i class="fas fa-align-justify"></i>
                </button>
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle Search</span>
                    <i class="fas fa-search"></i>
                </button>
            </div><!-- /navbarHeader -->

            <div class=" nav navbar-collapse collapse" id="navigation"><!-- navbarCollapse -->
                <div class="padding-nav"><!-- paddingNav -->
                    <ul class=" nav navbar-nav navbar-left"><!-- nav navbar-nav navbar-left -->
                        <li class=""><a href="../index.php">Home</a></li>
                        <li class=""><a href="../shop.php">Shop</a></li>
                        <li class="active"><a href="myAccount.php">My Account</a></li>
                        <li class=""><a href="../cart.php">Shopping Cart</a></li>
                        <li class=""><a href="../contact.php">Contact Us</a></li>
                    </ul><!-- /nav navbar-nav navbar-left -->
                </div><!-- /paddingNav -->
                <a href="cart.php" class="btn btn-primary navbar-btn" style="float: right;">
                    <i class="fas fa-shopping-cart"></i>
                    <span>4 items in cart</span>
                </a>
                <div class="navbar-collapse collapse right"><!-- navbar-collapse collapse right -->
                    <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse"
                            data-target="#search">
                        <span class="sr-only">Toggle Search</span>
                        <i class="fas fa-search"></i>
                    </button>
                </div><!-- /navbar-collapse collapse right -->
            </div><!-- /navbarCollapse -->

            <div class="collapse clearfix" id="search"><!-- collapse clearfix -->
                <form action="results.php" class="navbar-form" method="get"><!-- navbar-form -->
                    <div class="input-group"><!-- input-group -->
                        <input class="form-control" type="text" placeholder="Search" name="user_query" required>
                        <span class="input-group-btn">
                        <button type="submit" value="Search" name="search" class="btn btn-primary">
                        <i class="fas fa-search"></i>
                    </button>
                    </span>
                    </div><!-- /input-group -->
                </form><!-- /nnavbar-form -->

            </div><!-- /collapse clearfix -->

        </div><!-- /container -->
    </div><!-- /navbar -->

    <div id="content"><!-- content -->
        <div class="container"><!-- container -->
            <div class="col-md-12"><!-- col-md-12 -->
                <ul class="breadcrumb"><!-- breadcrumb -->
                    <li><a href="index.php">Home</a></li>
                    <li>My Account</li>
                </ul><!-- /breadcrumb -->
            </div><!-- /col-md-12 -->

            <div class="col-md-3"><!-- col-md-3 -->
                <?php include "/includes/sidebar.php" ?>
            </div><!-- /col-md-3 -->

            <div class="col-md-9"><!-- col-md-9 -->
                <div class="box"><!-- box -->
                    <h1 align="center">Please confirm your Payment</h1>
                    <form action="confirm.php" method="post" enctype="multipart/form-data"><!-- form -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">Invoice No:</label>
                            <input type="text" class="form-control" name="invoiceNumber">
                        </div>
                        <div class="form-group"><!-- form-group -->
                            <label for="">Amount Sent:</label>
                            <input type="text" class="form-control" name="amountSent">
                        </div>
                        <div class="form-group"><!-- form-group -->
                            <label for="">Select Payment Mode:</label>
                            <select name="paymentMode" id="" class="form-control">
                                <option value="">Select Payment</option>
                                <option value="Visa"></option>
                                <option value="Paypal"></option>
                                <option value="Master Card"></option>
                                <option value="Western Union"></option>
                            </select>
                        </div>
                        <div class="form-group"><!-- form-group -->
                            <label for="">Transaction/Reference ID:</label>
                            <input type="text" class="form-control" name="refId">
                        </div>
                        <div class="form-group"><!-- form-group -->
                            <label for="">Payment Date</label>
                            <input type="date" class="form-control" name="paymentDate">
                        </div>
                        <div class="text-center"><!-- form-group -->
                            <button type="submit" name="submit" class="btn btn-primary btn-lg"
                        </div>
                        <i class="fas fa-money-bill-alt"></i>&nbsp;Confirm Payment
                </div><!-- /form-group -->
                </form><!-- /form -->
            </div><!-- /box -->
        </div><!-- /col-md-9 -->

    </div><!-- /container -->
    </div><!-- /content -->

    <?php include "../includes/footer.php" ?>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>
    </html>

<?php }