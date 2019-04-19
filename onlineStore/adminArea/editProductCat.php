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

    if (isset($_GET['editProductCat'])){

        $productCatId = $_GET['editProductCat'];

        if (isset($_POST['update'])) {

            $productCatTitle = $_POST['productCatTitle'];
            $productCatDesc = $_POST['productCatDesc'];

            $query = "update onlinestore.product_categories set p_cat_title = '$productCatTitle', p_cat_desc = '$productCatDesc'  where p_cat_id = $productCatId ";
            $runQuery = mysqli_query($connection,$query);

            if ($runQuery){
                ?>
                <script>alert("New Product Category has been updated")</script>
                <script>window.open("index.php?viewProductCat","_self")</script>
                <?php

            }


        }

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

                    <?php

                        $productCatQuery = "select * from onlinestore.product_categories where p_cat_id = $productCatId";
                        $runQuery = mysqli_query($connection, $productCatQuery);
                        $rowProductCat = mysqli_fetch_array($runQuery);

                        $prodCatTitle = $rowProductCat['p_cat_title'];
                        $prodCatDesc = $rowProductCat['p_cat_desc'];

                    ?>

                    <form action="" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Product Category Title</label>
                            <div class="col-md-6">
                                <input type="text" name="productCatTitle" class="form-control" value="<?php echo $prodCatTitle ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Product Category Description</label>
                            <div class="col-md-6">
                                <textarea name="productCatDesc" id="" cols="30" rows="10" class="form-control"><?php echo $prodCatDesc ?></textarea>
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

}

