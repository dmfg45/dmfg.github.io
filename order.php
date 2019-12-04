<?php
session_start();
include "includes/db.php";
include "functions/functions.php";

if (isset($_SESSION['customer_email'])) {
    $customerEmail = $_SESSION['customer_email'];
    $getCustomer = "select * from onlinestore.customers where customer_email = '$customerEmail'";
    $customerQuery = mysqli_query($connection, $getCustomer);
    $customerRow = mysqli_fetch_array($customerQuery);
    $customerId = $customerRow['customer_id'];

    $amount = $_POST['amount'];
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

    if (count($physicalProducts) > 0) {
        $shipping_type = $_SESSION['shipping_type'];
        $shipping_cost = $_SESSION['shipping_cost'];

        $isShippingAddSame = $_SESSION['is_shipping_address_same'];
        $getShippingTypes = "select * from onlinestore.shipping_types where type_id = $shipping_type";
        $shippingTypeQuery = mysqli_query($connection, $getShippingTypes);
        $shippingTypeRow = mysqli_fetch_array($shippingTypeQuery);
        $shippingTypeName = $shippingTypeRow['type_name'];

    }

    $getCustomerAdd = "select * from onlinestore.customers_addresses where customer_id = $customerId";
    $customerAddQuery = mysqli_query($connection, $getCustomerAdd);

    $customerAddRow = mysqli_fetch_array($customerAddQuery);
    $billingFirstName = $customerAddRow['billing_first_name'];
    $billing_last_name = $customerAddRow['billing_last_name'];
    $billing_country = $customerAddRow['billing_country'];
    $billing_address_1 = $customerAddRow['billing_address_1'];
    $billing_address_2 = $customerAddRow['billing_address_2'];
    $billing_state = $customerAddRow['billing_state'];
    $billing_city = $customerAddRow['billing_city'];
    $billing_postcode = $customerAddRow['billing_postcode'];

    //                Shipping Details

    $shipping_first_name = $customerAddRow['shipping_first_name'];
    $shipping_last_name = $customerAddRow['shipping_last_name'];
    $shipping_country = $customerAddRow['shipping_country'];
    $shipping_address_1 = $customerAddRow['shipping_address_1'];
    $shipping_address_2 = $customerAddRow['shipping_address_2'];
    $shipping_state = $customerAddRow['shipping_state'];
    $shipping_city = $customerAddRow['shipping_city'];
    $shipping_postcode = $customerAddRow['shipping_postcode'];
    date_default_timezone_set("Europe/Lisbon");
    $orderDate = date("F d, Y h:i");
    $payment_method = "pay offline";
    $status = "pending";
    $invoice_no = mt_rand();

    if (count($physicalProducts) > 0) {
        $insertOrder = "insert into onlinestore.orders (
                                customer_id,
                                invoice_no,
                                shipping_type,
                                shipping_cost,
                                payment_method,
                                order_date,
                                order_total,
                                order_status
                                ) VALUES (
                                          $customerId,
                                          $invoice_no,
                                          '$shippingTypeName',
                                          $shipping_cost,
                                          '$payment_method',
                                          '$orderDate',
                                          $amount,
                                          '$status'
                                )";
    } else {
        $insertOrder = "insert into onlinestore.orders (
                                customer_id,
                                invoice_no,
                                shipping_type,
                                shipping_cost,
                                payment_method,
                                order_date,
                                order_total,
                                order_status
                                ) VALUES (
                                          $customerId,
                                          $invoice_no,
                                          '',
                                          0,
                                          '$payment_method',
                                          '$orderDate',
                                          $amount,
                                          '$status'
                                )";
    }

    $orderQuery = mysqli_query($connection, $insertOrder);
    $lastOrderId = mysqli_insert_id($connection);

    if ($orderQuery) {
        if (count($physicalProducts) > 0) {
            if ($isShippingAddSame == "yes") {
                $insertOrderAdd = "insert into onlinestore.orders_addresses (
                                          order_id,
                                          billing_name,
                                          billing_lastname,
                                          billing_country,
                                          billing_address1,
                                          billing_address2,
                                          billing_state,
                                          billing_city,
                                          billing_postcode,
                                          is_shipping_address
                                          ) VALUES (
                                                    $lastOrderId,
                                                    '$billingFirstName',
                                                    '$billing_last_name',
                                                    '$billing_country',
                                                    '$billing_address_1',
                                                    '$billing_address_2',
                                                    '$billing_state',
                                                    '$billing_city',
                                                    '$billing_postcode',
                                                    'yes'                                             
                                          )";
            } elseif ($isShippingAddSame == "no") {
                $insertOrderAdd = "insert into onlinestore.orders_addresses (
                                          order_id,
                                          billing_name,
                                          billing_lastname,
                                          billing_country,
                                          billing_address1,
                                          billing_address2,
                                          billing_state,
                                          billing_city,
                                          billing_postcode,
                                          is_shipping_address,
                                          shipping_first_name,
                                          shipping_last_name,
                                          shipping_country,
                                          shipping_address1,
                                          shipping_address2,
                                          shipping_state,
                                          shipping_city,
                                          shipping_postcode
                                          ) VALUES (
                                                    $lastOrderId,
                                                    '$billingFirstName',
                                                    '$billing_last_name',
                                                    '$billing_country',
                                                    '$billing_address_1',
                                                    '$billing_address_2',
                                                    '$billing_state',
                                                    '$billing_city',
                                                    '$billing_postcode',
                                                    'no',
                                                    '$shipping_first_name',
                                                    '$shipping_last_name',
                                                    '$shipping_country',
                                                    '$shipping_address_1',
                                                    '$shipping_address_2',
                                                    '$shipping_state',
                                                    '$shipping_city',
                                                    '$shipping_postcode'                                                    
                                          )";
            }
        } else {
            $insertOrderAdd = "insert into onlinestore.orders_addresses (
                                          order_id,
                                          billing_name,
                                          billing_lastname,
                                          billing_country,
                                          billing_address1,
                                          billing_address2,
                                          billing_state,
                                          billing_city,
                                          billing_postcode,
                                          is_shipping_address
                                          ) VALUES (
                                                    $lastOrderId,
                                                    '$billingFirstName',
                                                    '$billing_last_name',
                                                    '$billing_country',
                                                    '$billing_address_1',
                                                    '$billing_address_2',
                                                    '$billing_state',
                                                    '$billing_city',
                                                    '$billing_postcode',
                                                    'none'                                             
                                          )";
        }

        $orderQueryAdd = mysqli_query($connection, $insertOrderAdd);
        if ($orderQueryAdd) {
            $selectCart = "select * from onlinestore.cart where ip_add = '$ip_add'";
            $cartQuery = mysqli_query($connection, $selectCart);
            while ($cartRow = mysqli_fetch_array($cartQuery)) {
                $productId = $cartRow['p_id'];
                $productQty = $cartRow['qty'];
                $productSize = $cartRow['p_size'];
                $productPrice = $cartRow['p_price'];
                $insertOrderItem = "insert into onlinestore.orders_items (
                                      order_id,
                                      product_id,
                                      price,
                                      qty,
                                      size) VALUES (
                                                    $lastOrderId,
                                                    $productId,
                                                    $productQty,
                                                    $productPrice,
                                                    $productSize
                                      )";
                $orderItemQuery = mysqli_query($connection, $insertOrderItem);

            }

            $deleteCart = "delete from onlinestore.cart where ip_add = '$ip_add'";
            $deleteCartQuery = mysqli_query($connection, $deleteCart);

            if ($deleteCartQuery) {
                echo "<script>
                        alert('Your order has been submitted, Thanks');
                        window.open('order_received.php?order_id=$lastOrderId','_self');
                      </script>";

            }
        }
    }
}



