<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 20/11/2018
 * Time: 17:19
 */
?>

<?php

$aMan = array();

$aPCat = array();

$aCat = array();

/// Manufacturers Code Starts ///

if (isset($_REQUEST['man']) && is_array($_REQUEST['man'])) {

    foreach ($_REQUEST['man'] as $sKey => $sVal) {

        if ((int)$sVal != 0) {

            $aMan[(int)$sVal] = (int)$sVal;

        }

    }

}

/// Manufacturers Code Ends ///

/// Products Categories Code Starts ///

if (isset($_REQUEST['p_cat']) && is_array($_REQUEST['p_cat'])) {

    foreach ($_REQUEST['p_cat'] as $sKey => $sVal) {

        if ((int)$sVal != 0) {

            $aPCat[(int)$sVal] = (int)$sVal;

        }

    }

}

/// Products Categories Code Ends ///

/// Categories Code Starts ///

if (isset($_REQUEST['cat']) && is_array($_REQUEST['cat'])) {

    foreach ($_REQUEST['cat'] as $sKey => $sVal) {

        if ((int)$sVal != 0) {

            $aCat[(int)$sVal] = (int)$sVal;

        }

    }

}

/// Categories Code Ends ///


?>

<div class="panel panel-default sidebar-menu">
    <div class="panel-heading">
        <h3 class="panel-title">
            Manufacturers
            <div class="pull-right">
                <a href="#" style="color: #000;">
                    <span class="nav-toggle hide-show">Hide</span>
                </a>
            </div>
        </h3>
    </div>
    <div class="panel-collapse collapse-data">
        <div class="panel-body">
            <div class="input-group">
                <input type="text" class="form-control" id="dev-table-filter" data-action="filter"
                       data-filters="#dev-manufacturer" placeholder="Filter Manufacturers">
                <a href="#" class="input-group-addon"><i class="fas fa-search"></i></a>
            </div>
        </div>
        <div class="panel-body scroll-menu">
            <ul class="nav nav-pills nav-stacked category-menu" id="dev-manufacturer">
                <?php

                $getManufacturer = "select * from onlinestore.manufacturers where manufacturer_top = 'yes'";
                $runQueryManufacturer = mysqli_query($connection, $getManufacturer);

                while ($row = mysqli_fetch_array($runQueryManufacturer)) {
                    $manufacturerId = $row['manufacturer_id'];
                    $manufacturerTitle = $row['manufacturer_title'];
                    $manufacturerImg = $row['manufacturer_image'];

                    if ($manufacturerImg == "") {

                    } else {

                        $manufacturerImg = "<img src='adminArea/otherImages/$manufacturerImg' width='25'>&nbsp;";

                    }
                    ?>

                    <li style="background-color: #dddddd" class="checkbox checkbox-primary">
                        <a>
                            <label>
                                <input <?php

                                                if (isset($aMan[$manufacturerId])){
                                                    ?>checked="checked"<?php
                                                }


                                       ?>
                                        type="checkbox" value="<?php echo $manufacturerId ?>" name="manufacturer"
                                       class="getManufacturer">
                                <span>
                                    <?php echo $manufacturerImg ?>
                                    <?php echo $manufacturerTitle ?>
                                </span>
                            </label>
                        </a>
                    </li>

                    <?php
                }

                $getManufacturer = "select * from onlinestore.manufacturers where manufacturer_top = 'no'";
                $runQueryManufacturer = mysqli_query($connection, $getManufacturer);

                while ($row = mysqli_fetch_array($runQueryManufacturer)) {
                    $manufacturerId = $row['manufacturer_id'];
                    $manufacturerTitle = $row['manufacturer_title'];
                    $manufacturerImg = $row['manufacturer_image'];

                    if ($manufacturerImg == "") {

                    } else {

                        $manufacturerImg = "<img src='adminArea/otherImages/$manufacturerImg' width='25'>&nbsp;";

                    }
                    ?>

                    <li class="checkbox checkbox-primary">
                        <a>
                            <label>
                                <input <?php

                                    if (isset($aMan[$manufacturerId])){
                                    ?>checked="checked"<?php
                                }


                                ?> type="checkbox" value="<?php echo $manufacturerId ?>" name="manufacturer"
                                       class="getManufacturer">
                                <span>
                                    <?php echo $manufacturerImg ?>
                                    <?php echo $manufacturerTitle ?>
                                </span>
                            </label>
                        </a>
                    </li>

                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<div class="panel panel-default sidebar-menu"><!-- panel panel-default sidebar-menu -->
    <div class="panel-heading"><!-- panel-heading -->
        <h3 class="panel-title">
            Products Categories
            <div class="pull-right">
                <a href="#" style="color: #000;">
                    <span class="nav-toggle hide-show">Hide</span>
                </a>
            </div>
        </h3>
    </div><!-- /panel-heading -->
    <div class="panel-collapse collapse-data">
        <div class="panel-body"><!-- panel-body -->
            <div class="input-group">
                <input type="text" class="form-control" id="dev-table-filter" data-action="filter"
                       data-filters="#dev-p-cats" placeholder="Filter Product Categories">
                <a href="" class="input-group-addon"> <i class="fas fa-search"></i></a>
            </div>
        </div><!-- /panel-body -->
        <div class="panel-body scroll-menu">
            <ul class="nav nav-pills nav-stacked category-menu" id="dev-p-cats"><!-- category-menu-->
                <?php

                $getProductCat = "select * from onlinestore.product_categories where p_cat_top = 'yes'";
                $runQueryProductCat = mysqli_query($connection, $getProductCat);

                while ($row_ProductCat = mysqli_fetch_array($runQueryProductCat)) {
                    $productCatId = $row_ProductCat['p_cat_id'];
                    $productCatTitle = $row_ProductCat['p_cat_title'];
                    $productCatImg = $row_ProductCat['p_cat_image'];

                    if ($productCatImg == "") {

                    } else {

                        $productCatImg = "<img src='adminArea/otherImages/$productCatImg' width='25'>&nbsp;";

                    }
                    ?>

                    <li style="background-color: #dddddd" class="checkbox checkbox-primary">
                        <a>
                            <label for="">
                                <input <?php

                                       if (isset($aPCat[$productCatId])){
                                       ?>checked="checked"<?php
                                }


                                ?> type="checkbox" value="<?php echo $productCatId ?>" id="p_cat" name="p_cat"
                                       class="get_p_cat">
                                <span>
                                    <?php echo $productCatImg ?>
                                    <?php echo $productCatTitle ?>
                                </span>
                            </label>
                        </a>
                    </li>

                    <?php
                }

                $getProductCat = "select * from onlinestore.product_categories where p_cat_top = 'no'";
                $runQueryProductCat = mysqli_query($connection, $getProductCat);

                while ($row_ProductCat = mysqli_fetch_array($runQueryProductCat)) {
                    $productCatId = $row_ProductCat['p_cat_id'];
                    $productCatTitle = $row_ProductCat['p_cat_title'];
                    $productCatImg = $row_ProductCat['p_cat_image'];

                    if ($productCatImg == "") {

                    } else {

                        $productCatImg = "<img src='adminArea/otherImages/$productCatImg' width='25'>&nbsp;";

                    }
                    ?>

                    <li class="checkbox checkbox-primary">
                        <a>
                            <label for="">
                                <input <?php

                                       if (isset($aPCat[$productCatId])){
                                       ?>checked="checked"<?php
                                       }


                                       ?> type="checkbox" value="<?php echo $productCatId ?>" id="p_cat" name="p_cat"
                                       class="get_p_cat">
                                <span>
                                    <?php echo $productCatImg ?>
                                    <?php echo $productCatTitle ?>
                                </span>
                            </label>
                        </a>
                    </li>

                    <?php
                }

                ?>
            </ul><!-- /category-menu -->
        </div>
    </div>
</div><!-- /panel panel-default sidebar-menu -->

<div class="panel panel-default sidebar-menu"><!-- panel panel-default sidebar-menu -->
    <div class="panel-heading"><!-- panel-heading -->
        <h3 class="panel-title">
            Products Categories
            <div class="pull-right">
                <a href="#" style="color: #000;">
                    <span class="nav-toggle hide-show">Hide</span>
                </a>
            </div>
        </h3>
    </div><!-- /panel-heading -->
    <div class="panel-collapse collapse-data">
        <div class="panel-body"><!-- panel-body -->
            <div class="input-group">
                <input type="text" class="form-control" id="dev-table-filter" data-action="filter"
                       data-filters="#dev-cats" placeholder="Filter Categories">
                <a class="input-group-addon">
                    <i class="fas fa-search"></i>
                </a>
            </div>
        </div><!-- /panel-body -->
        <div class="panel-body scroll-menu">
            <ul class="nav nav-pills nav-stacked category-menu" id="dev-cats"><!-- category-menu-->
                <?php

                $getCategory = "select * from onlinestore.categories where cat_top = 'yes'";
                $runQueryCategory = mysqli_query($connection, $getCategory);

                while ($rowCategory = mysqli_fetch_array($runQueryCategory)) {
                    $catId = $rowCategory['cat_id'];
                    $catTitle = $rowCategory['cat_title'];
                    $catImg = $rowCategory['cat_image'];

                    if ($catImg == "") {

                    } else {

                        $catImg = "<img src='adminArea/otherImages/$catImg' width='25'>&nbsp;";

                    }
                    ?>

                    <li style="background-color: #dddddd" class="checkbox checkbox-primary">
                        <a>
                            <label for="">
                                <input <?php

                                       if (isset($aCat[$catId])){
                                       ?>checked="checked"<?php
                                }


                                ?> type="checkbox" value="<?php echo $catId ?>" id="cat" name="cat"
                                       class="get_cat">
                                <span>
                                    <?php echo $catImg ?>

                                    <?php echo $catTitle ?>
                                </span>
                            </label>
                        </a>
                    </li>

                    <?php
                }

                $getCategory = "select * from onlinestore.categories where cat_top = 'no'";
                $runQueryCategory = mysqli_query($connection, $getCategory);

                while ($rowCategory = mysqli_fetch_array($runQueryCategory)) {
                    $catId = $rowCategory['cat_id'];
                    $catTitle = $rowCategory['cat_title'];
                    $catImg = $rowCategory['cat_image'];

                    if ($catImg == "") {

                    } else {

                        $catImg = "<img src='adminArea/otherImages/$catImg' width='25'>&nbsp;";

                    }
                    ?>

                    <li class="checkbox checkbox-primary">
                        <a>
                            <label for="">
                                <input <?php

                                       if (isset($aCat[$catId])){
                                       ?>checked="checked"<?php
                                }


                                ?> type="checkbox" value="<?php echo $catId ?>" id="cat" name="cat"
                                       class="get_cat">
                                <span>
                                    <?php echo $catImg ?>
                                    <?php echo $catTitle ?>
                                </span>
                            </label>
                        </a>
                    </li>

                    <?php
                }
                ?>

            </ul><!-- /category-menu -->
        </div>
    </div>

</div><!-- /panel panel-default sidebar-menu -->
