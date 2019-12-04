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

    <?php
    $getIcons = "select * from onlinestore.icons";
    $iconsQuery = mysqli_query($connection,$getIcons);

    while ($iconsRow = mysqli_fetch_array($iconsQuery)){
        $iconId = $iconsRow['icon_id'];
        $iconTitle = $iconsRow['icon_title'];
        $iconImage = $iconsRow['icon_img'];
        $iconProduct = $iconsRow['icon_product'];
  ?>
    <div class="col-md-2 text-center">
        <div class="panel panel-default panel-primary">
            <div class="panel-heading ">
                <h3 class="panel-title">
                    <?php echo strtoupper($iconTitle) ?>
                </h3>
            </div>
            <div class="panel-body">
                <p>
                    <?php
                    $getProduct = "select * from onlinestore.products where product_id = $iconProduct";
                    $productQuery = mysqli_query($connection,$getProduct);
                    $productRow = mysqli_fetch_array($productQuery);
                    $productTitle = $productRow['product_title'];
                    ?>
                    <?php echo $productTitle ?>
                </p>
                <img src="iconImages/<?php echo $iconImage ?>" alt="iconImage" height="75" width="75">
            </div>
            <div class="panel-footer clearfix">
                <a href="index.php?deleteIcon=<?php echo $iconId ?>"><i class="fas fa-times-circle fa-2x pull-left"></i></a>
                <a href="index.php?editIcon=<?php echo $iconId ?>"><i class="fas fa-edit fa-2x pull-right"></i></a>
            </div>
        </div>

    </div>

    <?php  }

    ?>


    <?php

}