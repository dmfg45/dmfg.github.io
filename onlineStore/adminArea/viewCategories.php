<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 21/03/2019
 * Time: 18:29
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
                <li class="active"><i class="fas fa-tachometer-alt"></i> Dashboard / View Product Categories</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fas fa-money-bill-alt fa-fw"></i>&nbsp;View Product Categories</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-stripped">
                            <thead>
                            <tr>
                                <th>Category No:</th>
                                <th>Category title:</th>
                                <th>Category Description:</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php

                            $i = 0;

                            $query = "select * from onlinestore.categories";
                            $runQuery = mysqli_query($connection,$query);

                            while ($rowC = mysqli_fetch_array($runQuery)){

                                $catId = $rowC['cat_id'];
                                $catTitle = $rowC['cat_title'];
                                $catDesc = $rowC['cat_desc'];

                                $i++

                                ?>

                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $catTitle ?></td>
                                    <td width="300"><?php echo $catDesc ?></td>
                                    <td><a href="index.php?deleteCat=<?php echo $catId ?>"><i class="fas fa-times-circle fa-2x"></i></a></td>
                                    <td><a href="index.php?editCat=<?php echo $catId ?>"><i class="fas fa-edit fa-2x"></i></a></td>
                                </tr>
                            <?php  } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php

}
