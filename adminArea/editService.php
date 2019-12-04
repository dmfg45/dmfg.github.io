<?php
if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({selector:'#servicesDesc'});</script>

    <?php
    if (isset($_GET['editService'])){
        $service_id = $_GET['editService'];
        $getServices = "select * from onlinestore.services where service_id = $service_id";
        $serviceQuery = mysqli_query($connection,$getServices);
        $serviceRow = mysqli_fetch_array($serviceQuery);
        $service_title = $serviceRow['service_title'];
        $service_desc = $serviceRow['service_description'];
        $service_image = $serviceRow['service_image'];
        $newService_image = $serviceRow['service_image'];
        $service_btn = $serviceRow['service_button'];
        $service_url = $serviceRow['service_url'];
    }
    ?>

    <div class="row" ><!-- 1 row Starts -->

        <div class="col-lg-12" ><!-- col-lg-12 Starts -->

            <ol class="breadcrumb"><!-- breadcrumb Starts -->

                <li class="active">

                    <i class="fa fa-dashboard" ></i> Dashboard / Edit Service

                </li>

            </ol><!-- breadcrumb Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 1 row Ends -->

    <div class="row"><!-- 2 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <div class="panel panel-default"><!-- panel panel-default Starts -->

                <div class="panel-heading"><!-- panel-heading Starts -->

                    <h3 class="panel-title">

                        <i class="fa fa-money fa-fw"></i> Edit Service

                    </h3>

                </div><!-- panel-heading Ends -->

                <div class="panel-body"><!-- panel-body Starts -->
                    <form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                                Service Title
                            </label>
                            <div class="col-md-6">
                                <input type="text" name="serviceTitle" value="<?php echo $service_title ?>" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                                Service Image
                            </label>
                            <div class="col-md-6">
                                <img src="servicesImages/<?php echo $service_title ?>" alt="ServiceImage">
                                <br><br>
                                <input type="file" name="serviceImg" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                                Service Description
                            </label>
                            <div class="col-md-6">
                                <textarea name="serviceDesc" id="servicesDesc" cols="30" rows="10" class="form-control"><?php echo $service_desc ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                                Service Button
                            </label>
                            <div class="col-md-6">
                                <input type="text" value="<?php echo $service_btn ?>" name="serviceBtn" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                                Service Url
                            </label>
                            <div class="col-md-6">
                                <input type="text" value="<?php echo $service_url ?>" name="serviceUrl" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">
                            </label>
                            <div class="col-md-6">
                                <input type="submit" name="update" class="btn btn-primary form-control">
                            </div>
                        </div>
                    </form>


                </div><!-- panel-body Ends -->

            </div><!-- panel panel-default Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->

    <?php
    if (isset($_POST['update'])){
        $serviceTitle = $_POST['serviceTitle'];
        $serviceImg = $_FILES['serviceImg']['name'];
        $tmp_serviceImg = $_FILES['serviceImg']['tmp_name'];
        $serviceDesc = $_POST['serviceDesc'];
        $serviceBtn = $_POST['serviceBtn'];
        $serviceUrl = $_POST['serviceUrl'];

        if (empty($serviceImg)){
            $serviceImg = $newService_image;
        }

        move_uploaded_file($tmp_serviceImg,"servicesImages/$serviceImg");

        $insert = "update onlinestore.services set 
                                service_title ='$serviceTitle',
                                service_image ='$serviceImg',
                                service_description = '$serviceDesc',
                                service_button = '$serviceBtn',
                                service_url = '$serviceUrl' where service_id = $service_id";

        $query = mysqli_query($connection,$insert);
        if ($query){
            ?>
            <script>alert("A Service has been updated")</script>
            <script>window.open("index.php?viewServices","_self")</script>
            <?php
        }else{
            die("<h4 class='danger'>Something went wrong</h4><br>".mysqli_error($connection));
        }

    }
    ?>

    <?php
}
