<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 13/03/2019
 * Time: 05:39
 */
?>

<?php

session_start();

include "includes/db.php";

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

    <?php

    $adminSession = $_SESSION['admin_email'];

    $getAdmin = "select * from onlinestore.admins where admin_email = '$adminSession'";

    $runAdmins = mysqli_query($connection, $getAdmin);

    $rowAdmin = mysqli_fetch_array($runAdmins);

    $adminId = $rowAdmin['admin_id'];
    $adminName = $rowAdmin['admin_name'];
    $adminEmail = $rowAdmin['admin_email'];
    $adminImage = $rowAdmin['admin_image'];
    $adminCountry = $rowAdmin['admin_country'];
    $adminContact = $rowAdmin['admin_contact'];
    $adminJob = $rowAdmin['admin_job'];
    $adminAbout = $rowAdmin['admin_about'];


    $query = "select * from onlinestore.products";
    $runQuery = mysqli_query($connection, $query);
    $countProducts = mysqli_num_rows($runQuery);


    $query = "select * from onlinestore.product_categories";
    $runQuery = mysqli_query($connection, $query);
    $countProductCat = mysqli_num_rows($runQuery);

    $query = "select * from onlinestore.customers";
    $runQuery = mysqli_query($connection, $query);
    $countCustomers = mysqli_num_rows($runQuery);


    $query = "select * from onlinestore.pending_orders";
    $runQuery = mysqli_query($connection, $query);
    $countPendingOrders = mysqli_num_rows($runQuery);

//    $countProducts = getDbCountInfo('onlinestore.products');
//
//    $countCustomers = getDbCountInfo('onlinestore.customers');
//
//    $countProductCat = getDbCountInfo('onlinestore.product_categories');


    ?>

    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Area</title>

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
              integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
              crossorigin="anonymous">

    </head>
    <body>

    <div id="wrapper">
        <?php include "includes/sidebar.php" ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php

                if (isset($_GET['dashboard'])) {
                    include "dashboard.php";

                }

                /* Start Products Section*/

                elseif (isset($_GET['insertProduct'])) {
                    include "insert_product.php";

                } elseif (isset($_GET['viewProducts'])) {
                    include "viewProducts.php";

                }elseif (isset($_GET["deleteProduct"])) {

                    $productId = $_GET['deleteProduct'];

                    $query = "delete from onlinestore.products where product_id = $productId";
                    $runQuery = mysqli_query($connection, $query);
                    ?>
                    <script>alert("Product Deleted")</script>
                    <script>window.open("index.php?viewProducts", "_self")</script>
                <?php

                } elseif (isset($_GET['editProduct'])) {
                    include "edit_product.php";

                    /* End Products Section*/

                }

                /* Start Product Category Section*/

                elseif (isset($_GET['insertProductCat'])) {
                    include "insertProductCat.php";

                } elseif (isset($_GET['viewProductCat'])) {
                    include "viewProductCat.php";
                }
                elseif (isset($_GET['deleteProductCat'])){
                $productCatId = $_GET['deleteProductCat'];

                $query = "delete from onlinestore.product_categories where p_cat_id = $productCatId";
                $runQuery = mysqli_query($connection, $query);
                ?>
                    <script>alert("Product Category Deleted")</script>
                    <script>window.open("index.php?viewProductCat", "_self")</script>
                <?php
                } elseif (isset($_GET['editProductCat'])) {
                    include "editProductCat.php";

                    /* End Product Category Section*/


                }

                /* Start Categories Section*/

                elseif (isset($_GET['viewCategories'])) {
                    include "viewCategories.php";

                } elseif (isset($_GET['insertCategory'])) {
                    include "insertCategory.php";
                }
                elseif (isset($_GET['deleteCat'])){
                $catId = $_GET['deleteCat'];

                $query = "delete from onlinestore.categories where cat_id = $catId";
                $runQuery = mysqli_query($connection, $query);

                ?>
                    <script>alert("Category Deleted")</script>
                    <script>window.open("index.php?viewCategories", "_self")</script>
                    <?php
                } elseif (isset($_GET['editCat'])) {
                    include "editCategory.php";

                        /* End Categories Section*/


                }
                        /* Start Box Section*/

                elseif (isset($_GET['viewBoxes'])) {
                    include "viewBoxes.php";

                } elseif (isset($_GET['insertBox'])) {
                    include "insertBox.php";
                }
                elseif (isset($_GET['deleteBox'])){
                $boxId = $_GET['deleteBox'];

                $query = "delete from onlinestore.boxes_section where box_id = $boxId";
                $runQuery = mysqli_query($connection, $query);

                ?>
                    <script>alert("Box Deleted")</script>
                    <script>window.open("index.php?viewBoxes", "_self")</script>
                    <?php
                } elseif (isset($_GET['editBox'])) {
                    include "editBox.php";

                        /* End Box Section*/


                }

                    /* Start Slides Section*/

                elseif (isset($_GET['viewSlides'])) {
                    include "viewSlides.php";

                } elseif (isset($_GET['insertSlide'])) {
                    include "insertSlide.php";

                }elseif (isset($_GET['deleteSlide'])){
                    $slideId = $_GET['deleteSlide'];

                    $query = "delete from onlinestore.slider where slider_id = $slideId";
                    $rowQuery = mysqli_query($connection,$query);
                    ?>
                    <script>alert("Slide Deleted")</script>
                    <script>window.open("index.php?viewSlides", "_self")</script>
                <?php
                    }elseif (isset($_GET['editSlide'])) {

                    include "editSlide.php";

                    /* End Slides Section*/



                }               /* Start Terms & Conditions Section*/

                elseif (isset($_GET['viewTerms'])) {
                    include "viewSlides.php";

                } elseif (isset($_GET['insertTerm'])) {
                    include "insertTerm.php";

                }elseif (isset($_GET['deleteTerm'])){
                    $termId = $_GET['deleteTerm'];

                    $query = "delete from onlinestore.terms where term_id = $termId";
                    $rowQuery = mysqli_query($connection,$query);
                    ?>
                    <script>alert("Term Deleted")</script>
                    <script>window.open("index.php?viewTerms", "_self")</script>
                <?php
                    }elseif (isset($_GET['editTerm'])) {

                    include "editTerm.php";

                    /* End Terms & Conditions Section*/



                }

                /* Start Customers Section*/

                elseif (isset($_GET['viewCustomers'])){

                    include "viewCustomers.php";

                }elseif (isset($_GET['deleteCustomer'])){
                    $customerId = $_GET['deleteCustomer'];

                    $query = "delete from onlinestore.customers where customer_id = $customerId";
                    $runQuery = mysqli_query($connection,$query);
                    ?>
                    <script>alert("Customer Deleted")</script>
                    <script>window.open("index.php?viewCustomers", "_self")</script>
                    <?php

                    /* End Customers Section*/



                }

                    /* Start Orders Section*/

                elseif (isset($_GET['viewOrders'])){
                    include "viewOrders.php";
                }elseif (isset($_GET['deleteOrder'])){
                    $orderId = $_GET['deleteOrder'];

                    $query = "delete from onlinestore.pending_orders where order_id = $orderId";
                    $runQuery = mysqli_query($connection,$query);
                    ?>
                    <script>alert("Order Deleted")</script>
                    <script>window.open("index.php?viewOrders", "_self")</script>
                    <?php

                    /* End Customers Section*/


                }

                    /* Start Payments Section*/

                elseif (isset($_GET['viewPayments'])){
                    include "viewPayments.php";
                }elseif (isset($_GET['deletePayment'])){
                    $paymentId = $_GET['deletePayment'];

                    $query = "delete from onlinestore.payments where payment_id = $paymentId";
                    $runQuery = mysqli_query($connection,$query);
                    ?>
                    <script>alert("Payment Deleted")</script>
                    <script>window.open("index.php?viewPayments", "_self")</script>
                    <?php

                    /* End Payments Section*/


                }

                    /* Start Users Section*/

                elseif (isset($_GET['insertUser'])){
                    include "insertUsers.php";
                }elseif (isset($_GET['viewUsers'])){
                    include "viewUsers.php";
                }elseif (isset($_GET['deleteAdmin'])){
                    $userId = $_GET['deleteAdmin'];

                    $query = "delete from onlinestore.admins where admin_id = $userId";
                    $runQuery = mysqli_query($connection,$query);
                    ?>
                    <script>alert("Admin has been Deleted")</script>
                    <script>window.open("index.php?viewUsers", "_self")</script>
                    <?php
                }elseif (isset($_GET['userProfile'])){
                    include "userProfile.php";
                }

                /* Start Users Section*/
                ?>

            </div>
        </div>
    </div>

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    </body>
    </html>

    <?php

}

?>
