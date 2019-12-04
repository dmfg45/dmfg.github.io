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
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Relation Title</label>
                            <div class="col-md-6">
                                <input type="text" name="relationTitle" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Product Associated:</label>
                            <div class="col-md-6">
                                <select name="productAssc" id="" class="form-control">
                                    <option value=""> Select Product</option>
                                    <?php
                                    $getProducts = "select * from onlinestore.products where status = 'product'";
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
                            <label class="col-md-3 control-label" for="">Product Associated:</label>
                            <div class="col-md-6">
                                <select name="bundleAssc" id="" class="form-control">
                                    <option value=""> Select Bundle</option>
                                    <?php
                                    $getProducts = "select * from onlinestore.products where status = 'bundle'";
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
        $relationTitle = $_POST['relationTitle'];
        $prodAssc = $_POST['productAssc'];
        $bundleAssc = $_POST['bundleAssc'];

        $insertRel = "insert into onlinestore.bundle_product_relation (
                               bundle_id,
                               product_id,
                               rel_title
                               ) 
                               VALUES (
                                       $bundleAssc,
                                       $prodAssc,
                                       '$relationTitle'
                                       )";


        $query = mysqli_query($connection, $insertRel);

        if ($query) {
            ?>
            <script>
                alert("The Relation was Successfully Added");
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