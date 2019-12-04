<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 04/12/2018
 * Time: 21:15
 */
?>
<?php
session_start();

if(!isset($_SESSION['customer_email'])) {

    echo "<script>window.open('../checkout.php','_self')</script>";

} else {
?>
<?php
    include "customerPage.php";
    ?>

<?php }