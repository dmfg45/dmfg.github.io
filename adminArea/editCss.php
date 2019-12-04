<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

    <?php

    $file = "../styles/styles.css";

    if (file_exists($file)) {
        $data = file_get_contents($file);
    }

    ?>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active"><i class="fas fa-tachometer-alt"></i> Edit css File</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fas fa-money-bill-alt"></i> Edit css File</h3>
                </div>
                <div class="panel-body">
                    <form action="" method="post" class="form-horizontal">
                        <div class="form-group">
                            <div class="col-md-12">
                                <textarea name="newData" id="" rows="25" class="form-control">
                                    <?php echo $data ?>
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-6">
                                <input type="submit" name="update" value="Update css File"
                                       class="btn btn-primary form-control">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_POST['update'])) {
        $newData = $_POST['newData'];

        $handle = fopen($file, "w");

        fwrite($handle, $newData);
        fclose($handle);
        ?>
        <script>alert("Css file has been Updated")</script>
        <script>window.open("index.php?editCss", "_self")</script>
        <?php
    } ?>

    <?php
}