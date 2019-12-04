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

require "includes/db.php";

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


    $query = "select * from onlinestore.orders where order_status = 'pending'";
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
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Admin Area</title>

        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
              integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
              crossorigin="anonymous">
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/jquery-ui.min.js"></script>

    </head>
    <body>

    <div id="wrapper">
        <?php include "includes/sidebar.php" ?>
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php

                if (isset($_GET['dashboard'])) {
                    include "dashboard.php";

                } /* Start Products Section*/

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

                } /* Start Product Category Section*/

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


                } /* Start Categories Section*/

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


                } /* Start Box Section*/

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


                } /* Start Slides Section*/

                elseif (isset($_GET['viewSlides'])) {
                    include "viewSlides.php";

                } elseif (isset($_GET['insertSlide'])) {
                    include "insertSlide.php";

                }
                elseif (isset($_GET['deleteSlide'])){
                $slideId = $_GET['deleteSlide'];

                $query = "delete from onlinestore.slider where slider_id = $slideId";
                $rowQuery = mysqli_query($connection, $query);
                ?>
                    <script>alert("Slide Deleted")</script>
                    <script>window.open("index.php?viewSlides", "_self")</script>
                <?php
                } elseif (isset($_GET['editSlide'])) {

                    include "editSlide.php";

                    /* End Slides Section*/


                }               /* Start Terms & Conditions Section*/

                elseif (isset($_GET['viewTerms'])) {
                    include "viewTerms.php";

                } elseif (isset($_GET['insertTerm'])) {
                    include "insertTerm.php";

                }
                elseif (isset($_GET['deleteTerm'])){
                $termId = $_GET['deleteTerm'];

                $query = "delete from onlinestore.terms where term_id = $termId";
                $rowQuery = mysqli_query($connection, $query);
                ?>
                    <script>alert("Term Deleted")</script>
                    <script>window.open("index.php?viewTerms", "_self")</script>
                <?php
                } elseif (isset($_GET['editTerm'])) {

                    include "editTerm.php";

                    /* End Terms & Conditions Section*/

                    /* Start CSS Edit File Section*/

                } elseif (isset($_GET['editCss'])) {
                    include "editCss.php";

                }/* CSS Edit File Section*/

                /* Start Customers Section*/

                elseif (isset($_GET['viewCustomers'])) {

                    include "viewCustomers.php";

                }
                elseif (isset($_GET['deleteCustomer'])){
                $customerId = $_GET['deleteCustomer'];

                $query = "delete from onlinestore.customers where customer_id = $customerId";
                $runQuery = mysqli_query($connection, $query);
                ?>
                    <script>alert("Customer Deleted")</script>
                    <script>window.open("index.php?viewCustomers", "_self")</script>
                <?php

                /* End Customers Section*/


                }

                /* Start Orders Section*/

                elseif (isset($_GET['viewOrders'])) {
                    include "viewOrders.php";
                }
                elseif (isset($_GET['deleteOrder'])){
                $orderId = $_GET['deleteOrder'];

                $query = "delete from onlinestore.pending_orders where order_id = $orderId";
                $runQuery = mysqli_query($connection, $query);
                ?>
                    <script>alert("Order Deleted")</script>
                    <script>window.open("index.php?viewOrders", "_self")</script>
                <?php

                /* End Customers Section*/


                }

                /* Start Payments Section*/

                elseif (isset($_GET['viewPayments'])) {
                    include "viewPayments.php";
                }
                elseif (isset($_GET['deletePayment'])){
                $paymentId = $_GET['deletePayment'];

                $query = "delete from onlinestore.payments where payment_id = $paymentId";
                $runQuery = mysqli_query($connection, $query);
                ?>
                    <script>alert("Payment Deleted")</script>
                    <script>window.open("index.php?viewPayments", "_self")</script>
                <?php

                /* End Payments Section*/


                }

                /* Start Users Section*/

                elseif (isset($_GET['insertUser'])) {
                    include "insertUsers.php";
                } elseif (isset($_GET['viewUsers'])) {
                    include "viewUsers.php";
                }
                elseif (isset($_GET['deleteAdmin'])){
                $userId = $_GET['deleteAdmin'];

                $query = "delete from onlinestore.admins where admin_id = $userId";
                $runQuery = mysqli_query($connection, $query);
                ?>
                    <script>alert("Admin has been Deleted")</script>
                    <script>window.open("index.php?viewUsers", "_self")</script>
                <?php
                } elseif (isset($_GET['userProfile'])) {
                    include "userProfile.php";
                } /* Start Manufacturers Section*/


                elseif (isset($_GET['insertManufacturer'])) {
                    include "insertManufacturer.php";
                } elseif (isset($_GET['viewManufacturers'])) {
                    include "viewManufacturers.php";
                }

                elseif (isset($_GET['deleteManufacturer'])){
                $manufacturerId = $_GET['deleteManufacturer'];

                $query = "delete from onlinestore.manufacturers where manufacturer_id = $manufacturerId";
                $runQuery = mysqli_query($connection, $query);
                ?>
                    <script>alert("Manufacturer has been Deleted")</script>
                    <script>window.open("index.php?viewManufacturers", "_self")</script>
                <?php
                }

                elseif (isset($_GET['editManufacturer'])) {
                    include "editManufacturers.php";

                } /* Start Coupons Section*/


                elseif (isset($_GET['insertCoupon'])) {
                    include "insertCoupons.php";
                } elseif (isset($_GET['viewCoupons'])) {
                    include "viewCoupons.php";
                }

                elseif (isset($_GET['deleteCoupon'])){
                $couponId = $_GET['deleteCoupon'];

                $query = "delete from onlinestore.coupons where coupon_id = $couponId";
                $runQuery = mysqli_query($connection, $query);
                ?>
                    <script>alert("Coupon has been Deleted")</script>
                    <script>window.open("index.php?viewCoupons", "_self")</script>
                <?php
                }

                elseif (isset($_GET['editCoupon'])) {
                    include "editCoupon.php";
                } /* Start Icons Section*/


                elseif (isset($_GET['insertIcon'])) {
                    include "insertIcon.php";
                } elseif (isset($_GET['viewIcons'])) {
                    include "viewIcons.php";
                }

                elseif (isset($_GET['deleteIcon'])){
                $iconId = $_GET['deleteIcon'];

                $query = "delete from onlinestore.icons where icon_id = $iconId";
                $runQuery = mysqli_query($connection, $query);
                ?>
                    <script>alert("Icon has been Deleted")</script>
                    <script>window.open("index.php?viewIcons", "_self")</script>
                <?php
                }

                elseif (isset($_GET['editIcon'])) {
                    include "editIcon.php";
                } /* Start Bundles Section*/

                elseif (isset($_GET['insertBundle'])) {
                    include "insertBundle.php";
                } elseif (isset($_GET['viewBundles'])) {
                    include "viewBundles.php";
                }

                elseif (isset($_GET['deleteBundle'])){
                $bundleId = $_GET['deleteBundle'];
                $query = "delete from onlinestore.products where product_id = $bundleId";
                $runQuery = mysqli_query($connection, $query);
                $deleteRel = "delete from onlinestore.bundle_product_relations where bundle_id = $bundleId";
                $runRelQuery = mysqli_query($connection, $deleteRel);
                ?>
                    <script>alert("Bundle has been Deleted")</script>
                    <script>window.open("index.php?viewBundles", "_self")</script>
                <?php
                }

                elseif (isset($_GET['editBundle'])) {
                    include "editBundle.php";
                } /* Start Bundle Relation Section*/

                elseif (isset($_GET['insertRelation'])) {
                    include "insertRelation.php";
                } elseif (isset($_GET['viewRelations'])) {
                    include "viewRelations.php";
                }

                elseif (isset($_GET['deleteRelation'])){
                $relId = $_GET['deleteRelation'];
                $query = "delete from onlinestore.bundle_product_relations where rel_id = $relId";
                $runQuery = mysqli_query($connection, $query);
                ?>
                    <script>alert("Relation has been Deleted")</script>
                    <script>window.open("index.php?viewRelations", "_self")</script>
                <?php
                }

                elseif (isset($_GET['editRelation'])) {
                    include "editRelation.php";
                } /* Start Contact Us Section*/

                elseif (isset($_GET['editContactUs'])) {
                    include "editContactUs.php";
                } elseif (isset($_GET['insertEnquiry'])) {
                    include "insertEnquiry.php";
                } elseif (isset($_GET['viewEnquiries'])) {
                    include "viewEnquiries.php";
                }

                elseif (isset($_GET['deleteEnquiry'])){
                $enquiryId = $_GET['deleteEnquiry'];
                $query = "delete from onlinestore.enquiry_types where enquiry_id = $enquiryId";
                $runQuery = mysqli_query($connection, $query);
                ?>
                    <script>alert("Enquiry has been Deleted")</script>
                    <script>window.open("index.php?viewEnquiries", "_self")</script>
                <?php
                }

                elseif (isset($_GET['editEnquiry'])) {
                    include "editEnquiry.php";
                } /* Start Services Section*/

                elseif (isset($_GET['insertService'])) {
                    include "insertService.php";
                } elseif (isset($_GET['editService'])) {
                    include "editService.php";
                } elseif (isset($_GET['viewServices'])) {
                    include "viewServices.php";
                }

                elseif (isset($_GET['deleteService'])){
                $serviceId = $_GET['deleteService'];
                $query = "delete from onlinestore.services where service_id = $serviceId";
                $runQuery = mysqli_query($connection, $query);
                ?>
                    <script>alert("Service has been Deleted")</script>
                    <script>window.open("index.php?viewServices", "_self")</script>
                <?php
                }

                elseif (isset($_GET['editEnquiry'])) {
                    include "editEnquiry.php";
                } /* Start About Us Section*/

                elseif (isset($_GET['editAboutUs'])) {
                    include "editAboutUs.php";
                } /* Start Shipping Section*/

                elseif (isset($_GET['insertShippingZone'])) {
                    include "insertShippingZone.php";
                } elseif (isset($_GET['viewShippingZones'])) {
                    include "viewShippingZones.php";
                } elseif (isset($_GET['editShippingZone'])) {
                    include "editShippingZone.php";
                }
                elseif (isset($_GET['deleteShippingZone'])) {
                $shippingZoneId = $_GET['deleteShippingZone'];
                $query = "delete from onlinestore.zones where zone_id = $shippingZoneId";
                $runQuery = mysqli_query($connection, $query);
                if ($runQuery) {
                    $deleteZoneLocations = "delete from onlinestore.zone_locations where zone_id = $shippingZoneId";
                    $deleteQuery = mysqli_query($connection, $deleteZoneLocations);
                }
                ?>
                    <script>alert("Shipping Zone has been Deleted")</script>
                    <script>window.open("index.php?viewShippingZones", "_self")</script>
                    <?php
                } elseif (isset($_GET['insertShippingType'])) {
                    include "insertShippingType.php";

                } elseif (isset($_GET['viewShippingTypes'])) {
                    include "viewShippingTypes.php";
                } elseif (isset($_GET['editShippingType'])) {
                    include "editShippingType.php";
                } elseif (isset($_GET['deleteShippingType'])) {
                    $typeId = $_GET['deleteShippingType'];
                    $query = "delete from onlinestore.shipping_types where type_id = $typeId";
                    $runQuery = mysqli_query($connection,$query);
                    if ($runQuery){
                        $deleteShipping = "delete from onlinestore.shipping where shipping_type = $typeId";
                        $runQuery = mysqli_query($connection,$deleteShipping);
                        ?>
                    <script>alert("Shipping Type has been Deleted")</script>
                    <script>window.open("index.php?viewShippingTypes", "_self")</script>
                <?php
                    }
                }elseif (isset($_GET['editShippingRates'])){
                    include "editShippingRates.php";
                }

                ?>

            </div>
        </div>
    </div>


    <script src="js/bootstrap.min.js"></script>

    </body>
    </html>

    <?php

}

?>
