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
                    &nbsp;Dashboard&nbsp;/&nbsp;View&nbsp;Relations
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
    <div class="col-lg-12">
    <div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fas fa-money-bill"></i>&nbsp;View Relations
        </h3>
    </div>
    <div class="panel-body">

    <?php
    $getRelations = "select * from onlinestore.bundle_product_relation";
    $iconsQuery = mysqli_query($connection,$getRelations);

    while ($iconsRow = mysqli_fetch_array($iconsQuery)){
        $relationId = $iconsRow['rel_id'];
        $relationTitle = $iconsRow['rel_title'];
        $relationProduct = $iconsRow['product_id'];
        $relationBundle = $iconsRow['bundle_id'];
        ?>
        <div class="col-md-3 text-center">
            <div class="panel panel-default panel-primary">
                <div class="panel-heading ">
                    <h3 class="panel-title">
                        <?php echo strtoupper($relationTitle) ?>
                    </h3>
                </div>
                <div class="panel-body">
                    <div>
                        <p>
                            <?php
                            $getProduct = "select * from onlinestore.products where product_id = $relationProduct";
                            $productQuery = mysqli_query($connection,$getProduct);
                            $productRow = mysqli_fetch_array($productQuery);
                            $productTitle = $productRow['product_title'];
                            $productImage = $productRow['product_img1'];
                            $product_id = $productRow['product_id'];
                            ?>
                            <?php echo"<h5><b>Product: </b></h5>$productTitle" ?>
                        </p>
                        <img src="productImages/<?php echo $productImage ?>" alt="iconImage" height="75" width="75">
                    </div>
                    <hr>
                <div>
                        <p>
                            <?php
                            $getProduct = "select * from onlinestore.products where product_id = $relationBundle";
                            $product_Query = mysqli_query($connection,$getProduct);
                            $product_Row = mysqli_fetch_array($product_Query);
                            $productTitle = $product_Row['product_title'];
                            $product_Image = $product_Row['product_img1'];
                            ?>
                            <?php echo "<h5><b>Bundle: </b></h5>$productTitle" ?>
                        </p>
                        <img src="productImages/<?php echo $product_Image ?>" alt="iconImage" height="75" width="75">
                    </div>
                </div>
                <div class="panel-footer clearfix">
                    <a href="index.php?deleteRelation=<?php echo $relationId ?>"><i class="fas fa-times-circle fa-2x pull-left"></i></a>
                    <a href="index.php?editRelation=<?php echo $relationId ?>"><i class="fas fa-edit fa-2x pull-right"></i></a>
                </div>
            </div>

        </div>

    <?php  }

    ?>

    <?php
}
