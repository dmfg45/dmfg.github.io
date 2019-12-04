<?php
if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({selector:'#servicesDesc'});</script>

    <div class="row" ><!-- 1 row Starts -->

        <div class="col-lg-12" ><!-- col-lg-12 Starts -->

            <ol class="breadcrumb"><!-- breadcrumb Starts -->

                <li class="active">

                    <i class="fa fa-dashboard" ></i> Dashboard / Insert Service

                </li>

            </ol><!-- breadcrumb Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 1 row Ends -->

    <div class="row"><!-- 2 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <div class="panel panel-default"><!-- panel panel-default Starts -->

                <div class="panel-heading"><!-- panel-heading Starts -->

                    <h3 class="panel-title">

                        <i class="fa fa-money fa-fw"></i> Insert Service

                    </h3>

                </div><!-- panel-heading Ends -->

                <div class="panel-body"><!-- panel-body Starts -->
                    <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                                Service Title
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="serviceTitle" class="form-control">
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                                Service Image
                            </label>
                            <div class="col-md-6">
                                <input type="file" name="serviceImg" class="form-control">
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                                Service Description
                            </label>
                            <div class="col-md-6">
                                <textarea name="serviceDesc" id="servicesDesc" cols="30" rows="10" class="form-control"></textarea>
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                                Service Button
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="serviceBtn" class="form-control">
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                                Service Url
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="serviceUrl" class="form-control">
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                            </label>
                            <div class="col-md-6">
                                <input type="submit" name="insert" class="btn btn-primary form-control">
                            </div>
                        </div>
                    </form>


                </div><!-- panel-body Ends -->

            </div><!-- panel panel-default Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->

    <?php
    if (isset($_POST['insert'])){
        $serviceTitle = $_POST['serviceTitle'];
        $serviceImg = $_FILES['serviceImg']['name'];
        $tmp_serviceImg = $_FILES['serviceImg']['tmp_name'];
        $serviceDesc = $_POST['serviceDesc'];
        $serviceBtn = $_POST['serviceBtn'];
        $serviceUrl = $_POST['serviceUrl'];

        move_uploaded_file($tmp_serviceImg,"servicesImages/$serviceImg");

        $insert = "insert into onlinestore.services (
                                  service_title,
                                  service_image,
                                  service_description,
                                  service_button,
                                  service_url) 
                                  VALUES ('$serviceTitle',
                                          '$serviceImg',
                                          '$serviceDesc',
                                          '$serviceBtn',
                                          '$serviceUrl')";

        $query = mysqli_query($connection,$insert);
        if ($query){
            ?>
            <script>alert("A Service has been created")</script>
            <script>window.open("index.php?viewServices","_self")</script>
            <?php
        }else{
            die("<h4 class='danger'>Something went wrong</h4><br>".mysqli_error($connection));
        }

    }
    ?>

    <?php
}
