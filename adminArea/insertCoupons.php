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
                <li><i class="fas fa-tachometer-alt"></i> Dashboard / Insert Coupon</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;<i class="fas fa-money-bill-alt"></i>&nbsp;Insert Coupon</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Coupon Title:</label>
                            <div class="col-md-6">
                                <input type="text" name="couponTitle" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">

                            <label class="col-md-3 control-label" for="">Product Associated:</label>
                            <div class="col-md-6">
                                <select name="couponProduct" id="" class="form-control">
                                    <option>Select Product or Bundle Associated</option>
                                    <optgroup label="Products"></optgroup>
                                    <?php

                                    $getProducts = "select * from onlinestore.products where status = 'product'";
                                    $productQuery = mysqli_query($connection, $getProducts);

                                    while ($productRow = mysqli_fetch_array($productQuery)) {
                                        $productId = $productRow['product_id'];
                                        $productTitle = $productRow['product_title'];
                                        $productImage = $productRow['product_img1'];
                                        ?>
                                        <option value="<?php echo $productId ?>">
                                            <?php echo $productTitle ?>
                                        </option>
                                    <?php } ?>

                                    <optgroup label="Bundles"></optgroup>
                                    <?php

                                    $getProducts = "select * from onlinestore.products where status = 'bundle'";
                                    $productQuery = mysqli_query($connection, $getProducts);

                                    while ($productRow = mysqli_fetch_array($productQuery)) {
                                        $productId = $productRow['product_id'];
                                        $productTitle = $productRow['product_title'];
                                        $productImage = $productRow['product_img1'];
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
                                <input type="text" name="couponPrice" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Coupon Limit:</label>
                            <div class="col-md-6">
                                <input type="text" name="couponLimit" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
                            $code = md5(substr(str_shuffle($permitted_chars), 0, 10));
                            ?>
                            <label class="col-md-3 control-label" for="">Coupon Code:</label>
                            <div class="col-md-6">
                                <input type="text" name="couponCode" class="form-control" value="<?php echo $code ?>"
                                       disabled="disabled">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for=""></label>
                            <div class="col-md-6">
                                <input type="submit" name="insert" class="btn btn-primary form-control" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['insert'])) {
        $couponProduct = $_POST['couponProduct'];
        $couponTitle = $_POST['couponTitle'];
        $couponPrice = $_POST['couponPrice'];
        $couponLimit = $_POST['couponLimit'];
        $couponCode = $code;
        $couponUsed = 0;

        $getCoupons = "select * from onlinestore.coupons where product_id = $productId";
        $getCouponsQuery = mysqli_query($connection, $getCoupons);
        $countCoupons = mysqli_num_rows($getCouponsQuery);

        if ($countCoupons == 1) {
            ?>
            <script>alert("This coupon has been already been Added to this product")</script>
            <?php
        } else {
            $insertCoupon = "insert into onlinestore.coupons(
                                product_id,
                                coupon_title,
                                coupon_price,
                                coupon_code,
                                coupon_limit,
                                coupon_used)
                                VALUES (
                                        $couponProduct,
                                        '$couponTitle',
                                        '$couponPrice',
                                        '$couponCode',
                                        $couponLimit,
                                        $couponUsed
                                        )";

            $query = mysqli_query($connection, $insertCoupon);

            if ($query) {
                ?>
                <script>
                    alert("The Coupon was Successfully Added");
                    window.open("index.php?viewCoupons", "_self");
                </script>
                <?php
            } else {
                die("Something went wrong: => " . mysqli_error($connection));
            }


        }


    }


    ?>

    <?php

}


