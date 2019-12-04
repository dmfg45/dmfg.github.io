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
                <li class="active"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard / View Manufacturers</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fas fa-money-bill-alt"></i>&nbsp;View Manufacturers</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <th>
                                    Manufacturer Nº
                                </th>
                                <th>
                                    Manufacturer Title
                                </th>
                                <th>
                                    Manufacturer Image
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php

                            $i = 0;

                            $query = "select * from onlinestore.manufacturers";
                            $runQuery = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_array($runQuery)) {
                                $manufacturerId = $row['manufacturer_id'];
                                $manufacturerTitle = $row['manufacturer_title'];
                                $manufacturerImage = $row['manufacturer_image'];
                                $i++;
                                ?>

                                <tr>
                                    <td>
                                        <?php echo $i ?>
                                    </td>
                                    <td>
                                        <?php echo $manufacturerTitle ?>
                                    </td>
                                    <td>
                                        <img src="otherImages/<?php echo $manufacturerImage ?>" alt="manufacturerImage" width="75" height="75" class="img-responsive">
                                    </td>
                                    <td>
                                        <a href="index.php?deleteManufacturer=<?php echo $manufacturerId ?>"><i class="fas fa-times-circle fa-2x"></i></a>
                                    </td>
                                    <td>
                                        <a href="index.php?editManufacturer=<?php echo $manufacturerId ?>"><i class="fas fa-edit fa-2x"></i></a>
                                    </td>
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


    <?php

}