<?php
session_start();

if(!isset($_SESSION['customer_email'])) {

    echo "<script>window.open('../checkout.php','_self')</script>";

} else {

    include ("../includes/db.php");
    include ("../functions/functions.php");

    if (!isset($_GET['order_id'])) {
        echo "<script>window.open('myAccount.php?myOrders','_self')</script>";
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
            <div class="box" id="order-summary"><!-- box -->
                <?php
                if (isset($_GET['order_id'])) {
                $customerEmail = $_SESSION['customer_email'];

                $getCustomer = "select * from onlinestore.customers where customer_email = '$customerEmail'";
                $customerQuery = mysqli_query($connection, $getCustomer);
                $customerRow = mysqli_fetch_array($customerQuery);
                $customerId = $customerRow['customer_id'];
                $customerContact = $customerRow['customer_contact'];
                $order_id = $_GET['order_id'];

                $getOrders = "select * from onlinestore.orders where order_id = $order_id and customer_id = $customerId";
                $orderQuery = mysqli_query($connection, $getOrders);
                $orderRow = mysqli_fetch_array($orderQuery);
                $invoice_no = $orderRow['invoice_no'];
                $shipping_type = $orderRow['shipping_type'];
                $shipping_cost = $orderRow['shipping_cost'];
                $payment_method = $orderRow['payment_method'];
                $order_date = $orderRow['order_date'];
                $order_total = $orderRow['order_total'];
                $order_status = $orderRow['order_status'];

                $getOrdersAdd = "select * from onlinestore.orders_addresses where order_id = $order_id";
                $orderAddQuery = mysqli_query($connection, $getOrdersAdd);
                $orderAddRow = mysqli_fetch_array($orderAddQuery);
                $billing_name = $orderAddRow['billing_name'];
                $billing_lastname = $orderAddRow['billing_lastname'];
                $billing_country = $orderAddRow['billing_country'];
                $billing_address1 = $orderAddRow['billing_address1'];
                $billing_address2 = $orderAddRow['billing_address2'];
                $billing_state = $orderAddRow['billing_state'];
                $billing_city = $orderAddRow['billing_city'];
                $billing_postcode = $orderAddRow['billing_postcode'];
                $is_shipping_address = $orderAddRow['is_shipping_address'];

                //                    Shipping Details

                $shipping_first_name = $orderAddRow['shipping_first_name'];
                $shipping_last_name = $orderAddRow['shipping_last_name'];
                $shipping_country = $orderAddRow['shipping_country'];
                $shipping_address1 = $orderAddRow['shipping_address1'];
                $shipping_address2 = $orderAddRow['shipping_address2'];
                $shipping_state = $orderAddRow['shipping_state'];
                $shipping_city = $orderAddRow['shipping_city'];
                $shipping_postcode = $orderAddRow['shipping_postcode'];

                }
                ?>
                <p class="text-muted lead" style="font-size: 20px">
                    You are viewing Complete Details of this Order <mark>#<?php echo $invoice_no ?> </mark> that was place in <mark><?php echo $order_date ?></mark> and has current status of <mark>"<?php echo ucwords($order_status) ?>"</mark>
                </p>
                <h3>Order Details</h3>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="text-muted lead">Product:</th>
                        <th class="text-muted lead">Total:</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $items_subtotal = 0;
                    $physical_products = array();
                    $getOrderItems = "select * from onlinestore.orders_items where order_id = $order_id";
                    $orderItemsQuery = mysqli_query($connection, $getOrderItems);
                    while ($orderItemsRow = mysqli_fetch_array($orderItemsQuery)) {
                        $product_id = $orderItemsRow['product_id'];
                        $product_qty = $orderItemsRow['qty'];
                        $product_size = $orderItemsRow['size'];
                        $product_price = $orderItemsRow['price'];
                        $sub_total = $product_price * $product_qty;
                        $getProduct = "select * from onlinestore.products where product_id = $product_id";
                        $productQuery = mysqli_query($connection, $getProduct);
                        $productRow = mysqli_fetch_array($productQuery);
                        $product_title = $productRow['product_title'];
                        $product_type = $productRow['product_type'];

                        if ($product_type == "physicalProduct") {
                            array_push($physical_products, $product_id);
                        }

                        $items_subtotal += $sub_total;
                        ?>
                        <tr>
                            <td>
                                <a href="#" class="bold"><?php echo $product_title ?></a>
                                <i class="fas fa-times" title="Product Qty"></i> <?php echo $product_qty ?>
                                <?php if ($product_size != "None") { ?>
                                    <i class="fas fa-plus" title="Product Size"></i> <?php echo $product_size ?>
                                <?php } ?>
                            </td>
                            <td>&euro; <?php echo $sub_total ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <th class="text-muted">Subtotal:</th>
                        <th>&euro; <?php echo $items_subtotal ?></th>
                    </tr>
                    <?php
                    if (count($physical_products) > 0) {
                        ?>
                        <tr>
                            <th class="text-muted">Shipping:</th>
                            <th>
                                <span class="text-muted"><i
                                        class="fas fa-truck"></i> <?php echo $shipping_type ?></span>
                                &euro; <?php echo $shipping_cost ?>
                            </th>
                        </tr>
                    <?php } ?>
                    <tr class="total">
                        <td>Total:</td>
                        <td>&euro; <?php echo $order_total ?></td>
                    </tr>
                    </tbody>
                </table>
                <h3></h3>
            </div><!-- /box -->
        </div><!-- /col-md-9 -->

    </div><!-- /container -->
</div><!-- /content -->

<?php include "includes/cFooter.php" ?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>

<?php } ?>