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

                    <i class="fa fa-dashboard"></i> Dashboard / View Enquiries

                </li>

            </ol><!-- breadcrumb Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 1 row Ends -->

    <div class="row"><!-- 2 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <div class="panel panel-default"><!-- panel panel-default Starts -->

                <div class="panel-heading"><!-- panel-heading Starts -->

                    <h3 class="panel-title">

                        <i class="fa fa-money fa-fw"></i> View Enquiries

                    </h3>

                </div><!-- panel-heading Ends -->

                <div class="panel-body"><!-- panel-body Starts -->

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>Enquiry Nº</th>
                                <th>Enquiry Type</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <?php
                                $i = 0;
                                $getEnquiries = "select * from onlinestore.enquiry_types";
                                $enqQuery = mysqli_query($connection, $getEnquiries);

                                while ($enquiryRow = mysqli_fetch_array($enqQuery)){
                                $enquiryId = $enquiryRow['enquiry_id'];
                                $enquiryType = $enquiryRow['enquiry_title'];
                                $i++;
                                ?>
                                <td><?php echo $i ?></td>
                                <td><?php echo $enquiryType ?></td>
                                <td>
                                    <a href="index.php?deleteEnquiry=<?php echo $enquiryId ?>">
                                        <i class="fas fa-times-circle fa-2x"></i>
                                    </a>
                                </td>
                                <td>
                                    <a href="index.php?editEnquiry=<?php echo $enquiryId ?>">
                                        <i class="fas fa-edit fa-2x"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>

                </div><!-- panel-body Ends -->

            </div><!-- panel panel-default Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->
    <?php
}