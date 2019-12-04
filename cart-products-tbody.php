<?php
session_start();
?>
<?php include 'includes/db.php' ?>
<?php include 'functions/functions.php' ?>

<?php
$ipAdd = getUserIpAddress();
$total = 0;
$totalWeight = 0;
$physicalProducts = array();
$subTotal = 0;
$cart = "SELECT * FROM onlinestore.cart WHERE ip_add = '$ipAdd'";

$query = mysqli_query($connection, $cart);

while ($row = mysqli_fetch_array($query)) {
    $productId = $row['p_id'];
    $productSize = $row['p_size'];
    $product_Qty = $row['qty'];
    $productPrice = $row['p_price'];

    $products = "SELECT * FROM onlinestore.products WHERE product_id = $productId";

    $pQuery = mysqli_query($connection, $products);

    while ($prod_row = mysqli_fetch_array($pQuery)) {
        $productTitle = $prod_row['product_title'];
        $productImg = $prod_row['product_img1'];
        $productType = $prod_row['product_type'];
        $productWeight = $prod_row['product_weight'];
        $subTotalWeight = $productWeight * $product_Qty;
        $totalWeight += $subTotalWeight;
        if ($productType = "physicalProduct") {
            array_push($physicalProducts, $productId);
        }
        $subTotal = $productPrice * $product_Qty;
        $_SESSION['product_Qty'] = $product_Qty;
        $total += $subTotal;

        ?>

        <tr>
            <td><img src="adminArea/productImages/<?php echo $productImg ?>" alt=""></td>
            <td><a href="#"><?php echo $productTitle ?></a></td>
            <td><input type="text" name="qty" value="<?php echo $_SESSION['product_Qty'] ?>"
                       data-product_id="<?php echo $productId ?>" class="qty form-control">
            </td>
            <td>&euro;&nbsp;<?php echo $productPrice ?></td>
            <td><?php echo $productSize ?></td>
            <td><input type="checkbox" name="remove[]" value="<?php echo $productId ?>">
            </td>
            <td>&euro;&nbsp;<?php echo $subTotal ?></td>
        </tr>

        <?php
    }
}

?>