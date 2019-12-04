<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

    <div class="row" ><!-- 1 row Starts -->

        <div class="col-lg-12" ><!-- col-lg-12 Starts -->

            <ol class="breadcrumb"><!-- breadcrumb Starts -->

                <li class="active">

                    <i class="fa fa-dashboard" ></i> Dashboard / Insert Enquiry

                </li>

            </ol><!-- breadcrumb Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 1 row Ends -->

    <div class="row"><!-- 2 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <div class="panel panel-default"><!-- panel panel-default Starts -->

                <div class="panel-heading"><!-- panel-heading Starts -->

                    <h3 class="panel-title">

                        <i class="fa fa-money fa-fw"></i> Edit Insert Enquiry

                    </h3>

                </div><!-- panel-heading Ends -->

                <div class="panel-body"><!-- panel-body Starts -->

                    <form action="" class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Enquiry Type</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="enquiryType">
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-primary form-control" name="insert" value="Insert Enquiry Type">
                            </div>
                        </div>
                    </form>

                </div><!-- panel-body Ends -->

            </div><!-- panel panel-default Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->

    <?php
    if (isset($_POST['insert'])){
        $enquiryType = $_POST['enquiryType'];
        $insertEnquiry = "insert into onlinestore.enquiry_types(enquiry_title) values ('$enquiryType')";
        $query = mysqli_query($connection,$insertEnquiry);

        if ($query){
            ?>
            <script>alert("New Enquiry Type has been Created")</script>
            <script>window.open("index.php?viewEnquiries", "_self")</script>
            <?php

        }
    }
    ?>

    <?php

}