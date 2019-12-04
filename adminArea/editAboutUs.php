<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({selector: 'textarea'});</script>

    <div class="row"><!-- 1 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <ol class="breadcrumb"><!-- breadcrumb Starts -->

                <li class="active">

                    <i class="fa fa-dashboard"></i> Dashboard / Edit About Us

                </li>

            </ol><!-- breadcrumb Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 1 row Ends -->

    <div class="row"><!-- 2 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <div class="panel panel-default"><!-- panel panel-default Starts -->

                <div class="panel-heading"><!-- panel-heading Starts -->

                    <h3 class="panel-title">

                        <i class="fa fa-money fa-fw"></i> Edit About Us

                    </h3>

                </div><!-- panel-heading Ends -->

                <div class="panel-body"><!-- panel-body Starts -->
                    <?php
                    $getAboutUs = "select * from onlinestore.about_us";
                    $query = mysqli_query($connection, $getAboutUs);
                    $aboutRow = mysqli_fetch_array($query);
                    $aboutHeading = $aboutRow['about_heading'];
                    $aboutShortDesc = $aboutRow['about_short_desc'];
                    $aboutDesc = $aboutRow['about_desc'];
                    ?>
                    <form action="" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                                About Us Heading :
                            </label>
                            <div class="col-md-8">
                                <input type="text" name="aboutHeading" value="<?php echo $aboutHeading ?>"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                                About Us Short Description :
                            </label>
                            <div class="col-md-8">
                                <textarea name="aboutShortDesc" id="" cols="30" rows="15"
                                          class="form-control"><?php echo $aboutShortDesc ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                                About Us Description :
                            </label>
                            <div class="col-md-8">
                                <textarea name="aboutDesc" id="" cols="30" rows="20"
                                          class="form-control"><?php echo $aboutDesc ?></textarea>

                            </div>
                        </div>
                    <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                            </label>
                            <div class="col-md-8">
                                <input type="submit" class="btn btn-primary form-control" value="Update About Us Page" name="update">
                            </div>
                        </div>
                    </form>


                </div><!-- panel-body Ends -->

            </div><!-- panel panel-default Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->

    <?php
    if (isset($_POST['update'])){
        $about_heading = $_POST['aboutHeading'];
        $about_short_desc = $_POST['aboutShortDesc'];
        $about_desc = $_POST['aboutDesc'];


        $aboutUsCount = mysqli_num_rows($query);

        if ($aboutUsCount == 0){
            $insertAbout = "insert into onlinestore.about_us(
                                 about_heading,
                                 about_short_desc,
                                 about_desc)
                                  values (
                                          '$about_heading',
                                          '$about_short_desc',
                                          '$about_desc'
                                          )";
            $aboutInQuery = mysqli_query($connection,$insertAbout);
            if ($aboutInQuery){
                ?>
                <script>alert("The About Us Page has been Updated")</script>
                <script>window.open("index.php?dashboard","_self")</script>
                <?php
            }
            
        }else{

            $updateAbout = "update onlinestore.about_us set about_heading = '$about_heading', about_short_desc = '$about_short_desc', about_desc = '$about_desc'";
            $aboutQuery = mysqli_query($connection,$updateAbout);



            if ($aboutQuery){
                ?>
                <script>alert("The About Us Page has been Updated")</script>
                <script>window.open("index.php?dashboard","_self")</script>
                <?php
            }
        }

    }
    ?>

    <?php
}
