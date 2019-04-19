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

    <?php

    if (isset($_POST['insert'])) {

        $productCatTitle = $_POST['productCatTitle'];
        $productCatDesc = $_POST['productCatDesc'];

        $query = "insert into onlinestore.product_categories (p_cat_title, p_cat_desc) values ('$productCatTitle','$productCatDesc')";
        $runQuery = mysqli_query($connection,$query);

        if ($runQuery){
            ?>
            <script>alert("New Product Category has been Inserted")</script>
            <script>window.open("index.php?viewProductCat","_self")</script>
            <?php

        }


    }

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
                    <h3 class="panel-title">&nbsp;<i class="fas fa-money-bill-alt"></i>&nbsp;Insert Product Category</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Product Category Title</label>
                            <div class="col-md-6">
                                <input type="text" name="productCatTitle" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Product Category Description</label>
                            <div class="col-md-6">
                                <textarea name="productCatDesc" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Product Category Title</label>
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

}
