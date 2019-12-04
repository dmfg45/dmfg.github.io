<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 04/12/2018
 * Time: 17:55
 */

include_once 'includes/db.php';
include 'functions/functions.php';
session_start();

?>

<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Store</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

</head>
<body>

<?php include 'includes/top.php' ?>

<?php include "includes/navbar.php"; ?>

<div id="content"><!-- content -->
    <div class="container"><!-- container -->
        <div class="col-md-12"><!-- col-md-12 -->
            <ul class="breadcrumb"><!-- breadcrumb -->
                <li><a href="index.php">Home</a></li>
                <li>Contact Us</li>
            </ul><!-- /breadcrumb -->
        </div><!-- /col-md-12 -->

        <div class="col-md-12"><!-- col-md-12 -->
            <div class="services row">
                <?php
                $getServices  = "select * from onlinestore.services";
                $servicesQuery = mysqli_query($connection,$getServices);

                while ($servicesRow = mysqli_fetch_array($servicesQuery)){
                    $serviceId = $servicesRow['service_id'];
                    $serviceTitle = $servicesRow['service_title'];
                    $serviceImage = $servicesRow['service_image'];
                    $serviceDesc = $servicesRow['service_description'];
                    $serviceButton = $servicesRow['service_button'];
                    $serviceUrl = $servicesRow['service_url'];
                    ?>
                    <div class="col-md-4 col-sm-6 box">
                        <img src="adminArea/servicesImages/<?php echo $serviceImage ?>" alt="ServiceImg" class="img-responsive" width="400" height="400">
                        <h2 align="center"><?php echo $serviceTitle ?></h2>
                        <p><?php echo $serviceDesc ?></p>
                        <div class="text-center">
                            <a href="<?php echo $serviceUrl ?>" class="btn btn-primary"><?php echo $serviceButton?></a>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div><!-- /col-md-12 -->

    </div><!-- /container -->
</div><!-- /content -->

<?php include "includes/footer.php" ?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
