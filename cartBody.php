<?php
session_start();
?>
<?php include 'includes/db.php' ?>
<?php include 'functions/functions.php' ?>

<body>

<?php include 'includes/top.php' ?>

<?php include "includes/navbar.php"; ?>

<div id="content"><!-- content -->
    <div class="container"><!-- container -->
        <div class="col-md-12"><!-- col-md-12 -->
            <ul class="breadcrumb"><!-- breadcrumb -->
                <li><a href="index.php">Home</a></li>
                <li>Cart</li>
            </ul><!-- /breadcrumb -->
        </div><!-- /col-md-12 -->

        <div class="col-md-9" id="cart"><!-- cart -->
            <div class="box"><!-- box -->
                <form action="cart.php" method="post" enctype="multipart/form-data"><!-- form -->
                    <h1>Shopping Cart</h1>
                    <p class="text-muted">
                        You currently have <?php cartItems() ?>
                    </p>
                    <div class="table-responsive"><!-- table-responsive -->
                        <table class="table"><!-- table -->
                            <thead><!-- thead -->
                            <tr>
                                <th colspan="2">Product</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Size</th>
                                <th colspan="1">Delete</th>
                                <th colspan="2">Sub Total</th>
                            </tr>
                            </thead><!-- /thead -->
                            <tbody><!-- tbody -->

                            <?php
                            $ipAdd = getUserIpAddress();
                            $total = 0;
                            $subTotal = 0;
                            $cart = "SELECT * FROM cart WHERE ip_add = '$ipAdd'";

                            $query = mysqli_query($connection, $cart);

                            while ($row = mysqli_fetch_array($query)) {
                                $productId = $row['p_id'];
                                $productSize = $row['p_size'];
                                $product_Qty = $row['qty'];
                                $productPrice = $row['p_price'];

                                $products = "SELECT * FROM products WHERE product_id = $productId";

                                $pQuery = mysqli_query($connection, $products);

                                while ($prod_row = mysqli_fetch_array($pQuery)) {
                                    $productTitle = $prod_row['product_title'];
                                    $productImg = $prod_row['product_img1'];
                                    $subTotal = $productPrice * $product_Qty;
                                    $_SESSION['product_Qty'] = $product_Qty;
                                    $total += $subTotal;

                                    ?>

                                    <tr>
                                        <td><img src="adminArea/productImages/<?php echo $productImg ?>" alt=""></td>
                                        <td><a href="#"><?php echo $productTitle ?></a></td>
                                        <td><input type="text" name="qty" value="<?php echo $_SESSION['product_Qty'] ?>"
                                                   data-product_id="<?php echo $productId ?>" class="qty form-control">
                                        </td>
                                        <td>&euro;&nbsp;<?php echo $productPrice ?></td>
                                        <td><?php echo $productSize ?></td>
                                        <td><input type="checkbox" name="remove[]" value="<?php echo $productId ?>">
                                        </td>
                                        <td>&euro;&nbsp;<?php echo $subTotal ?></td>
                                    </tr>

                                    <?php
                                }
                            }

                            ?>
                            </tbody><!-- /tbody -->
                            <tfoot><!-- tfoot -->
                            <tr>
                                <th colspan="5">Total</th>
                                <th colspan="2">&euro;&nbsp;<?php echo $total ?>.00</th>
                            </tr>
                            </tfoot><!-- /tfoot -->
                        </table><!-- /table -->
                        <div class="form-inline pull-right">
                            <div class="form-group">
                                <label for="">Coupon Code</label>
                                <input type="text" name="couponCode" class="form-control">
                            </div>
                            <input type="submit" class="btn btn-primary" name="applyCoupon" value="Apply Coupon Code">
                        </div>
                    </div><!-- /table-responsive -->
                    <div class="box-footer"><!-- box-footer -->
                        <div class="pull-left">
                            <a href="index.php" class="btn btn-default">
                                <i class="fas fa-chevron-left"></i>&nbsp;Continue Shopping
                            </a>
                        </div>
                        <div class="pull-right">
                            <button class="btn btn-default" type="submit" name="update" value="Update Cart">
                                <i class="fas fa-sync-alt"></i>&nbsp;Update Cart
                            </button>
                            <a href="checkout.php" class="btn btn-primary">
                                Proceed to checkout <i class="fas fa-chevron-right"></i>
                            </a>
                        </div>
                    </div><!-- /box-footer -->
                </form><!-- /form -->
            </div><!-- /box -->

            <?php

            if (isset($_POST['applyCoupon'])) {
                $code = $_POST['couponCode'];
                if ($code !== '') {
                    $getCoupon = "select * from onlinestore.coupons where coupon_code = '$code'";
                    $couponQuery = mysqli_query($connection, $getCoupon);
                    $checkCoupons = mysqli_num_rows($couponQuery);

                    if ($checkCoupons == 1) {
                        $couponsRow = mysqli_fetch_array($couponQuery);
                        $couponProduct = $couponsRow['product_id'];
                        $couponPrice = $couponsRow['coupon_price'];
                        $couponLimit = $couponsRow['coupon_limit'];
                        $couponUsed = $couponsRow['coupon_used'];
                    if ($couponLimit == $couponUsed) {
                        ?>
                        <script>alert("You Coupon Has been Expired")</script>
                    <?php
                    }else{
                    $getCart = "select * from onlinestore.cart where p_id = $couponProduct and ip_add = '$ipAdd'";
                    $cartQuery = mysqli_query($connection, $getCart);
                    $checkCart = mysqli_num_rows($cartQuery);
                    if ($checkCart == 1){
                    $addUsed = "update onlinestore.coupons set coupon_used = coupon_used+1 where coupon_code = '$code'";
                    $usedQuery = mysqli_query($connection, $addUsed);

                    $update_cart = "update onlinestore.cart set p_price='$couponPrice' where p_id = $couponProduct and ip_add = '$ipAdd'";
                    $upCartQuery = mysqli_query($connection,$update_cart);
                    ?>
                        <script>
                            alert("Your Coupon has been Accepted and Applied");
                            window.open("cart.php","_self")
                        </script>
                    <?php

                    }else{
                    ?>
                        <script>alert("Product does not Exist in Cart")</script>
                    <?php
                    }
                    }
                    }else{
                    ?>
                        <script>alert("Your Coupon it is not Valid")</script>
                        <?php
                    }

                } else {

                }
            }

            ?>

            <?php
            function updateCart()
            {
                global $connection;
                if (isset($_POST['update'])) {
                    foreach ($_POST['remove'] as $removeItem) {
                        $deleteProd = "DELETE FROM cart WHERE p_id=$removeItem";

                        $query = mysqli_query($connection, $deleteProd);

                        if ($query) {
                            ?>

                            <script>window.open("cart.php", "_self")</script>

                            <?php
                        }
                    }
                }
            }

            echo $updateCart = updateCart();
            ?>

            <div id="row same-height-row"><!-- row -->
                <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 -->
                    <div class="box same-height headline"><!-- box same-height headline -->
                        <h3>You also liked these Products</h3>
                    </div><!-- /box same-height headline -->
                </div><!-- /col-md-3 col-sm-6 -->
                <?php

                $productsTable = "SELECT * FROM products ORDER BY rand() DESC LIMIT 0,3";

                $productQuery = mysqli_query($connection, $productsTable);

                while ($productRow = mysqli_fetch_array($productQuery)) {
                    $productId = $productRow['product_id'];
                    $productTitle = $productRow['product_title'];
                    $productImg1 = $productRow['product_img1'];
                    $productPrice = $productRow['product_price'];
                    $product_Label = $productRow['product_label'];
                    $productPspPrice = $productRow['product_psp_price'];
                    $manufacturerId = $productRow['manufacturer_id'];

                    $getMnaufacturer = "select * from onlinestore.manufacturers where manufacturer_id = $manufacturerId";

                    $runQuery = mysqli_query($connection, $getMnaufacturer);

                    $rowManufacturer = mysqli_fetch_array($runQuery);

                    $manufacturerName = $rowManufacturer['manufacturer_title'];

                    if ($product_Label == "Sale" || $product_Label == "Gift") {

                        $product_Price = "<del>&euro;&nbsp;$productPrice </del>";

                        $productPspPrice = "| &euro;&nbsp;$productPspPrice ";

                    } else {

                        $productPspPrice = "";

                        $product_Price = "&euro;&nbsp;$productPrice";

                    }
                    ?>

                    <div class="col-md-3 col-sm-6 center-responsive">
                        <div class="product same-height">
                            <a href="details.php?pro_id=<?php echo $productId ?>"><img
                                        src="adminArea/productImages/<?php echo $productImg1 ?>" alt=""
                                        class="img-responsive"></a>
                            <div class="text">
                                <div class="text-center">
                                    <p class="btn btn-primary"><?php echo $manufacturerName ?></p>
                                </div>
                                <h3>
                                    <a href="details.php?pro_id=<?php echo $productId ?> "><?php echo $productTitle ?></a>
                                </h3>
                                <p class="price"><?php echo $product_Price, $productPspPrice ?></p>
                            </div>
                        </div>
                        <?php

                        if ($product_Label == "") {

                        } else { ?>
                            <a href="#" class="label sale" style="color: black">
                                <div class="theLabel"><?php echo $product_Label ?></div>
                                <div class="label-background"></div>
                            </a>
                            <?php
                        }

                        ?>
                    </div>

                    <?php

                }
                ?>
            </div><!-- /row -->

        </div><!-- /cart -->

        <div class="col-md-3"><!-- col-md-3 -->
            <div class="box" id="order-summary"><!-- box -->
                <div class="box-header"><!-- box-header -->
                    <h3>Order Summary</h3>
                </div><!-- /box-header -->
                <p class="text-muted">
                    Shipping and additional costs are calculated based on the values you have entered
                </p>
                <div class="table-responsive"><!-- table-responsive -->
                    <table class="table"><!-- table -->
                        <tbody><!-- tbody -->
                        <tr>
                            <td>Order Subtotal</td>
                            <th>&euro;&nbsp;<?php echo $subTotal ?></th>
                        </tr>
                        <tr>
                            <td>Shipping and handling</td>
                            <th>&euro;0</th>
                        </tr>
                        <tr>
                            <td>Tax</td>
                            <th>&euro;0</th>
                        </tr>
                        <tr class="total">
                            <td>Total</td>
                            <th>&euro;&nbsp;<?php echo $total ?>.00</th>
                        </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /table-responsive -->
            </div><!-- /box -->
        </div><!-- /col-md-3 -->


    </div><!-- /container -->
</div><!-- /content -->

<?php include "includes/footer.php" ?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function (data) {
        $(document).on('keyup', '.qty', function () {
            let id = $(this).data("product_id");
            let quantity = $(this).val();
            if (quantity !== '') {
                $.ajax({
                    url: "change.php",
                    method: "POST",
                    data: {
                        id: id,
                        qty: quantity
                    },
                    success: (data) => {
                        return $("body").load('cartBody.php');
                    }
                });
            }
        });
    });
</script>

</body>