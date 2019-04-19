<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 21/03/2019
 * Time: 20:23
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
                <li class="active"><i class="fas fa-tachometer-alt"></i> Dashboard / View Slides</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fas fa-money-bill-alt fa-fw"></i>&nbsp;View Slides</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-stripped">
                            <thead>
                            <tr>
                                <th>Category No:</th>
                                <th>Slide Name:</th>
                                <th>Slide Image</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php

                            $i = 0;

                            $query = "select * from onlinestore.slider";
                            $runQuery = mysqli_query($connection,$query);

                            while ($rowC = mysqli_fetch_array($runQuery)){

                                $slideId = $rowC['slider_id'];
                                $slideName = $rowC['slide_name'];
                                $slideImage = $rowC['slider_image'];

                                $i++

                                ?>

                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $slideName ?></td>
                                    <td><img src="slidesImages/<?php echo $slideImage ?>" alt="SlideIMG" width="250" height="250" class="img-responsive"></td>
                                    <td><a href="index.php?deleteSlide=<?php echo $slideId ?>"><i class="fas fa-times-circle fa-2x"></i></a></td>
                                    <td><a href="index.php?editSlide=<?php echo $slideId ?>"><i class="fas fa-edit fa-2x"></i></a></td>
                                </tr>
                            <?php  } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


<?php }
