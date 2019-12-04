<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 20/01/2019
 * Time: 01:42
 */
?>


<div class="box">
    <?php

    $sessionEmail = $_SESSION['customer_email'];

    $customer = "select * from onlinestore.customers where customer_email = '$sessionEmail'";

    $query = mysqli_query($connection, $customer);

    $row = mysqli_fetch_array($query);

    $customerId = $row['customer_id'];

    ?>


    <h1 class="text-center">Payment Options for you</h1>
    <br>
    <br>
    <div class="text-center">
        <a name="submitOrder" class="btn btn-primary" href="order.php?c_id=<?php echo $customerId ?>">Submit Order</a>
    </div>
    <br>
    <br>
    <div class="text-center row">
        <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" class="col-md-4">
            <input type="hidden" name="business" value="andre.graca.45@gmail.com">
            <input type="hidden" name="cmd" value="_cart">
            <input type="hidden" name="upload" value="1">
            <input type="hidden" name="currency_code" value="EUR">
            <input type="hidden" name="return"
                   value="http://localhost/onlinestore/customer/myAccount.php?myOrders">
            <input type="hidden" name="cancel_return" value="http://localhost/onlinestore/index.php">
            <?php
            $i = 0;
            $ipAdd = getUserIpAddress();
            $getCart = "select * from onlinestore.cart where ip_add = '$ipAdd'";
            $cartQuery = mysqli_query($connection, $getCart);
            $cartCount = mysqli_num_rows($cartQuery);

            while ($cartRow = mysqli_fetch_array($cartQuery)) {
                $productId = $cartRow['p_id'];
                $productQty = $cartRow['qty'];
                $productPrice = $cartRow['p_price'];

                $getProducts = "select * from onlinestore.products where product_id = $productId";
                $productQuery = mysqli_query($connection, $getProducts);
                $productsRow = mysqli_fetch_array($productQuery);
                $productTitle = $productsRow['product_title'];
                $i++;

                ?>
                <input type="hidden" name="item_name_<?php echo $i ?>" value="<?php echo $productTitle ?>">
                <input type="hidden" name="item_number_<?php echo $i ?>" value="<?php echo $i ?>">
                <input type="hidden" name="amount_<?php echo $i ?>" value="<?php echo $productPrice ?>">
                <input type="hidden" name="quantity_<?php echo $i ?>" value="<?php echo $productQty ?>">
            <?php  }

            if (isset($_GET['order_id'])) {
                $orderId = $_GET['order_id'];
                $getOrder = "select * from onlinestore.customers_orders where order_id = $orderId";
                $orderQuery = mysqli_query($connection, $getOrder);
                $orderRow = mysqli_fetch_array($orderQuery);
                $productId = $orderRow['product_id'];
                $productQty = $orderRow['qty'];
                $productPrice = $orderRow['due_amount'];

                $getProducts = "select * from onlinestore.products where product_id = $productId";
                $productQuery = mysqli_query($connection, $getProducts);
                $productsRow = mysqli_fetch_array($productQuery);
                $productTitle = $productsRow['product_title'];
                $i++;


                ?>
                <input type="hidden" name="item_name_<?php echo $i ?>" value="<?php echo $productTitle ?>">
                <input type="hidden" name="item_number_<?php echo $i ?>" value="<?php echo $i ?>">
                <input type="hidden" name="amount_<?php echo $i ?>" value="<?php echo $productPrice ?>">
                <input type="hidden" name="quantity_<?php echo $i ?>" value="<?php echo $productQty ?>">
                <?php
            }
            ?>
            <input type="image" name="submit" width="150" height="150" src="images/paypal.png" align="center">
        </form>
        <div class="col-md-4">
            <img src="images/visa.png" alt="" style="max-width: 150px; max-height: 150px">
        </div>
        <div class="col-md-4" style="height: 150px;">
            <img src="images/mastercard.png" alt="" style="max-width: 150px; max-height: 150px">
        </div>

    </div>


</div>



