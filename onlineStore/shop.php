<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 17/11/2018
 * Time: 00:05
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
                <li>Shop</li>
            </ul><!-- /breadcrumb -->
        </div><!-- /col-md-12 -->

        <div class="col-md-3"><!-- col-md-3 -->
            <?php include "includes/sidebar.php" ?>
        </div><!-- /col-md-3 -->

        <div class="col-md-9"><!-- col-md-9 -->
            <?php

            if (!isset($_GET['p_cat'])) {
                if (!isset($_GET['category'])) {
                    ?>

                    <div class="box"><!-- box -->
                        <h1>Shop</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                            Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo
                            consequat.
                        </p>
                    </div><!-- /box -->

                    <?php

                }
            }

            ?>

            <div class="row">

                <?php

                if (!isset($_GET['p_cat'])) {
                if (!isset($_GET['category'])){

                $perPage = 6;

                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }

                $beginFrom = ($page - 1) * $perPage;

                $products = "SELECT * FROM products ORDER BY 1 DESC LIMIT $beginFrom,$perPage";
                $query = mysqli_query($connection, $products);

                while ($row = mysqli_fetch_array($query)) {
                    $productId = $row{'product_id'};
                    $productTitle = $row{'product_title'};
                    $productPrice = $row{'product_price'};
                    $productImg = $row{'product_img1'};

                    ?>

                    <div class="col-md-4 col-sm-6 center-responsive">
                        <div class="product">
                            <a href="details.php?pro_id=<?php echo $productId ?>">
                                <img src="adminArea/productImages/<?php echo $productImg ?>" class="img-responsive"
                                     alt="">
                            </a>
                            <div class="text">
                                <h3>
                                    <a href="details.php?pro_id=<?php echo $productId ?>"><?php echo $productTitle ?></a>
                                </h3>
                                <p class="price">€&nbsp;<?php echo $productPrice ?></p>
                                <p class="buttons">
                                    <a href="details.php?pro_id=<?php echo $productId ?>" class="btn btn-default">View
                                        details</a>
                                    <a href="details.php?pro_id=<?php echo $productId ?>" class="btn btn-primary"><i
                                                class="fas fa-shopping-cart">&nbsp;Add to Cart</i></a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <?php

                }

                ?>

            </div><!-- /row -->
            <div class="text-center">
                <ul class="pagination"><!-- pagination -->

                    <?php

                    $query = "SELECT * FROM products";
                    $result = mysqli_query($connection, $query);

                    $recordsNumber = mysqli_num_rows($result);

                    $pagesNumber = ceil($recordsNumber / $perPage);

                    ?>

                    <li><a href="shop.php?page=1">First Page</a></li>
                    <?php for ($i = 1; $i <= $pagesNumber; $i++) {

                        ?>

                        <li><a href="shop.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>

                        <?php
                    }

                    ?>
                    <li><a href="shop.php?page=<?php echo $pagesNumber ?>">Last Page</a></li>

                    <?php

                    }

                    }

                    ?>

                </ul><!-- /pagination -->
            </div>
            <div class="row">
                <?php getCatProduct(); ?>
                <?php getCategoryProduct(); ?>
            </div>
        </div><!-- /col-md-9 -->

    </div><!-- /container -->
</div><!-- /content -->

<?php include "includes/footer.php" ?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>