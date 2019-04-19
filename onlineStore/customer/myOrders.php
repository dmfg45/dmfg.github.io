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
            <th>Due Amount</th>
            <th>Invoice No</th>
            <th>Qty</th>
            <th>Size</th>
            <th>Order Date</th>
            <th>Paid/Unpaid</th>
            <th>Status</th>
        </tr>
        </thead><!-- /thead -->
        <tbody><!-- tbody -->

        <?php

        $customerSession = $_SESSION['customer_email'];

        $customerSql = "SELECT * FROM onlinestore.customers where customer_email = '$customerSession'";

        $customerSelect = mysqli_query($connection, $customerSql);

        $rowCustomer = mysqli_fetch_array($customerSelect);

        $customerId = $rowCustomer['customer_id'];

        $ordersSql = "SELECT * FROM onlinestore.customers_orders where customer_id = '$customerId'";

        $orderQuery = mysqli_query($connection,$ordersSql);

        $i = 0;


        while ($rowOrders = mysqli_fetch_array($orderQuery)){
            $orderId = $rowOrders['order_id'];
            $orderDamount = $rowOrders['due_amount'];
            $orderInumber = $rowOrders['invoice_number'];
            $orderQty = $rowOrders['qty'];
            $orderSize = $rowOrders['size'];
            $orderDate = substr($rowOrders['order_date'],0,11);
            $orderStatus = $rowOrders['order_status'];
            $i++

            ?>

        <tr>
            <th>#<?php echo $i ?></th>
            <td><?php echo $orderDamount ?> &euro;</td>
            <td><?php echo $orderInumber ?></td>
            <td><?php echo $orderQty ?></td>
            <td><?php echo $orderSize ?></td>
            <td><?php echo $orderDate ?></td>
            <td><?php echo $orderStatus ?></td>
            <td><a href="confirm.php" target="_blank" class="btn btn-primary btn-sm">Confirm Status</a></td>
        </tr>

        <?php

        }

        ?>


        </tbody><!-- /tbody -->
    </table><!-- /table -->
</div><!-- /table-responsive -->
