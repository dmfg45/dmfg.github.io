<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 22/03/2019
 * Time: 03:32
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
                <li class="active">
                    <i class="fas fa-tachometer-alt"></i>
                    &nbsp;Dashboard&nbsp;/&nbsp;View&nbsp;Customers
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill"></i>&nbsp;View Customers
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-stripped">
                            <thead>
                            <tr>
                                <th>Customer Id</th>
                                <th>Customer Name</th>
                                <th>Customer Email</th>
                                <th>Customer Image</th>
                                <th>Customer Country</th>
                                <th>Customer City</th>
                                <th>Customer Phone No</th>
                                <th>Customer Address</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php

                            $i = 0;

                            $query = "select * from onlinestore.customers";
                            $runQuery = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_array($runQuery)) {
                                $customerId = $row['customer_id'];
                                $customerName = $row['customer_name'];
                                $customerEmail = $row['customer_email'];
                                $customerImage = $row['customer_image'];
                                $customerCountry = $row['customer_country'];
                                $customerCity = $row['customer_city'];
                                $customerPhone = $row['customer_contact'];
                                $customerAddress = $row['customer_address'];

                                $i++;

                                ?>

                                <tr>

                                    <td><?php echo $i ?></td>
                                    <td><?php echo $customerName ?></td>
                                    <td><?php echo $customerEmail ?></td>
                                    <td><img width="75" height="75" src="productImages/<?php echo $customerImage ?>"
                                             alt="ProdImg"></td>
                                    <td>
                                        <?php echo $customerCountry ?>
                                    </td>
                                    <td><?php echo $customerCity ?></td>
                                    <td><?php echo $customerPhone ?></td>
                                    <td><?php echo $customerAddress ?></td>
                                    <td><a href="index.php?deleteCustomer=<?php echo $customerId ?>"><i
                                                    class="fas fa-times-circle fa-2x"></i></a></td>
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
    </div>

<?php }
