<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 30/11/2018
 * Time: 13:56
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
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

</head>
<body>

<?php include 'includes/top.php' ?>

<?php include "includes/navbar.php"; ?>

<div id="content"><!-- content -->
    <div class="container"><!-- container -->
        <div class="col-md-12"><!-- col-md-12 -->
            <ul class="breadcrumb"><!-- breadcrumb -->
                <li><a href="index.php">Home</a></li>
                <li>Cart</li>
            </ul><!-- /breadcrumb -->
            <nav class="checkout-breadcrumbs text-center">
                <a href="cart.php" class="active">Shopping Cart</a>
                <i class="fas fa-chevron-right"></i>
                <a href="checkout.php">Checkout Details</a>
                <i class="fas fa-chevron-right"></i>
                <a href="checkout.php">Order Complete</a>
            </nav>
        </div><!-- /col-md-12 -->

        <div class="col-md-8" id="cart"><!-- cart -->
            <div class="box"><!-- box -->
                <form action="cart.php" method="post" enctype="multipart/form-data"><!-- form -->
                    <h1>Shopping Cart</h1>
                    <p class="text-muted">
                        You currently have <?php cartItems() ?>
                    </p>
                    <div class="table-responsive"><!-- table-responsive -->
                        <table class="table"><!-- table -->
                            <thead><!-- thead -->
                            <tr>
                                <th colspan="2">Product</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Size</th>
                                <th colspan="1">Delete</th>
                                <th colspan="2">Sub Total</th>
                            </tr>
                            </thead><!-- /thead -->
                            <tbody id="cart-products-tbody"><!-- tbody -->

                            <?php
                            $ipAdd = getUserIpAddress();
                            $total = 0;
                            $totalWeight = 0;
                            $physicalProducts = array();
                            $subTotal = 0;
                            $cart = "SELECT * FROM onlinestore.cart WHERE ip_add = '$ipAdd'";

                            $query = mysqli_query($connection, $cart);

                            while ($row = mysqli_fetch_array($query)) {
                                $productId = $row['p_id'];
                                $productSize = $row['p_size'];
                                $product_Qty = $row['qty'];
                                $productPrice = $row['p_price'];

                                $products = "SELECT * FROM onlinestore.products WHERE product_id = $productId";

                                $pQuery = mysqli_query($connection, $products);

                                while ($prod_row = mysqli_fetch_array($pQuery)) {
                                    $productTitle = $prod_row['product_title'];
                                    $productImg = $prod_row['product_img1'];
                                    $productType = $prod_row['product_type'];
                                    $productWeight = $prod_row['product_weight'];
                                    $subTotalWeight = $productWeight * $product_Qty;
                                    $totalWeight += $subTotalWeight;
                                    if ($productType = "physicalProduct") {
                                        array_push($physicalProducts, $productId);
                                    }
                                    $subTotal = $productPrice * $product_Qty;
                                    $_SESSION['product_Qty'] = $product_Qty;
                                    $total += $subTotal;

                                    ?>

                                    <tr>
                                        <td><img src="adminArea/productImages/<?php echo $productImg ?>" alt=""></td>
                                        <td><a href="#"><?php echo $productTitle ?></a></td>
                                        <td><input type="text" name="qty" value="<?php echo $_SESSION['product_Qty'] ?>"
                                                   data-product_id="<?php echo $productId ?>" class="qty form-control">
                                        </td>
                                        <td>&euro;&nbsp;<?php echo $productPrice ?></td>
                                        <td><?php echo $productSize ?></td>
                                        <td><input type="checkbox" name="remove[]" value="<?php echo $productId ?>">
                                        </td>
                                        <td>&euro;&nbsp;<?php echo $subTotal ?></td>
                                    </tr>

                                    <?php
                                }
                            }

                            ?>
                            </tbody><!-- /tbody -->
                            <tfoot><!-- tfoot -->
                            <tr>
                                <th colspan="5">Total</th>
                                <th colspan="2"><span class="subtotal-cart-price">&euro;&nbsp;<?php echo $total ?></span>.00</th>
                            </tr>
                            </tfoot><!-- /tfoot -->
                        </table><!-- /table -->
                        <div class="form-inline pull-right">
                            <div class="form-group">
                                <label for="">Coupon Code</label>
                                <input type="text" name="couponCode" class="form-control">
                            </div>
                            <input type="submit" class="btn btn-primary" name="applyCoupon" value="Apply Coupon Code">
                        </div>
                    </div><!-- /table-responsive -->
                    <div class="box-footer"><!-- box-footer -->
                        <div class="pull-left">
                            <a href="index.php" class="btn btn-default">
                                <i class="fas fa-chevron-left"></i>&nbsp;Continue Shopping
                            </a>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-default" type="submit" name="update" value="Update Cart">
                                <i class="fas fa-sync-alt"></i>&nbsp;Update Cart
                            </button>

                            <a <?php
                            $getCountCart = "select * from onlinestore.cart";
                            $countCartQuery = mysqli_query($connection, $getCountCart);
                            $cartCount = mysqli_num_rows($countCartQuery);
                            if ($cartCount != 0) { ?>
                                href="checkout.php"
                            <?php } else {
                                ?>
                                href=""
                                onclick="alert('Your cart is currently empty')"<?php } ?> class="btn btn-primary">
                                Proceed to checkout <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div><!-- /box-footer -->
                </form><!-- /form -->
            </div><!-- /box -->

            <?php

            if (isset($_POST['applyCoupon'])) {
                $code = $_POST['couponCode'];
                if ($code !== '') {
                    $getCoupon = "select * from onlinestore.coupons where coupon_code = '$code'";
                    $couponQuery = mysqli_query($connection, $getCoupon);
                    $checkCoupons = mysqli_num_rows($couponQuery);

                    if ($checkCoupons == 1) {
                        $couponsRow = mysqli_fetch_array($couponQuery);
                        $couponProduct = $couponsRow['product_id'];
                        $couponPrice = $couponsRow['coupon_price'];
                        $couponLimit = $couponsRow['coupon_limit'];
                        $couponUsed = $couponsRow['coupon_used'];
                    if ($couponLimit == $couponUsed) {
                        ?>
                        <script>alert("You Coupon Has been Expired")</script>
                    <?php
                    }else{
                    $getCart = "select * from onlinestore.cart where p_id = $couponProduct and ip_add = '$ipAdd'";
                    $cartQuery = mysqli_query($connection, $getCart);
                    $checkCart = mysqli_num_rows($cartQuery);
                    if ($checkCart == 1){
                    $addUsed = "update onlinestore.coupons set coupon_used = coupon_used+1 where coupon_code = '$code'";
                    $usedQuery = mysqli_query($connection, $addUsed);

                    $update_cart = "update onlinestore.cart set p_price='$couponPrice' where p_id = $couponProduct and ip_add = '$ipAdd'";
                    $upCartQuery = mysqli_query($connection, $update_cart);
                    ?>
                        <script>
                            alert("Your Coupon has been Accepted and Applied");
                            window.open("cart.php", "_self")
                        </script>
                    <?php

                    }else{
                    ?>
                        <script>alert("Product does not Exist in Cart")</script>
                    <?php
                    }
                    }
                    }else{
                    ?>
                        <script>alert("Your Coupon it is not Valid")</script>
                        <?php
                    }

                } else {

                }
            }

            ?>

            <?php
            function updateCart()
            {
                global $connection;
                if (isset($_POST['update'])) {
                    foreach ($_POST['remove'] as $removeItem) {
                        $deleteProd = "DELETE FROM onlinestore.cart WHERE p_id=$removeItem";

                        $query = mysqli_query($connection, $deleteProd);

                        if ($query) {
                            ?>

                            <script>window.open("cart.php", "_self")</script>

                            <?php
                        }
                    }
                }
            }

            echo $updateCart = updateCart();
            ?>

            <div id="row same-height-row"><!-- row -->
                <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 -->
                    <div class="box same-height headline"><!-- box same-height headline -->
                        <h3>You also liked these Products</h3>
                    </div><!-- /box same-height headline -->
                </div><!-- /col-md-3 col-sm-6 -->
                <?php

                $productsTable = "SELECT * FROM onlinestore.products ORDER BY rand() DESC LIMIT 0,3";

                $productQuery = mysqli_query($connection, $productsTable);

                while ($productRow = mysqli_fetch_array($productQuery)) {
                    $productId = $productRow['product_id'];
                    $productTitle = $productRow['product_title'];
                    $productImg1 = $productRow['product_img1'];
                    $productPrice = $productRow['product_price'];
                    $product_Label = $productRow['product_label'];
                    $productPspPrice = $productRow['product_psp_price'];
                    $productUrl = $productRow['product_url'];
                    $manufacturerId = $productRow['manufacturer_id'];

                    $getMnaufacturer = "select * from onlinestore.manufacturers where manufacturer_id = $manufacturerId";

                    $runQuery = mysqli_query($connection, $getMnaufacturer);

                    $rowManufacturer = mysqli_fetch_array($runQuery);

                    $manufacturerName = $rowManufacturer['manufacturer_title'];

                    if ($product_Label == "Sale" || $product_Label == "Gift") {

                        $product_Price = "<del>&euro;&nbsp;$productPrice </del>";

                        $productPspPrice = "| &euro;&nbsp;$productPspPrice ";

                    } else {

                        $productPspPrice = "";

                        $product_Price = "&euro;&nbsp;$productPrice";

                    }
                    ?>

                    <div class="col-md-3 col-sm-6 center-responsive">
                        <div class="product same-height">
                            <a href="<?php echo $productUrl ?>"><img
                                        src="adminArea/productImages/<?php echo $productImg1 ?>" alt=""
                                        class="img-responsive"></a>
                            <div class="text">
                                <div class="text-center">
                                    <p class="btn btn-primary"><?php echo $manufacturerName ?></p>
                                </div>
                                <h3>
                                    <a href="<?php echo $productUrl ?>"><?php echo $productTitle ?></a>
                                </h3>
                                <p class="price"><?php echo $product_Price, $productPspPrice ?></p>
                            </div>
                        </div>
                        <?php

                        if ($product_Label == "") {

                        } else { ?>
                            <a href="#" class="label sale" style="color: black">
                                <div class="theLabel"><?php echo $product_Label ?></div>
                                <div class="label-background"></div>
                            </a>
                            <?php
                        }

                        ?>
                    </div>

                    <?php

                }
                ?>
            </div><!-- /row -->

        </div><!-- /cart -->

        <div class="col-md-4"><!-- col-md-3 -->
            <div class="box" id="order-summary"><!-- box -->
                <div class="box-header"><!-- box-header -->
                    <h3>Order Summary</h3>
                </div><!-- /box-header -->
                <p class="text-muted">
                    Shipping and additional costs are calculated based on the values you have entered
                </p>
                <div class="table-responsive"><!-- table-responsive -->
                    <table class="table"><!-- table -->
                        <tbody id="cart-summary-tbody"><!-- tbody -->
                        <tr>
                            <td>Order Subtotal</td>
                            <th>&euro;&nbsp;<?php echo $subTotal ?></th>
                        </tr>
                        <?php
                        if ($physicalProducts > 0) { ?>
                            <tr>
                                <th colspan="2">
                                    <p class="shipping-header text-muted">
                                        Cart Total Weight: <?php echo $totalWeight ?> Kg
                                    </p>
                                    <p class="shipping-header text-muted">
                                        <i class="fas fa-truck"></i> Shipping:
                                    </p>
                                    <ul class="list-unstyled">
                                        <?php
                                        if (isset($_SESSION['customer_email'])) {
                                            $customerEmail = $_SESSION['customer_email'];

                                            $getCustomer = "select * from onlinestore.customers where customer_email = '$customerEmail'";
                                            $customerQuery = mysqli_query($connection, $getCustomer);
                                            $customerRow = mysqli_fetch_array($customerQuery);
                                            $customerId = $customerRow['customer_id'];

                                            $getCustomerAdd = "select * from onlinestore.customers_addresses where customer_id = $customerId";
                                            $customerAddQuery = mysqli_query($connection, $getCustomerAdd);

                                            $customerAddRow = mysqli_fetch_array($customerAddQuery);
                                            $billing_country = $customerAddRow['billing_country'];
                                            $billing_postcode = $customerAddRow['billing_postcode'];
                                            $shipping_country = $customerAddRow['shipping_country'];
                                            $shipping_postcode = $customerAddRow['shipping_postcode'];
                                            $shippingZoneId = "";

                                            if (@$_SESSION["isShippingAddressSame"] == "yes") {
                                                if (empty($billing_country) and empty($billing_postcode)) { ?>
                                                    <li>
                                                        <p>
                                                            There are no shipping types available.
                                                            Please double check your address,
                                                            or contact us if you need any help.
                                                        </p>
                                                    </li>
                                                <?php }
                                                $selectZones = "select * from onlinestore.zones order by zone_order desc";
                                                $zoneQuery = mysqli_query($connection, $selectZones);
                                                while ($rowZones = mysqli_fetch_array($zoneQuery)) {
                                                    $zoneId = $rowZones['zone_id'];
                                                    $selectZoneLocations = "select distinct zone_id from onlinestore.zone_locations
                                                                                                where zone_id = $zoneId 
                                                                                                  and (location_code = '$billing_country'
                                                                                                   and location_type = 'country')";

                                                    $zoneLocationsQuery = mysqli_query($connection, $selectZoneLocations);
                                                    $countZoneLocations = mysqli_num_rows($zoneLocationsQuery);
                                                    if ($countZoneLocations != 0) {
                                                        $rowZoneLocations = mysqli_fetch_array($zoneLocationsQuery);
                                                        $zoneId = $rowZoneLocations['zone_id'];
                                                        $selectZoneShipping = "select * from onlinestore.shipping where shipping_zone = $zoneId";
                                                        $shippingQuery = mysqli_query($connection, $selectZoneShipping);
                                                        $countShipping = mysqli_num_rows($shippingQuery);

                                                        if ($countShipping != 0) {
                                                            $selectZonePostCodes = "select * from onlinestore.zone_locations where zone_id = $zoneId and location_type = 'postcode'";
                                                            $postCodeQuery = mysqli_query($connection, $selectZonePostCodes);
                                                            $countPostCodes = mysqli_num_rows($postCodeQuery);

                                                            if ($countPostCodes != 0) {
                                                                while ($rowZonePostCodes = mysqli_fetch_array($postCodeQuery)) {
                                                                    $locationCode = $rowZonePostCodes['location_code'];
                                                                    if ($locationCode == $billing_postcode) {
                                                                        $shippingZoneId = $zoneId;
                                                                    }
                                                                }
                                                            } else {
                                                                $shippingZoneId = $zoneId;
                                                            }
                                                        }
                                                    }
                                                }
                                            } elseif (@$_SESSION["isShippingAddressSame"] == "no") {
                                                if (empty($shipping_country) and empty($shipping_postcode)) { ?>
                                                    <li>
                                                        <p>
                                                            There are no shipping types available.
                                                            Please double check your address,
                                                            or contact us if you need any help.
                                                        </p>
                                                    </li>
                                                <?php }
                                                $selectZones = "select * from onlinestore.zones order by zone_order desc";
                                                $zoneQuery = mysqli_query($connection, $selectZones);
                                                while ($rowZones = mysqli_fetch_array($zoneQuery)) {
                                                    $zoneId = $rowZones['zone_id'];
                                                    $selectZoneLocations = "select distinct zone_id from onlinestore.zone_locations
                                                                                                where zone_id = $zoneId 
                                                                                                  and (location_code = '$shipping_country'
                                                                                                   and location_type = 'country')";

                                                    $zoneLocationsQuery = mysqli_query($connection, $selectZoneLocations);
                                                    $countZoneLocations = mysqli_num_rows($zoneLocationsQuery);
                                                    if ($countZoneLocations != 0) {
                                                        $rowZoneLocations = mysqli_fetch_array($zoneLocationsQuery);
                                                        $zoneId = $rowZoneLocations['zone_id'];
                                                        $selectZoneShipping = "select * from onlinestore.shipping where shipping_zone = $zoneId";
                                                        $shippingQuery = mysqli_query($connection, $selectZoneShipping);
                                                        $countShipping = mysqli_num_rows($shippingQuery);

                                                        if ($countShipping != 0) {
                                                            $selectZonePostCodes = "select * from onlinestore.zone_locations where zone_id = $zoneId and location_type = 'postcode'";
                                                            $postCodeQuery = mysqli_query($connection, $selectZonePostCodes);
                                                            $countPostCodes = mysqli_num_rows($postCodeQuery);

                                                            if ($countPostCodes != 0) {
                                                                while ($rowZonePostCodes = mysqli_fetch_array($postCodeQuery)) {
                                                                    $locationCode = $rowZonePostCodes['location_code'];
                                                                    if ($locationCode == $shipping_postcode) {
                                                                        $shippingZoneId = $zoneId;
                                                                    }
                                                                }
                                                            } else {
                                                                $shippingZoneId = $zoneId;
                                                            }
                                                        }
                                                    }
                                                }
                                            } else {
                                                if (empty($billing_country) and empty($billing_postcode)) { ?>
                                                    <li>
                                                        <p>
                                                            There are no shipping types available.
                                                            Please double check your address,
                                                            or contact us if you need any help.
                                                        </p>
                                                    </li>
                                                <?php }
                                                $selectZones = "select * from onlinestore.zones order by zone_order desc";
                                                $zoneQuery = mysqli_query($connection, $selectZones);
                                                while ($rowZones = mysqli_fetch_array($zoneQuery)) {
                                                    $zoneId = $rowZones['zone_id'];
                                                    $selectZoneLocations = "select distinct zone_id from onlinestore.zone_locations
                                                                                                where zone_id = $zoneId 
                                                                                                  and (location_code = '$billing_country'
                                                                                                   and location_type = 'country')";

                                                    $zoneLocationsQuery = mysqli_query($connection, $selectZoneLocations);
                                                    $countZoneLocations = mysqli_num_rows($zoneLocationsQuery);
                                                    if ($countZoneLocations != 0) {
                                                        $rowZoneLocations = mysqli_fetch_array($zoneLocationsQuery);
                                                        $zoneId = $rowZoneLocations['zone_id'];
                                                        $selectZoneShipping = "select * from onlinestore.shipping where shipping_zone = $zoneId";
                                                        $shippingQuery = mysqli_query($connection, $selectZoneShipping);
                                                        $countShipping = mysqli_num_rows($shippingQuery);

                                                        if ($countShipping != 0) {
                                                            $selectZonePostCodes = "select * from onlinestore.zone_locations where zone_id = $zoneId and location_type = 'postcode'";
                                                            $postCodeQuery = mysqli_query($connection, $selectZonePostCodes);
                                                            $countPostCodes = mysqli_num_rows($postCodeQuery);

                                                            if ($countPostCodes != 0) {
                                                                while ($rowZonePostCodes = mysqli_fetch_array($postCodeQuery)) {
                                                                    $locationCode = $rowZonePostCodes['location_code'];
                                                                    if ($locationCode == $billing_postcode) {
                                                                        $shippingZoneId = $zoneId;
                                                                    }
                                                                }
                                                            } else {
                                                                $shippingZoneId = $zoneId;
                                                            }
                                                        }
                                                    }
                                                }
                                            }

                                            if (!empty($shippingZoneId)) {
                                                $selectShippingTypes = "
                                                                        select *, 
                                                                                if(
                                                                                        $totalWeight > 
                                                                                    (   
                                                                                        select max(shipping_weight)
                                                                                        from onlinestore.shipping 
                                                                                        where shipping_type = type_id 
                                                                                        and shipping_zone = $shippingZoneId
                                                                                    ),
                                                                                   (
                                                                                       select shipping_cost 
                                                                                       from onlinestore.shipping 
                                                                                       where shipping_type = type_id 
                                                                                       and shipping_zone = $shippingZoneId 
                                                                                       order by shipping_weight desc limit 0,1
                                                                                   ),
                                                                                    (
                                                                                        select shipping_cost 
                                                                                        from onlinestore.shipping 
                                                                                        where shipping_type = type_id
                                                                                        and shipping_zone = $shippingZoneId
                                                                                        and shipping_weight >= $totalWeight
                                                                                        order by shipping_weight limit 0,1
                                                                                    )
                                                                               ) as shipping_cost
                                                                                from onlinestore.shipping_types 
                                                                                where type_local = 'yes' 
                                                                                order by type_order";

                                                $shippingTypesQuery = mysqli_query($connection,$selectShippingTypes);
                                                $i = 0;
                                                while ($rowShippingTypes = mysqli_fetch_array($shippingTypesQuery)){
                                                    $i++;
                                                    $typeId = $rowShippingTypes['type_id'];
                                                    $typeName = $rowShippingTypes['type_name'];
                                                    $typeDefault = $rowShippingTypes['type_default'];
                                                    $shippingCost = $rowShippingTypes['shipping_cost'];

                                                    if (!empty($shippingCost)){ ?>

                                                        <li>
                                                            <input type="radio" name="shipping_type" value="<?php echo $typeId ?>" class="shipping-type" data-shipping_cost="<?php echo $shippingCost ?>"
                                                            <?php
                                                            if ($typeDefault == "yes"){
                                                                $_SESSION['shipping_type'] = $typeId;
                                                                $_SESSION['shipping_cost'] = $shippingCost;
                                                                echo "checked";
                                                            }elseif ($i == 1){
                                                                $_SESSION['shipping_type'] = $typeId;
                                                                $_SESSION['shipping_cost'] = $shippingCost;
                                                                echo "checked";
                                                            }
                                                            ?>>
                                                            <?php echo $typeName ?> : <span class="text-muted"> $<?php echo $shippingCost ?></span>
                                                        </li>
                                                    <?php }
                                                }
                                            } else {
                                                if (!empty($billing_country) or !empty($shipping_country)){
                                                    if (@$_SESSION["isShippingAddressSame"] == "yes"){
                                                        $selectCountryShipping = "select * from onlinestore.shipping where shipping_country = '$billing_country'";
                                                    }elseif (@$_SESSION["isShippingAddressSame"] == "no"){
                                                        $selectCountryShipping = "select * from onlinestore.shipping where shipping_country = '$shipping_country'";
                                                    }else{
                                                        $selectCountryShipping = "select * from onlinestore.shipping where shipping_country = '$billing_country'";
                                                    }
                                                    $shippingCountryQuery = mysqli_query($connection,$selectCountryShipping);
                                                    $countCountryShipping = mysqli_num_rows($shippingCountryQuery);
                                                    if ($countCountryShipping == 0){ ?>
                                                        <li>
                                                            <p>
                                                                There are no shipping types available for your address,
                                                                contact us if yuo need any help with the subject
                                                            </p>
                                                        </li>
                                                   <?php }else{
                                                        if (@$_SESSION["isShippingAddressSame"] == "yes"){
                                                            $selectShippingTypes = "
                                                                        select *, 
                                                                                if(
                                                                                        $totalWeight > 
                                                                                    (   
                                                                                        select max(shipping_weight)
                                                                                        from onlinestore.shipping 
                                                                                        where shipping_type = type_id 
                                                                                        and shipping_country = '$billing_country'
                                                                                    ),
                                                                                   (
                                                                                       select shipping_cost 
                                                                                       from onlinestore.shipping 
                                                                                       where shipping_type = type_id 
                                                                                       and shipping_country = '$billing_country'
                                                                                       order by shipping_weight desc limit 0,1
                                                                                   ),
                                                                                    (
                                                                                        select shipping_cost 
                                                                                        from onlinestore.shipping 
                                                                                        where shipping_type = type_id
                                                                                        and shipping_country = '$billing_country'
                                                                                        and shipping_weight >= $totalWeight
                                                                                        order by shipping_weight limit 0,1
                                                                                    )
                                                                               ) as shipping_cost
                                                                                from onlinestore.shipping_types 
                                                                                where type_local = 'no' 
                                                                                order by type_order";

                                                        }elseif (@$_SESSION["isShippingAddressSame"] == "no"){
                                                            $selectShippingTypes = "
                                                                        select *, 
                                                                                if(
                                                                                        $totalWeight > 
                                                                                    (   
                                                                                        select max(shipping_weight)
                                                                                        from onlinestore.shipping 
                                                                                        where shipping_type = type_id 
                                                                                        and shipping_country = '$shipping_country'
                                                                                    ),
                                                                                   (
                                                                                       select shipping_cost 
                                                                                       from onlinestore.shipping 
                                                                                       where shipping_type = type_id 
                                                                                       and shipping_country = '$shipping_country'
                                                                                       order by shipping_weight desc limit 0,1
                                                                                   ),
                                                                                    (
                                                                                        select shipping_cost 
                                                                                        from onlinestore.shipping 
                                                                                        where shipping_type = type_id
                                                                                        and shipping_country = '$shipping_country'
                                                                                        and shipping_weight >= $totalWeight
                                                                                        order by shipping_weight limit 0,1
                                                                                    )
                                                                               ) as shipping_cost
                                                                                from onlinestore.shipping_types 
                                                                                where type_local = 'no' 
                                                                                order by type_order";
                                                        }else{
                                                            $selectShippingTypes = "
                                                                        select *, 
                                                                                if(
                                                                                        $totalWeight > 
                                                                                    (   
                                                                                        select max(shipping_weight)
                                                                                        from onlinestore.shipping 
                                                                                        where shipping_type = type_id 
                                                                                        and shipping_country = '$billing_country'
                                                                                    ),
                                                                                   (
                                                                                       select shipping_cost 
                                                                                       from onlinestore.shipping 
                                                                                       where shipping_type = type_id 
                                                                                       and shipping_country = '$billing_country'
                                                                                       order by shipping_weight desc limit 0,1
                                                                                   ),
                                                                                    (
                                                                                        select shipping_cost 
                                                                                        from onlinestore.shipping 
                                                                                        where shipping_type = type_id
                                                                                        and shipping_country = '$billing_country'
                                                                                        and shipping_weight >= $totalWeight
                                                                                        order by shipping_weight limit 0,1
                                                                                    )
                                                                               ) as shipping_cost
                                                                                from onlinestore.shipping_types 
                                                                                where type_local = 'no' 
                                                                                order by type_order";
                                                        }

                                                        $shippingTypesQuery = mysqli_query($connection,$selectShippingTypes);
                                                        $i = 0;
                                                        while ($rowShippingTypes = mysqli_fetch_array($shippingTypesQuery)){
                                                            $i++;
                                                            $typeId = $rowShippingTypes['type_id'];
                                                            $typeName = $rowShippingTypes['type_name'];
                                                            $typeDefault = $rowShippingTypes['type_default'];
                                                            $shippingCost = $rowShippingTypes['shipping_cost'];

                                                            if (!empty($shippingCost)){ ?>

                                                                <li>
                                                                    <input type="radio" name="shipping_type" value="<?php echo $typeId ?>" class="shipping-type" data-shipping_cost="<?php echo $shippingCost ?>"
                                                                        <?php
                                                                        if ($typeDefault == "yes"){
                                                                            $_SESSION['shipping_type'] = $typeId;
                                                                            $_SESSION['shipping_cost'] = $shippingCost;
                                                                            echo "checked";
                                                                        }elseif ($i == 1){
                                                                            $_SESSION['shipping_type'] = $typeId;
                                                                            $_SESSION['shipping_cost'] = $shippingCost;
                                                                            echo "checked";
                                                                        }
                                                                        ?>>
                                                                    <?php echo $typeName ?> : <span class="text-muted"> $<?php echo $shippingCost ?></span>
                                                                </li>
                                                            <?php }
                                                        }

                                                    }

                                                }
                                            }


                                        } else { ?>
                                            <li><p>Please login to view the shipping types</p></li>
                                            <?php
                                        }
                                        ?>
                                    </ul>
                                </th>
                            </tr>
                        <?php
                            $totalCartPrice = $total + @$_SESSION['shipping_cost'];
                        }
                        ?>
                        <tr>
                            <td>Tax</td>
                            <th>&euro;0</th>
                        </tr>
                        <tr class="total">
                            <td>Total</td>
                            <?php
                            if (count($physicalProducts) > 0){ ?>
                                <th class="total-cart-price">&euro;&nbsp;<?php echo $totalCartPrice ?>.00</th>
                            <?php }else{ ?>
                                <th class="total-cart-price">&euro;&nbsp;<?php echo $total ?>.00</th>
                            <?php } ?>
                        </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /table-responsive -->
            </div><!-- /box -->
        </div><!-- /col-md-3 -->


    </div><!-- /container -->
</div><!-- /content -->

<?php include "includes/footer.php" ?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function (data) {
        $(document).on('keyup', '.qty', function () {
            let id = $(this).data("product_id");
            let quantity = $(this).val();
            let shipping_type = $("input[name='shipping_type']:checked").val();
            let shipping_cost = Number($("input[name='shipping_type']:checked").data("shipping_cost"));
            if (quantity !== '') {
                $.ajax({
                    url: "change.php",
                    method: "POST",
                    data: {
                        id: id,
                        qty: quantity,
                        shipping_type: shipping_type,
                        shipping_cost: shipping_cost
                    },
                    success: (data) => {
                        $(".subtotal-cart-price").html(data);
                        $("#cart-products-tbody").load("cart-products-tbody.php");
                        $("#cart-summary-tbody").load("cart-summary-tbody.php");
                    }
                });
            }
        });
        <?php
            if (count($physicalProducts) > 0){ ?>
                $(document).on("change",".shipping-type",function () {
                    var shipping_cost = Number($(this).data("shipping_cost"));
                    var total = Number(<?php echo $total ?>);
                    var totalCartPrice = total + shipping_cost;
                    $(".total-cart-price").html("€" + totalCartPrice + ".00")
                });
            <?php } ?>
    });
</script>

</body>
</html>