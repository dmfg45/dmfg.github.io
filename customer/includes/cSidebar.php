<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 20/11/2018
 * Time: 17:19
 */
?>
<?php

if (!isset($_SESSION['customer_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {

    ?>

    <div class="panel panel-default sidebar-menu"><!-- panel panel-default sidebar-menu -->
        <div class="panel-heading"><!-- panel-heading -->

            <?php

            $customerSession = $_SESSION['customer_email'];

            $getCustomer = "SELECT * FROM onlinestore.customers where customer_email = '$customerSession'";

            $customer = mysqli_query($connection, $getCustomer);

            $row = mysqli_fetch_array($customer);

            $customerName = $row['customer_name'];
            $customerImage = $row['customer_image'];

            if (!isset($_SESSION['customer_email'])) {

            } else {
                ?>

                <img src="customer_images/<?php echo $customerImage ?>" alt="profi1eImg"
                     class="img-responsive text-center">
                <br>
                <h3 align="center" class="panel-title"><?php echo $customerName ?></h3>

                <?php

            }

            ?>


        </div><!-- /panel-heading -->
        <div class="panel-body"><!-- panel-body -->
            <ul class="nav nav-pills nav-stacked"><!-- nav-pills -->

                <li class="<?php if (isset($_GET['myOrders'])) {
                    echo "active";
                } ?>">
                    <a href="myAccount.php?myOrders">
                        <i class="fas fa-list"></i>&nbsp;My Orders
                    </a>
                </li>

                <li class="<?php if (isset($_GET['payOffline'])) {
                    echo "active";
                } ?>">
                    <a href="myAccount.php?payOffline">
                        <i class="fas fa-bolt"></i>&nbsp;Pay Offline
                    </a>
                </li>

                <li class="<?php if (isset($_GET['editAccount'])) {
                    echo "active";
                } ?>">
                    <a href="myAccount.php?editAccount">
                        <i class="fas fa-pencil-alt"></i>&nbsp;Edit Account
                    </a>
                </li>

                <li class="<?php if (isset($_GET['myWishList'])) {
                    echo "active";
                } ?>">
                    <a href="myAccount.php?myWishList">
                        <i class="fas fa-heart"></i>&nbsp;My WishList
                    </a>
                </li>

                <li class="<?php if (isset($_GET['changePass'])) {
                    echo "active";
                } ?>">
                    <a href="myAccount.php?changePass">
                        <i class="fas fa-lock"></i>&nbsp;Change Password
                    </a>
                </li>

                <li class="<?php if (isset($_GET['delAccount'])) {
                    echo "active";
                } ?>">
                    <a href="myAccount.php?delAccount">
                        <i class="fas fa-trash-alt"></i>&nbsp;Delete Account
                    </a>
                </li>

                <li>
                    <a href="logout.php">
                        <i class="fas fa-sign-out-alt"></i>&nbsp;Logout
                    </a>
                </li>

            </ul><!-- /nav-pills -->
        </div><!-- /panel-body -->
    </div><!-- /panel panel-default sidebar-menu -->

    <?php
}

?>