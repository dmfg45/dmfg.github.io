<?php
session_start();
?>
<?php include 'includes/db.php' ?>
<?php include 'functions/functions.php' ?>

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
    }
}
?>
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
                                    <input type="radio" name="shippingType" value="<?php echo $typeId ?>" class="shipping-type" data-shipping_cost="<?php echo $shippingCost ?>"
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
                                            <input type="radio" name="shippingType" value="<?php echo $typeId ?>" class="shipping-type" data-shipping_cost="<?php echo $shippingCost ?>"
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

<script>
    $(document).ready(function () {
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
