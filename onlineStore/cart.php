<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 30/11/2018
 * Time: 13:56
 */
session_start();
include_once 'includes/db.php';
include 'functions/functions.php';

?>

<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Store</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

</head>
<body>

<?php include 'includes/top.php' ?>

<?php include "includes/navbar.php";?>

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
                        You currently have <?php cartItems()?>
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

                            $query = mysqli_query($connection,$cart);

                            while ($row = mysqli_fetch_array($query)){
                                $productId = $row['p_id'];
                                $productSize = $row['p_size'];
                                $productQty = $row['qty'];

                                $products = "SELECT * FROM products WHERE product_id = $productId";

                                $pquery = mysqli_query($connection,$products);

                                while ($row = mysqli_fetch_array($pquery)){
                                    $productTitle = $row['product_title'];
                                    $productImg = $row['product_img1'];
                                    $productPrice = $row['product_price'];
                                    $subTotal = $row['product_price']*$productQty;
                                    $total += $subTotal;

                            ?>

                            <tr>
                                <td><img src="adminArea/productImages/<?php echo $productImg ?>" alt=""></td>
                                <td><a href="#"><?php echo $productTitle ?></a></td>
                                <td><?php echo $productQty ?></td>
                                <td>&euro;&nbsp;<?php echo $productPrice ?></td>
                                <td><?php echo $productSize ?></td>
                                <td><input type="checkbox" name="remove[]" value="<?php echo $productId ?>"></td>
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
            function updateCart(){
                global $connection;
                if (isset($_POST['update'])){
                    foreach ($_POST['remove'] as $removeItem){
                        $deleteProd = "DELETE FROM cart WHERE p_id=$removeItem";

                        $query = mysqli_query($connection,$deleteProd);

                        if ($query){
                            ?>

                            <script>window.open("cart.php", "_self")</script>

            <?php
                        }
                    }
                }
            }

            echo @$updateCart = updateCart();
            ?>

            <div id="row same-height-row"><!-- row -->
                <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 -->
                    <div class="box same-height headline"><!-- box same-height headline -->
                        <h3>You also liked these Products</h3>
                    </div><!-- /box same-height headline -->
                </div><!-- /col-md-3 col-sm-6 -->
                <?php

                $productsTable = "SELECT * FROM products ORDER BY rand() DESC LIMIT 0,3";

                $query = mysqli_query($connection, $productsTable);

                while ($row = mysqli_fetch_array($query)) {
                    $productID = $row['product_id'];
                    $productTitle = $row['product_title'];
                    $productImage = $row['product_img1'];
                    $productPrice = $row['product_price'];
                    ?>

                    <div class="center-responsive col-md-3 col-sm-6"><!-- center-responsive col-md-3 col-sm-6 -->
                        <div class="product same-height"><!-- product same-height -->
                            <a href="details.php">
                                <img src="adminArea/productImages/product.jpg" alt="" class="img-responsive">
                            </a>
                            <div class="text"><!-- text -->
                                <h3><a href="details.php"><?php
                                        echo $productTitle
                                        ?></a></h3>
                                <p class="price">&euro;&nbsp;<?php
                                    echo $productPrice
                                    ?></p>
                            </div><!-- /text -->
                        </div><!-- /product same-height -->
                    </div><!-- /center-responsive col-md-3 col-sm-6 -->

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

</body>
</html>