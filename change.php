<?php
session_start();
?>
<?php include 'includes/db.php' ?>
<?php include 'functions/functions.php' ?>

<?php

$ipAdd = getUserIpAddress();

if (isset($_POST['id'])){
    $id = $_POST['id'];
    $qty = $_POST['qty'];
    $shipping_type = $_POST['shipping_type'];
    $shipping_cost = $_POST['shipping_cost'];
    $_SESSION['shipping_type'] = $shipping_type;
    $_SESSION['shipping_cost'] = $shipping_cost;
    $changeQty = "update onlinestore.cart set qty = $qty where p_id = $id and ip_add = '$ipAdd'";
    $query = mysqli_query($connection,$changeQty);

    if ($query){
        echo totalPrice();
    }


}