<div class="text-center">
    <h1>
        My WishList
    </h1>
    <p class="lead">
        Your all WishList Products on one Place.
    </p>
</div>

<hr>

<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead>
        <tr>
            <th>WishLis nº</th>
            <th>WishLis Product</th>
            <th>Delete WishList</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $customerSession = $_SESSION['customer_email'];
        $getCustomer = "select * from onlinestore.customers where customer_email = '$customerSession'";
        $customerQuery = mysqli_query($connection, $getCustomer);
        $customerRow = mysqli_fetch_array($customerQuery);
        $customerId = $customerRow['customer_id'];

        $i = 0;

        $getWishList = "select * from onlinestore.wishlist where customer_id = $customerId";
        $wishListQuery = mysqli_query($connection,$getWishList);
        while ($wishRow = mysqli_fetch_array($wishListQuery)){
            $wishListId = $wishRow['wishlist_id'];
            $wishProduct_id = $wishRow['product_id'];

            $getProducts = "select * from onlinestore.products where product_id = $wishProduct_id";
            $productQuery = mysqli_query($connection,$getProducts);
            $productsRow = mysqli_fetch_array($productQuery);
            $productTitle = $productsRow['product_title'];
            $productUrl = $productsRow['product_url'];
            $productImg = $productsRow['product_img1'];

            $i++;
            ?>

            <tr>
                <td width="100"><?php echo $i ?></td>
                <td>
                    <img src="../adminArea/productImages/<?php echo $productImg ?>" alt="prodImg" width="60" height="60">
                    &nbsp;
                    &nbsp;
                    &nbsp;
                    <a href="../<?php echo $productUrl ?>">
                        <?php echo $productTitle ?>
                    </a>
                </td>
                <td class="text-center">
                    <a href="myAccount.php?deleteWishList=<?php echo $wishListId ?>" class="btn btn-primary">
                        <i class="fas fa-times-circle"></i> Delete
                    </a>
                </td>
            </tr>

            <?php
        }
        ?>
        </tbody>
    </table>
</div>