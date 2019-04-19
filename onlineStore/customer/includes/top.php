<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 28/11/2018
 * Time: 22:17
 */
?>

<div id="top"><!-- Top -->
    <div class="container"><!-- Container -->
        <div class="row"><!-- row -->
            <div class="col-md-6 offer"><!-- col-md-6 -->
                <?php
                if (!isset($_SESSION['customer_email'])){
                    ?>
                    <a href="" class="btn btn-success btn-sm">
                        Welcome :&nbsp;Guest
                    </a>
                    <?php
                }else{
                    ?>
                    <a href="" class="btn btn-success btn-sm">
                        Welcome :&nbsp;<?php
                        echo strtoupper(before('@',$_SESSION['customer_email']));
                        ?>
                    </a>
                    <?php
                }
                ?>
                <a href="#">Shopping Cart Total Price : <?php totalPrice() ?>&xrArr;&nbsp;<?php cartItems() ?></a>
            </div><!-- /col-md-6 -->
            <div class="col-md-6"><!-- col-md-6 -->
                <ul class="menu"><!-- Menu -->
                    <li>
                        <a href="../customerRegister.php">Register</a>
                    </li>
                    <li>
                        <?php
                        if (!isset($_SESSION['customer_email'])){
                            ?>

                            <a href="../checkout.php">My Account</a>

                            <?php

                        }else{
                            ?>

                            <a href="myAccount.php?myOrders">My Account</a>

                            <?php
                        }
                        ?>
                    </li>
                    <li>
                        <a href="../cart.php">Go to Cart</a>
                    </li>
                    <li>
                        <?php
                        if (!isset($_SESSION['customer_email'])){
                            ?>

                            <a href="../checkout.php">Login</a>

                            <?php
                        }else{
                            ?>

                            <a href="logout.php">Logout</a>

                            <?php
                        }
                        ?>
                    </li>
                </ul><!-- /Menu -->
            </div><!-- /col-md-6 -->
        </div><!-- /row -->

    </div><!-- /Container -->

</div><!-- /Top -->
