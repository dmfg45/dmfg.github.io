<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {

    $zone_Id = $_GET['editShippingZone'];
    $getZone = "select * from onlinestore.zones where zone_id = $zone_Id";
    $zone_query = mysqli_query($connection,$getZone);
    $zoneRow = mysqli_fetch_array($zone_query);
    $zone_name = $zoneRow['zone_name'];
    ?>


    <link rel="stylesheet" href="css/chosen.min.css">
    <script src="js/chosen.jquery.min.js"></script>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard / Edit Shipping Zone
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill-alt fa-fw"></i> Edit Shipping Zone
                    </h3>
                </div>
                <div class="panel-body">
                    <form action="" class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Zone Name</label>
                            <div class="col-md-7">
                                <input type="text" name="zoneName" value="<?php echo $zone_name ?>" class="form-control">
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

                                        $getZoneLocations = "select * from onlinestore.zone_locations 
                                                                    where zone_id = $zone_Id 
                                                                  and location_type = 'country' 
                                                                  and location_code = '$countryCode'";

                                        $zoneLocationQuery = mysqli_query($connection,$getZoneLocations);
                                        $locationsCount = mysqli_num_rows($zoneLocationQuery);
                                        if ($locationsCount == 0){ ?>
                                            <option value="<?php echo $countryCode ?>"><?php echo $countryName ?></option>
                                        <?php }else{ ?>
                                            <option selected value="<?php echo $countryCode ?>"><?php echo $countryName ?></option>
                                        <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <script>$('.chosen-select').chosen();</script>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Limit to Specific Zip/PostCodes</label>
                            <div class="col-md-7">
                                <textarea name="zonePostCodes" class="form-control" rows="5" placeholder="List 1 PostCode per Line"><?php
                                    $result = "";
                                    $get_Zone_Locations = "select * from onlinestore.zone_locations where zone_id = $zone_Id and location_type = 'postcode'";
                                    $zone_Location_Query = mysqli_query($connection,$get_Zone_Locations);
                                    while($zoneLocationRow = mysqli_fetch_array($zone_Location_Query)){
                                        $location_code = $zoneLocationRow['location_code'];
                                        $result .= "$location_code\n";
                                    }
                                    echo rtrim($result, "\n");
                                    ?>
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label"></label>
                            <div class="col-md-7">
                                <input type="submit" name="update" class="btn btn-primary form-control" value="Update Shipping Zone">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['update'])){
        $zoneName = mysqli_real_escape_string($connection,$_POST['zoneName']);
        $zoneCountries = $_POST['zoneCountries'];
        $updateZones = "update onlinestore.zones set zone_name = '$zoneName' where zone_id = $zone_Id";
        $zoneQuery = mysqli_query($connection,$updateZones);
        if ($zoneQuery){
            $deleteZoneLocations = "delete from onlinestore.zone_locations where zone_id = $zone_Id";
            $zoneLocQuery = mysqli_query($connection,$deleteZoneLocations);

            foreach ($zoneCountries as $countryId){
                $countryId = mysqli_real_escape_string($connection, $countryId);
                $insertZoneLocation = "insert into onlinestore.zone_locations (
                                        zone_id,
                                        location_code,
                                        location_type)
                                         VALUES ($zone_Id,'$countryId','country')";

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
                                         VALUES ($zone_Id,'$locationCode','postcode')";

                    $zoneLocation = mysqli_query($connection,$insertZoneLocation);

                }
            }

            ?>
            <script>alert("Shipping zone has been updated")</script>
            <script>window.open("index.php?viewShippingZones", "_self")</script>
            <?php

        }
    }
    ?>

    <?php
}
