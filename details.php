<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 20/11/2018
 * Time: 19:12
 */
session_start();
?>
<?php include 'includes/db.php' ?>
<?php include 'functions/functions.php' ?>

<?php
$productId = $_GET['pro_id'];
$getProducts = "SELECT * FROM onlinestore.products WHERE product_url = '$productId'";
$productQuery = mysqli_query($connection, $getProducts);
$checkProduct = mysqli_num_rows($productQuery);
if ($checkProduct == 0) {
    echo mysqli_error($connection)
    ?>
    <!--    <script>window.open("index.php", "_self")</script>-->
    <?php
} else { ?>
    <?php


    $row_products = mysqli_fetch_array($productQuery);
    $productCatId = $row_products['p_cat_id'];
    $product_id = $row_products['product_id'];
    $productTitle = $row_products['product_title'];
    $productPrice = $row_products['product_price'];
    $productDesc = $row_products['product_description'];
    $productImg1 = $row_products['product_img1'];
    $productImg2 = $row_products['product_img2'];
    $productImg3 = $row_products['product_img3'];
    $productLabel = $row_products['product_label'];

    $prodCategories = "SELECT * FROM onlinestore.product_categories WHERE p_cat_id = $productCatId";
    $pCatquery = mysqli_query($connection, $prodCategories);
    $pCatrow = mysqli_fetch_array($pCatquery);
    $prodCatTitle = $pCatrow['p_cat_title'];

    $productPspPrice = $row_products['product_psp_price'];
    $productFeatures = $row_products['product_features'];
    $productVideo = $row_products['product_video'];
    $productKeywords = $row_products['product_keywords'];
    $product_seo_desc = $row_products['product_seo_desc'];
    $product_type = $row_products['product_type'];
    $product_weight = $row_products['product_weight'];
    $status = $row_products['status'];
    $proUrl = $row_products['product_url'];

    if ($productLabel == "Sale" || $productLabel == "Gift") {

        $product_Price = "<del>&euro;&nbsp;$productPrice </del>";

        $productPspPrice = "| &euro;&nbsp;$productPspPrice ";

    } else {

        $productPspPrice = "";

        $product_Price = "&euro;&nbsp;$productPrice";

    }


    ?>
    <!doctype html>
    <html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo $productTitle ?></title>
        <meta name="description" content="<?php echo $product_seo_desc ?>">
        <meta name="keywords" content="<?php echo $productKeywords ?>">
        <meta name="author" content="André Graça">
        <link rel="stylesheet" href="styles/bootstrap.min.css">
        <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
        <link rel="stylesheet" href="styles/styles.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
              integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
              crossorigin="anonymous">

    </head>
    <body>

    <?php include 'includes/top.php' ?>

    <?php include "includes/navbar.php"; ?>

    <div id="content"><!-- content -->
        <div class="container"><!-- container -->
            <div class="col-md-12"><!-- col-md-12 -->
                <ul class="breadcrumb"><!-- breadcrumb -->

                    <li><a href="index.php">Home</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="shop.php?p_cat=<?php echo $productCatId ?>"><?php echo $prodCatTitle ?></a></li>
                    <li><?php echo $productTitle ?></li>
                </ul><!-- /breadcrumb -->
            </div><!-- /col-md-12 -->

            <div class="col-md-12"><!-- col-md-12 -->
                <div class="row" id="productMain"><!-- row -->
                    <div class="col-sm-6"><!-- col-sm-6 -->
                        <div id="mainImage"><!-- mainImage -->
                            <div id="myCarousel" class="carousel slide" data-ride="carousel"><!-- carousel -->
                                <ol class="carousel-indicators">
                                    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#myCarousel" data-slide-to="1"></li>
                                    <li data-target="#myCarousel" data-slide-to="2"></li>
                                </ol>
                                <div class="carousel-inner"><!-- carousel-inner -->
                                    <div class="item active text-center">
                                        <img src="adminArea/productImages/<?php echo $productImg1 ?>" alt=""
                                             class="img-responsive">
                                    </div>
                                    <div class="item text-center">
                                        <img src="adminArea/productImages/<?php echo $productImg2 ?>" alt=""
                                             class="img-responsive">
                                    </div>
                                    <div class="item text-center">
                                        <img src="adminArea/productImages/<?php echo $productImg3 ?>" alt=""
                                             class="img-responsive">
                                    </div>
                                </div><!-- /carousel-inner -->

                                <a href="#myCarousel" class="left carousel-control" data-slide="prev">
                                    <!-- left carousel-control -->
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                    <span class="sr-only"> Previous </span>
                                </a><!-- /left carousel-control -->
                                <a href="#myCarousel" class="right carousel-control" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <span class="sr-only"> Next </span>
                                </a>
                            </div><!-- /carousel -->
                        </div><!-- /mainImage -->
                        <?php

                        if ($productLabel == "") {

                        } else { ?>
                            <a href="#" class="label sale" style="color: black">
                                <div class="theLabel"><?php echo $productLabel ?></div>
                                <div class="label-background"></div>
                            </a>
                            <?php
                        }

                        ?>

                    </div><!-- /col-sm-6 -->
                    <div class="col-sm-6"><!-- col-sm-6 -->
                        <div class="box"><!-- box -->
                            <h1 class="text-center"><?php echo $productTitle ?></h1>
                            <?php

                            if (isset($_POST['addCart'])) {
                                $ipAdd = getUserIpAddress();

                                $productId = $product_id;
                                $productQty = $_POST['product_qty'];
                                $productSize = $_POST['product_size'];

                                $checkProduct = "SELECT * FROM onlinestore.cart WHERE ip_add = '$ipAdd' AND p_id = '$productId'";
                                $p_query = mysqli_query($connection, $checkProduct);

                                if (mysqli_num_rows($p_query) > 0) {
                                    ?>

                                    <script>alert("This product is already added in cart")</script>
                                    <script>window.open("<?php echo $proUrl ?>", "_self")</script>
                                <?php

                                } else {

                                $getPrice = "select * from onlinestore.products where product_id = '$productId'";
                                $priceQuery = mysqli_query($connection, $getPrice);
                                $priceRow = mysqli_fetch_array($priceQuery);
                                $prodPrice = $priceRow['product_price'];
                                $prodPSPPrice = $priceRow['product_psp_price'];
                                $prodLabel = $priceRow['product_label'];

                                if ($prodLabel == "Sale" or $prodLabel == "Gift") {
                                    $productPrice = $prodPSPPrice;
                                    strval($productPrice);
                                } else {
                                    $productPrice = $prodPrice;
                                    strval($productPrice);
                                }

                                $insertCart = "INSERT INTO 
                                            onlinestore.cart (        p_id,
                                                          ip_add,
                                                          qty,
                                                          p_size,
                                                          p_price) 
                                                          VALUES (
                                                                  $productId,
                                                                  '$ipAdd',
                                                                  $productQty,
                                                                  '$productSize',
                                                                  '$productPrice')";

                                $query = mysqli_query($connection, $insertCart);

                                confirmResult($query);

                                ?>

                                    <script>window.open("<?php echo $proUrl ?>", "_self")</script>

                                    <?php


                                }
                            }
                            ?>
                            <form action="" method="post" class="form-horizontal"><!-- form-horizontal -->
                                <?php
                                if ($status == "product") {


                                    ?>

                                    <div class="form-group"><!-- form-group -->
                                        <label for="" class="col-md-5 control-label">Product Quantity</label>
                                        <div class="col-md-7"><!-- col-md-7 -->
                                            <select name="product_qty" id="" class="form-control" required>
                                                <option value="">Select Quantity</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div><!-- /col-md-7 -->
                                    </div><!-- /form-group -->
                                    <?php if ($product_type == "physicalProduct"){ ?>
                                    <div class="form-group"><!-- form-group -->
                                        <label for="" class="col-md-5 control-label">Product Size</label>
                                        <div class="col-md-7"><!-- /col-md-7 -->
                                            <select name="product_size" id="" class="form-control" required>
                                                <option value="">Select a Size</option>
                                                <option>Small</option>
                                                <option>Medium</option>
                                                <option>Large</option>
                                                <option>Extra Large</option>
                                            </select>
                                        </div><!-- /col-md-7 -->
                                    </div><!-- /form-group -->
                                    <?php } elseif ($product_type == "digitalProduct"){ ?>
                                        <input type="hidden" name="product_size" value="None">
                                    <?php } ?>
                                    <?php
                                } else { ?>

                                    <div class="form-group"><!-- form-group -->
                                        <label for="" class="col-md-5 control-label">Bundle Quantity</label>
                                        <div class="col-md-7"><!-- col-md-7 -->
                                            <select name="product_qty" id="" class="form-control">
                                                <option value="">Select a Quantity</option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                                <option>5</option>
                                            </select>
                                        </div><!-- /col-md-7 -->
                                    </div><!-- /form-group -->
                                <?php if ($product_type == "physicalProduct"){ ?>
                                    <div class="form-group"><!-- form-group -->
                                        <label for="" class="col-md-5 control-label">Bundle Size</label>
                                        <div class="col-md-7"><!-- /col-md-7 -->
                                            <select name="product_size" id="" class="form-control">
                                                <option>Select a Size</option>
                                                <option>Small</option>
                                                <option>Medium</option>
                                                <option>Large</option>
                                                <option>Extra Large</option>
                                            </select>
                                        </div><!-- /col-md-7 -->
                                    </div><!-- /form-group -->
                                    <?php } elseif ($product_type == "digitalProduct"){ ?>
                                        <input type="hidden" name="product_size" value="None">
                                    <?php } ?>
                                <?php } ?>
                                <div class="text-center">
                                    <?php
                                    $getIcons = "select * from onlinestore.icons where icon_product = $product_id";
                                    $iconQuery = mysqli_query($connection, $getIcons);

                                    while ($iconsRow = mysqli_fetch_array($iconQuery)) {
                                        $iconImage = $iconsRow['icon_img'];
                                        ?>

                                        <img src="adminArea/iconImages/<?php echo $iconImage ?>" alt="icoImg" width="45"
                                             height="45">&nbsp;&nbsp;

                                        <?php
                                    }

                                    ?>
                                </div>
                                <?php
                                if ($status == "product") { ?>
                                    <p class="price">Product
                                        Price:&nbsp;<?php echo $product_Price, $productPspPrice ?></p>
                                <?php } else { ?>
                                    <p class="price">Bundle
                                        Price:&nbsp;<?php echo $product_Price, $productPspPrice ?></p>
                                <?php } ?>
                                <p class="text-center buttons">
                                    <button class="btn btn-primary" type="submit" name="addCart">
                                        <i class="fas fa-shopping-cart"></i>&nbsp;Add to Cart
                                    </button>
                                    <button class="btn btn-primary" type="submit" name="addtoWish">
                                        <i class="fas fa-heartbeat"></i>&nbsp;Add to Wishlist
                                    </button>
                                    <?php
                                    if (isset($_POST['addtoWish'])) {
                                        if (!isset($_SESSION['customer_email'])) {
                                            ?>
                                            <script>alert("You must Login to add a Product to Wishlist")</script>
                                            <script>window.open("checkout.php", "_self")</script>
                                        <?php
                                        }else{
                                        $customerSession = $_SESSION['customer_email'];

                                        $getCustomer = "select * from onlinestore.customers where customer_email = '$customerSession'";
                                        $customerQuery = mysqli_query($connection, $getCustomer);
                                        $customerRow = mysqli_fetch_array($customerQuery);
                                        $customerId = $customerRow['customer_id'];

                                        $selectWishlist = "select * from onlinestore.wishlist where customer_id = $customerId and product_id = $product_id";
                                        $wishQuery = mysqli_query($connection, $selectWishlist);
                                        $checkhWish = mysqli_num_rows($wishQuery);

                                        if ($checkhWish == 1){
                                        ?>
                                            <script>alert("This Product has been already added in the wishlist")</script>
                                            <script>window.open("<?php echo $proUrl ?>", "_self")</script>
                                            <?php
                                        }
                                        else {
                                            $insertWish = "insert into onlinestore.wishlist (
                                                                                    customer_id,
                                                                                    product_id) 
                                                                                    VALUES (
                                                                                            $customerId,
                                                                                            $product_id)";
                                            $runWish = mysqli_query($connection,$insertWish);

                                            if ($runWish){
                                                ?>
                                            <script>alert("Product has been added to the Wishlist")</script>
                                            <script>window.open("<?php echo $proUrl ?>", "_self")</script>
                                            <?php
                                            }
                                        }
                                        }
                                    }
                                    ?>
                                </p>
                            </form><!-- /form-horizontal -->
                        </div><!-- /box -->

                        <div class="row" id="thumbs"><!-- row -->
                            <div class="col-xs-4"><!-- col-xs-4 -->
                                <a href="#" class="thumb">
                                    <img src="adminArea/productImages/<?php echo $productImg1 ?>" alt=""
                                         class="img-responsive">
                                </a>
                            </div><!-- /col-xs-4 -->

                            <div class="col-xs-4"><!-- col-xs-4 -->
                                <a href="#" class="thumb">
                                    <img src="adminArea/productImages/<?php echo $productImg2 ?>" alt=""
                                         class="img-responsive">
                                </a>
                            </div><!-- /col-xs-4 -->

                            <div class="col-xs-4"><!-- col-xs-4 -->
                                <a href="#" class="thumb">
                                    <img src="adminArea/productImages/<?php echo $productImg3 ?>" alt=""
                                         class="img-responsive">
                                </a>
                            </div><!-- /col-xs-4 -->
                        </div><!-- /row -->
                    </div><!-- /col-sm-6 -->
                </div><!-- /row -->
                <?php
                if ($status == "product") { ?>
                    <div class="box" id="details"><!-- box -->
                        <a href="#description" class="btn btn-primary tab" style="margin-bottom: 10px"
                           data-toggle="tab">
                            Product Description
                        </a>
                        <a href="#features" class="btn btn-primary tab" style="margin-bottom: 10px" data-toggle="tab">
                            Product Features
                        </a>
                        <a href="#video" class="btn btn-primary tab" style="margin-bottom: 10px" data-toggle="tab">
                            Product Sounds And Video
                        </a>
                        <hr style="margin-top: 0">
                        <div class="tab-content">
                            <div id="description" class="tab-pane fade in active" style="margin-top: 7px">
                                <?php echo $productDesc ?>
                            </div>
                            <div id="features" class="tab-pane fade in " style="margin-top: 7px">
                                <?php echo $productFeatures ?>
                            </div>
                            <div id="video" class="tab-pane fade in " style="margin-top: 7px">
                                <?php echo $productVideo ?>
                            </div>
                        </div>

                    </div><!-- /box -->
                <?php } else { ?>
                    <div class="box" id="details"><!-- box -->
                        <a href="#description" class="btn btn-primary tab" style="margin-bottom: 10px"
                           data-toggle="tab">
                            Bundle Description
                        </a>
                        <a href="#features" class="btn btn-primary tab" style="margin-bottom: 10px" data-toggle="tab">
                            Bundle Features
                        </a>
                        <a href="#video" class="btn btn-primary tab" style="margin-bottom: 10px" data-toggle="tab">
                            Bundle Sounds And Video
                        </a>
                        <hr style="margin-top: 0">
                        <div class="tab-content">
                            <div id="description" class="tab-pane fade in active" style="margin-top: 7px">
                                <?php echo $productDesc ?>
                            </div>
                            <div id="features" class="tab-pane fade in " style="margin-top: 7px">
                                <?php echo $productFeatures ?>
                            </div>
                            <div id="video" class="tab-pane fade in " style="margin-top: 7px">
                                <?php echo $productVideo ?>
                            </div>
                        </div>

                    </div><!-- /box -->
                <?php } ?>

                <div id="row same-height-row"><!-- row -->
                    <?php
                    if ($status == "product") {

                        ?>
                        <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 -->
                            <div class="box same-height headline"><!-- box same-height headline -->
                                <h3>You also liked these Products</h3>
                            </div><!-- /box same-height headline -->
                        </div><!-- /col-md-3 col-sm-6 -->

                        <?php

                        $products = "SELECT * FROM onlinestore.products where product_id != $product_id ORDER BY rand() LIMIT 0, 3";
                        $query = mysqli_query($connection, $products);

                        while ($row = mysqli_fetch_array($query)) {
                            $productId = $row['product_id'];
                            $productTitle = $row['product_title'];
                            $productPrice = $row['product_price'];
                            $product_Label = $row['product_label'];
                            $productPspPrice = $row['product_psp_price'];
                            $productImage = $row['product_img1'];
                            $productUrl = $row['product_url'];
                            $manufacturerId = $row['manufacturer_id'];

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
                                    <a href="<?php echo $productUrl ?>"><img
                                                src="adminArea/productImages/<?php echo $productImage ?>" alt=""
                                                class="img-responsive"></a>
                                    <div class="text">
                                        <div class="text-center">
                                            <p class="btn btn-primary"><?php echo $manufacturerName ?></p>
                                        </div>
                                        <h3>
                                            <a href="<?php echo $productUrl ?>"><?php echo $productTitle ?></a>
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

                        <?php

                    } else {
                        ?>

                        <div class="box same-height">
                            <h3 class="text-center"> Bundle Products </h3>
                        </div>

                        <?php

                        $getBundle = "select * from onlinestore.bundle_product_relations where bundle_id = $product_id";
                        $bundleQuery = mysqli_query($connection, $getBundle);

                        while ($bundleRow = mysqli_fetch_array($bundleQuery)) {
                            $bundleProductId = $bundleRow['product_id'];
                            $get_products = "select * from onlinestore.products where product_id = $bundleProductId";
                            $product_query = mysqli_query($connection, $get_products);

                            while ($productRow = mysqli_fetch_array($product_query)) {
                                $productId = $productRow['product_id'];
                                $productTitle = $productRow['product_title'];
                                $productPrice = $productRow['product_price'];
                                $product_Label = $productRow['product_label'];
                                $productPspPrice = $productRow['product_psp_price'];
                                $productImage = $productRow['product_img1'];
                                $productUrl = $productRow['product_url'];
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
                                        <a href="<?php echo $productUrl ?>"><img
                                                    src="adminArea/productImages/<?php echo $productImage ?>" alt=""
                                                    class="img-responsive"></a>
                                        <div class="text">
                                            <div class="text-center">
                                                <p class="btn btn-primary"><?php echo $manufacturerName ?></p>
                                            </div>
                                            <h3>
                                                <a href="<?php echo $productUrl ?>"><?php echo $productTitle ?></a>
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

                        };


                        ?>

                        <?php
                    }
                    ?>
                </div><!-- /row -->
            </div><!-- /col-md-9 -->


        </div><!-- /container -->
    </div><!-- /content -->

    <?php include "includes/footer.php" ?>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>
    </html>

    <?php
}