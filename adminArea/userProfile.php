<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 26/03/2019
 * Time: 04:28
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

    if (isset($_GET['userProfile'])) {
        $adminId = $_GET['userProfile'];

        $getAdmin = "select * from onlinestore.admins where admin_id = $adminId";
        $queryRun = mysqli_query($connection, $getAdmin);

        $rowAdmin = mysqli_fetch_array($queryRun);

        $admin_name = $rowAdmin['admin_name'];
        $admin_email = $rowAdmin['admin_email'];
        $admin_password = $rowAdmin['admin_password'];
        $admin_id = $rowAdmin['admin_id'];
        $admin_country = $rowAdmin['admin_country'];
        $admin_job = $rowAdmin['admin_job'];
        $admin_about = $rowAdmin['admin_about'];
        $admin_image = $rowAdmin['admin_image'];
        $new_admin_image = $rowAdmin['admin_image'];
        $admin_contact = $rowAdmin['admin_contact'];


    }

    ?>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard&nbsp;/&nbsp;Edit Profile</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fas fa-money-bill-alt fa-fw"></i> User Profile User</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">User Name:</label>
                            <div class="col-md-6">
                                <input type="text" name="adminName" class="form-control"
                                       value="<?php echo $admin_name ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">User Email:</label>
                            <div class="col-md-6">
                                <input type="text" name="adminEmail" class="form-control"
                                       value="<?php echo $admin_email ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">User Image:</label>
                            <div class="col-md-6">
                                <img src="adminImages/<?php echo $admin_image ?>" alt="ProfileImage"
                                     class="img-responsive" width="150" height="150">
                                <br>
                                <input type="file" name="adminImage" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">User Contact:</label>
                            <div class="col-md-6">
                                <input type="text" name="adminContact" class="form-control"
                                       value="<?php echo $admin_contact ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">User Country:</label>
                            <div class="col-md-6">
                                <input type="text" name="adminCountry" class="form-control"
                                       value="<?php echo $admin_country ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">User Job:</label>
                            <div class="col-md-6">
                                <input type="text" name="adminJob" class="form-control" value="<?php echo $admin_job ?>"
                                       required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">User About:</label>
                            <div class="col-md-6">
                                <textarea name="adminAbout" id="" cols="30" rows="10" class="form-control"
                                          required><?php echo $admin_about ?></textarea>
                            </div>
                        </div>
                        <hr>
                        <h4 class="text-center">Change Account Password: <span style="font-size: 14px" class="text-muted">&nbsp;If you don't want to chge your password leave these fields empty.</span></h4>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Change Password:</label>
                            <div class="col-md-6">
                                <input type="password" name="adminPass" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Confirm Password:</label>
                            <div class="col-md-6">
                                <input type="password" name="confirmAdminPass" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <input type="submit" name="update" value="Update Profile"
                                       class="btn btn-primary form-control">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php

    if (isset($_POST['update'])) {

        $adminName = $_POST['adminName'];
        $adminEmail = $_POST['adminEmail'];
        $adminImage = $_FILES['adminImage']['name'];
        $tmp_name = $_FILES['adminImage']['tmp_name'];
        $adminContact = $_POST['adminContact'];
        $adminCountry = $_POST['adminCountry'];
        $adminJob = $_POST['adminJob'];
        $adminAbout = $_POST['adminAbout'];



        move_uploaded_file($tmp_name, "adminImages/$adminImage");

        if (empty($adminImage)){
            $adminImage = $new_admin_image;
        }

        $adminPass = $_POST['adminPass'];
        $confirmPass = $_POST['confirmAdminPass'];

        if (!empty($adminPass) or (!empty($confirmPass))){
            if ($adminPass !== $confirmPass){
                ?>
                <script>alert("Your Passwords do not match")</script>
                <?php
            }else{
                $encryptPass = password_hash($confirmPass,PASSWORD_DEFAULT);
                $updatePassQuery = "update onlinestore.admins set
                              admin_password = '$encryptPass' where admin_id = $adminId";
                $runPassQuery = mysqli_query($connection, $updatePassQuery);
            }
        }

        $query = "update onlinestore.admins set
                              admin_email = '$adminEmail',
                              admin_contact = '$adminContact',
                              admin_about = '$adminAbout',
                              admin_country = '$adminCountry',
                              admin_image = '$adminImage',
                              admin_job = '$adminJob',
                              admin_name = '$adminName' where admin_id = $adminId";
        $runQuery = mysqli_query($connection, $query);

        if ($runQuery) {
            ?>
            <script>alert("User profile was successfully updated")</script>
            <script>window.open("login.php", "_self")</script>
            <?php
            session_destroy();
        } else {
            die("<h3 style='color: #ac2925'>Error -> </h3>" . mysqli_error($connection));
        }
    }


}

