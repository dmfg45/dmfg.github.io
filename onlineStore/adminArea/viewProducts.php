<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 20/03/2019
 * Time: 00:17
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
                <li class="active">
                    <i class="fas fa-tachometer-alt"></i>
                    &nbsp;Dashboard&nbsp;/&nbsp;ViewProducts
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill"></i>&nbsp;View Products
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-stripped">
                            <thead>
                            <tr>
                                <th>Porduct Id</th>
                                <th>Product Title</th>
                                <th>Product Image</th>
                                <th>Product Price</th>
                                <th>Product Sold</th>
                                <th>Product Keywords</th>
                                <th>Product Date</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>


                                <?php

                                $i = 0;

                                $query = "select * from onlinestore.products";
                                $runQuery = mysqli_query($connection,$query);

                                while ($row = mysqli_fetch_array($runQuery)){
                                    $productId = $row['product_id'];
                                    $productTitle = $row['product_title'];
                                    $productImage = $row['product_img1'];
                                    $productPrice = $row['product_price'];
                                    $productKeywords = $row['product_keywords'];
                                    $productDate = $row['prod_date'];

                                    $i++;

                                    ?>

                                    <tr>

                                    <td><?php echo $i ?></td>
                                    <td><?php echo $productTitle ?></td>
                                    <td><img width="50" height="50" src="productImages/<?php echo$productImage ?>" alt="ProdImg"></td>
                                    <td><?php echo $productPrice ?>&nbsp;&euro;</td>
                                    <td>
                                        <?php

                                        $OrderQuery = "select * from onlinestore.pending_orders where product_id = $productId";
                                        $runOrderQuery = mysqli_query($connection,$OrderQuery);
                                        $count = mysqli_num_rows($runOrderQuery);

                                        echo $count;


                                        ?>
                                    </td>
                                    <td><?php echo $productKeywords ?></td>
                                    <td><?php echo $productDate ?></td>
                                    <td><a href="index.php?deleteProduct=<?php echo $productId ?>"><i class="fas fa-times-circle fa-2x"></i></a></td>
                                    <td><a href="index.php?editProduct=<?php echo $productId ?>"><i class="fas fa-edit fa-2x"></i></a></td>
                            </tr>
                            <?php

                            }

                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }