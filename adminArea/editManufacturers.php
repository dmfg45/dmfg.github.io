<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

    <?php

    if (isset($_GET['editManufacturer'])){

        $manufacturerId = $_GET['editManufacturer'];

        $getManufacturers = "select * from onlinestore.manufacturers where manufacturer_id = $manufacturerId";
        $getQuery = mysqli_query($connection,$getManufacturers);

        $row = mysqli_fetch_array($getQuery);

        $manufacturer_Id = $row['manufacturer_id'];
        $manufacturer_Title = $row['manufacturer_title'];
        $manufacturer_Top = $row['manufacturer_top'];
        $manufacturer_Image = $row['manufacturer_image'];
        $new_manufacturer_Image = $row['manufacturer_image'];

    }
    ?>


    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><i class="fas fa-tachometer-alt"></i> Dashboard / Edit Manufacturer</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;<i class="fas fa-money-bill-alt"></i>&nbsp;Edit Manufacturer</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Manufacturer Title</label>
                            <div class="col-md-6">
                                <input type="text" name="manTitle" class="form-control" value="<?php echo $manufacturer_Title ?>">
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <label class="col-md-3 control-label" for="">Manufacturer Top</label>
                            <div class="col-md-3">

                                <input type="radio" name="manTop" value="yes" <?php if ($manufacturer_Top == "no"){

                                } else{
                                    ?>checked="checked"<?php
                                }

                                ?>>
                                <label><i style="color: #398439;" class="fas fa-check fa-2x"></i>
                                </label>&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="manTop" value="no" <?php if ($manufacturer_Top == "yes"){

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
                            <label class="col-md-3 control-label" for="">Manufacturer Image</label>
                            <div class="col-md-6">
                                <img src="otherImages/<?php echo $manufacturer_Image ?>" alt="manufacturerImage" class="img-responsive" width="100" height="100">
                                <label for=""></label>
                                <input type="file" name="manImage" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label" for=""></label>
                            <div class="col-md-6">
                                <input type="submit" name="update" class="btn btn-primary form-control" value="Update">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['update'])){
        $manufacturerTitle = $_POST['manTitle'];
        $manufacturerTop = $_POST['manTop'];
        $manufacturerImage = $_FILES['manImage']['name'];
        $tmp_image = $_FILES['manImage']['tmp_name'];

        if (empty($manufacturerImage)){
            $manufacturerImage = $new_manufacturer_Image;
        }

        move_uploaded_file($tmp_image,"otherImages/$manufacturerImage");

        $query = "update onlinestore.manufacturers set manufacturer_title = '$manufacturerTitle', manufacturer_image = '$manufacturerImage', manufacturer_top = '$manufacturerTop' where manufacturer_id = $manufacturerId";
        $runQuery = mysqli_query($connection,$query);

        if ($runQuery){
            ?>
            <script>alert("Manufacturer was updated successfully")</script>
            <script>window.open("index.php?viewManufacturers","_self")</script>
            <?php
        }else{
            die("something went wrong -> ".mysqli_error($connection));
        }
    }

    ?>

    <?php

}