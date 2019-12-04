<?php if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
    <script>tinymce.init({selector:'#productDescription,#productFeatures'});</script>

    <div class="row"><!-- row  -->
        <div class="col-md-12"><!-- col-md-12  -->
            <ol class="breadcrumb"><!-- breadcrumb  -->
                <li class="active">
                    <i class="fa fa-tachometer-alt"></i>&nbsp;Dashboard / Insert Bundles
                </li>
            </ol><!-- /breadcrumb  -->
        </div><!-- /col-md-12  -->
    </div><!-- /row  -->

    <div class="row"><!-- row  -->
        <div class="col-lg-12"><!-- col-lg-12  -->
            <div class="panel panel-default"><!-- panel  -->
                <div class="panel-heading"><!-- panel-heading  -->
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill-alt fa-fw"></i>&nbsp;Insert Bundles
                    </h3>
                </div><!-- /panel-heading  -->
                <div class="panel-body"><!-- panel-body  -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label"> Bundle Title </label>
                                        <input type="text" name="product_title" class="form-control" required>
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Seo Description</label>
                                    <textarea name="productSeoDesc"maxlength="230" placeholder="Most search engines use a maximum of 230 characters for the description."
                                              class="form-control"></textarea>
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Url</label>
                                        <input type="text" name="product_url" class="form-control" required>
                                        <br>
                                        <p style="font-size: 15px; font-weight: bold;">
                                            Product URL Example: jacket-blue-navy
                                        </p>
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Price</label>
                                        <input type="text" name="product_price" class="form-control" required>
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Sale Price</label>
                                        <input type="text" name="product_price_sale" class="form-control">
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Keywords</label>
                                        <input type="text" name="product_keywords" class="form-control" required>
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
                                        <textarea name="productDescription" class="form-control" id="productDescription"
                                                  cols="30" rows="15"></textarea>
                                            </div>
                                            <div id="features" class="tab-pane fade in">
                                        <textarea name="productFeatures" id="productFeatures" class="form-control"
                                                  rows="15"></textarea>
                                            </div>
                                            <div id="media" class="tab-pane fade in">
                                                <textarea name="productMedia" class="form-control" rows="15"></textarea>
                                            </div>
                                        </div>
                                </div>
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Weight <small> (kg) </small></label>
                                    <input type="text" name="product_weight" class="form-control">
                                </div><!-- /form-group  -->

                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Label</label>
                                        <input type="text" name="product_label" class="form-control">
                                </div><!-- /form-group  -->

                            </div>
                            <div class="col-md-3">
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Type</label>
                                    <select class="form-control" name="productType" id="">
                                        <option value="">Select a Bundle Type</option>
                                        <option value="physicalProduct">(Physical Bundle) Simple Bundle</option>
                                        <option value="digitalProduct">(Digital Bundle) Downloadable Bundle</option>
                                    </select>
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Manufacturer</label>
                                        <select class="form-control" name="manufacturer" id="">
                                            <option value="">Select Manufacturer</option>
                                            <?php

                                            $getManufacturer = "select * from onlinestore.manufacturers";
                                            $runQuery = mysqli_query($connection, $getManufacturer);

                                            while ($rowManufacturers = mysqli_fetch_array($runQuery)) {
                                                $manufacturerId = $rowManufacturers['manufacturer_id'];
                                                $manufacturerTitle = $rowManufacturers['manufacturer_title'];
                                                ?>

                                                <option value="<?php echo $manufacturerId ?>">
                                                    <?php echo $manufacturerTitle ?>
                                                </option>

                                                <?php
                                            }

                                            ?>

                                        </select>
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Product Category</label>
                                        <select name="product_category" id="" class="form-control">
                                            <option value="">
                                                Select Product Category
                                            </option>

                                            <?php
                                            $query = "SELECT * FROM product_categories";

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
                                            <option value="">Select Category</option>

                                            <?php
                                            $query = "SELECT * FROM categories";

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
                                    <label for="" class="control-label">Bundle Image 1</label>
                                        <input type="file" name="product_img1" class="form-control" required>
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Image 2</label>
                                        <input type="file" name="product_img2" class="form-control" required>
                                </div><!-- /form-group  -->
                                <div class="form-group"><!-- form-group  -->
                                    <label for="" class="control-label">Bundle Image 3</label>
                                        <input type="file" name="product_img3" class="form-control" required>
                                </div><!-- /form-group  -->

                            </div>
                        </div>

                        <!-- form-horizontal  -->

                        <div class="form-group"><!-- form-group  -->
                            <label for="" class="control-label"></label>
                                <input type="submit" name="submit" class="btn btn-primary form-control"
                                       value="Insert Product">
                        </div><!-- /form-group  -->
                    </form><!-- /form-horizontal  -->
                </div><!-- /panel-body  -->
            </div><!-- /panel  -->
        </div><!-- /col-lg-12  -->
    </div><!-- /row  -->

    <?php

    if (isset($_POST['submit'])) {

        $productTitle = $_POST['product_title'];
        $productCategory = $_POST['product_category'];
        $category = $_POST['category'];
        $productPrice = $_POST['product_price'];
        $productKeywords = $_POST['product_keywords'];
        $productDescription = $_POST['productDescription'];
        $manufacturer_Id = $_POST['manufacturer'];
        $productLabel = $_POST['product_label'];
        $productUrl = $_POST['product_url'];
        $product_url_new = strtolower(str_replace(" ","-",$productUrl));
        $productFeatures = $_POST['productFeatures'];
        $productMedia = $_POST['productMedia'];
        $productSeoDesc = $_POST['productSeoDesc'];
        $productType = $_POST['productType'];
        $productWeight = $_POST['product_weight'];
        $status = "bundle";
        $productSalePrice = $_POST['product_price_sale'];

        $productImage1 = $_FILES['product_img1']['name'];
        $productImage2 = $_FILES['product_img2']['name'];
        $productImage3 = $_FILES['product_img3']['name'];

        $tmp_name1 = $_FILES['product_img1']['tmp_name'];
        $tmp_name2 = $_FILES['product_img2']['tmp_name'];
        $tmp_name3 = $_FILES['product_img3']['tmp_name'];

        move_uploaded_file($tmp_name1, "productImages/$productImage1");
        move_uploaded_file($tmp_name2, "productImages/$productImage2");
        move_uploaded_file($tmp_name3, "productImages/$productImage3");


        $query = "INSERT INTO onlinestore.products
  (p_cat_id,
   cat_id,
   prod_date,
   product_title,
   product_seo_desc,
   product_img1,
   product_img2,
   product_img3,
   product_price,
   product_psp_price,
   manufacturer_id,
   product_description,
   product_features,
   product_video,
   product_url,
   product_keywords,
   product_label,
   product_type,
   product_weight,
   status) 
  VALUES ($productCategory,
          $category,
          NOW(),
          '$productTitle',
          '$productSeoDesc',
          '$productImage1',
          '$productImage2',
          '$productImage3',
          $productPrice,
          $productSalePrice,
          $manufacturer_Id,
          '$productDescription',
          '$productFeatures',
          '$productMedia',
          '$product_url_new',
          '$productKeywords',
          '$productLabel',
          '$productType',
          $productWeight,
          '$status')";

        $insert = mysqli_query($connection, $query);

        if ($insert) {
            ?>
            <script>alert("Bundle has been added successfully")</script>
            <script>window.open("index.php?viewBundles","_self")</script>
            <?php
        }
    }

    ?>

    <?php
}