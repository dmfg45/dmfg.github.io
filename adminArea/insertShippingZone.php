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
                    <i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard / Insert Shipping Zone
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill-alt fa-fw"></i> Insert Shipping Zone
                    </h3>
                </div>
                <div class="panel-body">
                    <form action="" class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Zone Name</label>
                            <div class="col-md-7">
                                <input type="text" name="zoneName" class="form-control">
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="" class="col-md-3 control-label">Zone Regions</label>
                            <div class="col-md-7">
                                <select name="zoneCountries[]" class="form-control chosen-select" data-placeholder="Select Zone Regions" multiple>
                                    <?php
                                    $getCountries = "select * from onlinestore.countries";
                                    $countriesQuery = mysqli_query($connection,$getCountries);
                                    while ($countriesRow = mysqli_fetch_array($countriesQuery)){
                                        $countryCode = $countriesRow['country_code'];
                                        $countryName = $countriesRow['country_name'];
                                        ?>
                                        <option value="<?php echo $countryCode ?>"><?php echo $countryName ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                                <script>$('.chosen-select').chosen();</script>
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="" class="col-md-3 control-label">Limit to Specific Zip/PostCodes</label>
                            <div class="col-md-7">
                                <textarea name="zonePostCodes" class="form-control" rows="5" placeholder="List 1 PostCode per Line"></textarea>
                            </div>
                        </div>
                    <div class="form-group">
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-7">
                                <input type="submit" name="insert" class="btn btn-primary form-control" value="Insert Shipping Zone">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['insert'])){
        $zoneName = mysqli_real_escape_string($connection,$_POST['zoneName']);
        $getZoneOrder = "select max(zone_order) as zone_order from onlinestore.zones";
        $zoneOrderQuery = mysqli_query($connection,$getZoneOrder);
        $zoneOrderRow = mysqli_fetch_array($zoneOrderQuery);
        $zoneOrder = $zoneOrderRow['zone_order'] + 1 ;
        $zoneCountries = $_POST['zoneCountries'];
        $insertZone = "insert into onlinestore.zones (zone_name, zone_order) VALUES ('$zoneName','$zoneOrder')";

        $zoneQuery = mysqli_query($connection,$insertZone);
        $insertZoneId = mysqli_insert_id($connection);
        if ($zoneQuery){
            foreach ($zoneCountries as $countryId){
                $countryId = mysqli_real_escape_string($connection, $countryId);
                $insertZoneLocation = "insert into onlinestore.zone_locations (
                                        zone_id,
                                        location_code,
                                        location_type)
                                         VALUES ($insertZoneId,'$countryId','country')";

                $zoneLocation = mysqli_query($connection,$insertZoneLocation);

            }

            if (!empty($_POST['zonePostCodes'])){
                if (strpos($_POST['zonePostCodes'],"\n")){
                    $postCodes = explode("\n",$_POST['zonePostCodes']);
                }else{
                    $postCodes = array($_POST['zonePostCodes']);
                }
                foreach ($postCodes as $postCode){
                    $locationCode = mysqli_real_escape_string($connection,trim($postCode));
                    $insertZoneLocation = "insert into onlinestore.zone_locations (
                                        zone_id,
                                        location_code,
                                        location_type)
                                         VALUES ($insertZoneId,'$locationCode','postcode')";

                    $zoneLocation = mysqli_query($connection,$insertZoneLocation);

                }
            }

            ?>
            <script>alert("New shipping zone has been added")</script>
            <script>window.open("index.php?viewShippingZones", "_self")</script>
            <?php

        }
    }
    ?>

    <?php
}
