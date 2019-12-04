<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 21/03/2019
 * Time: 17:20
 */
?>


<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

    <?php

    if (isset($_GET['editProductCat'])) {

        $productCatId = $_GET['editProductCat'];


        $productCatQuery = "select * from onlinestore.product_categories where p_cat_id = $productCatId";
        $runQuery = mysqli_query($connection, $productCatQuery);
        $rowProductCat = mysqli_fetch_array($runQuery);

        $prodCatTitle = $rowProductCat['p_cat_title'];
        $prodCatImage = $rowProductCat['p_cat_image'];
        $newProdCatImage = $rowProductCat['p_cat_image'];
        $prodCatTop = $rowProductCat['p_cat_top'];

    }

    ?>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><i class="fas fa-tachometer-alt"></i> Dashboard / Edit Product Category</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;<i class="fas fa-money-bill-alt"></i>&nbsp;Edit Product Category</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Product Category Title</label>
                            <div class="col-md-6">
                                <input type="text" name="productCatTitle" class="form-control"
                                       value="<?php echo $prodCatTitle ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Product Category Image</label>
                            <div class="col-md-6">
                                <img src="otherImages/<?php echo $prodCatImage ?>" alt="PCatImage" class="img-responsive" width="100" height="100">
                                <label></label>
                                <input type="file" class="form-control" name="productCatImage">
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <label class="col-md-3 control-label" for="">Product Category Top</label>
                            <div class="col-md-3">

                                <input type="radio" name="productCatTop" value="yes" <?php if ($prodCatTop == "no"){

                                } else{
                                ?>checked="checked"<?php
                                }

                                ?>>
                                <label><i style="color: #398439;" class="fas fa-check fa-2x"></i>
                                </label>&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="productCatTop" value="no" <?php if ($prodCatTop == "yes"){

                                } else{
                                ?>checked="checked"<?php
                                }

                                ?>>
                                <label>
                                    <i class="fas fa-times-circle fa-2x"></i>
                                </label>
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

        $productCatTitle = $_POST['productCatTitle'];
        $productCatTop = $_POST['productCatTop'];
        $productCatImage = $_FILES['productCatImage']['name'];
        $tmp_image = $_FILES['productCatImage']['tmp_name'];

        if (empty($productCatImage)){
            $productCatImage = $newProdCatImage;
        }

        move_uploaded_file($tmp_image,"otherImages/$productCatImage");

        $query = "update onlinestore.product_categories set p_cat_title = '$productCatTitle', p_cat_image = '$productCatImage', p_cat_top ='$productCatTop' where p_cat_id = $productCatId ";
        $runQuery = mysqli_query($connection, $query);

        if ($runQuery) {
            ?>
            <script>alert("New Product Category has been updated")</script>
            <script>window.open("index.php?viewProductCat", "_self")</script>
            <?php

        }


    }

    ?>

    <?php

}

