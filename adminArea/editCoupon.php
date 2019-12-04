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
                <li><i class="fas fa-tachometer-alt"></i> Dashboard / Edit Coupon</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;<i class="fas fa-money-bill-alt"></i>&nbsp;Edit Coupon</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <?php

                        if (isset($_GET['editCoupon'])) {
                            $couponId = $_GET['editCoupon'];

                            $editQuery = "select * from onlinestore.coupons where coupon_id = $couponId";
                            $runQuery = mysqli_query($connection, $editQuery);

                            $couponsRow = mysqli_fetch_array($runQuery);
                            $couponTitle = $couponsRow['coupon_title'];
                            $couponProduct = $couponsRow['product_id'];
                            $couponPrice = $couponsRow['coupon_price'];
                            $couponLimit = $couponsRow['coupon_limit'];
                        }


                        ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Coupon Title:</label>
                            <div class="col-md-6">
                                <input type="text" name="couponTitle" class="form-control" value="<?php echo $couponTitle ?>">
                            </div>
                        </div>
                        <div class="form-group">

                            <label class="col-md-3 control-label" for="">Product Associated:</label>
                            <div class="col-md-6">
                                <select name="couponProduct" id="">
                                    <?php

                                    $getProducts = "select * from onlinestore.products where product_id = $couponProduct";
                                    $productQuery = mysqli_query($connection, $getProducts);

                                    while ($productRow = mysqli_fetch_array($productQuery)) {
                                        $productId = $productRow['product_id'];
                                        $productTitle = $productRow['product_title'];
                                        ?>
                                        <option value="<?php echo $productId ?>">
                                            <?php echo $productTitle ?>
                                        </option>
                                    <?php } ?>
                                    <optgroup label="Products"></optgroup>
                                  <?php

                                    $getProducts = "select * from onlinestore.products where product_id != $couponProduct and status = 'product'";
                                    $productQuery = mysqli_query($connection, $getProducts);

                                    while ($productRow = mysqli_fetch_array($productQuery)) {
                                        $productId = $productRow['product_id'];
                                        $productTitle = $productRow['product_title'];
                                        ?>

                                        <option value="<?php echo $productId ?>">
                                            <?php echo $productTitle ?>
                                        </option>
                                    <?php } ?>
                                    <optgroup label="Bundles"></optgroup>
                                 <?php

                                    $getProducts = "select * from onlinestore.products where product_id != $couponProduct and status = 'bundle'";
                                    $productQuery = mysqli_query($connection, $getProducts);

                                    while ($productRow = mysqli_fetch_array($productQuery)) {
                                        $productId = $productRow['product_id'];
                                        $productTitle = $productRow['product_title'];
                                        ?>

                                        <option value="<?php echo $productId ?>">
                                            <?php echo $productTitle ?>
                                        </option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Coupon Price:</label>
                            <div class="col-md-6">
                                <input type="text" name="couponPrice" class="form-control" value="<?php echo $couponPrice ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Coupon Limit:</label>
                            <div class="col-md-6">
                                <input type="text" name="couponLimit" class="form-control" value="<?php echo $couponLimit ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for=""></label>
                            <div class="col-md-6">
                                <input type="submit" name="update" class="btn btn-primary form-control" value="Update">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['update'])) {
        $couponProduct = $_POST['couponProduct'];
        $couponTitle = $_POST['couponTitle'];
        $couponPrice = $_POST['couponPrice'];
        $couponLimit = $_POST['couponLimit'];

            $updateCoupon = "update onlinestore.coupons set product_id = $couponProduct, coupon_title = '$couponTitle', coupon_price = '$couponPrice', coupon_limit = $couponLimit where coupon_id = $couponId ";
            $couponQuery = mysqli_query($connection, $updateCoupon);

            if ($couponQuery) {
                ?>
                <script>
                    alert("The Coupon was Successfully Updated");
                    window.open("index.php?viewCoupons", "_self");
                </script>
                <?php
            } else {
                die("Something went wrong: => " . mysqli_error($connection));
            }


        }

?>


    <?php

}
