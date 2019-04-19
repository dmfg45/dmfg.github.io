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

    if (isset($_GET['editCat'])){

        $catId = $_GET['editCat'];

        if (isset($_POST['update'])) {

            $catTitle = $_POST['catTitle'];
            $catDesc = $_POST['catDesc'];

            $query = "update onlinestore.categories set cat_title = '$catTitle', cat_desc = '$catDesc'  where cat_id = $catId ";
            $runQuery = mysqli_query($connection,$query);

            if ($runQuery){
                ?>
                <script>alert("Category has been updated")</script>
                <script>window.open("index.php?viewCategories","_self")</script>
                <?php

            }


        }

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

                    <?php

                    $catQuery = "select * from onlinestore.categories where cat_id = $catId";
                    $runQuery = mysqli_query($connection, $catQuery);
                    $rowCat = mysqli_fetch_array($runQuery);

                    $catTitle = $rowCat['cat_title'];
                    $catDesc = $rowCat['cat_desc'];

                    ?>

                    <form action="" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Product Category Title</label>
                            <div class="col-md-6">
                                <input type="text" name="catTitle" class="form-control" value="<?php echo $catTitle ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Product Category Description</label>
                            <div class="col-md-6">
                                <textarea name="catDesc" id="" cols="30" rows="10" class="form-control"><?php echo $catDesc ?></textarea>
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

}


