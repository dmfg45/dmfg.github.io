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
                    &nbsp;Dashboard&nbsp;/&nbsp;View Bundles
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill"></i>&nbsp;View Bundles
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-stripped">
                            <thead>
                            <tr>
                                <th>Bundles Id</th>
                                <th>Bundles Title</th>
                                <th>Bundles Image</th>
                                <th>Bundles Price</th>
                                <th>Bundles Sold</th>
                                <th>Bundles Keywords</th>
                                <th>Bundles Date</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php

                            $i = 0;

                            $query = "select * from onlinestore.products where status = 'bundle'";
                            $runQuery = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_array($runQuery)) {
                                $productId = $row['product_id'];
                                $productTitle = $row['product_title'];
                                $productImage = $row['product_img1'];
                                $productPrice = $row['product_price'];
                                $productKeywords = $row['product_keywords'];
                                $productDate = $row['prod_date'];

                                $i++;

                                ?>

                                <tr>

                                    <td><?php echo $i ?></td>
                                    <td><?php echo $productTitle ?></td>
                                    <td><img width="50" height="50" src="productImages/<?php echo $productImage ?>"
                                             alt="ProdImg"></td>
                                    <td><?php echo $productPrice ?>&nbsp;&euro;</td>
                                    <td>
                                        <?php
                                        $orderSold = 0;
                                        $getOrderItems = "select * from onlinestore.orders_items where product_id = $productId";
                                        $orderItemsQuery = mysqli_query($connection, $getOrderItems);
                                        while ($orderItemsRow = mysqli_fetch_array($orderItemsQuery)) {
                                            $qty = $orderItemsRow['qty'];
                                            $orderSold += $qty;
                                        }

                                        echo $orderSold

                                        ?>
                                    </td>
                                    <td><?php echo $productKeywords ?></td>
                                    <td><?php echo $productDate ?></td>
                                    <td><a href="index.php?deleteBundle=<?php echo $productId ?>"><i
                                                    class="fas fa-times-circle fa-2x"></i></a></td>
                                    <td><a href="index.php?editBundle=<?php echo $productId ?>"><i
                                                    class="fas fa-edit fa-2x"></i></a></td>
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