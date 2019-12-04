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
                <li><i class="fas fa-tachometer-alt"></i> Dashboard / Insert Manufacturer</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">&nbsp;<i class="fas fa-money-bill-alt"></i>&nbsp;Insert Manufacturer</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Manufacturer Title</label>
                            <div class="col-md-6">
                                <input type="text" name="manTitle" class="form-control">
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <label class="col-md-3 control-label" for="">Manufacturer Top</label>
                            <div class="col-md-3">

                                <input type="radio" name="manTop" value="yes">
                                <label><i style="color: #398439;" class="fas fa-check fa-2x"></i>
                                </label>&nbsp;&nbsp;&nbsp;
                                <input type="radio" name="manTop" value="no">
                                <label>
                                    <i class="fas fa-times-circle fa-2x"></i>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Manufacturer Image</label>
                            <div class="col-md-6">
                                <input type="file" name="manImage" class="form-control">
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

    if (isset($_POST['insert'])){
        $manufacturerTitle = $_POST['manTitle'];
        $manufacturerTop = $_POST['manTop'];
        $manufacturerImage = $_FILES['manImage']['name'];
        $tmp_image = $_FILES['manImage']['tmp_name'];

        move_uploaded_file($tmp_image,"otherImages/$manufacturerImage");

        $query = "insert into  onlinestore.manufacturers(
                                       manufacturer_title,
                                       manufacturer_top,
                                       manufacturer_image) 
                                       VALUES (
                                               '$manufacturerTitle',
                                               '$manufacturerTop',
                                               '$manufacturerImage')";
        $runQuery = mysqli_query($connection,$query);

        if ($runQuery){
            ?>
            <script>alert("New Manufacturer has been added successfully")</script>
            <script>window.open("index.php?viewManufacturers","_self")</script>
            <?php
        }else{
            die("something went wrong -> ".mysqli_error($connection));
        }
    }

    ?>

    <?php

}