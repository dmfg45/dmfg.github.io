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
                    <i class="fas fa-tachometer-alt"></i>&nbsp;Dashboard / View Shipping Type
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill-alt fa-fw"></i> View Shipping Type
                    </h3>
                </div>
                <div class="panel-body">
                    <p class="lead">Shipping Local Types</p>
                    <table class="table table-hover table-bordered table-striped local-types">
                        <thead>
                        <tr>
                            <th>Type Order</th>
                            <th>Type Name</th>
                            <th>Type Rates</th>
                            <th>Type Default</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $selectTypes = "select * from onlinestore.shipping_types where type_local = 'yes' order by type_order";
                        $query = mysqli_query($connection, $selectTypes);
                        while ($rowTypes = mysqli_fetch_array($query)) {
                            $typeId = $rowTypes['type_id'];
                            $typeName = $rowTypes['type_name'];
                            $typeDefault = $rowTypes['type_default'];
                            $typeOrder = $rowTypes['type_order'];
                            ?>
                            <tr id="<?php echo $typeId ?>">
                                <td><?php echo $typeOrder ?></td>
                                <td><?php echo $typeName ?></td>
                                <td>
                                    <select class="form-control">
                                        <option class="hidden">Edit Shipping Rates</option>
                                        <?php
                                        $getZones = "select * from onlinestore.zones order by zone_order";
                                        $zoneQuery = mysqli_query($connection, $getZones);
                                        while ($rowZones = mysqli_fetch_array($zoneQuery)) {
                                            $zoneId = $rowZones['zone_id'];
                                            $zoneName = $rowZones['zone_name'];
                                            ?>
                                            <option data-url="index.php?editShippingRates=<?php echo $typeId ?>&zone_id=<?php echo $zoneId ?>">
                                                <?php echo $zoneName ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><?php echo ucfirst($typeDefault) ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="index.php?editShippingType=<?php echo $typeId ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a href="index.php?deleteShippingType=<?php echo $typeId ?>">
                                                    <i class="fas fa-times-circle"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }

                        ?>
                        </tbody>
                    </table>

                    <p class="lead">Shipping International Types</p>
                    <table class="table table-hover table-bordered table-striped international-types">
                        <thead>
                        <tr>
                            <th>Type Order</th>
                            <th>Type Name</th>
                            <th>Type Rates</th>
                            <th>Type Default</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $selectTypes = "select * from onlinestore.shipping_types where type_local = 'no' order by type_order";
                        $query = mysqli_query($connection, $selectTypes);
                        while ($rowTypes = mysqli_fetch_array($query)) {
                            $typeId = $rowTypes['type_id'];
                            $typeName = $rowTypes['type_name'];
                            $typeDefault = $rowTypes['type_default'];
                            $typeOrder = $rowTypes['type_order'];
                            ?>
                            <tr id="<?php echo $typeId ?>">
                                <td><?php echo $typeOrder ?></td>
                                <td><?php echo $typeName ?></td>
                                <td>
                                    <select class="form-control">
                                        <option class="hidden">Edit Shipping Rates</option>
                                        <?php
                                        $selectCountries = "select * from onlinestore.countries";
                                        $countriesQuery = mysqli_query($connection, $selectCountries);
                                        while ($rowCountries = mysqli_fetch_array($countriesQuery)) {
                                            $countryId = $rowCountries['country_code'];
                                            $countryName = $rowCountries['country_name'];
                                            ?>
                                            <option data-url="index.php?editShippingRates=<?php echo $typeId ?>&countryId=<?php echo $countryId ?>">
                                                <?php echo $countryName ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td><?php echo ucfirst($typeDefault) ?></td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="index.php?editShippingType=<?php echo $typeId ?>">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a href="index.php?deleteShippingType=<?php echo $typeId ?>">
                                                    <i class="fas fa-times-circle"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <?php
                        }

                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $(document).on("mouseenter", ".local-types tr td:first-child", function () {
                $(this).css("cursor", "move");
                $(".local-types tbody").sortable({
                    helper: fixedWidthHelper,
                    placeholder: "placeholder-highlight",
                    containment: ".local-types tbody",
                    update: function () {
                        var types_ids = Array();
                        $(".local-types tbody tr").each(function () {
                            type_id = $(this).attr("id");
                            types_ids.push(type_id);
                        });
                        $.ajax({
                            url: "updateTypeOrder.php",
                            method: "POST",
                            data: {types_ids: types_ids, type_local: "yes"}
                        });
                    }
                }).disableSelection();

                function fixedWidthHelper(e, ui) {
                    ui.children().each(function () {
                        $(this).width($(this).width());
                    });
                    return ui;
                }
            })

            $(document).on("mouseenter", ".international-types tr td:first-child", function () {
                $(this).css("cursor", "move");
                $(".international-types tbody").sortable({
                    helper: fixedWidthHelper,
                    placeholder: "placeholder-highlight",
                    containment: ".international-types tbody",
                    update: function () {
                        var types_ids = Array();
                        $(".international-types tbody tr").each(function () {
                            type_id = $(this).attr("id");
                            types_ids.push(type_id);
                        });
                        $.ajax({
                            url: "updateTypeOrder.php",
                            method: "POST",
                            data: {types_ids: types_ids, type_local: "no"}
                        });
                    }
                }).disableSelection();

                function fixedWidthHelper(e, ui) {
                    ui.children().each(function () {
                        $(this).width($(this).width());
                    });
                    return ui;
                }
            });
            $("select").change(function () {
                var option = $(this).find("option:selected");
                var url = option.data("url");
                window.open(url);
            });
        })
    </script>

    <?php
}
