<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {

    if (isset($_GET['editShippingType'])){
        $type_Id = $_GET['editShippingType'];
        $getTypes = "select * from onlinestore.shipping_types where type_id = $type_Id";
        $query = mysqli_query($connection,$getTypes);
        $rowTypes = mysqli_fetch_array($query);
        $typeName = $rowTypes['type_name'];
        $typeDefault = $rowTypes['type_default'];
        $typeLocal = $rowTypes['type_local'];
    }

    ?>

    <link rel="stylesheet" href="css/chosen.min.css">
    <script src="js/chosen.jquery.min.js"></script>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard / Edit Shipping Type
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill-alt fa-fw"></i> Edit Shipping Type
                    </h3>
                </div>
                <div class="panel-body">
                    <form action="" class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Type Name</label>
                            <div class="col-md-7">
                                <input type="text" name="typeName" value="<?php echo $typeName;?>" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Type Default</label>
                            <div class="col-md-7">

                                    <label for="">
                                        <input type="radio" name="typeDefault" value="yes" required
                                            <?php if ($typeDefault == "yes"){ echo "checked";} ?>
                                        > Yes
                                    </label>
                                    <label for="">
                                        <input type="radio" name="typeDefault" value="no" required
                                            <?php if ($typeDefault == "no"){ echo "checked";} ?>
                                        > No
                                    </label>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-7">
                                <input type="submit" name="update" class="btn btn-primary form-control" value="Update">
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['update'])) {
        $type_name = mysqli_real_escape_string($connection, $_POST['typeName']);
        $type_default = mysqli_real_escape_string($connection, $_POST['typeDefault']);

        if ($type_default == "yes") {
            $updateTypeDef = "update onlinestore.shipping_types set type_default = 'no' where type_local = '$typeLocal'";
            $typeDefQuery = mysqli_query($connection, $updateTypeDef);

        }

        $updateShippingType = "update onlinestore.shipping_types set type_name = '$type_name', type_default = '$type_default' where type_id = $type_Id";
        $updateQuery = mysqli_query($connection,$updateShippingType);

        if ($updateShippingType){
            ?>
            <script>
                alert("Shipping Type has been updated Successfully")
            </script>
            <script>
                window.open("index.php?viewShippingTypes", "_self")
            </script>
            <?php
        }

    }

}
