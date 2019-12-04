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
                <li><i class="fas fa-tachometer-alt"></i> Dashboard / Insert Icon</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;<i class="fas fa-money-bill-alt"></i>&nbsp;Insert Icon</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Icon Title:</label>
                            <div class="col-md-6">
                                <input type="text" name="iconTitle" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">

                            <label class="col-md-3 control-label" for="">Product Associated:</label>
                            <div class="col-md-6">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Select Icon Products or Bundles</h3>
                                    </div>
                                    <div class="panel-body" style="height: 250px; overflow-y: scroll;">
                                        <ul class="nav nav-pills nav-stacked category-menu">

                                            <h4>Products</h4>
                                            <?php

                                            $getProducts = "select * from onlinestore.products where status = 'product'";
                                            $productQuery = mysqli_query($connection, $getProducts);

                                            while ($productRow = mysqli_fetch_array($productQuery)) {
                                                $productId = $productRow['product_id'];
                                                $productImage = $productRow['product_img1'];
                                                $productTitle = $productRow['product_title'];
                                                ?>

                                                <input type="checkbox" value="<?php echo $productId ?>"
                                                       name="iconProduct[]">&nbsp;
                                                <!--<img src="productImages/<?php /*echo $productImage */?> " width="45" height="45"
                                                     alt="">-->&nbsp;&nbsp;<?php echo $productTitle ?>
<!--                                                <br>-->
<!--                                                <br>-->
                                                <br>


                                            <?php } ?>

                                            <h4>Bundles</h4>
                                            <?php

                                            $getProducts = "select * from onlinestore.products where status = 'bundle'";
                                            $productQuery = mysqli_query($connection, $getProducts);

                                            while ($productRow = mysqli_fetch_array($productQuery)) {
                                                $productId = $productRow['product_id'];
                                                $productImage = $productRow['product_img1'];
                                                $productTitle = $productRow['product_title'];
                                                ?>

                                                <input type="checkbox" value="<?php echo $productId ?>"
                                                       name="iconProduct[]">&nbsp;
                                                <!--<img src="productImages/<?php /*echo $productImage */?> " width="45" height="45"
                                                     alt="">&nbsp;-->&nbsp;<?php echo $productTitle ?>
<!--                                                <br>-->
<!--                                                <br>-->
                                                <br>


                                            <?php } ?>
                                        </ul>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Icon Image:</label>
                            <div class="col-md-6">
                                <input type="file" name="iconImage" class="form-control">
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
        $iconTitle = $_POST['iconTitle'];
        $iconImage = $_FILES['iconImage']['name'];
        $tmp_iconImage = $_FILES['iconImage']['tmp_name'];

        move_uploaded_file($tmp_iconImage, "iconImages/$iconImage");

        foreach ($_POST['iconProduct'] as $iconProduct) {
            $insertIcon = "insert into onlinestore.icons (
                               icon_product,
                               icon_title,
                               icon_img
                               ) 
                               VALUES (
                                       $iconProduct,
                                       '$iconTitle',
                                       '$iconImage'
                                       )";
        }


        $query = mysqli_query($connection, $insertIcon);

        if ($query) {
            ?>
            <script>
                alert("The Icon was Successfully Added");
                window.open("index.php?viewIcons", "_self");
            </script>
            <?php
        } else {
            die("Something went wrong: => " . mysqli_error($connection));
        }


    }


    ?>

    <?php
}