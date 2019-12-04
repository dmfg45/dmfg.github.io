<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 21/03/2019
 * Time: 17:48
 */
?>
<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>


    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><i class="fas fa-tachometer-alt"></i> Dashboard / Insert Category</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;<i class="fas fa-money-bill-alt"></i>&nbsp;Insert Category</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Category Title</label>
                            <div class="col-md-6">
                                <input type="text" name="catTitle" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Category Image</label>
                            <div class="col-md-6">
                                <input type="file" name="catImage" class="form-control">
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <label class="col-md-3 control-label" for="">Category Top</label>
                            <div class="col-md-3">

                                <input type="radio" name="catTop" value="yes">
                                <label><i style="color: #398439;" class="fas fa-check fa-2x"></i>
                                </label>&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="catTop" value="no">
                                <label>
                                    <i class="fas fa-times-circle fa-2x"></i>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for=""></label>
                            <div class="col-md-6">
                                <input type="submit" name="insert" class="btn btn-primary form-control" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['insert'])) {

        $catTitle = $_POST['catTitle'];
        $catImage = $_FILES['catImage']['name'];
        $tmp_name = $_FILES['catImage']['tmp_name'];
        $catTop = $_POST['catTop'];

        move_uploaded_file($tmp_name,"otherImages/$catImage");

        $query = "insert into onlinestore.categories (cat_title, cat_image, cat_top) values ('$catTitle','$catImage','$catTop')";
        $runQuery = mysqli_query($connection, $query);

        if ($runQuery) {
            ?>
            <script>alert("New Category has been Inserted")</script>
            <script>window.open("index.php?viewCategories", "_self")</script>
            <?php

        }


    }

    ?>

    <?php
}
