<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 22/03/2019
 * Time: 19:56
 */
?>

<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard&nbsp;/&nbsp;Insert User</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fas fa-money-bill-alt fa-fw"></i> Insert User</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">User Name:</label>
                            <div class="col-md-6">
                                <input type="text" name="adminName" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">User Password:</label>
                            <div class="col-md-6">
                                <input type="password" name="adminPw" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">User Email:</label>
                            <div class="col-md-6">
                                <input type="text" name="adminEmail" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">User Image:</label>
                            <div class="col-md-6">
                                <input type="file" name="adminImage" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">User Contact:</label>
                            <div class="col-md-6">
                                <input type="text" name="adminContact" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">User Country:</label>
                            <div class="col-md-6">
                                <input type="text" name="adminCountry" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">User Job:</label>
                            <div class="col-md-6">
                                <input type="text" name="adminJob" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">User About:</label>
                            <div class="col-md-6">
                                <input type="text" name="adminAbout" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <input type="submit" name="submit" class="btn btn-primary form-control" required>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <?php

    if (isset($_POST['submit'])) {

        $adminName = $_POST['adminName'];
        $adminPw = password_hash($_POST['adminPw'],PASSWORD_DEFAULT);
        $adminEmail = $_POST['adminEmail'];
        $adminImage = $_FILES['adminImage']['name'];
        $tmp_name = $_FILES['adminImage']['tmp_name'];
        $adminContact = $_POST['adminContact'];
        $adminCountry = $_POST['adminCountry'];
        $adminJob = $_POST['adminJob'];
        $adminAbout = $_POST['adminAbout'];

        move_uploaded_file($tmp_name,"adminImages/$adminImage");

        $query = "insert into onlinestore.admins(
                               admin_name,
                               admin_email,
                               admin_password,
                               admin_image,
                               admin_contact,
                               admin_country,
                               admin_job,
                               admin_about) VALUES ('$adminName',
                                                    '$adminEmail',
                                                    '$adminPw',
                                                    '$adminImage',
                                                    '$adminContact',
                                                    '$adminCountry',
                                                    '$adminJob',
                                                    '$adminAbout')";
        $runQuery = mysqli_query($connection, $query);

        if ($runQuery) {
            ?>
            <script>alert("New user was added successfully")</script>
            <script>window.open("index.php?viewUsers", "_self")</script>
            <?php
        } else {
            die("<h3 style='color: #ac2925'>Error -> </h3>" . mysqli_error($connection));
        }
    }


}
