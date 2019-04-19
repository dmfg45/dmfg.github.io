<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 18/03/2019
 * Time: 03:59
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
        <h1 class="page-header">
            Dashboard
        </h1>
        <ol class="breadcrumb">
            <li class="active">
                <i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard
            </li>
        </ol>
    </div>
</div>

<div class="row">
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-tasks fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $countProducts?></div>
                        <div>Products</div>
                    </div>
                </div>
            </div>
            <a href="index.php?viewProducts">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fas fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-comments fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $countCustomers ?></div>
                        <div>Customers</div>
                    </div>
                </div>
            </div>
            <a href="index.php?viewCustomers">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fas fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-shopping-cart fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $countProductCat?></div>
                        <div>Product Categories</div>
                    </div>
                </div>
            </div>
            <a href="index.php?viewCategories">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fas fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-xs-3">
                        <i class="fas fa-life-ring fa-5x"></i>
                    </div>
                    <div class="col-xs-9 text-right">
                        <div class="huge"><?php echo $countPendingOrders?></div>
                        <div>Orders</div>
                    </div>
                </div>
            </div>
            <a href="index.php?viewOrders">
                <div class="panel-footer">
                    <span class="pull-left">View Details</span>
                    <span class="pull-right"><i class="fas fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fas fa-money-bill fa-fw"></i>&nbsp;New Orders</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-stripped">
                        <thead>
                        <tr>
                            <th>Order No:</th>
                            <th>Customer Email:</th>
                            <th>Invoice No:</th>
                            <th>Product Id:</th>
                            <th>Product Qty:</th>
                            <th>Product Size:</th>
                            <th>Status:</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        $i = 0;

                        $query = "select * from onlinestore.pending_orders order by 1 desc limit 0,5";
                        $runQuery = mysqli_query($connection,$query);

                        while ($row = mysqli_fetch_array($runQuery)){

                            $orderId = $row['order_id'];
                            $customerId = $row['customer_id'];
                            $productId = $row['product_id'];
                            $invoiceNumber = $row['invoice_number'];
                            $qty = $row['qty'];
                            $size = $row['size'];
                            $orderStatus = $row['order_status'];

                            $i++;

                            ?>


                        <tr>
                            <td><?php echo $i ?></td>
                            <td>
                                <?php

                                $Cquery = "select * from onlinestore.customers where customer_id = $customerId";
                                $CrunQuery = mysqli_query($connection,$Cquery);
                                $Crow = mysqli_fetch_array($CrunQuery);
                                $customerEmail = $Crow['customer_email'];

                             echo  $customerEmail

                                ?>
                            </td>
                            <td><?php echo $invoiceNumber?></td>
                            <td><?php echo $productId ?></td>
                            <td><?php echo $qty ?></td>
                            <td><?php echo $size ?></td>
                            <td><?php echo $orderStatus ?></td>
                        </tr>

                            <?php
                        }

                        ?>

                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="index.php?viewOrders">View All Orders&nbsp;<i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-body">
                <div class="thumb-info mb-md">
                    <img src="adminImages/<?php echo $adminImage?>" alt="AdminImg" class="rounded img-responsive">
                    <div class="thumb-info-title">
                        <span class="thumb-info-inner"> <?php echo $adminName?></span>
                        <span class="thumb-info-type"> <?php echo $adminJob?></span>
                    </div>
                </div>
                <div class="mb-md">
                    <div class="widget-content-expanded">
                        <i class="fas fa-user-alt"></i>&nbsp;<span>Email:</span>&nbsp;<?php echo $adminEmail?>&nbsp;<br>
                        <i class="fas fa-user-alt"></i>&nbsp;<span>Country:</span>&nbsp;<?php echo $adminCountry?>&nbsp;<br>
                        <i class="fas fa-user-alt"></i>&nbsp;<span>Contact:</span>&nbsp;<?php echo $adminContact?>&nbsp;<br>
                    </div>
                    <hr class="dotted short">
                    <h5 class="text-muted">About</h5>
                    <p align="justify"><?php echo $adminAbout?></p>
                </div>
            </div>
        </div>
    </div>
    
</div>

<?php } ?>