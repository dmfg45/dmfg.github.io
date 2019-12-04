<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {

    if (isset($_GET['editShippingRates'])){
        $typeId = $_GET['editShippingRates'];
        $selectShippingType = "select * from onlinestore.shipping_types where type_id = $typeId";
        $shippingTypeQuery = mysqli_query($connection,$selectShippingType);
        $rowShippingType = mysqli_fetch_array($shippingTypeQuery);
        $typeName = $rowShippingType['type_name'];
        if (isset($_GET['zone_id'])){
            $zoneId = $_GET['zone_id'];
            $getZones = "select * from onlinestore.zones where zone_id = $zoneId";
            $zoneQuery = mysqli_query($connection,$getZones);
            $rowZone = mysqli_fetch_array($zoneQuery);
            $zoneName = $rowZone['zone_name'];

        }elseif ($_GET['countryId']){
            $countryId = $_GET['countryId'];
            $getCountries = "select * from onlinestore.countries where country_code = '$countryId'";
            $countryQuery = mysqli_query($connection,$getCountries);
            $rowCountries = mysqli_fetch_array($countryQuery);
            $countryName = $rowCountries['country_name'];


        }
    }

    ?>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard / Edit Shipping Rates
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill-alt fa-fw"></i> Edit Shipping Rates
                    </h3>
                </div>
                <div class="panel-body">
                    <h4>
                        <strong>Edit Shipping Rates For:</strong>
                        <?php
                        if (isset($_GET['zone_id'])){
                           echo $zoneName;
                        }elseif ($_GET['countryId']){
                            echo $countryName;
                        }

                        echo "&nbsp;&xrArr; $typeName";
                        ?>
                    </h4>
                    <h3>Insert Shipping Rate:</h3>
                    <form action="" method="post">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Weight up to :</label>
                                    <input type="text" name="shippingWeight" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Cost :</label>
                                    <input type="text" name="shippingCost" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Submit" name="insert" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $("form").submit(function (event) {
                event.preventDefault();
                $.ajax({
                    method: "POST",
                    url: "insertShippingRate.php",

                    <?php
                    if (isset($_GET['zone_id'])){ ?>

                    data: $("form").serialize() + "&type_id=<?php echo $typeId ?>&zone_id=<?php echo $zoneId ?>",

                        <?php }elseif (isset($_GET['countryId'])){ ?>

                    data: $("form").serialize() + "&type_id=<?php echo $typeId ?>&countryId=<?php echo $countryId ?>"

                    <?php } ?>

                    success:function () {
                        $("form").find("input[type=text]").val("");
                    }
                })
            })
        })
    </script>
    <?php
}