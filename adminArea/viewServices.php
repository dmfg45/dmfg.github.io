<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

    <div class="row"><!-- 1 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <ol class="breadcrumb"><!-- breadcrumb Starts -->

                <li class="active">

                    <i class="fas fa-tachometer-alt"></i> Dashboard / View Services

                </li>

            </ol><!-- breadcrumb Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 1 row Ends -->

    <div class="row"><!-- 2 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <div class="panel panel-default"><!-- panel panel-default Starts -->

                <div class="panel-heading"><!-- panel-heading Starts -->

                    <h3 class="panel-title">

                        <i class="fas fa-money-bill-alt fa-fw"></i> View Services

                    </h3>

                </div><!-- panel-heading Ends -->

                <div class="panel-body"><!-- panel-body Starts -->
                    <?php
                    $getServices = "select * from onlinestore.services";
                    $query = mysqli_query($connection, $getServices);
                    while ($serviceRow = mysqli_fetch_array($query)) {
                        $serviceId = $serviceRow['service_id'];
                        $serviceTitle = $serviceRow['service_title'];
                        $serviceImage = $serviceRow['service_image'];
                        $serviceDesc = $serviceRow['service_description'];
                        $serviceBtn = $serviceRow['service_button'];
                        $serviceUrl = $serviceRow['service_url'];
                        $newServiceDesc = substr($serviceDesc, 0, 350);
                        ?>
                        <div class="col-lg-4 col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-center">
                                        <?php echo $serviceTitle ?>
                                    </h3>
                                </div>
                                <div class="panel-body text-center">
                                    <img src="servicesImages/<?php echo $serviceImage ?>" alt="ServiceImg" class="img-responsive">
                                    <p class="text-justify" style="padding: 2%"><?php echo $newServiceDesc ?>&nbsp;<span><b>. . .</b></span>
                                    <p class="btn btn-primary"><?php echo $serviceBtn ?></p>
                                </div>
                                <div class="panel-footer clearfix">
                                    <a href="index.php?deleteService=<?php echo $serviceId ?>"><i class="fas fa-times-circle fa-2x pull-left"></i></a>
                                    <a href="index.php?editService=<?php echo $serviceId ?>"><i class="fas fa-edit fa-2x pull-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                        ?>
                </div><!-- panel-body Ends -->

            </div><!-- panel panel-default Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->

    <?php

}