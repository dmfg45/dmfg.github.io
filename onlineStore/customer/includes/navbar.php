<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 17/01/2019
 * Time: 22:40
 */

?>

<div class="navbar navbar-default" id="navbar"><!-- navbar -->
    <div class="container"><!-- container -->
        <div class="navbar-header"><!-- navbarHeader -->
            <a href="../index.php" class="navbar-brand home"><!-- navbarBrand -->
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
                <ul class=" nav navbar-nav navbar-left" id="navbar"><!-- nav navbar-nav navbar-left -->
                    <li id="Home"><a href="../index.php" >Home</a></li>
                    <li class=""><a href="../shop.php">Shop</a></li>
                    <li>

                        <?php
                        if (!isset($_SESSION['customer_email'])) {
                            ?>

                            <a href="../checkout.php">My Account</a>

                            <?php

                        } else {
                            ?>

                            <a href="myAccount.php?myOrders">My Account</a>

                            <?php
                        }
                        ?>

                    </li>
                    <li class=""><a href="../cart.php">Shopping Cart</a></li>
                    <li class=""><a href="../contact.php">Contact Us</a></li>
                </ul><!-- /nav navbar-nav navbar-left -->
            </div><!-- /paddingNav -->
            <a href="cart.php" class="btn btn-primary navbar-btn" style="float: right;">
                <i class="fas fa-shopping-cart"></i>
                <span>

                    <?php cartItems() ?>

                </span>
            </a>
            <div class="navbar-collapse collapse right"><!-- navbar-collapse collapse right -->
                <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
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
