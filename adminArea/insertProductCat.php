<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 20/03/2019
 * Time: 03:33
 */
?>

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
                <li><i class="fas fa-tachometer-alt"></i> Dashboard / Insert Product Category</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;<i class="fas fa-money-bill-alt"></i>&nbsp;Insert Product Category
                    </h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Product Category Title</label>
                            <div class="col-md-6">
                                <input type="text" name="productCatTitle" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Product Category Image</label>
                            <div class="col-md-6">
                                <input type="file" name="productCatImage" class="form-control">
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <label class="col-md-3 control-label" for="">Product Category Top</label>
                            <div class="col-md-3">

                                <input type="radio" name="productCatTop" value="yes">
                                <label><i style="color: #398439;" class="fas fa-check fa-2x"></i>
                                </label>&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="productCatTop" value="no">
                                <label>
                                    <i class="fas fa-times-circle fa-2x"></i>
                                </label>
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

        $productCatTitle = $_POST['productCatTitle'];
        $productCatTop = $_POST['productCatTop'];
        $productCatImage= $_FILES['productCatImage']['name'];
        $tmp_image = $_FILES['productCatImage']['tmp_name'];

        move_uploaded_file($tmp_image,"otherImages/$productCatImage");

        $query = "insert into onlinestore.product_categories (
                                            p_cat_title,
                                            p_cat_top,
                                            p_cat_image)
                                             values (
                                                     '$productCatTitle',
                                                     '$productCatTop',
                                                     '$productCatImage')";
        $runQuery = mysqli_query($connection, $query);

        if ($runQuery) {
            ?>
            <script>alert("New Product Category has been Inserted")</script>
            <script>window.open("index.php?viewProductCat", "_self")</script>
            <?php

        }


    }

    ?>

    <?php

}
