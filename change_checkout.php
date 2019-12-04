<?php
session_start();
include_once 'includes/db.php';
include 'functions/functions.php';

if (isset($_SESSION['customer_email'])){?>
    <?php
    $customerEmail = $_SESSION['customer_email'];

    $getCustomer = "select * from onlinestore.customers where customer_email = '$customerEmail'";
    $customerQuery = mysqli_query($connection, $getCustomer);
    $customerRow = mysqli_fetch_array($customerQuery);
    $customerId = $customerRow['customer_id'];

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

    $total = $_POST["total"];
    $shipping_type = $_POST["shipping_type"];
    $shipping_cost = $_POST["shipping_cost"];
    $payment_method = $_POST["payment_method"];

    $_SESSION['shipping_type'] = $shipping_type;
    $_SESSION['shipping_cost'] = $shipping_cost;

    $total_cart_price = $total + $shipping_cost

    ?>

    <form action="order.php" id="offline-form" method="post">
        <?php
        if (count($physicalProducts) > 0) {
            ?>
            <input type="hidden" name="amount" value="<?php echo $total_cart_price ?>">
        <?php } else { ?>
            <input type="hidden" name="amount" value="<?php echo $total ?>">
        <?php } ?>
        <input type="submit" value="Place Order" id="offline-submit"
               class="btn btn-success btn-lg" style="border-radius: 0">
    </form>
    <?php
    include "stripe_config.php";
    if (count($physicalProducts) > 0) {
        $stripeTotal = $total_cart_price * 100;
    } else {
        $stripeTotal = $total * 100;
    }
    ?>
    <form id="stripe-form" action="stripe_charge.php" method="post">
        <?php if (count($physicalProducts) > 0) { ?>
            <input type="hidden" name="totalAmount" value="<?php echo $total_cart_price ?>">
        <?php } else { ?>
            <input type="hidden" name="totalAmount" value="<?php echo $total ?>">
        <?php } ?>
        <input type="hidden" name="stripeTotalAmount" value="<?php echo $stripeTotal ?>">
        <input
            type="submit"
            id="stripe-submit"
            class="btn btn-success btn-lg"
            value="Proceed with Stripe"
            style="border-radius: 0"
            data-name="moto-stash.com"
            data-description="Pay With Credit Card"
            data-image="images/logo.png"
            data-key="<?php echo $stripe["publishable_key"] ?>"
            data-amount="<?php echo $stripeTotal ?>"
            data-currency="euro"
            data-email="<?php echo $customerEmail ?>"
        >
    </form>
    <form id="paypal-form" action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="business" value="andre.graca.45@gmail.com">
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="upload" value="1">
        <input type="hidden" name="currency" value="EUR">
        <?php if (count($physicalProducts) > 0) { ?>
            <input type="hidden"
                   name="return"
                   value="http://localhost/onlinestore/paypalOrder?c_id=<?php echo $customerId ?>&amount=<?php echo $total_cart_price ?>">
        <?php } else { ?>
            <input type="hidden"
                   name="return"
                   value="http://localhost/onlinestore/paypalOrder?c_id=<?php echo $customerId ?>&amount=<?php echo $total ?>">
        <?php } ?>

        <input type="hidden" name="cancel_return"
               value="http://localhost/onlinestore/checkout.php">

        <?php
        $i = 0;
        $selectCart = "select * from onlinestore.cart where ip_add = '$ip_add'";
        $cartQuery = mysqli_query($connection, $selectCart);

        while ($cartRow = mysqli_fetch_array($cartQuery)) {
            $productId = $cartRow['p_id'];
            $productQty = $cartRow['qty'];
            $productPrice = $cartRow['p_price'];
            $getProducts = "select * from onlinestore.products where product_id = $productId";
            $productQuery = mysqli_query($connection, $getProducts);
            $productRow = mysqli_fetch_array($productQuery);
            $product_title = $productRow['product_title'];

            $i++;
            ?>
            <input type="hidden" name="item_name_<?php echo $i ?>"
                   value="<?php echo $product_title ?>">
            <input type="hidden" name="item_number_<?php echo $i ?>" value="<?php echo $i ?>">
            <input type="hidden" name="amount_<?php echo $i ?>"
                   value="<?php echo $productPrice ?>">
            <input type="hidden" name="quantity_<?php echo $i ?>"
                   value="<?php echo $productQty ?>">
        <?php } ?>
        <input type="hidden" name="shipping_1"
               value="<?php echo @$_SESSION['shipping_cost'] ?>">
        <input type="hidden" name="fist_name" value="<?php echo $billingFirstName ?>">
        <input type="hidden" name="last_name" value="<?php echo $billing_last_name ?>">
        <input type="hidden" name="address_1" value="<?php echo $billing_address_1 ?>">
        <input type="hidden" name="address_2" value="<?php echo $billing_address_2 ?>">
        <input type="hidden" name="city" value="<?php echo $billing_city ?>">
        <input type="hidden" name="state" value="<?php echo $billing_state ?>">
        <input type="hidden" name="zip" value="<?php echo $billing_postcode ?>">
        <input type="hidden" name="email" value="<?php echo $customerEmail ?>">
        <input type="submit" id="paypal-submit" name="submit" value="Proceed with Paypal"
               class="btn btn-success btn-lg" style="border-radius: 0" checked>
    </form>
    <script>
        $(document).ready(function () {
            <?php if ($payment_method == "paypal"){?>
            $("#offline-desc").hide();
            $("#offline-form").hide();
            $("#stripe-desc").hide();
            $("#stripe-form").hide();
            $("#paypal-desc").show();
            $("#paypal-form").show();
            <?php } elseif ($payment_method == "pay_offline"){?>
            $("#offline-desc").fadeIn(500);
            $("#offline-form").fadeIn(500);
            $("#stripe-desc").hide();
            $("#stripe-form").hide();
            $("#paypal-desc").hide();
            $("#paypal-form").hide();
            <?php } elseif ($payment_method == "stripe"){?>
            $("#offline-desc").hide();
            $("#offline-form").hide();
            $("#stripe-desc").fadeIn(500);
            $("#stripe-form").fadeIn(500);
            $("#paypal-desc").hide();
            $("#paypal-form").hide();
            <?php } ?>
            $("#offline-radio").click(function () {
                $("#offline-desc").fadeIn(500);
                $("#offline-form").fadeIn(500);
                $("#stripe-desc").hide();
                $("#stripe-form").hide();
                $("#paypal-desc").hide();
                $("#paypal-form").hide();
            });

            $("#stripe-radio").click(function () {
                $("#offline-desc").hide();
                $("#offline-form").hide();
                $("#stripe-desc").fadeIn(500);
                $("#stripe-form").fadeIn(500);
                $("#paypal-desc").hide();
                $("#paypal-form").hide();
            });

            $("#paypal-radio").click(function () {
                $("#offline-desc").hide();
                $("#offline-form").hide();
                $("#stripe-desc").hide();
                $("#stripe-form").hide();
                $("#paypal-desc").fadeIn(500);
                $("#paypal-form").fadeIn(500);
            });


            $("#offline-submit").click(function (event) {
                event.preventDefault();
                $("#shipping-billing-details-form").submit(function (event) {
                    event.preventDefault();
                    var confirm_action = confirm("Do you really want to order Cart Products by Offline Method?");
                    if (confirm_action == true) {
                        $("#offline-submit").click();
                    }
                });
                $("#shipping-details-submit-button").click();
            });

            $("#stripe-submit").click(function (event) {
                event.preventDefault();
                $("#shipping-billing-details-form").submit(function (event) {
                    event.preventDefault();
                    var confirm_action = confirm("Do you really want to order Cart Products by Credit Cart?");
                    if (confirm_action == true) {
                        var $button = $("#stripe-submit"),
                            $form = $button.parents('form');
                        var opts = $.extend({}, $button.data(), {
                            token: function(result) {
                                $form.append($('<input>').attr({ type: 'hidden', name: 'stripeToken', value: result.id })).submit();
                            }
                        });
                        StripeCheckout.open(opts);
                    }
                });
                $("#shipping-details-submit-button").click();
            });

            $("#paypal-submit").click(function (event) {
                event.preventDefault();
                $("#shipping-billing-details-form").submit(function (event) {
                    event.preventDefault();
                    var confirm_action = confirm("Do you really want to order Cart Products by Paypal?");
                    if (confirm_action == true) {
                        $("#paypal-submit").click();
                    }
                });
                $("#shipping-details-submit-button").click();
            });

        });
    </script>
<?php}

