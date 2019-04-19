<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 27/03/2019
 * Time: 23:31
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
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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

<div id="content">
    <div class="container">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li><a href="index.php">Home</a></li>
                <li>Terms & Conditions | Refund Policy</li>
            </ul>
        </div>
        <div class="col-md-3">
            <div class="box">
                <ul class="nav nav-pills nav-stacked">
                    <?php

                    $query = "select * from onlinestore.terms limit 0,1";
                    $runQuery = mysqli_query($connection, $query);

                    while ($row = mysqli_fetch_array($runQuery)) {
                        $termTitle = $row['term_title'];
                        $termLink = $row['term_link'];
                        ?>

                        <li class="active">
                            <a data-toggle="pill" href="#<?php echo $termLink ?>">
                                <?php echo $termTitle ?>
                            </a>
                        </li>

                        <?php
                    }
                    ?>

                    <?php

                    $terms = "select * from onlinestore.terms";
                    $runTerms = mysqli_query($connection, $terms);
                    $count = mysqli_num_rows($runTerms);

                    $getTerms = "select * from onlinestore.terms limit 1,$count";
                    $queryTerms = mysqli_query($connection, $getTerms);

                    while ($rowTerms = mysqli_fetch_array($queryTerms)) {
                        $term_Title = $rowTerms['term_title'];
                        $term_Link = $rowTerms['term_link']
                        ?>

                        <li>
                            <a data-toggle="pill" href="#<?php echo $term_Link ?>">
                                <?php echo $term_Title ?>
                            </a>
                        </li>

                        <?php
                    }
                    ?>

                </ul>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box">
                <div class="tab-content">
                    <?php

                    $query_term = "select * from onlinestore.terms limit 0,1";
                    $runQueryTerm = mysqli_query($connection, $query_term);

                    while ($rowTerm = mysqli_fetch_array($runQueryTerm)) {
                        $term_title = $rowTerm['term_title'];
                        $term_desc = $rowTerm['term_desc'];
                        $term_link = $rowTerm['term_link'];

                        ?>

                        <div id="<?php echo $term_link ?>" class="tab-pane fade in active">
                            <h1><?php echo $term_title ?></h1>
                            <br>
                            <p class="text-justify"><?php echo $term_desc ?></p>
                        </div>
                        <?php
                    }
                    ?>

                    <?php

                    $countTerms = "select * from onlinestore.terms";
                    $runCount = mysqli_query($connection,$countTerms);
                    $count = mysqli_num_rows($runCount);

                    $getCountTerms = "select * from onlinestore.terms limit 1,$count";

                    $runCountTerms = mysqli_query($connection,$getCountTerms);

                    while ($row_Term = mysqli_fetch_array($runCountTerms)) {
                        $term_title = $row_Term['term_title'];
                        $term_desc = $row_Term['term_desc'];
                        $term_link = $row_Term['term_link'];

                        ?>

                        <div id="<?php echo $term_link ?>" class="tab-pane fade in">
                            <h1><?php echo $term_title ?></h1>
                            <br>
                            <p class="text-justify"><?php echo $term_desc ?></p>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php" ?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>


</body>
</html>
