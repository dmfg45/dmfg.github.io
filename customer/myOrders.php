<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 05/12/2018
 * Time: 02:50
 */
?>

<div class="text-center">
    <h1>My Orders</h1>
    <p class="lead">Your orders in one place</p>
    <p class="text-muted">If you have any questions fell free to <a href="../contact.php">contact us</a>, our service
        center is working 24/7</p>
</div>

<hr>

<div class="table-responsive"><!-- table-responsive -->
    <table class="table table-bordered table-hover"><!-- table -->
        <thead><!-- thead -->
        <tr>
            <th>Order No</th>
            <th>Invoice No</th>
            <th>Order date</th>
            <th>Order Status</th>
            <th>Order Total</th>
            <th>Actions</th>
        </tr>
        </thead><!-- /thead -->
        <tbody><!-- tbody -->
        <?php
        $customerEmail = $_SESSION['customer_email'];

        $getCustomer = "select * from onlinestore.customers where customer_email = '$customerEmail'";
        $customerQuery = mysqli_query($connection, $getCustomer);
        $customerRow = mysqli_fetch_array($customerQuery);
        $customerId = $customerRow['customer_id'];

        $getOrders = "select * from onlinestore.orders where customer_id = $customerId order by 1 desc";
        $ordersQuery = mysqli_query($connection, $getOrders);
        $i = 0;

        while ($ordersRow = mysqli_fetch_array($ordersQuery)) {
            $i++;
            $order_id = $ordersRow['order_id'];
            $invoice_no = $ordersRow['invoice_no'];
            $order_total = $ordersRow['order_total'];
            $order_date = $ordersRow['order_date'];
            $order_status = $ordersRow['order_status'];
            ?>

            <tr>
                <th><?php echo $i ?></th>
                <td><?php echo $invoice_no ?></td>
                <td><?php echo $order_date ?></td>
                <td><?php
                    if ($order_status == "pending") {
                        echo ucwords($order_status . " Payment");
                    } else {
                        echo ucwords($order_status);
                    }
                    ?>
                <td>
                    <strong>&euro;
                        <?php echo $order_total ?> for <?php
                        $total_items = 0;
                        $getOrderItems = "select * from onlinestore.orders_items where order_id = $order_id";
                        $orderItemsQuery = mysqli_query($connection, $getOrderItems);
                        while ($orderItemsRow = mysqli_fetch_array($orderItemsQuery)) {
                            $qty = $orderItemsRow['qty'];
                            $total_items += $qty;
                        }
                        if ($total_items == 1) {
                            echo $total_items . " Item";
                        } else {
                            echo $total_items . " Items";
                        }

                        ?>
                    </strong>
                </td>

                <td>
                    <div class="dropdown">
                        <button class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <?php if ($order_status == "pending") { ?>
                                <li>
                                    <a href="confirm.php?order_id=<?php echo $order_id ?>" target="_blank"
                                       class="bg-danger">
                                        Confirm if Paid
                                    </a>
                                </li>
                            <?php } ?>
                            <li>
                                <a href="viewOrder.php?order_id=<?php echo $order_id ?>" target="_blank">View</a>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php } ?>
        </tbody><!-- /tbody -->
    </table><!-- /table -->
</div><!-- /table-responsive -->
