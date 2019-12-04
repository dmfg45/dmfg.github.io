<?php
session_start();

require "includes/db.php";

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else { ?>

    <?php

        $typeId = mysqli_real_escape_string($connection,$_POST['type_id']);
        $shippingWeight = mysqli_real_escape_string($connection,$_POST['shippingWeight']);
        $shippingCost = mysqli_real_escape_string($connection,$_POST['shippingCost']);

        if (isset($_POST['zone_id'])){
            $zoneId = $_POST['zone_id'];
            $insertShippingRate = "insert into onlinestore.shipping(
                                 shipping_type,
                                 shipping_zone,
                                 shipping_weight,
                                 shipping_cost) 
                                 values (
                                         $typeId,
                                         $zoneId,
                                         $shippingWeight,
                                         $shippingCost
                                         )";
            $zoneQuery = mysqli_query($connection,$insertShippingRate);

        }elseif(isset($_POST['countryId'])){

            $countryId = $_POST['countryId'];

            $insertShippingRates = "insert into onlinestore.shipping(
                                 shipping_type,
                                 shipping_country,
                                 shipping_weight,
                                 shipping_cost) 
                                 values (
                                         $typeId,
                                         '$countryId',
                                         $shippingWeight,
                                         $shippingCost
                                         )";
            $countryQuery = mysqli_query($connection,$insertShippingRates);
        }

    ?>

<?php }