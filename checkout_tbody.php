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

    $getCustomerAdd = "select * from onlinestore.customers_addresses where customer_id = $customerId";
    $customerAddQuery = mysqli_query($connection, $getCustomerAdd);

    $customerAddRow = mysqli_fetch_array($customerAddQuery);

    $billing_country = $customerAddRow['billing_country'];
    $billing_postcode = $customerAddRow['billing_postcode'];
    $shipping_country = $customerAddRow['shipping_country'];
    $shipping_postcode = $customerAddRow['shipping_postcode'];

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
    ?>

    <?php
    $total = 0;
    $totalWeight = 0;

    $selectCart = "select * from onlinestore.cart where ip_add = '$ip_add'";
    $cartQuery = mysqli_query($connection, $selectCart);
    while ($cartRow = mysqli_fetch_array($cartQuery)) {
        $productId = $cartRow['p_id'];
        $productQty = $cartRow['qty'];
        $productSize = $cartRow['p_size'];
        $productPrice = $cartRow['p_price'];

        $getProducts = "select * from onlinestore.products where product_id = $productId";
        $productQuery = mysqli_query($connection, $getProducts);
        $productRow = mysqli_fetch_array($productQuery);
        $productTitle = $productRow['product_title'];
        $productWeight = $productRow['product_weight'];
        $subTotal = $productPrice * $productQty;
        $total += $subTotal;
        $subTotalWeight = $productWeight * $productQty;
        $totalWeight += $subTotalWeight;
        ?>

        <tr>
            <td>
                <a href="#" class="bold"><?php echo $productTitle ?></a>
                <i class="fas fa-times" title="Product Qty"></i> <?php echo $productQty ?>
                <?php if ($productSize != "None") { ?>
                    <i class="fas fa-plus" title="Product Size"></i> <?php echo $productSize ?>
                <?php } ?>
            </td>
            <td>&euro; <?php echo $subTotal ?></td>
        </tr>
    <?php } ?>
    <tr>
        <td class="text-muted bold">Order Subtotal</td>
        <th>&euro;&nbsp;<?php echo $total ?></th>
    </tr>
    <?php if (count($physicalProducts) > 0) { ?>
    <tr>
        <th colspan="2">
            <p class="shipping-header text-muted">
                <i class="fas fa-truck"></i> Shipping:
            </p>
            <ul class="list-unstyled">
                <?php
                $shippingZoneId = "";

                if (@$_SESSION["is_shipping_address_same"] == "yes") {
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
                } elseif (@$_SESSION["is_shipping_address_same"] == "no") {
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

                    $shippingTypesQuery = mysqli_query($connection, $selectShippingTypes);
                    $i = 0;
                    while ($rowShippingTypes = mysqli_fetch_array($shippingTypesQuery)) {
                        $i++;
                        $typeId = $rowShippingTypes['type_id'];
                        $typeName = $rowShippingTypes['type_name'];
                        $typeDefault = $rowShippingTypes['type_default'];
                        $shippingCost = $rowShippingTypes['shipping_cost'];

                        if (!empty($shippingCost)) { ?>

                            <li>
                                <input type="radio" name="shippingType"
                                       value="<?php echo $typeId ?>" class="shipping-type"
                                       data-shipping_cost="<?php echo $shippingCost ?>"
                                    <?php
                                    if (@$_SESSION['shipping_type'] == $typeId) {
                                        $_SESSION['shipping_type'] = $typeId;
                                        $_SESSION['shipping_cost'] = $shippingCost;
                                        echo "checked";
                                    } elseif ($i == 1) {
                                        echo "checked";
                                    }
                                    ?>>
                                <?php echo $typeName ?> : <span
                                        class="text-muted"> $<?php echo $shippingCost ?></span>
                            </li>
                        <?php }
                    }
                } else {
                    if (!empty($billing_country) or !empty($shipping_country)) {
                        if (@$_SESSION["is_shipping_address_same"] == "yes") {
                            $selectCountryShipping = "select * from onlinestore.shipping where shipping_country = '$billing_country'";
                        } elseif (@$_SESSION["is_shipping_address_same"] == "no") {
                            $selectCountryShipping = "select * from onlinestore.shipping where shipping_country = '$shipping_country'";
                        } else {
                            $selectCountryShipping = "select * from onlinestore.shipping where shipping_country = '$billing_country'";
                        }
                        $shippingCountryQuery = mysqli_query($connection, $selectCountryShipping);
                        $countCountryShipping = mysqli_num_rows($shippingCountryQuery);
                        if ($countCountryShipping == 0) { ?>
                            <li>
                                <p>
                                    There are no shipping types available for your address,
                                    contact us if yuo need any help with the subject
                                </p>
                            </li>
                        <?php } else {
                            if (@$_SESSION["is_shipping_address_same"] == "yes") {
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

                            } elseif (@$_SESSION["is_shipping_address_same"] == "no") {
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
                            } else {
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

                            $shippingTypesQuery = mysqli_query($connection, $selectShippingTypes);
                            $i = 0;
                            while ($rowShippingTypes = mysqli_fetch_array($shippingTypesQuery)) {
                                $i++;
                                $typeId = $rowShippingTypes['type_id'];
                                $typeName = $rowShippingTypes['type_name'];
                                $typeDefault = $rowShippingTypes['type_default'];
                                $shippingCost = $rowShippingTypes['shipping_cost'];

                                if (!empty($shippingCost)) { ?>

                                    <li>
                                        <input type="radio" name="shippingType"
                                               value="<?php echo $typeId ?>" class="shipping-type"
                                               data-shipping_cost="<?php echo $shippingCost ?>"
                                            <?php
                                            if (@$_SESSION['shipping_type'] == $typeId) {
                                                $_SESSION['shipping_type'] = $typeId;
                                                $_SESSION['shipping_cost'] = $shippingCost;
                                                echo "checked";
                                            } elseif ($i == 1) {
                                                echo "checked";
                                            }
                                            ?>>
                                        <?php echo $typeName ?> : <span
                                                class="text-muted"> $<?php echo $shippingCost ?></span>
                                    </li>
                                <?php }
                            }

                        }

                    }
                }

                $totalCartPrice = $total + @$_SESSION['shipping_cost'];
                ?>
            </ul>
        </th>
    </tr>
<?php } ?>
    <tr>
        <td class="text-muted bold">Tax</td>
        <th>&euro;0</th>
    </tr>
    <tr class="total">
        <td>Total</td>
        <?php
        if (count($physicalProducts) > 0) { ?>
            <th class="total-cart-price">&euro;&nbsp;<?php echo $totalCartPrice ?>.00</th>
        <?php } else { ?>
            <th class="total-cart-price">&euro;&nbsp;<?php echo $total ?>.00</th>
        <?php } ?>
    </tr>
    <tr>
        <th colspan="2">
            <input type="radio" id="offline-radio" name="payment_method" value="pay_offline"
                <?php if (@$_SESSION['payment_method'] == "pay_offline") {
                    echo "checked";
                } ?>>
            <label for="offline-radio">Pay Offline</label>
            <p id="offline-desc" class="text-muted">
                You will not be shipped until the funds have cleared in our bank account.
            </p>
        </th>
    </tr>
    <tr>
        <th colspan="2">
            <input type="radio" id="offline-radio" name="payment_method" value="stripe"
                <?php if (@$_SESSION['payment_method'] == "stripe") {
                    echo "checked";
                } ?>>
            <label for="stripe-radio">Credit Card</label>
            <p id="stripe-desc" class="text-muted">
                Pay with you credit card via Stripe.
            </p>
        </th>
    </tr>
    <tr>
        <th colspan="2">
            <input type="radio" id="paypal-radio" name="payment_method" value="paypal"
                <?php if (@$_SESSION['payment_method'] == "paypal") {
                    echo "checked";
                } ?>>
            <label for="paypal-radio">Paypal</label>
            <p id="paypal-desc" class="text-muted">
                Pay with your paypal account.
            </p>
        </th>
    </tr>
    <tr>
        <td id="payment-method-forms-td" colspan="2">
            <form action="order.php" id="offline-form" method="post">
                <?php
                if (count($physicalProducts) > 0) {
                    ?>
                    <input type="hidden" name="amount" value="<?php echo $totalCartPrice ?>">
                <?php } else { ?>
                    <input type="hidden" name="amount" value="<?php echo $total ?>">
                <?php } ?>
                <input type="submit" value="Place Order" id="offline-submit"
                       class="btn btn-success btn-lg" style="border-radius: 0">
            </form>
            <?php
            include "stripe_config.php";
            if (count($physicalProducts) > 0) {
                $stripeTotal = $totalCartPrice * 100;
            } else {
                $stripeTotal = $total * 100;
            }
            ?>
            <form id="stripe-form" action="stripe_charge.php" method="post">
                <?php if (count($physicalProducts) > 0) { ?>
                    <input type="hidden" name="totalAmount" value="<?php echo $totalCartPrice ?>">
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
                           value="http://localhost/onlinestore/paypalOrder?c_id=<?php echo $customerId ?>&amount=<?php echo $totalCartPrice ?>">
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
        </td>
    </tr>

    <script>
        $(document).ready(function () {
            <?php if (@$_SESSION['payment_method'] == "paypal"){?>
            $("#offline-desc").hide();
            $("#offline-form").hide();
            $("#stripe-desc").hide();
            $("#stripe-form").hide();
            $("#paypal-desc").show();
            $("#paypal-form").show();
            <?php } elseif (@$_SESSION['payment_method'] == "pay_offline"){?>
            $("#offline-desc").fadeIn(500);
            $("#offline-form").fadeIn(500);
            $("#stripe-desc").hide();
            $("#stripe-form").hide();
            $("#paypal-desc").hide();
            $("#paypal-form").hide();
            <?php } elseif (@$_SESSION['payment_method'] == "stripe"){?>
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

<?php } ?>