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
                <li class="active">
                    <i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard / View Shipping Zones
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-truck"></i>
                        View Shipping Zones
                    </h3>
                </div>
                <div class="panel-body">
                    <p class="lead">
                        Shipping Zones
                    <a href="index.php?insertShippingZone" class="btn btn-default">Add Shipping Zone</a>
                    </p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat.
                    <br><br>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Zone Order</th>
                                <th>Zone Name</th>
                                <th>Zone Regions</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $getZones = "select * from onlinestore.zones order by zone_order";
                            $zonesQuery = mysqli_query($connection,$getZones);
                            while ($zonesRow = mysqli_fetch_array($zonesQuery)){
                                $zoneId = $zonesRow['zone_id'];
                                $zoneName = $zonesRow['zone_name'];
                                $zoneOrder = $zonesRow['zone_order'];

                            ?>
                            <tr id="<?php echo $zoneId ?>">
                                <td><?php echo $zoneOrder ?></td>
                                <td><?php echo $zoneName ?></td>
                                <td>
                                    <?php
                                    $result ="";

                                    $getZonesLocations = "select * from onlinestore.zone_locations where zone_id = $zoneId";
                                    $zonesLocationQuery = mysqli_query($connection,$getZonesLocations);
                                    while($zonesLocationRow = mysqli_fetch_array($zonesLocationQuery)){
                                        $locationCode = $zonesLocationRow['location_code'];
                                        $locationType = $zonesLocationRow['location_type'];

                                        if ($locationType == "country"){
                                            $getCountry = "select * from onlinestore.countries where country_code = '$locationCode'";
                                            $countryQuery = mysqli_query($connection,$getCountry);
                                            $countryRow = mysqli_fetch_array($countryQuery);
                                            $countryName = $countryRow['country_name'];
                                            $result .= "$countryName, ";
                                        }elseif ($locationType == "postcode"){
                                            $result .= "$locationCode, ";
                                        }

                                    }

                                    echo rtrim($result, ", ");

                                    ?>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="index.php?editShippingZone=<?php echo $zoneId ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            </li>
                                        <li>
                                                <a href="index.php?deleteShippingZone=<?php echo $zoneId ?>">
                                                    <i class="fas fa-times-circle"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function (){
            $(document).on("mouseenter","tr td:first-child",function(){
                $(this).css("cursor","move");
                $("tbody").sortable({
                    helper: fixWidthHelper,
                    placeholder: "placeholder-highlight",
                    containment: "tbody",
                    update: function () {
                        var zonesIds = new Array();
                        $("tbody tr").each(function () {
                            zoneId = $(this).attr("id");
                            zonesIds.push(zoneId);
                        });
                        $.ajax({
                            url: "updateZoneOrder.php",
                            method: "POST",
                            data: { zonesIds: zonesIds }

                        });
                    }
                }).disableSelection();
                function fixWidthHelper(e, ui) {
                    ui.children().each(function() {
                        $(this).width($(this).width());
                    });
                    return ui;
                }
            })
        })
    </script>
    <?php
    }
