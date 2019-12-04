<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 09/11/2018
 * Time: 19:55
 */
session_start();

include_once 'includes/db.php';
include 'functions/functions.php';

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

<div class="container" id="slider"><!-- container -->
    <div class="col-md-12"><!-- col-md-12r -->
        <div id="myCarousel" class="carousel slide" data-ride="carousel"><!-- carousel -->
            <ol class="carousel-indicators"><!-- carousel-indicators -->
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
            </ol><!-- /carousel-indicators -->
            <div class="carousel-inner"><!-- carousel-inner -->

                <?php
                $get_slides = "SELECT * FROM onlinestore.slider LIMIT 0, 1";

                $run_slides = mysqli_query($connection, $get_slides);

                while ($row = mysqli_fetch_array($run_slides)) {
                    $slide_name = $row['slide_name'];
                    $slide_image = $row['slider_image'];
                    $slide_url = $row['slide_url']

                    ?>


                    <div class="item active">
                        <a href="<?php echo $slide_url ?>" target="_blank"><img
                                    src="adminArea/slidesImages/<?php echo $slide_image ?>" alt=""></a>
                    </div>

                    <?php

                }

                ?>
                <?php

                $get_slides = "SELECT * FROM onlinestore.slider LIMIT 1, 3";

                $run_slides = mysqli_query($connection, $get_slides);

                while ($row = mysqli_fetch_array($run_slides)) {
                    $slide_name = $row['slide_name'];
                    $slide_image = $row['slider_image'];
                    $slide_url = $row['slide_url']
                    ?>
                    <div class="item">
                        <a href="<?php echo $slide_url ?>" target="_blank"><img
                                    src="adminArea/slidesImages/<?php echo $slide_image ?>" alt=""></a>
                    </div>
                <?php } ?>
            </div><!-- /carousel-inner -->
            <a href="#myCarousel" class="carousel-control left" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only"> Previous </span>
            </a>
            <a href="#myCarousel" class="carousel-control right" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only"> Next </span>
            </a>
        </div><!-- /carousel -->
    </div><!-- /col-md-12 -->
</div><!-- /container -->
<div id="advantages"><!-- advantages -->
    <div class="container"><!-- container -->
        <div class="same-height-row"><!-- /same-height-row -->

            <?php

            getBoxes()

            ?>

        </div><!-- /same-height-row -->
    </div><!-- /container -->
</div><!-- /advantages -->

<div id="hot"><!-- Hot -->
    <div class="box"><!-- Box -->
        <div class="container"><!-- container -->
            <div class="col-md-12"><!-- col-md-12 -->
                <h2>Latest this week</h2>
            </div><!-- /col-md-12 -->
        </div><!-- /container -->
    </div><!-- /Box -->
</div><!-- /Hot -->

<div id="content" class="container"><!-- content -->
    <div class="row flex-wrap"><!-- row -->

        <?php

        getPro();

        ?>

    </div><!-- /row -->
</div><!-- /content -->

<?php include "includes/footer.php" ?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>
