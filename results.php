<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

?>
<!DOCTYPE html>
<html>

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

<div id="content" ><!-- content Starts -->
    <div class="container" ><!-- container Starts -->

        <div class="col-md-12" ><!--- col-md-12 Starts -->

            <ul class="breadcrumb" ><!-- breadcrumb Starts -->

                <li>
                    <a href="index.php">Home</a>
                </li>

                <li>Search Results</li>

            </ul><!-- breadcrumb Ends -->



        </div><!--- col-md-12 Ends -->

        <div class="col-md-12" ><!-- col-md-12 Starts --->

            <div class="row" id="Products" ><!-- row Starts -->

                <?php

                if(isset($_GET['search'])){

                    $user_keyword = $_GET['user_query'];

                    $get_products = "select * from products where product_keywords like '%$user_keyword%'";

                    $run_products = mysqli_query($connection,$get_products);

                    $count = mysqli_num_rows($run_products);

                    if($count==0){

                        echo "

<div class='box'>

<h2>No Search Results Found</h2>

</div>

";

                    }else{

                        while($row_products=mysqli_fetch_array($run_products)){

                            $pro_id = $row_products['product_id'];

                            $pro_title = $row_products['product_title'];

                            $pro_price = $row_products['product_price'];

                            $pro_img1 = $row_products['product_img1'];

                            $pro_label = $row_products['product_label'];

                            $manufacturer_id = $row_products['manufacturer_id'];

                            $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";

                            $run_manufacturer = mysqli_query($connection,$get_manufacturer);

                            $row_manufacturer = mysqli_fetch_array($run_manufacturer);

                            $manufacturer_name = $row_manufacturer['manufacturer_title'];

                            $pro_psp_price = $row_products['product_psp_price'];

                            $pro_url = $row_products['product_url'];


                            if($pro_label == "Sale" or $pro_label == "Gift"){

                                $product_price = "<del> $$pro_price </del>";

                                $product_psp_price = "| $$pro_psp_price";

                            }
                            else{

                                $product_psp_price = "";

                                $product_price = "$$pro_price";

                            }


                            if($pro_label == ""){


                            }
                            else{

                                $product_label = "

<a class='label sale' href='#' style='color:black;'>

<div class='theLabel'>$pro_label</div>

<div class='label-background'> </div>

</a>

";

                            }


                            echo "

<div class='col-md-3 col-sm-6 center-responsive' >

<div class='product' >

<a href='$pro_url' >

<img src='adminArea/productImages/$pro_img1' class='img-responsive' >

</a>

<div class='text' >

<div class='text-center'>

<p class='btn btn-primary'> $manufacturer_name </p>

</div>

<hr>

<h3><a href='$pro_url' >$pro_title</a></h3>

<p class='price' > $product_price $product_psp_price </p>

<p class='buttons' >

<a href='$pro_url' class='btn btn-default' >View details</a>

<a href='$pro_url' class='btn btn-primary'>

<i class='fa fa-shopping-cart'></i> Add to cart

</a>


</p>

</div>

$product_label


</div>

</div>

";

                        }

                    }

                }
                ?>

            </div><!-- row Ends -->

        </div><!-- col-md-9 Ends --->

    </div><!-- container Ends -->

</div><!-- content Ends -->


<?php

include("includes/footer.php");

?>

<script src="js/jquery-3.3.1.min.js"></script>

<script src="js/bootstrap.min.js"></script>


</body>

</html>