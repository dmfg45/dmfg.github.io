<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 26/03/2019
 * Time: 06:05
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
            <li class="active"><i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard / Insert Box</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fas fa-money-bill-alt fa-fw"></i>&nbsp;Insert Box</h3>
            </div>
            <div class="panel-body">
                <form action="" class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Box Title :</label>
                        <div class="col-md-6">
                            <input type="text" name="boxTitle" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-md-3 control-label">Box Description :</label>
                        <div class="col-md-6">
                            <textarea name="boxDesc" class="form-control"></textarea>
                        </div>
                    </div>
                <div class="form-group">
                        <label for="" class="col-md-3 control-label"></label>
                        <div class="col-md-6">
                            <input type="submit" name="submit" value="Insert Box" class="btn btn-primary form-control">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <?php

    if (isset($_POST['submit'])){
        $boxTitle = $_POST['boxTitle'];
        $boxDesc = $_POST['boxDesc'];

        $query = "insert into onlinestore.boxes_section (box_title, box_desc) values ('$boxTitle', '$boxDesc')";
        $runQuery = mysqli_query($connection, $query);

        if ($runQuery){
            ?>
            <script>alert("New Box has been Inserted")</script>
            <script>window.open("index.php?viewBoxes","_self")</script>
            <?php
        }else{
            die("Something Went Wrong -> ".mysqli_error($connection));
        }

    }

    ?>

    <?php
}
