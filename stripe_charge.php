<?php
session_start();
include "includes/db.php";
include "functions/functions.php";
include "stripe_config.php";

if (isset($_SESSION['customer_email'])){
    $customerEmail = $_SESSION['customer_email'];

    $getCustomer = "select * from onlinestore.customers where customer_email = '$customerEmail'";
    $customerQuery = mysqli_query($connection, $getCustomer);
    $customerRow = mysqli_fetch_array($customerQuery);
    $customerId = $customerRow['customer_id'];

    $totalAmount = $_POST['totalAmount'];
    $stripeTotalAmount = $_POST['stripeTotalAmount'];
    $token = $_POST['stripeToken'];
    $customer = \Stripe\Customer::create(array(
       'email' => $customerEmail,
       'source' => $token
    ));
    $charge = \Stripe\Charge::create(array(
       'customer' => $customer->id,
        'amount' => $stripeTotalAmount,
        'currency' => 'eur'
    ));

   echo "<script>window.open('stripe_order.php?c_id=$customerId&amount=$totalAmount','_self')</script>";


}