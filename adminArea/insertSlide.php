<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 21/03/2019
 * Time: 18:57
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
                <li class="active"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard&nbsp;/&nbsp;Insert Slide</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fas fa-money-bill-alt"></i>&nbsp;Insert Slide</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Slide Name:</label>
                            <div class="col-md-6">
                                <input type="text" name="slideName" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Slide Image:</label>
                            <div class="col-md-6">
                                <input type="file" name="slideImage" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Slide Url:</label>
                            <div class="col-md-6">
                                <input type="url" name="slideUrl" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <input type="submit" name="submit" class="btn btn-primary form-control" value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['submit'])) {
        $slideName = $_POST['slideName'];
        $slideUrl = $_POST['slideUrl'];
        $slideImage = $_FILES['slideImage']['name'];
        $tmp_name = $_FILES['slideImage']['tmp_name'];

        $viewSlides = "select * from onlinestore.slider";
        $slidesQuery = mysqli_query($connection, $viewSlides);

        $count = mysqli_num_rows($slidesQuery);

        if ($count < 5) {
            move_uploaded_file($tmp_name, "slidesImages/$slideImage");

            $insertSlides = "insert into onlinestore.slider(slide_name, slider_image, slide_url) VALUES ('$slideName','$slideImage','$slideUrl')";
            $slidesQuery = mysqli_query($connection, $insertSlides);

            ?>

            <script>alert("New Slide has been Inserted")</script>
            <script>window.open("index.php?viewSlides", "_self")</script>

            <?php

        } else {
            ?>

            <script>alert("You have already inserted the limit slides")</script>

            <?php
        }

    }

    ?>


    <?php

}
