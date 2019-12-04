<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 20/03/2019
 * Time: 19:03
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
                <li class="active"><i class="fas fa-tachometer-alt"></i> Dashboard / View Product Categories</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fas fa-money-bill-alt fa-fw"></i>&nbsp;View Product Categories
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-stripped">
                            <thead>
                            <tr>
                                <th>Product Category No:</th>
                                <th>Product Category title:</th>
                                <th>Product Category Top:</th>
                                <th>Product Category Image:</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php

                            $i = 0;

                            $query = "select * from onlinestore.product_categories";
                            $runQuery = mysqli_query($connection, $query);

                            while ($rowPC = mysqli_fetch_array($runQuery)) {

                                $productCatId = $rowPC['p_cat_id'];
                                $productCatTitle = $rowPC['p_cat_title'];
                                $productCatImage = $rowPC['p_cat_image'];
                                $productCatTop = $rowPC['p_cat_top'];

                                $i++

                                ?>

                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $productCatTitle ?></td>
                                    <td><?php echo $productCatTop ?></td>
                                    <td><img src="otherImages/<?php echo $productCatImage ?>" alt="PCatImage" class="img-responsive" width="75" height="75"></td>
                                    <td><a href="index.php?deleteProductCat=<?php echo $productCatId ?>"><i
                                                    class="fas fa-times-circle fa-2x"></i></a></td>
                                    <td><a href="index.php?editProductCat=<?php echo $productCatId ?>"><i
                                                    class="fas fa-edit fa-2x"></i></a></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

}