<?php /**
 * Created by PhpStorm.
 * User: Andre
 * Date: 24/12/2018
 * Time: 01:52
 */


function confirmResult($result)
{
    global $connection;
    if (!$result) {
        die("<h4><b class='text-danger'>Query failed:</b> &nbsp;</h4>" . mysqli_error($connection));
    } else {
        echo "<script>alert('Product Added')</script>";
    }
}

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
                <a href="details.php?product_id=<?php echo $productID ?>"><img
                            src="adminArea/productImages/<?php echo $productImage ?>" alt="" class="img-responsive"></a>
                <div class="text"><!-- text -->
                    <h3><a href="details.php?product_id=<?php echo $productID ?>"><?php echo $productTitle ?></a></h3>
                    <p class="price">€&nbsp;<?php echo $productPrice ?></p>
                    <p class="buttons">
                        <a href="details.php?product_id=<?php echo $productID ?>" class="btn btn-default">View
                            Details</a>
                        <a href="deatails.php?<?php echo $productID ?>" class="btn btn-primary"><i
                                    class="fas fa-shopping-cart"></i>Add to
                            cart</a>
                    </p>
                </div><!-- /text -->
            </div><!-- /product -->
        </div><!-- /col-sm-4 col-sm-6 single -->


        <?php

    }


}

function getProductCategories()
{
    global $connection;

    $productCatTable = "SELECT * FROM product_categories";
    $query = mysqli_query($connection, $productCatTable);

    while ($row = mysqli_fetch_array($query)) {

        $productCatId = $row['p_cat_id'];
        $productCatTitle = $row['p_cat_title'];

        ?>

        <li><a href="shop.php?p_cat=<?php echo $productCatId ?>"><?php echo $productCatTitle ?></a></li>

        <?php
    }
}

function getCategories()
{
    global $connection;

    $productCatTable = "SELECT * FROM categories";
    $query = mysqli_query($connection, $productCatTable);

    while ($row = mysqli_fetch_array($query)) {

        $catId = $row['cat_id'];
        $catTitle = $row['cat_title'];

        ?>

        <li><a href="shop.php?category=<?php echo $catId ?>"><?php echo $catTitle ?></a></li>

        <?php
    }
}

function getCatProduct()
{
    global $connection;

    if (isset($_GET['p_cat'])) {
        $productCatId = $_GET['p_cat'];

        $query = "SELECT * FROM product_categories WHERE p_cat_id = $productCatId";

        $result = mysqli_query($connection, $query);

        $row = mysqli_fetch_array($result);

        $productCatTitle = $row['p_cat_title'];
        $productCatDesc = $row['p_cat_desc'];

        $products = "SELECT * FROM products WHERE p_cat_id = $productCatId";

        $query = mysqli_query($connection, $products);

        $count = mysqli_num_rows($query);

        if ($count == 0) {

            ?>
            <div class="box">
                <h1>No Products on this Category</h1>
            </div>
            <?php

        } else {

            ?>

            <div class="box">
                <h1><?php echo $productCatTitle ?></h1>
                <p><?php echo $productCatDesc ?></p>
            </div>

            <?php
        }

        while ($row = mysqli_fetch_array($query)) {
            $productId = $row['product_id'];
            $productTitle = $row['product_title'];
            $productPrice = $row['product_price'];
            $productImg = $row['product_img1'];


            ?>

            <div class="col-md-4 col-sm-6 center-responsive">
                <div class="product">
                    <a href="details.php?pro_id=<?php echo $productId ?>">
                        <img src="adminArea/productImages/<?php echo $productImg ?>" alt="" class="img-responsive">
                    </a>
                    <div class="text">
                        <h3><a href="details.php?pro_id=<?php echo $productId ?>"><?php echo $productTitle ?></a></h3>
                        <p class="price">€&nbsp;<?php echo $productPrice ?></p>
                        <p class="buttons">
                            <a href="details.php?pro_id=<?php echo $productId ?>" class="btn btn-default">View
                                Details</a>
                            <a href="details.php?pro_id =<?php echo $productId ?>" class="btn btn-primary">
                                <i class="fas fa-shopping-cart"></i>&nbsp;Add to cart
                            </a>
                        </p>

                    </div>
                </div>
            </div>


            <?php

        }
    }
}

function getCategoryProduct()
{
    global $connection;

    if (isset($_GET['category'])) {
        $categoryId = $_GET['category'];

        $categories = "SELECT * FROM categories WHERE cat_id = $categoryId";
        $query = mysqli_query($connection, $categories);

        $row = mysqli_fetch_array($query);

        $categoryTitle = $row['cat_title'];
        $categoryDesc = $row['cat_desc'];

        $products = "SELECT * FROM products WHERE cat_id = $categoryId";
        $query = mysqli_query($connection, $products);

        $count = mysqli_num_rows($query);

        if ($count == 0) {
            ?>

            <div class="box">
                <h1>No Products Found In This Category</h1>
            </div>

            <?php
        } else {
            ?>

            <div class="box">
                <h1><?php echo $categoryTitle ?></h1>
                <p><?php echo $categoryDesc ?></p>
            </div>

            <?php
        }

        while ($row = mysqli_fetch_array($query)) {
            $productId = $row['product_id'];
            $productTitle = $row['product_title'];
            $productPrice = $row['product_price'];
            $productImg = $row['product_img1'];
//            $productDesc = $row['product_description'];

            ?>

            <div class="col-md-4 col-sm-6 center-responsive">
                <div class="product">
                    <a href="details.php?pro_id=<?php echo $productId ?>"><img
                                src="adminArea/productImages/<?php echo $productImg ?>" alt=""
                                class="img-responsive"></a>
                    <div class="text">
                        <h3><a href="details.php?pro_id=<?php echo $productId ?>"><?php echo $productTitle ?></a></h3>
                        <p class="price">€&nbsp;<?php echo $productPrice ?></p>
                        <p class="buttons">
                            <a href="details.php?pro_id=<?php echo $productId ?>" class="btn btn-default">View
                                Details</a>
                            <a href="details.php?pro_id=<?php echo $productId ?>" class="btn btn-primary"><i
                                        class="fas fa-shopping-cart"></i>&nbsp;Add to cart</a>
                        </p>
                    </div>
                </div>
            </div>

            <?php

        }


    }
}

function getUserIpAddress()
{
    if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipAdd = $_SERVER['REMOTE_ADDR'];
        return $ipAdd;
    } else {
        return false;
    }
}


function addToCart()
{
    global $connection;

    if (isset($_GET['add_cart'])) {
        $ipAdd = getUserIpAddress();

        $productId = $_GET['add_cart'];
        $productQty = $_POST['product_qty'];
        $productSize = $_POST['product_size'];

        $checkProduct = "SELECT * FROM cart WHERE ip_add = '$ipAdd' AND p_id = $productId";
        $p_query = mysqli_query($connection, $checkProduct);

        if (mysqli_num_rows($p_query) > 0) {
            ?>

            <script>alert("This product is already added in cart")</script>
            <script>window.open("details.php?pro_id=<?php echo $productId ?>", "_self")</script>
            <?php
        } else {

            $insertCart = "INSERT INTO cart (p_id,ip_add,qty,p_size) ";
            $insertCart .= "VALUES ($productId,'$ipAdd',$productQty,'$productSize')";

            $query = mysqli_query($connection, $insertCart);

            confirmResult($query);

            ?>

            <script>window.open("details.php?pro_id=<?php echo $productId ?>", "_self")</script>

            <?php


        }
    }

}

function cartItems()
{
    global $connection;

    $ipAdd = getUserIpAddress();
    $getItems = "SELECT * FROM cart WHERE ip_add = '$ipAdd'";

    $query = mysqli_query($connection, $getItems);

    $count = mysqli_num_rows($query);

    if ($count > 1) {

        echo "$count items in cart";

    } elseif ($count == 0) {

        echo "$count items in cart";

    } elseif ($count == 1) {
        echo "$count item in cart";

    }


}


function totalPrice()
{
    global $connection;

    $ipAdd = getUserIpAddress();

    $total = 0;

    $cart = "SELECT * FROM cart WHERE ip_add = '$ipAdd'";

    $query = mysqli_query($connection, $cart);

    while ($record = mysqli_fetch_array($query)) {
        $productId = $record['p_id'];
        $productQty = $record['qty'];

        $getPrice = "SELECT * FROM products WHERE product_id = $productId";

        $query = mysqli_query($connection, $getPrice);

        while ($row = mysqli_fetch_array($query)) {
            $subTotal = $row['product_price'] * $productQty;
            $total += $subTotal;

        }
    }

    ?>

    &euro;&nbsp;<?php echo $total; ?>

    <?php

}

function before ($character, $inthat)
{
    return substr($inthat, 0, strpos($inthat, $character));
};

function getBoxes(){
    global $connection;

    $getBoxes  = "select * from  onlinestore.boxes_section";
    $runQuery = mysqli_query($connection,$getBoxes);

    while ($runQuerySection = mysqli_fetch_array($runQuery)){

        $boxId = $runQuerySection['box_id'];
        $boxTitle = $runQuerySection['box_title'];
        $boxDesc = $runQuerySection['box_desc'];


        ?>

        <div class="col-sm-4"><!-- col-sm-4 -->
            <div class="box same-height"><!-- box same-height -->
                <div class="icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3><a href="#"><?php echo $boxTitle?></a></h3>
                <p><?php echo $boxDesc ?></p>
            </div><!-- /box same-height -->
        </div><!-- /col-sm-4 -->


<?php
    }
}
