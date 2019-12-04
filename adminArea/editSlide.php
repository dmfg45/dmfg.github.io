<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 21/03/2019
 * Time: 20:35
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

    if (isset($_GET['editSlide'])) {

        $sliderId = $_GET['editSlide'];

        $slideQuery = "select * from onlinestore.slider where slider_id = '$sliderId'";
        $runSlideQuery = mysqli_query($connection, $slideQuery);
        $rowSlide = mysqli_fetch_array($runSlideQuery);

        $slideNm = $rowSlide['slide_name'];
        $slideImg = $rowSlide['slider_image'];
        $slideUrl = $rowSlide['slide_url'];
        $newSlideImg = $rowSlide['slider_image'];

    }

    ?>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard&nbsp;/&nbsp;Edit Slide</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fas fa-money-bill-alt"></i>&nbsp;Edit Slide</h3>
                </div>
                <div class="panel-body">

                    <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Slide Name:</label>
                            <div class="col-md-6">
                                <input type="text" name="slideName" class="form-control"
                                       value="<?php echo $slideNm ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Slide Image:</label>
                            <div class="col-md-6">
                                <img src="slidesImages/<?php echo $slideImg ?>" alt="SlideImg" width="100" height="100">
                                <br>
                                <br>
                                <input type="file" name="slideImage" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Slide Url:</label>
                            <div class="col-md-6">
                                <input type="url" name="slideUrl" class="form-control"
                                       value="<?php echo $slideUrl ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <input type="submit" name="update" class="btn btn-primary form-control"
                                       value="Submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['update'])) {

        $slideName = $_POST['slideName'];
        $slideImage = $_FILES['slideImage']['name'];
        $temp_name = $_FILES['slideImage']['tmp_name'];
        $slideUrl = $_POST['slideUrl'];

        move_uploaded_file($temp_name,"slidesImages/$slideImage");

        if (empty($slideImage)){
            $slideImage = $newSlideImg;
        }


        $insertSlides = "update onlinestore.slider set slide_name = '$slideName', slider_image = '$slideImage', slide_url = '$slideUrl' where slider_id = $sliderId";
        $slidesQuery = mysqli_query($connection, $insertSlides);

        if ($slidesQuery) {

            ?>
            <script>alert("Slide has been Updated")</script>
            <script>window.open("index.php?viewSlides", "_self")</script>

            <?php
        }
    }

    ?>

    <?php

}

