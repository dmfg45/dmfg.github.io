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

                    <?php
                    if (isset($_GET['editIcon'])) {
                        $iconId = $_GET['editIcon'];

                        $getIcons = "select * from onlinestore.icons where icon_id = $iconId";
                        $iconQuery = mysqli_query($connection, $getIcons);

                        $iconRow = mysqli_fetch_array($iconQuery);
                        $icon_title = $iconRow['icon_title'];
                        $icon_product = $iconRow['icon_product'];
                        $icon_image = $iconRow['icon_img'];
                        $new_icon_image = $iconRow['icon_img'];
                        $icon_product = $iconRow['icon_product'];
                    }

                    ?>

                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Icon Title:</label>
                            <div class="col-md-6">
                                <input type="text" name="iconTitle" value="<?php echo $icon_title ?>"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="form-group">

                            <label class="col-md-3 control-label" for="">Product Associated:</label>
                            <div class="col-md-6">
                                <select name="iconProduct" id="" class="form-control">
                                    <?php

                                    $getProducts = "select * from onlinestore.products where product_id = $icon_product";
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
                                    <optgroup label="Products"></optgroup>
                                    <?php
                                    $getProducts = "select * from onlinestore.products where product_id != $icon_product and status = 'product'";
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
                                <optgroup label="Products"></optgroup>
                                    <?php
                                    $getProducts = "select * from onlinestore.products where product_id != $icon_product and status = 'bundle'";
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
                            <label class="col-md-3 control-label" for="">Icon Image:</label>
                            <div class="col-md-6">
                                <img src="iconImages/<?php echo $icon_image ?>" alt=""
                                     class="img-responsive img-thumbnail">
                                <br>
                                <br>
                                <input type="file" name="iconImage" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for=""></label>
                            <div class="col-md-6">
                                <input type="submit" name="update" class="btn btn-primary form-control" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['update'])) {
        $iconProduct = $_POST['iconProduct'];
        $iconTitle = $_POST['iconTitle'];
        $iconImage = $_FILES['iconImage']['name'];
        $tmp_iconImage = $_FILES['iconImage']['tmp_name'];

        if (empty($iconImage)) {
            $iconImage = $new_icon_image;
        }

        move_uploaded_file($tmp_iconImage, "iconImages/$iconImage");


        $insertCoupon = "update onlinestore.icons set 
                             icon_product = $iconProduct,
                             icon_img = '$iconImage',
                             icon_title = '$iconTitle' where icon_id = $iconId";

        $query = mysqli_query($connection, $insertCoupon);

        if ($query) {
            ?>
            <script>
                alert("The Icon was Successfully Updated");
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