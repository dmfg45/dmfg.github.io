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
    $i = 0;
    $zonesIds = $_POST['zonesIds'];
    foreach ($zonesIds as $zoneId){
        $i++;
        $updateZoneOrder = "update onlinestore.zones set zone_order = $i where zone_id = $zoneId";
        $zoneOrderQuery = mysqli_query($connection,$updateZoneOrder);

    }
    ?>

    <?php
}
