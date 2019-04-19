<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 26/03/2019
 * Time: 06:17
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
                <li class="active"><i class="fas fa-tachometer-alt"></i> Dashboard / View Boxes</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill-alt fa-fw"></i> View Boxes
                    </h3>
                </div>
                <div class="panel-body">
                    <?php

                    $getBoxes = "select * from onlinestore.boxes_section";
                    $runQuery = mysqli_query($connection,$getBoxes);

                    while ($row = mysqli_fetch_array($runQuery)){
                        $boxId = $row['box_id'];
                        $boxTitle = $row['box_title'];
                        $boxDesc = $row['box_desc'];
                        ?>

                        <div class="col-lg-4 col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-center">
                                    <?php echo $boxTitle?>
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <p><?php echo $boxDesc ?></p>
                                </div>
                                <div class="panel-footer clearfix">
                                    <a href="index.php?deleteBox=<?php echo $boxId ?>"><i class="fas fa-times-circle fa-2x pull-left"></i></a>
                                    <a href="index.php?editBox=<?php echo $boxId ?>"><i class="fas fa-edit fa-2x pull-right"></i></a>
                                </div>
                            </div>
                        </div>


                        <?php

                    }

                    ?>
                </div>
            </div>
        </div>
    </div>



    <?php
}

