<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

    <link rel="stylesheet" href="css/chosen.min.css">
    <script src="js/chosen.jquery.min.js"></script>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard / Insert Shipping Type
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill-alt fa-fw"></i> Insert Shipping Type
                    </h3>
                </div>
                <div class="panel-body">
                    <form action="" class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Type Name</label>
                            <div class="col-md-7">
                                <input type="text" name="typeName" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Type Default</label>
                            <div class="col-md-7">
                                <label for="">
                                    <input type="radio" name="typeDefault" value="yes"> Yes
                                </label>
                                <label for="">
                                    <input type="radio" name="typeDefault" value="no"> No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Type Local</label>
                            <div class="col-md-7">
                                <label for="">
                                    <input type="radio" name="typeLocal" value="yes"> Yes
                                </label>
                                <label for="">
                                    <input type="radio" name="typeLocal" value="no"> No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-7">
                                <input type="submit" name="insert" class="btn btn-primary form-control" value="Submit">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['insert'])) {
        $type_name = mysqli_real_escape_string($connection, $_POST['typeName']);
        $type_default = mysqli_real_escape_string($connection, $_POST['typeDefault']);
        $type_local = mysqli_real_escape_string($connection, $_POST['typeLocal']);

        if ($type_default == "yes") {
            $updateTypeDef = "update onlinestore.shipping_types set type_default = 'no' where type_local = '$type_local'";
            $typeDefQuery = mysqli_query($connection, $updateTypeDef);

        }

        $selectTypeOrder = "select max(type_order) as type_order from onlinestore.shipping_types where type_local = '$type_local'";
        $typeOrderQuery = mysqli_query($connection, $selectTypeOrder);
        $rowTypeOrder = mysqli_fetch_array($typeOrderQuery);
        $typeOrder = $rowTypeOrder['type_order'] + 1;
        $insertShippingType = "insert into onlinestore.shipping_types(
                                       type_name,
                                       type_default,
                                       type_local,
                                       type_order) 
                                       VALUES ('$type_name','$type_default','$type_local','$typeOrder')";

        $insertShippQuery = mysqli_query($connection, $insertShippingType);

        if ($insertShippQuery) {
            ?>
            <script>
                alert("New Shipping Type has been inserted Successfully")
            </script>
            <script>
                window.open("index.php?viewShippingTypes", "_self")
            </script>
            <?php
        }

    }

}
