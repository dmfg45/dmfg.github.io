<?php /**
 * Created by PhpStorm.
 * User: Andre
 * Date: 19/12/2018
 * Time: 00:26
 */ ?>
<?php if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>


    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Insert Products</title>
        <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
        <script>tinymce.init({selector: 'textarea'});</script>


        <!--    <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">-->
    </head>
    <body>

    <?php

    if (isset($_GET['editProduct'])) {
        $productId = $_GET['editProduct'];

        $query = "select * from onlinestore.products where product_id = $productId";
        $runQuery = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($runQuery);

        $productTitle = $row['product_title'];
        $productPrice = $row['product_price'];
        $productImg1 = $row['product_img1'];
        $productImg2 = $row['product_img2'];
        $productImg3 = $row['product_img3'];
        $productKeywords = $row['product_keywords'];
        $productDescription = $row['product_keywords'];
        $productCat = $row['p_cat_id'];
    }

    ?>
    <div class="row"><!-- row  -->
        <div class="col-md-12"><!-- col-md-12  -->
            <ol class="breadcrumb"><!-- breadcrumb  -->
                <li class="active">
                    <i class="fa fa-tachometer-alt"></i>&nbsp;Dashboard / Edit Products
                </li>
            </ol><!-- /breadcrumb  -->
        </div><!-- /col-md-12  -->
    </div><!-- /row  -->

    <div class="row"><!-- row  -->
        <div class="col-lg-12"><!-- col-lg-12  -->
            <div class="panel panel-default"><!-- panel  -->
                <div class="panel-heading"><!-- panel-heading  -->
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill-alt fa-fw"></i>&nbsp;Edit Products
                    </h3>
                </div><!-- /panel-heading  -->
                <div class="panel-body"><!-- panel-body  -->
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">


                        <!-- form-horizontal  -->
                        <div class="form-group"><!-- form-group  -->
                            <label for="" class="col-md-3 control-label">Product Title</label>
                            <div class="col-md-6">
                                <input type="text" name="product_title" class="form-control"
                                       value="<?php echo $productTitle ?>" required>
                            </div>
                        </div><!-- /form-group  -->
                        <div class="form-group"><!-- form-group  -->
                            <label for="" class="col-md-3 control-label">Product Category</label>
                            <div class="col-md-6">
                                <select name="product_category" id="" class="form-control">
                                    <?php
                                    $pCQuery = "SELECT * FROM onlinestore.product_categories where p_cat_id = $productCat";

                                    $selectPCategories = mysqli_query($connection, $pCQuery);

                                    $rowPCategory = mysqli_fetch_array($selectPCategories);

                                    $productCatName = $rowPCategory['p_cat_title'];

                                    ?>
                                    <option value="<?php echo $productCat ?>">
                                        <?php echo $productCatName ?>
                                    </option>

                                    <?php
                                    $query = "SELECT * FROM onlinestore.product_categories";

                                    $selectCategories = mysqli_query($connection, $query);

                                    while ($row = mysqli_fetch_array($selectCategories)) {
                                        $categoryId = $row['p_cat_id'];
                                        $categoryName = $row['p_cat_title'];

                                        ?>


                                        <option value="<?php echo $categoryId ?>">
                                            <?php echo $categoryName ?>
                                        </option>

                                        <?php
                                    }


                                    ?>
                                </select>
                            </div>
                        </div><!-- /form-group  -->
                        <div class="form-group"><!-- form-group  -->
                            <label for="" class="col-md-3 control-label">Category</label>
                            <div class="col-md-6">
                                <select name="category" id="" class="form-control">
                                    <option value="">Select Category</option>

                                    <?php
                                    $query = "SELECT * FROM onlinestore.categories";

                                    $selectCategories = mysqli_query($connection, $query);

                                    while ($row = mysqli_fetch_array($selectCategories)) {
                                        $categoryId = $row['cat_id'];
                                        $categoryName = $row['cat_title'];

                                        ?>

                                        <option value="<?php echo $categoryId ?>">
                                            <?php echo $categoryName ?>
                                        </option>

                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div><!-- /form-group  -->
                        <div class="form-group"><!-- form-group  -->
                            <label for="" class="col-md-3 control-label">Product Image 1</label>
                            <div class="col-md-6">
                                <img src="productImages/<?php echo $productImg1 ?>" alt="ProductIMG" width="100"
                                     height="100">
                                <input type="file" name="product_img1" class="form-control" required>
                            </div>
                        </div><!-- /form-group  -->
                        <div class="form-group"><!-- form-group  -->
                            <label for="" class="col-md-3 control-label">Product Image 2</label>
                            <div class="col-md-6">
                                <img src="productImages/<?php echo $productImg2 ?>" alt="ProductIMG" width="100"
                                     height="100">
                                <input type="file" name="product_img2" class="form-control" required>
                            </div>
                        </div><!-- /form-group  -->
                        <div class="form-group"><!-- form-group  -->
                            <label for="" class="col-md-3 control-label">Product Image 3</label>
                            <div class="col-md-6">
                                <img src="productImages/<?php echo $productImg3 ?>" alt="ProductIMG" width="100"
                                     height="100">
                                <input type="file" name="product_img3" class="form-control" required>
                            </div>
                        </div><!-- /form-group  -->
                        <div class="form-group"><!-- form-group  -->
                            <label for="" class="col-md-3 control-label">Product Price</label>
                            <div class="col-md-6">
                                <input type="text" name="product_price" class="form-control"
                                       value="<?php echo $productPrice ?>" required>
                            </div>
                        </div><!-- /form-group  -->
                        <div class="form-group"><!-- form-group  -->
                            <label for="" class="col-md-3 control-label">Product Keywords</label>
                            <div class="col-md-6">
                                <input type="text" name="product_keywords" class="form-control"
                                       value="<?php echo $productKeywords ?>" required>
                            </div>
                        </div><!-- /form-group  -->
                        <div class="form-group"><!-- form-group  -->
                            <label for="" class="col-md-3 control-label">Product Description</label>
                            <div class="col-md-6">
                                <textarea name="product_desc" id="" cols="30" rows="10"
                                          class="form-control"><?php echo $productDescription ?>"</textarea>
                            </div>
                        </div><!-- /form-group  -->
                        <div class="form-group"><!-- form-group  -->
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <input type="submit" name="update" class="btn btn-primary form-control"
                                       value="Update Product">
                            </div>
                        </div><!-- /form-group  -->
                    </form><!-- /form-horizontal  -->
                </div><!-- /panel-body  -->
            </div><!-- /panel  -->
        </div><!-- /col-lg-12  -->
    </div><!-- /row  -->
    </body>
    </html>

    <?php
    if (isset($_GET['editProduct'])) {
        $productId = $_GET['editProduct'];

        if (isset($_POST['update'])) {

            $productTitle = $_POST['product_title'];
            $productCategory = $_POST['product_category'];
            $category = $_POST['category'];
            $productPrice = $_POST['product_price'];
            $productKeywords = $_POST['product_keywords'];
            $productDescription = $_POST['product_desc'];

            $productImage1 = $_FILES['product_img1']['name'];
            $productImage2 = $_FILES['product_img2']['name'];
            $productImage3 = $_FILES['product_img3']['name'];

            $tmp_name1 = $_FILES['product_img1']['tmp_name'];
            $tmp_name2 = $_FILES['product_img2']['tmp_name'];
            $tmp_name3 = $_FILES['product_img3']['tmp_name'];

            move_uploaded_file($tmp_name1, "productImages/$productImage1");
            move_uploaded_file($tmp_name2, "productImages/$productImage2");
            move_uploaded_file($tmp_name3, "productImages/$productImage3");


            $query = "update onlinestore.products set 
                                product_title = '$productTitle', 
                                product_description = '$productDescription', 
                                product_keywords = '$productKeywords', 
                                prod_date = now(), 
                                product_price = $productPrice, 
                                p_cat_id = $productCategory, 
                                cat_id = $category, 
                                product_img1 = '$productImage1', 
                                product_img2 = '$productImage2', 
                                product_img3 = '$productImage3' where product_id = $productId ";

            $update = mysqli_query($connection, $query);

            if ($update) {
                ?>
                <script>alert("Product has been updated successfully")</script>
                <script>window.open("index.php?viewProducts")</script>
                <?php
            } else {
                die("error: -> " . mysqli_error($connection));
            }
        }

    }

    ?>

<?php }