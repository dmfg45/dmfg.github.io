<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 22/03/2019
 * Time: 03:50
 */
?>
<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fas fa-tachometer-alt"></i>
                    &nbsp;Dashboard&nbsp;/&nbsp;View&nbsp;Orders
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill"></i>&nbsp;View Orders
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-stripped">
                            <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Ship to</th>
                                <th>Customer Email</th>
                                <th>Invoice No</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th>Order Status</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 0;
                            $selectOrders = "select * from onlinestore.orders order by 1 desc";
                            $orderQuery = mysqli_query($connection,$selectOrders);
                            while ($ordersRow = mysqli_fetch_array($orderQuery)){
                                $order_id = $ordersRow['order_id'];
                                $customer_id = $ordersRow['customer_id'];
                                $invoice_no = $ordersRow['invoice_no'];
                                $shipping_type = $ordersRow['shipping_type'];
                                $shipping_cost = $ordersRow['shipping_cost'];
                                $payment_method = $ordersRow['payment_method'];
                                $order_date = $ordersRow['order_date'];
                                $order_total = $ordersRow['order_total'];
                                $order_status = $ordersRow['order_status'];

                                $getCustomer = "select * from onlinestore.customers where customer_id = '$customer_id'";
                                $customerQuery = mysqli_query($connection,$getCustomer);
                                $customerRow = mysqli_fetch_array($customerQuery);
                                $customer_email = $customerRow['customer_email'];

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

                                ?>
                                <tr>
                                    <td>
                                        <?php echo $i ?>
                                    </td>
                                 <td>
                                     <strong>
                                         <?php if ($is_shipping_address == "yes"){ ?>
                                             <?php echo $billing_name . " " . $billing_lastname ?>,
                                             <?php echo $billing_city ?>,
                                             <?php echo $billing_state ?>,
                                             <?php echo $billing_postcode ?>,
                                             <?php
                                             $selectCountry = "select * from onlinestore.countries where country_code = '$billing_country'";
                                             $countryQuery = mysqli_query($connection, $selectCountry);
                                             $countryRow = mysqli_fetch_array($countryQuery);
                                             echo $country_name = $countryRow['country_name'];
                                             ?>
                                        <?php } elseif ($is_shipping_address == "no"){ ?>
                                             <?php echo $shipping_first_name . " " . $shipping_last_name ?>,
                                             <?php echo $shipping_city ?>,
                                             <?php echo $shipping_state ?>,
                                             <?php echo $shipping_postcode ?>,
                                             <?php
                                             $selectCountry = "select * from onlinestore.countries where country_code = '$shipping_country'";
                                             $countryQuery = mysqli_query($connection, $selectCountry);
                                             $countryRow = mysqli_fetch_array($countryQuery);
                                             echo $country_name = $countryRow['country_name'];
                                             ?>
                                        <?php }elseif ($is_shipping_address == "none"){ ?>
                                             Shipping None
                                        <?php } ?>
                                     </strong>
                                     <br>
                                     <?php
                                     if ($is_shipping_address != "none"){ ?>
                                            <span class="text-muted"> <?php echo ucwords($shipping_type)?></span>
                                     <?php }
                                     ?>
                                    </td>
                                 <td>
                                        <?php echo $customer_email ?>
                                    </td>
                                 <td bgcolor="yellow">
                                        #<?php echo $invoice_no ?>
                                    </td>
                                <td>
                                        #<?php echo $order_date ?>
                                    </td>
                                 <td>
                                        <strong>&euro; <?php echo $order_total ?></strong>
                                     <span class="text-muted"> <?php echo ucwords($payment_method)?></span>
                                    </td>
                                    <td>
                                        <?php
                                        if ($order_status == "pending"){
                                            echo ucwords($order_status . " Payment");
                                        }else{
                                            echo ucwords($order_status);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                                <span class="caret"></span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right">
                                                <li>
                                                    <a href="index.php?viewOrderId=<?php echo $order_id ?>" target="_blank">
                                                        <i class="fas fa-edit"></i> View / Edit
                                                    </a>
                                                 <a href="index.php?orderDelete=<?php echo $order_id ?>" target="_blank">
                                                        <i class="fas fa-times-circle"></i> Delete
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }

