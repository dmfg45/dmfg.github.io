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

if (isset($_GET['pro_id'])){

    $productId = $_GET['pro_id'];
    $products = "SELECT * FROM products WHERE product_id = $productId";
    $query = mysqli_query($connection,$products);
    $row = mysqli_fetch_array($query);
    $productCatId = $row['p_cat_id'];
    $productTitle = $row['product_title'];
    $productPrice = $row['product_price'];
    $productDesc = $row['product_description'];
    $productImg1 = $row['product_img1'];
    $productImg2 = $row['product_img2'];
    $productImg3 = $row['product_img3'];

    $prodCategories = "SELECT * FROM product_categories WHERE p_cat_id = $productCatId";
    $query = mysqli_query($connection,$prodCategories);
    $row = mysqli_fetch_array($query);
    $prodCatTitle = $row['p_cat_title'];

}

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
                <li><a href="shop.php">Shop</a></li>
                <li><a href="shop.php?p_cat=<?php echo $productCatId ?>"><?php echo $prodCatTitle ?></a></li>
                <li><?php echo $productTitle ?></li>
            </ul><!-- /breadcrumb -->
        </div><!-- /col-md-12 -->

        <div class="col-md-3"><!-- col-md-3 -->
            <?php include "includes/sidebar.php" ?>
        </div><!-- /col-md-3 -->

        <div class="col-md-9"><!-- col-md-9 -->
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
                                    <img src="adminArea/productImages/<?php echo $productImg1 ?>" alt="" class="img-responsive">
                                </div>
                                <div class="item text-center">
                                    <img src="adminArea/productImages/<?php echo $productImg2 ?>" alt="" class="img-responsive">
                                </div>
                                <div class="item text-center">
                                    <img src="adminArea/productImages/<?php echo $productImg3 ?>" alt="" class="img-responsive">
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
                </div><!-- /col-sm-6 -->
                <div class="col-sm-6"><!-- col-sm-6 -->
                    <div class="box"><!-- box -->
                        <h1 class="text-center"><?php echo $productTitle ?></h1>
                        <?php addToCart() ?>
                        <form action="details.php?add_cart=<?php echo $productId ?>" method="post" class="form-horizontal"><!-- form-horizontal -->
                            <div class="form-group"><!-- form-group -->
                                <label for="" class="col-md-5 control-label">Product Quantity</label>
                                <div class="col-md-7"><!-- col-md-7 -->
                                    <select name="product_qty" id="" class="form-control">
                                        <option value="">Select Quantity</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div><!-- /col-md-7 -->
                            </div><!-- /form-group -->
                            <div class="form-group"><!-- form-group -->
                                <label for="" class="col-md-5 control-label">Product Size</label>
                                <div class="col-md-7"><!-- /col-md-7 -->
                                    <select name="product_size" id="" class="form-control">
                                        <option>Select a Size</option>
                                        <option>Small</option>
                                        <option>Medium</option>
                                        <option>Large</option>
                                    </select>
                                </div><!-- /col-md-7 -->
                            </div><!-- /form-group -->
                            <p class="price">€&nbsp;<?php echo $productPrice ?></p>
                            <p class="text-center buttons">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-shopping-cart"></i>&nbsp;Add to a Cart
                                </button>
                            </p>
                        </form><!-- /form-horizontal -->
                    </div><!-- /box -->

                    <div class="row" id="thumbs"><!-- row -->
                        <div class="col-xs-4"><!-- col-xs-4 -->
                            <a href="#" class="thumb">
                                <img src="adminArea/productImages/<?php echo $productImg1 ?>" alt="" class="img-responsive">
                            </a>
                        </div><!-- /col-xs-4 -->

                        <div class="col-xs-4"><!-- col-xs-4 -->
                            <a href="#" class="thumb">
                                <img src="adminArea/productImages/<?php echo $productImg2 ?>" alt="" class="img-responsive">
                            </a>
                        </div><!-- /col-xs-4 -->

                        <div class="col-xs-4"><!-- col-xs-4 -->
                            <a href="#" class="thumb">
                                <img src="adminArea/productImages/<?php echo $productImg3 ?>" alt="" class="img-responsive">
                            </a>
                        </div><!-- /col-xs-4 -->
                    </div><!-- /row -->
                </div><!-- /col-sm-6 -->
            </div><!-- /row -->
            <div class="box" id="details"><!-- box -->
                <p>
                <h4>Product Details</h4>
                <p>
                    <?php echo $productDesc ?>
                </p>
                <h4>Size</h4>
                <ul>
                    <li>Small</li>
                    <li>Medium</li>
                    <li>Large</li>
                </ul>
                <hr>
            </div><!-- /box -->
            <div id="row same-height-row"><!-- row -->
                <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 -->
                    <div class="box same-height headline"><!-- box same-height headline -->
                        <h3>You also liked these Products</h3>
                    </div><!-- /box same-height headline -->
                </div><!-- /col-md-3 col-sm-6 -->

                <?php

                $products = "SELECT * FROM products ORDER BY rand() LIMIT 0, 3";
                $query = mysqli_query($connection,$products);

                while ($row = mysqli_fetch_array($query)){
                    $productId = $row['product_id'];
                    $productTitle = $row['product_title'];
                    $productPrice = $row['product_price'];

                    ?>

                    <div class="col-md-3 col-sm-6 center-responsive">
                        <div class="product same-height">
                            <a href="details.php?pro_id=<?php echo $productId ?>"><img src="adminArea/productImages/<?php echo $productImg1 ?>" alt="" class="img-responsive"></a>
                            <div class="text">
                                <h3><a href="details.php?pro_id=<?php echo $productId ?> "><?php echo $productTitle ?></a></h3>
                                <p class="price"><?php echo $productPrice ?></p>
                            </div>
                        </div>
                    </div>

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