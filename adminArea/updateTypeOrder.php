<?php
session_start();
include "includes/db.php";

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {

    $i = 0;
    $types_ids = $_POST['types_ids'];
    $type_local = $_POST['type_local'];

    foreach ($types_ids as $type_id){
        $i++;
        $updateTypeOrder = "update onlinestore.shipping_types set type_order = $i where type_id = $type_id and type_local = '$type_local'";
        $query = mysqli_query($connection,$updateTypeOrder);


    }

}