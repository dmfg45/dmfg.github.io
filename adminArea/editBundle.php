<?php if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>


    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script>tinymce.init({selector: '#productDescription,#productFeatures'});</script>

    <?php

    if (isset($_GET['editBundle'])) {
        $productId = $_GET['editBundle'];

        $query = "select * from onlinestore.products where product_id = $productId";
        $runQuery = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($runQuery);

        $productTitle = $row['product_title'];
        $productPrice = $row['product_price'];
        $productImg1 = $row['product_img1'];
        $productImg2 = $row['product_img2'];
        $productImg3 = $row['product_img3'];
        $newProductImg1 = $row['product_img1'];
        $newProductImg2 = $row['product_img2'];
        $newProductImg3 = $row['product_img3'];
        $productKeywords = $row['product_keywords'];
        $product_description = $row['product_description'];
        $product_features = $row['product_features'];
        $product_media = $row['product_video'];
        $product_seo_desc = $row['product_seo_desc'];
        $product_type = $row['product_type'];
        $product_weight = $row['product_weight'];
        $productCat = $row['p_cat_id'];
        $manufacturer = $row['manufacturer_id'];
        $productSalePrice = $row['product_psp_price'];
        $productLabel = $row['product_label'];
        $productUrl = $row['product_url'];
        $catId = $row['cat_id'];
    }

    ?>
    <div class="row"><!-- row  -->
        <div class="col-md-12"><!-- col-md-12  -->
            <ol class="breadcrumb"><!-- breadcrumb  -->
                <li class="active">
                    <i class="fa fa-tachometer-alt"></i>&nbsp;Dashboard / Edit Bundle
                </li>
            </ol><!-- /breadcrumb  -->
        </div><!-- /col-md-12  -->
    </div><!-- /row  -->

    <div class="row"><!-- row  -->
        <div class="col-lg-12"><!-- col-lg-12  -->
            <div class="panel panel-default"><!-- panel  -->
                <div class="panel-heading"><!-- panel-heading  -->
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill-alt fa-fw"></i>&nbsp;Edit Bundle
                    </h3>
                </div><!-- /panel-heading  -->
                <div class="panel-body"><!-- panel-body  -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Title</label>
                                        <input type="text" name="product_title" class="form-control"
                                               value="<?php echo $productTitle ?>" required>
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Seo Description</label>
                                    <textarea name="productSeoDesc"maxlength="230" placeholder="Most search engines use a maximum of 230 characters for the description."
                                              class="form-control"><?php echo $product_seo_desc ?></textarea>
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Url</label>
                                        <input type="text" name="product_url" class="form-control"
                                               value="<?php echo $productUrl ?>" required>
                                        <br>
                                        <p style="font-size: 15px; font-weight: bold;">
                                            Bundle URL Example: jacket-blue-navy
                                        </p>
                                </div><!-- /form-group  -->
                                <div class="form-group">
                                    <label for="" class="control-label">Bundle Tabs</label>
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a data-toggle="tab" href="#description">Bundle Description</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" href="#features">Bundle Features</a>
                                            </li>
                                            <li>
                                                <a data-toggle="tab" href="#media">Bundle Media</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div id="description" class="tab-pane fade in active">
                                        <textarea name="productDescription" id="productDescription" class="form-control"
                                                  cols="30" rows="15">
                                            <?php echo $product_description ?>
                                        </textarea>
                                            </div>
                                            <div id="features" class="tab-pane fade in">
                                        <textarea name="productFeatures" id="productFeatures" class="form-control"
                                                  rows="15">
                                            <?php echo $product_features ?>
                                        </textarea>
                                            </div>
                                            <div id="media" class="tab-pane fade in">
                                        <textarea name="productMedia" class="form-control" rows="15">
                                            <?php echo $product_media ?>
                                        </textarea>
                                            </div>
                                        </div>
                                </div>
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Weight <small> (kg) </small></label>
                                    <input type="text" name="product_weight" class="form-control" value="<?php echo $product_weight ?>">
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Price</label>
                                    <input type="text" name="product_price" class="form-control"
                                           value="<?php echo $productPrice ?>" required>
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Sale Price</label>
                                    <input type="text" name="product_sale_price" class="form-control"
                                           value="<?php echo $productSalePrice ?>">
                                </div><!-- /form-group  -->
                            </div>
                            <div class="col-md-3">
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Type</label>
                                    <select name="productType" id="" class="form-control">
                                        <?php
                                        if ($product_type == "physicalProduct"){
                                            ?>
                                            <option value="<?php echo $product_type ?>">(Physical Bundle) Simple Bundle</option>
                                            <option value="digitalProduct">(Digital Bundle) Downloadable Bundle</option>
                                            <?php
                                        }elseif ($product_type == "digitalProduct"){
                                            ?>
                                            <option value="<?php echo $product_type ?>">(Digital Bundle) Downloadable Bundle</option>
                                            <option value="physicalProduct">(Physical Bundle) Simple Bundle</option>
                                            <?php
                                        }else{ ?>
                                            <option value="physicalProduct">(Physical Bundle) Simple Bundle</option>
                                            <option value="digitalProduct">(Digital Bundle) Downloadable Bundle</option>
                                        <?php }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Manufacturer</label>
                                        <select name="manufacturer" id="" class="form-control">
                                            <?php
                                            $manufacturerQuery = "SELECT * FROM onlinestore.manufacturers where manufacturer_id = $manufacturer";

                                            $selectManufacturer = mysqli_query($connection, $manufacturerQuery);

                                            $rowManufacturer = mysqli_fetch_array($selectManufacturer);

                                            $manufacturer_id = $rowManufacturer['manufacturer_id'];
                                            $manufacturer_title = $rowManufacturer['manufacturer_title'];

                                            ?>
                                            <option value="<?php echo $manufacturer_id ?>">
                                                <?php echo $manufacturer_title ?>
                                            </option>

                                            <?php
                                            $queryManufacturer = "SELECT * FROM onlinestore.manufacturers where manufacturer_id != $manufacturer_id";

                                            $selectAllManufacturer = mysqli_query($connection, $queryManufacturer);

                                            while ($rowAllManufacturer = mysqli_fetch_array($selectAllManufacturer)) {

                                                $manufacturerId = $rowAllManufacturer['manufacturer_id'];
                                                $manufacturerTitle = $rowAllManufacturer['manufacturer_title'];
                                                ?>


                                                <option value="<?php echo $manufacturerId ?>">
                                                    <?php echo $manufacturerTitle ?>
                                                </option>

                                                <?php
                                            }


                                            ?>
                                        </select>
                                </div>
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Product Category</label>
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
                                            $query = "SELECT * FROM onlinestore.product_categories where p_cat_id != $productCat";

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
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Category</label>
                                        <select name="category" id="" class="form-control">

                                            <?php
                                            $query = "SELECT * FROM onlinestore.categories where cat_id = $catId";

                                            $selectCategories = mysqli_query($connection, $query);

                                            while ($row = mysqli_fetch_array($selectCategories)) {
                                                $category_Id = $row['cat_id'];
                                                $category_Name = $row['cat_title'];

                                                ?>

                                                <option value="<?php echo $category_Id ?>">
                                                    <?php echo $category_Name ?>
                                                </option>

                                                <?php
                                            }
                                            ?>

                                            <?php
                                            $query = "SELECT * FROM onlinestore.categories where cat_id != $catId";

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
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Keywords</label>
                                    <input type="text" name="product_keywords" class="form-control"
                                           value="<?php echo $productKeywords ?>" required>
                                </div><!-- /form-group  -->

                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Label</label>
                                    <input type="text" name="product_label" class="form-control"
                                           value="<?php echo $productLabel ?>" required>
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Image 1</label>
                                    <br>
                                        <img src="productImages/<?php echo $productImg1 ?>" alt="ProductIMG" width="100"
                                             height="100">
                                        <input type="file" name="product_img1" class="form-control">
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Image 2</label>
                                    <br>
                                        <img src="productImages/<?php echo $productImg2 ?>" alt="ProductIMG" width="100"
                                             height="100">
                                        <input type="file" name="product_img2" class="form-control">
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Image 3</label>
                                    <br>
                                        <img src="productImages/<?php echo $productImg3 ?>" alt="ProductIMG" width="100"
                                             height="100">
                                        <input type="file" name="product_img3" class="form-control">
                                </div><!-- /form-group  -->

                            </div>
                        </div>
                        <!-- form-horizontal  -->
                        <div class="form-group"><!-- form-group  -->
                            <label for="" class="control-label"></label>
                                <input type="submit" name="update" class="btn btn-primary form-control"
                                       value="Update Bundle">
                        </div><!-- /form-group  -->
                    </form><!-- /form-horizontal  -->
                </div><!-- /panel-body  -->
            </div><!-- /panel  -->
        </div><!-- /col-lg-12  -->
    </div><!-- /row  -->
    </body>
    </html>

    <?php
    if (isset($_GET['editBundle'])) {
        $productId = $_GET['editBundle'];

        if (isset($_POST['update'])) {

            $productTitle = $_POST['product_title'];
            $productCategory = $_POST['product_category'];
            $category = $_POST['category'];
            $productPrice = $_POST['product_price'];
            $productKeywords = $_POST['product_keywords'];
            $productDescription = $_POST['productDescription'];
            $productFeatures = $_POST['productFeatures'];
            $productMedia = $_POST['productMedia'];
            $productSeoDesc = $_POST['productSeoDesc'];
            $productType = $_POST['productType'];
            $productWeight = $_POST['product_weight'];
            $manufacturer = $_POST['manufacturer'];
            $product_Sale_Price = $_POST['product_sale_price'];
            $product_label = $_POST['product_label'];
            $product_url = $_POST['product_url'];
            $product_url_new = strtolower(str_replace(" ", "-", $product_url));
            $status = "bundle";


            $productImage1 = $_FILES['product_img1']['name'];
            $productImage2 = $_FILES['product_img2']['name'];
            $productImage3 = $_FILES['product_img3']['name'];

            $tmp_name1 = $_FILES['product_img1']['tmp_name'];
            $tmp_name2 = $_FILES['product_img2']['tmp_name'];
            $tmp_name3 = $_FILES['product_img3']['tmp_name'];

            if (empty($productImage1)) {
                $productImage1 = $newProductImg1;
            }
            if (empty($productImage2)) {
                $productImage2 = $newProductImg2;
            }
            if (empty($productImage3)) {
                $productImage3 = $newProductImg3;
            }

            move_uploaded_file($tmp_name1, "productImages/$productImage1");
            move_uploaded_file($tmp_name2, "productImages/$productImage2");
            move_uploaded_file($tmp_name3, "productImages/$productImage3");


            $query = "update onlinestore.products set 
                                product_title = '$productTitle', 
                                product_seo_desc = '$productSeoDesc',
                                product_description = '$productDescription',
                                product_features = '$productFeatures',
                                product_video = '$productMedia',
                                product_keywords = '$productKeywords', 
                                prod_date = now(), 
                                product_price = $productPrice,
                                product_psp_price = $product_Sale_Price,
                                p_cat_id = $productCategory, 
                                cat_id = $category,
                                manufacturer_id = $manufacturer,
                                product_img1 = '$productImage1', 
                                product_img2 = '$productImage2', 
                                product_url = '$product_url_new',
                                product_img3 = '$productImage3',
                                product_label = '$product_label',
                                product_type = '$productType',
                                product_weight = '$productWeight',
                                status = '$status' where product_id = $productId ";

            $update = mysqli_query($connection, $query);

            if ($update) {
                ?>
                <script>alert("Bundle has been updated successfully")</script>
                <script>window.open("index.php?viewBundles", "_self")</script>
                <?php
            } else {
                die("error: -> " . mysqli_error($connection));
            }
        }

    }

    ?>

<?php }