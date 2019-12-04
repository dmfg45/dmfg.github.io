<?php

session_start();
include_once 'includes/db.php';
include 'functions/functions.php';

if (isset($_SESSION['customer_email'])) {
    $customerEmail = $_SESSION['customer_email'];

    $getCustomer = "select * from onlinestore.customers where customer_email = '$customerEmail'";
    $customerQuery = mysqli_query($connection, $getCustomer);
    $customerRow = mysqli_fetch_array($customerQuery);
    $customerId = $customerRow['customer_id'];
    $ip_add = getUserIpAddress();
    $physicalProducts = array();
    $selectCart = "select * from onlinestore.cart where ip_add = '$ip_add'";
    $cartQuery = mysqli_query($connection, $selectCart);

    while ($cartRow = mysqli_fetch_array($cartQuery)) {
        $productId = $cartRow['p_id'];
        $getProducts = "select * from onlinestore.products where product_id = $productId";
        $productQuery = mysqli_query($connection, $getProducts);
        $productRow = mysqli_fetch_array($productQuery);
        $productType = $productRow['product_type'];

        if ($productType == "physicalProduct") {
            array_push($physicalProducts, $productId);
        }
    }
    $billing_name = mysqli_real_escape_string($connection,$_POST['billingFirstName']);
    $billingLastName = mysqli_real_escape_string($connection,$_POST['billingLastName']);
    $billingCountry = mysqli_real_escape_string($connection,$_POST['billingCountry']);
    $billingAddress1 = mysqli_real_escape_string($connection,$_POST['billingAddress1']);
    $billingAddress2 = mysqli_real_escape_string($connection,$_POST['billingAddress2']);
    $billingState = mysqli_real_escape_string($connection,$_POST['billingState']);
    $billingCity = mysqli_real_escape_string($connection,$_POST['billingCity']);
    $billingPostcode = mysqli_real_escape_string($connection,$_POST['billingPostcode']);
    $is_shipping_address_same = mysqli_real_escape_string($connection,$_POST['is_shipping_address_same']);



    $updateBillingAdd = "update onlinestore.customers_addresses 
                                set 
                                    billing_first_name = '$billing_name',
                                    billing_last_name = '$billingLastName',
                                    billing_address_1 = '$billingAddress1',
                                    billing_address_2 = '$billingAddress2',
                                    billing_city = '$billingCity',
                                    billing_country = '$billingCountry',
                                    billing_postcode = '$billingPostcode',
                                    billing_state = '$billingState' where customer_id = $customerId;
                                    ";

    $billingAdd = mysqli_query($connection,$updateBillingAdd);
    $shippingType = $_POST['shipping_type'];
    $paymentMethod = $_POST['paymentMethod'];

    $_SESSION['is_shipping_address_same'] = $is_shipping_address_same;
    $_SESSION['shipping_type'] = $shippingType;
    $_SESSION['paymentMethod'] = $paymentMethod;

    if (count($physicalProducts) > 0){
        if ($is_shipping_address_same = "no"){
            //    Shipping Details

            $shippingFirstName = mysqli_real_escape_string($connection,$_POST['shippingFirstName']);
            $shippingLastName = mysqli_real_escape_string($connection,$_POST['shippingLastName']);
            $shippingCountry = mysqli_real_escape_string($connection,$_POST['shippingCountry']);
            $shippingAddress1 = mysqli_real_escape_string($connection,$_POST['shippingAddress1']);
            $shippingAddress2 = mysqli_real_escape_string($connection,$_POST['shippingAddress2']);
            $shippingState = mysqli_real_escape_string($connection,$_POST['shippingState']);
            $shippingCity = mysqli_real_escape_string($connection,$_POST['shippingCity']);
            $shippingPostcode = mysqli_real_escape_string($connection,$_POST['shippingPostcode']);

            $updateShippingAdd = "update onlinestore.customers_addresses 
                                        set 
                                            shipping_first_name = '$shippingFirstName',
                                            shipping_last_name = '$shippingLastName',
                                            shipping_country = '$shippingCountry',
                                            shipping_address_1 = '$shippingAddress1',
                                            shipping_address_2 = '$shippingAddress2',
                                            shipping_state = '$shippingState',
                                            shipping_city = '$shippingCity',
                                            shipping_postcode = '$shippingPostcode' where customer_id = $customerId
                                            ";
            $shippingAddQuery = mysqli_query($connection,$updateShippingAdd);
        }
    }

}

?>
