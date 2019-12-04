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
                <li><i class="fas fa-tachometer-alt"></i> Dashboard / Insert Relation</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;<i class="fas fa-money-bill-alt"></i>&nbsp;Insert Relation</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal">
                        <?php
                        if (isset($_GET['editRelation'])) {
                            $relationId = $_GET['editRelation'];
                        }
                        $getProdRel = "select * from onlinestore.bundle_product_relation where rel_id = $relationId";
                        $runQuery = mysqli_query($connection, $getProdRel);
                        $relRow = mysqli_fetch_array($runQuery);
                        $product_id = $relRow['product_id'];
                        $bundle_id = $relRow['bundle_id'];
                        $relTitle = $relRow['rel_title'];
                        ?>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Relation Title</label>
                            <div class="col-md-6">
                                <input type="text" name="relationTitle" value="<?php echo $relTitle ?>"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Product Associated:</label>
                            <div class="col-md-6">
                                <select name="productAssc" id="" class="form-control">
                                    <?php
                                    $getProducts = "select * from onlinestore.products where product_id = $product_id";
                                    $productQuery = mysqli_query($connection, $getProducts);

                                    while ($productRow = mysqli_fetch_array($productQuery)) {
                                        $productId = $productRow['product_id'];
                                        $productTitle = $productRow['product_title'];
                                        ?>
                                        <option value="<?php echo $productId ?>"><?php echo $productTitle ?></option>


                                    <?php } ?>

                                    <?php
                                    $getProducts = "select * from onlinestore.products where product_id != $product_id";
                                    $productQuery = mysqli_query($connection, $getProducts);

                                    while ($productRow = mysqli_fetch_array($productQuery)) {
                                        $productId = $productRow['product_id'];
                                        $productTitle = $productRow['product_title'];
                                        ?>
                                        <option value="<?php echo $productId ?>"><?php echo $productTitle ?></option>


                                    <?php } ?>

                                </select>
                            </div>

                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Bundle Associated:</label>
                            <div class="col-md-6">
                                <select name="bundleAssc" id="" class="form-control">
                                    <?php
                                    $getProducts = "select * from onlinestore.products where product_id = $bundle_id";
                                    $productQuery = mysqli_query($connection, $getProducts);

                                    while ($productRow = mysqli_fetch_array($productQuery)) {
                                        $productId = $productRow['product_id'];
                                        $productTitle = $productRow['product_title'];
                                        ?>
                                        <option value="<?php echo $productId ?>"><?php echo $productTitle ?></option>


                                    <?php } ?>

                                    <?php
                                    $getProducts = "select * from onlinestore.products where product_id != $bundle_id";
                                    $productQuery = mysqli_query($connection, $getProducts);

                                    while ($productRow = mysqli_fetch_array($productQuery)) {
                                        $productId = $productRow['product_id'];
                                        $productTitle = $productRow['product_title'];
                                        ?>
                                        <option value="<?php echo $productId ?>"><?php echo $productTitle ?></option>
                                    <?php } ?>
                                </select>
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
        $relationTitle = $_POST['relationTitle'];
        $prodAssc = $_POST['productAssc'];
        $bundleAssc = $_POST['bundleAssc'];


        $updateRel = "update onlinestore.bundle_product_relation set
                                               rel_title = '$relationTitle',
                                               product_id = $prodAssc,
                                               bundle_id = $bundleAssc where rel_id = $relationId";

        $query = mysqli_query($connection, $updateRel);

        if ($query) {
            ?>
            <script>
                alert("The Relation was Successfully Updated");
                window.open("index.php?viewRelations", "_self");
            </script>
            <?php
        } else {
            die("Something went wrong: => " . mysqli_error($connection));
        }


    }


    ?>

    <?php
}