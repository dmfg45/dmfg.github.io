<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>


    <?php

    $getContactInf = "select * from onlinestore.contact_us";
    $contactQuery = mysqli_query($connection,$getContactInf);
    $contactRow = mysqli_fetch_array($contactQuery);
    $contactEmail = $contactRow['contact_email'];
    $contactHead = $contactRow['contact_heading'];
    $contactDesc = $contactRow['contact_description'];

    ?>


    <div class="row" ><!-- 1 row Starts -->

        <div class="col-lg-12" ><!-- col-lg-12 Starts -->

            <ol class="breadcrumb"><!-- breadcrumb Starts -->

                <li class="active">

                    <i class="fas fa-tachometer-alt" ></i> Dashboard / Edit Contact Us

                </li>

            </ol><!-- breadcrumb Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 1 row Ends -->

    <div class="row"><!-- 2 row Starts -->

        <div class="col-lg-12"><!-- col-lg-12 Starts -->

            <div class="panel panel-default"><!-- panel panel-default Starts -->

                <div class="panel-heading"><!-- panel-heading Starts -->

                    <h3 class="panel-title">

                        <i class="fas fa-money-bill-alt fa-fw"></i> Edit Contact Us

                    </h3>

                </div><!-- panel-heading Ends -->

                <div class="panel-body"><!-- panel-body Starts -->
                    <form class="form-horizontal" action="" method="post">
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="">Contact Email :</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="contactEmail" value="<?php echo $contactEmail ?>">
                            </div>
                        </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="">Contact Heading :</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="contactHeading" value="<?php echo $contactHead ?>">
                            </div>
                        </div>
                    <div class="form-group">
                            <label class="col-md-3 control-label" for="">Contact Description :</label>
                            <div class="col-md-6">
                                <textarea name="contactDesc" id="" cols="9" rows="6" class="form-control"><?php echo $contactDesc ?></textarea>
                            </div>
                        </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label" for=""></label>
                        <div class="col-md-6">
                            <input type="submit" class="btn btn-primary form-control" value="Update Contact Us" name="update">                        </div>
                        </div>
                    </form>

                </div><!-- panel-body Ends -->

            </div><!-- panel panel-default Ends -->

        </div><!-- col-lg-12 Ends -->

    </div><!-- 2 row Ends -->

    <?php
    if (isset($_POST['update'])){
        $contact_email= $_POST['contactEmail'];
        $contact_desc = $_POST['contactDesc'];
        $contact_heading = $_POST['contactHeading'];

        $query = "update onlinestore.contact_us set contact_email = '$contact_email', contact_heading = '$contact_heading',contact_description = '$contact_desc'";
        $contactQuery = mysqli_query($connection,$query);

        if ($contactQuery){
            ?>
            <script>alert("Contact Us Page has been Updated")</script>
            <script>window.open("index.php?dashboard", "_self")</script>
            <?php
        }
    }
    ?>

    <?php
}