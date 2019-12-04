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
                <li>About Us</li>
            </ul><!-- /breadcrumb -->
        </div><!-- /col-md-12 -->

        <div class="col-md-12"><!-- col-md-12 -->
            <div class="box"><!-- box -->
                        <?php
                        $getAboutUs = "select * from onlinestore.about_us";
                        $query = mysqli_query($connection,$getAboutUs);
                        $rowAboutUs = mysqli_fetch_array($query);
                        $aboutHeading = $rowAboutUs['about_heading'];
                        $aboutShortDesc = $rowAboutUs['about_short_desc'];
                        $aboutDesc = $rowAboutUs['about_desc'];
                        ?>
                        <h1><?php echo $aboutHeading ?></h1>
                <p class="lead text-justify"><?php echo $aboutShortDesc ?></p>
                <p class="text-justify"><?php echo $aboutDesc ?></p>
            </div><!-- /box -->
        </div><!-- /col-md-12 -->

    </div><!-- /container -->
</div><!-- /content -->

<?php include "includes/footer.php" ?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
