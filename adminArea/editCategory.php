<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 21/03/2019
 * Time: 18:40
 */
?>

<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

    <?php

    if (isset($_GET['editCat'])) {

        $catId = $_GET['editCat'];

        $catQuery = "select * from onlinestore.categories where cat_id = $catId";
        $runQuery = mysqli_query($connection, $catQuery);
        $rowCat = mysqli_fetch_array($runQuery);

        $catTitle = $rowCat['cat_title'];
        $catTop = $rowCat['cat_top'];
        $catImage = $rowCat['cat_image'];
        $newCatImage = $rowCat['cat_image'];

    }

    ?>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><i class="fas fa-tachometer-alt"></i> Dashboard / Edit Category</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;<i class="fas fa-money-bill-alt"></i>&nbsp;Edit Category</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Product Category Title</label>
                            <div class="col-md-6">
                                <input type="text" name="catTitle" class="form-control" value="<?php echo $catTitle ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Category Image</label>
                            <div class="col-md-6">
                                <img src="otherImages/<?php echo $catImage ?>" alt="Catimage" class="img-responsive" width="100" height="100">
                                <label></label>
                                <input type="file" name="catImage" class="form-control">
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <label class="col-md-3 control-label" for="">Category Top</label>
                            <div class="col-md-3">

                                <input type="radio" name="catTop" value="yes" <?php if ($catTop == "no"){

                                } else{
                                ?>checked="checked"<?php
                                }

                                ?>>
                                <label><i style="color: #398439;" class="fas fa-check fa-2x"></i>
                                </label>&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="catTop" value="no" <?php if ($catTop == "yes"){

                                } else{
                                ?>checked="checked"<?php
                                }

                                ?>>
                                <label>
                                    <i class="fas fa-times-circle fa-2x"></i>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for=""></label>
                            <div class="col-md-6">
                                <input type="submit" name="update" class="btn btn-primary form-control" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['update'])) {

        $catTitle = $_POST['catTitle'];
        $catTop = $_POST['catTop'];
        $catImage = $_FILES['catImage']['name'];
        $tmp_name = $_FILES['catImage']['tmp_name'];

        if(empty($catImage)){
            $catImage = $newCatImage;
        }

        move_uploaded_file($tmp_name,"otherImages/$catImage");

        $query = "update onlinestore.categories set cat_title = '$catTitle', cat_top = '$catTop',cat_image='$catImage'  where cat_id = $catId ";
        $runQuery = mysqli_query($connection, $query);

        if ($runQuery) {
            ?>
            <script>alert("Category has been updated")</script>
            <script>window.open("index.php?viewCategories", "_self")</script>
            <?php

        }

    }

}


