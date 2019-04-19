<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 20/01/2019
 * Time: 01:42
 */
?>

<div class="box">
    <?php

        $sessionEmail = $_SESSION['customer_email'];

        $customer = "select * from onlinestore.customers where customer_email = '$sessionEmail'";

        $query = mysqli_query($connection,$customer);

        $row = mysqli_fetch_array($query);

        $customerId  = $row['customer_id'];


    ?>
    <h1 class="text-center">Payment Options for you</h1>
    <br>
    <br>
    <p class="text-center">
        <a href="#"><i class="fab fa-cc-paypal fa-5x"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#"><i class="fab fa-cc-visa fa-5x"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#"><i class="fab fa-cc-mastercard fa-5x"></i></a>
    </p>
    <div class="text-center">
        <p class="text-center">
            <br><br>
        </p>

    </div>
</div>
