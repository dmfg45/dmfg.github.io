<?php /**
 * Created by PhpStorm.
 * User: Andre
 * Date: 24/12/2018
 * Time: 01:52
 */


function confirmResult($result)
{
    global $connection;
    if (!$result) {
        die("<h4><b class='text-danger'>Query failed:</b> &nbsp;</h4>" . mysqli_error($connection));
    } else {
        echo "<script>alert('Product Added')</script>";
    }
}

function getPro()
{
    global $connection;

    $productsTable = "SELECT * FROM onlinestore.products ORDER BY 1 DESC LIMIT 0,8";

    $query = mysqli_query($connection, $productsTable);

    while ($row = mysqli_fetch_array($query)) {
        $productID = $row['product_id'];
        $productTitle = $row['product_title'];
        $productImage = $row['product_img1'];
        $productPrice = $row['product_price'];
        $productLabel = $row['product_label'];

        $manufacturerId = $row['manufacturer_id'];

        $getMnaufacturer = "select * from onlinestore.manufacturers where manufacturer_id = $manufacturerId";
        $runQuery = mysqli_query($connection, $getMnaufacturer);

        $rowManufacturer = mysqli_fetch_array($runQuery);

        $manufacturerName = $rowManufacturer['manufacturer_title'];
        $productPspPrice = $row['product_psp_price'];
        $productUrl = $row['product_url'];

        if ($productLabel == "Sale" || $productLabel == "Gift") {
            $product_Price = "<del>&euro;&nbsp;$productPrice </del>";
            $productPspPrice = "| &euro;&nbsp;$productPspPrice ";
        } else {
            $productPspPrice = "";
            $product_Price = "&euro;&nbsp;$productPrice";
        }

        ?>

        <div class="col-sm-4 col-sm-6 single"><!-- col-sm-4 col-sm-6 single -->
            <div class="product"><!-- product -->
                <a href="<?php echo $productUrl ?>"><img
                            src="adminArea/productImages/<?php echo $productImage ?>" alt="" class="img-responsive"></a>
                <div class="text"><!-- text -->
                    <div class="text-center">
                        <p class="btn btn-primary"><?php echo $manufacturerName ?></p>
                    </div>
                    <hr>
                    <h3><a href="<?php echo $productUrl ?>"><?php echo $productTitle ?></a></h3>
                    <p class="price"><?php echo $product_Price, $productPspPrice ?></p>
                    <p class="buttons">
                        <a href="<?php echo $productUrl ?>" class="btn btn-default">View
                            Details</a>
                        <a href="<?php echo $productUrl ?>" class="btn btn-primary"><i
                                    class="fas fa-shopping-cart"></i>Add to
                            cart</a>
                    </p>
                </div><!-- /text -->
                <?php

                if ($productLabel == "") {

                } else { ?>
                    <a href="#" class="label sale" style="color: black">
                        <div class="theLabel"><?php echo $productLabel ?></div>
                        <div class="label-background"></div>
                    </a>
                    <?php
                }

                ?>
            </div><!-- /product -->
        </div><!-- /col-sm-4 col-sm-6 single -->


        <?php

    }


}

function getProductCategories()
{
    global $connection;

    $productCatTable = "SELECT * FROM onlinestore.product_categories";
    $query = mysqli_query($connection, $productCatTable);

    while ($row = mysqli_fetch_array($query)) {

        $productCatId = $row['p_cat_id'];
        $productCatTitle = $row['p_cat_title'];

        ?>

        <li><a href="shop.php?p_cat=<?php echo $productCatId ?>"><?php echo $productCatTitle ?></a></li>

        <?php
    }
}

function getCategories()
{
    global $connection;

    $productCatTable = "SELECT * FROM onlinestore.categories";
    $query = mysqli_query($connection, $productCatTable);

    while ($row = mysqli_fetch_array($query)) {

        $catId = $row['cat_id'];
        $catTitle = $row['cat_title'];

        ?>

        <li><a href="shop.php?category=<?php echo $catId ?>"><?php echo $catTitle ?></a></li>

        <?php
    }
}

function getProducts()
{
/// getProducts function Code Starts ///

    global $connection;

    $aWhere = array();

/// Manufacturers Code Starts ///

    if (isset($_REQUEST['man']) && is_array($_REQUEST['man'])) {

        foreach ($_REQUEST['man'] as $sKey => $sVal) {

            if ((int)$sVal != 0) {

                $aWhere[] = 'manufacturer_id=' . (int)$sVal;

            }

        }

    }

/// Manufacturers Code Ends ///

/// Products Categories Code Starts ///

    if (isset($_REQUEST['p_cat']) && is_array($_REQUEST['p_cat'])) {

        foreach ($_REQUEST['p_cat'] as $sKey => $sVal) {

            if ((int)$sVal != 0) {

                $aWhere[] = 'p_cat_id=' . (int)$sVal;

            }

        }

    }

/// Products Categories Code Ends ///

/// Categories Code Starts ///

    if (isset($_REQUEST['cat']) && is_array($_REQUEST['cat'])) {

        foreach ($_REQUEST['cat'] as $sKey => $sVal) {

            if ((int)$sVal != 0) {

                $aWhere[] = 'cat_id=' . (int)$sVal;

            }

        }

    }

/// Categories Code Ends ///

    $per_page = 6;

    if (isset($_GET['page'])) {

        $page = $_GET['page'];

    } else {

        $page = 1;

    }

    $start_from = ($page - 1) * $per_page;

    $sLimit = " order by 1 DESC LIMIT $start_from,$per_page";

    $sWhere = (count($aWhere) > 0 ? ' WHERE ' . implode(' or ', $aWhere) : '') . $sLimit;

    $get_products = "select * from onlinestore.products  " . $sWhere;

    $run_products = mysqli_query($connection, $get_products);

    while ($row_products = mysqli_fetch_array($run_products)) {

        $pro_id = $row_products['product_id'];

        $pro_title = $row_products['product_title'];

        $pro_price = $row_products['product_price'];

        $pro_img1 = $row_products['product_img1'];

        $productLabel = $row_products['product_label'];

        $manufacturerId = $row_products['manufacturer_id'];

        $getMnaufacturer = "select * from onlinestore.manufacturers where manufacturer_id = $manufacturerId";

        $runQuery = mysqli_query($connection, $getMnaufacturer);

        $rowManufacturer = mysqli_fetch_array($runQuery);

        $manufacturerName = $rowManufacturer['manufacturer_title'];

        $productPspPrice = $row_products['product_psp_price'];

        $productUrl = $row_products['product_url'];

        if ($productLabel == "Sale" || $productLabel == "Gift") {

            $product_Price = "<del>&euro;&nbsp;$pro_price </del>";

            $productPspPrice = "| &euro;&nbsp;$productPspPrice ";

        } else {

            $productPspPrice = "";

            $product_Price = "&euro;&nbsp;$pro_price";

        }
        ?>

        <div class='col-md-4 col-sm-6 center-responsive'>

            <div class='product'>

                <a href='<?php echo $productUrl ?>'>

                    <img src='adminArea/productImages/<?php echo $pro_img1 ?>' class='img-responsive'>

                </a>

                <div class='text'>
                    <div class="text-center">
                        <p class="btn btn-primary"><?php echo $manufacturerName ?></p>
                    </div>
                    <hr>
                    <h3><a href="<?php echo $productUrl ?>"><?php echo $pro_title ?></a></h3>

                    <p class="price"><?php echo $product_Price, $productPspPrice ?></p>

                    <p class='buttons'>

                        <a href='<?php echo $productUrl ?>' class='btn btn-default'>View details</a>

                        <a href='<?php echo $productUrl ?>' class='btn btn-primary'>

                            <i class='fa fa-shopping-cart'></i> Add To Cart

                        </a>

                    </p>

                </div>

                <?php

                if ($productLabel == "") {

                } else { ?>
                    <a href="#" class="label sale" style="color: black">
                        <div class="theLabel"><?php echo $productLabel ?></div>
                        <div class="label-background"></div>
                    </a>
                    <?php
                }

                ?>

            </div>

        </div>

        <?php

    }
/// getProducts function Code Ends ///
}

function getPagination()
{
/// getPaginator Function Code Starts ///

    $per_page = 6;

    global $connection;

    $aWhere = array();

    $aPath = '';

/// Manufacturers Code Starts ///

    if (isset($_REQUEST['man']) && is_array($_REQUEST['man'])) {

        foreach ($_REQUEST['man'] as $sKey => $sVal) {

            if ((int)$sVal != 0) {

                $aWhere[] = 'manufacturer_id=' . (int)$sVal;

                $aPath .= 'man[]=' . (int)$sVal . '&';

            }

        }

    }

/// Manufacturers Code Ends ///

/// Products Categories Code Starts ///

    if (isset($_REQUEST['p_cat']) && is_array($_REQUEST['p_cat'])) {

        foreach ($_REQUEST['p_cat'] as $sKey => $sVal) {

            if ((int)$sVal != 0) {

                $aWhere[] = 'p_cat_id=' . (int)$sVal;

                $aPath .= 'p_cat[]=' . (int)$sVal . '&';

            }

        }

    }

/// Products Categories Code Ends ///

/// Categories Code Starts ///

    if (isset($_REQUEST['cat']) && is_array($_REQUEST['cat'])) {

        foreach ($_REQUEST['cat'] as $sKey => $sVal) {

            if ((int)$sVal != 0) {

                $aWhere[] = 'cat_id=' . (int)$sVal;

                $aPath .= 'cat[]=' . (int)$sVal . '&';

            }

        }

    }

/// Categories Code Ends ///

    $sWhere = (count($aWhere) > 0 ? ' WHERE ' . implode(' or ', $aWhere) : '');

    $query = "select * from onlinestore.products " . $sWhere;

    $result = mysqli_query($connection, $query);

    $total_records = mysqli_num_rows($result);

    $total_pages = ceil($total_records / $per_page);

    echo "<li><a href='shop.php?page=1";

    if (!empty($aPath)) {
        echo "&" . $aPath;
    }

    echo "' >" . 'First Page' . "</a></li>";

    for ($i = 1; $i <= $total_pages; $i++) {

        echo "<li><a href='shop.php?page=" . $i . (!empty($aPath) ? '&' . $aPath : '') . "' >" . $i . "</a></li>";

    };

    echo "<li><a href='shop.php?page=$total_pages";

    if (!empty($aPath)) {
        echo "&" . $aPath;
    }

    echo "' >" . 'Last Page' . "</a></li>";

/// getPaginator Function Code Ends ///
}

function getUserIpAddress()
{
    if (isset($_SERVER['REMOTE_ADDR'])) {
        $ipAdd = $_SERVER['REMOTE_ADDR'];
        return $ipAdd;
    } else {
        return false;
    }
}

function cartItems()
{
    global $connection;

    $ipAdd = getUserIpAddress();
    $getItems = "SELECT * FROM onlinestore.cart WHERE ip_add = '$ipAdd'";

    $query = mysqli_query($connection, $getItems);

    $count = mysqli_num_rows($query);

    if ($count > 1) {

        echo "$count items in cart";

    } elseif ($count == 0) {

        echo "$count items in cart";

    } elseif ($count == 1) {
        echo "$count item in cart";

    }


}

function totalPrice()
{
    global $connection;

    $ipAdd = getUserIpAddress();

    $total = 0;

    $cart = "SELECT * FROM onlinestore.cart WHERE ip_add = '$ipAdd'";

    $query = mysqli_query($connection, $cart);

    while ($record = mysqli_fetch_array($query)) {
        $productId = $record['p_id'];
        $productQty = $record['qty'];
        $subTotal = $record['p_price'] * $productQty;

        $total += $subTotal;

    }

    ?>

    &euro;&nbsp;<?php echo $total; ?>

    <?php

}

function before($character, $inthat)
{
    return substr($inthat, 0, strpos($inthat, $character));
}

function getBoxes()
{
    global $connection;

    $getBoxes = "select * from  onlinestore.boxes_section";
    $runQuery = mysqli_query($connection, $getBoxes);

    while ($runQuerySection = mysqli_fetch_array($runQuery)) {

        $boxId = $runQuerySection['box_id'];
        $boxTitle = $runQuerySection['box_title'];
        $boxDesc = $runQuerySection['box_desc'];


        ?>

        <div class="col-sm-4"><!-- col-sm-4 -->
            <div class="box same-height"><!-- box same-height -->
                <div class="icon">
                    <i class="fas fa-heart"></i>
                </div>
                <h3><a href="#"><?php echo $boxTitle ?></a></h3>
                <p><?php echo $boxDesc ?></p>
            </div><!-- /box same-height -->
        </div><!-- /col-sm-4 -->


        <?php
    }
}
