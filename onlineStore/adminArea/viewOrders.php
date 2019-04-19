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
                    &nbsp;Dashboard&nbsp;/&nbsp;View&nbsp;Customers
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill"></i>&nbsp;View Customers
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-stripped">
                            <thead>
                            <tr>
                                <th>Order No</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Invoice No</th>
                                <th>Product Title</th>
                                <th>Product Qty</th>
                                <th>Product Size</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th>Order Status</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php

                            $i = 0;

                            $query = "select * from onlinestore.customers_orders";
                            $runQuery = mysqli_query($connection,$query);

                            while ($row = mysqli_fetch_array($runQuery)){
                                $orderId = $row['order_id'];
                                $customerId = $row['customer_id'];
                                $orderTotalAmount = $row['due_amount'];
                                $invoiceNo = $row['invoice_number'];
                                $orderQty = $row['qty'];
                                $orderSize = $row['size'];
                                $orderDate = $row['order_date'];
                                $orderStatus = $row['order_status'];
                                $productId = $row['product_id'];

                                $i++;

                                ?>

                                <tr>

                                    <td><?php echo $i ?></td>
                                    <?php

                                    $query = "select * from onlinestore.customers where customer_id = $customerId";
                                    $runCustomerQuery = mysqli_query($connection,$query);
                                    $rowCustomer = mysqli_fetch_array($runCustomerQuery);

                                    $customerEmail = $rowCustomer['customer_email'];
                                    $customerName = $rowCustomer['customer_name'];

                                    ?>
                                    <td><?php echo $customerName ?></td>
                                    <td><?php echo $customerEmail ?></td>
                                    <td><?php echo $invoiceNo ?></td>

                                    <?php

                                    $query = "select * from onlinestore.products where product_id = $productId";
                                    $runProductQuery = mysqli_query($connection,$query);
                                    $rowProduct = mysqli_fetch_array($runProductQuery);

                                    $productTitle = $rowProduct['product_title'];

                                    ?>

                                    <td>
                                        <?php echo $productTitle ?>
                                    </td>
                                    <td><?php echo $orderQty ?></td>
                                    <td><?php echo $orderSize ?></td>
                                    <td><?php echo $orderDate ?></td>
                                    <td><?php echo $orderTotalAmount ?></td>
                                    <td><?php echo $orderStatus ?></td>
                                    <td><a href="index.php?deleteOrder=<?php echo $orderId ?>"><i class="fas fa-times-circle fa-2x"></i></a></td>
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

