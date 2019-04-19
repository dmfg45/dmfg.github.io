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
        <?php

        if (isset($_POST['insert'])) {

            $catTitle = $_POST['catTitle'];
            $catDesc = $_POST['catDesc'];

            $query = "insert into onlinestore.categories (cat_title, cat_desc) values ('$catTitle','$catDesc')";
            $runQuery = mysqli_query($connection,$query);

            if ($runQuery){
                ?>
                <script>alert("New Category has been Inserted")</script>
                <script>window.open("index.php?viewCategories","_self")</script>
                <?php

            }


        }

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
                        <form action="" method="post" class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="">Category Title</label>
                                <div class="col-md-6">
                                    <input type="text" name="catTitle" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label" for="">Category Description</label>
                                <div class="col-md-6">
                                    <textarea name="catDesc" id="" cols="30" rows="10" class="form-control"></textarea>
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
    }
