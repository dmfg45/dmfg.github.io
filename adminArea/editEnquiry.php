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

                    <i class="fa fa-dashboard" ></i> Dashboard / Edit Enquiry

                </li>

            </ol><!-- breadcrumb Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 1 row Ends -->

    <div class="row"><!-- 2 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <div class="panel panel-default"><!-- panel panel-default Starts -->

                <div class="panel-heading"><!-- panel-heading Starts -->

                    <h3 class="panel-title">

                        <i class="fa fa-money fa-fw"></i> Edit Enquiry

                    </h3>

                </div><!-- panel-heading Ends -->

                <div class="panel-body"><!-- panel-body Starts -->

                    <?php
                    if (isset($_GET['editEnquiry'])){
                        $enquiryId = $_GET['editEnquiry'];
                        $getEnquiries = "select * from onlinestore.enquiry_types where enquiry_id = $enquiryId";
                        $enquiryQuery = mysqli_query($connection,$getEnquiries);

                        $enquiryRow = mysqli_fetch_array($enquiryQuery);
                        $enquiry_Type = $enquiryRow['enquiry_title'];


                    }
                    ?>

                    <form action="" class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Enquiry Type</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" value="<?php echo $enquiry_Type ?>" name="enquiryType">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-primary form-control" name="update" value="Insert Enquiry Type">
                            </div>
                        </div>
                    </form>

                </div><!-- panel-body Ends -->

            </div><!-- panel panel-default Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->

    <?php
    if (isset($_POST['update'])){
        $enquiryType = $_POST['enquiryType'];
        $updateEnquiry = "update onlinestore.enquiry_types set enquiry_title = '$enquiryType' where enquiry_id = $enquiryId";
        $query = mysqli_query($connection,$updateEnquiry);

        if ($query){
            ?>
            <script>alert("Enquiry Type has been Updated")</script>
            <script>window.open("index.php?viewEnquiries", "_self")</script>
            <?php

        }
    }
    ?>

    <?php

}