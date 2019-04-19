<?php /**
 * Created by PhpStorm.
 * User: Andre
 * Date: 24/12/2018
 * Time: 01:52
 */


function getPro()
{
    global $connection;

    $productsTable = "SELECT * FROM products ORDER BY 1 DESC LIMIT 0,8";

    $query = mysqli_query($connection, $productsTable);

    while ($row = mysqli_fetch_array($query)) {
        $productID = $row['product_id'];
        $productTitle = $row['product_title'];
        $productImage = $row['product_img1'];
        $productPrice = $row['product_price'];
        ?>

        <div class="col-sm-4 col-sm-6 single"><!-- col-sm-4 col-sm-6 single -->
            <div class="product"><!-- product -->
                <a href="details.php?product_id=<?php echo $productID ?>"><img src="adminArea/productImages/<?php echo $productImage ?>" alt="" class="img-responsive"></a>
                <div class="text"><!-- text -->
                    <h3><a href="details.php?product_id=<?php echo $productID ?>"><?php echo $productTitle ?></a></h3>
                    <p class="price">€&nbsp;<?php echo $productPrice ?></p>
                    <p class="buttons">
                        <a href="details.php?product_id=<?php echo $productID?>" class="btn btn-default">View Details</a>
                        <a href="deatails.php?<?php echo $productID?>" class="btn btn-primary"><i class="fas fa-shopping-cart"></i>Add to
                            cart</a>
                    </p>
                </div><!-- /text -->
            </div><!-- /product -->
        </div><!-- /col-sm-4 col-sm-6 single -->


        <?php

    }


}