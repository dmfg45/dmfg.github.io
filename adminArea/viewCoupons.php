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
                    &nbsp;Dashboard&nbsp;/&nbsp;View&nbsp;Coupons
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill"></i>&nbsp;View Coupons
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-stripped">
                            <thead>
                            <tr>
                                <th>Coupon No</th>
                                <th>Coupon Title</th>
                                <th>Product Associated</th>
                                <th>Coupon Price</th>
                                <th>Coupon Code</th>
                                <th>Product Limit</th>
                                <th>Product Used</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php

                            $i = 0;

                            $getCoupons = "select * from onlinestore.coupons";
                            $couponQuery = mysqli_query($connection, $getCoupons);

                            while ($couponRow = mysqli_fetch_array($couponQuery)) {
                                $couponId = $couponRow['coupon_id'];
                                $couponProduct = $couponRow['product_id'];
                                $couponTitle = $couponRow['coupon_title'];
                                $couponPrice = $couponRow['coupon_price'];
                                $couponCode = $couponRow['coupon_code'];
                                $couponLimit = $couponRow['coupon_limit'];
                                $couponUsed = $couponRow['coupon_used'];

                                $i++;

                                ?>

                                <tr>

                                    <td><?php echo $i ?></td>
                                    <?php

                                    $query = "select * from onlinestore.products where product_id = $couponProduct";
                                    $runCustomerQuery = mysqli_query($connection, $query);
                                    $rowCustomer = mysqli_fetch_array($runCustomerQuery);
                                    $productTitle = $rowCustomer['product_title'];
                                    $productImage = $rowCustomer['product_img1'];


                                    ?>
                                    <td><?php echo $couponTitle ?></td>
                                    <td class="text-center"><?php echo $productTitle ?><br><br><img
                                                src="productImages/<?php echo $productImage ?>" alt="" width="75" height="75"></td>
                                    <td>&euro;&nbsp;<?php echo $couponPrice ?></td>
                                    <td><?php echo $couponCode ?></td>
                                    <td><?php echo $couponLimit ?></td>
                                    <td><?php echo $couponUsed ?></td>

                                    <td><a href="index.php?editCoupon=<?php echo $couponId ?>"><i
                                                    class="fas fa-edit fa-2x"></i></a></td>
                                    <td><a href="index.php?deleteCoupon=<?php echo $couponId ?>"><i
                                                    class="fas fa-times-circle fa-2x"></i></a></td>
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


    <?php

}


