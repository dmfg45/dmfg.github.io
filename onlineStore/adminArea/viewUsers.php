<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 22/03/2019
 * Time: 22:14
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
                <li class="active">
                    <i class="fas fa-tachometer-alt"></i>
                    &nbsp;Dashboard&nbsp;/&nbsp;View&nbsp;Users
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill"></i>&nbsp;View Users
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-stripped">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Admin Name</th>
                                <th>Admin Email</th>
                                <th>Admin Image</th>
                                <th>Admin Country</th>
                                <th>Admin Contact</th>
                                <th>Admin Job</th>
                                <th>Delete</th>
<!--                                <th>Edit</th>-->
                            </tr>
                            </thead>
                            <tbody>


                            <?php

                            $i = 0;

                            $query = "select * from onlinestore.admins";
                            $runQuery = mysqli_query($connection,$query);

                            while ($row = mysqli_fetch_array($runQuery)){
                                $adminId = $row['admin_id'];
                                $adminName = $row['admin_name'];
                                $adminEmail = $row['admin_email'];
                                $adminImage = $row['admin_image'];
                                $adminCountry = $row['admin_country'];
                                $adminContact = $row['admin_contact'];
                                $adminJob = $row['admin_job'];

                                $i++;

                                ?>

                                <tr>

                                    <td><?php echo $i ?></td>
                                    <td><?php echo $adminName ?></td>
                                    <td><?php echo $adminEmail ?></td>
                                    <td><img width="75" height="75" src="adminImages/<?php echo$adminImage ?>" alt="ProdImg"></td>
                                    <td><?php echo $adminCountry ?></td>
                                    <td><?php echo $adminContact ?></td>
                                    <td><?php echo $adminJob ?></td>
                                    <td><a href="index.php?deleteAdmin=<?php echo $adminId ?>"><i class="fas fa-times-circle fa-2x"></i></a></td>
<!--                                    <td><a href="index.php?editAdmin=--><?php //echo $adminId ?><!--"><i class="fas fa-user-edit fa-2x"></i></a></td>-->
                                </tr>
                                <?php

                            }

                            ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php }

