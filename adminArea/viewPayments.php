<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 22/03/2019
 * Time: 18:09
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
                    &nbsp;Dashboard&nbsp;/&nbsp;View&nbsp;Payments
                </li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill"></i>&nbsp;View Payments
                    </h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-stripped">
                            <thead>
                            <tr>
                                <th>Payment No</th>
                                <th>Invoice No</th>
                                <th>Amount Paid</th>
                                <th>Payment Method</th>
                                <th>Reference No</th>
                                <th>Payment Code</th>
                                <th>Payment Date</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>


                            <?php

                            $i = 0;

                            $query = "select * from onlinestore.payments";
                            $runQuery = mysqli_query($connection, $query);

                            while ($row = mysqli_fetch_array($runQuery)) {

                                $paymentId = $row['payment_id'];
                                $invoiceNo = $row['invoice_no'];
                                $amount = $row['amount'];
                                $paymentMode = $row['payment_mode'];
                                $refNo = $row['ref_no'];
                                $paymentCode = $row['payment_code'];
                                $paymentDate = $row['payment_date'];

                                $i++;

                                ?>

                                <tr>

                                    <td><?php echo $i ?></td>
                                    <td><?php echo $invoiceNo ?></td>
                                    <td><?php echo $amount ?></td>
                                    <td><?php echo $paymentMode ?></td>
                                    <td><?php echo $refNo ?></td>
                                    <td><?php echo $paymentCode ?></td>
                                    <td><?php echo $paymentDate ?></td>
                                    <td><a href="index.php?deletePayment=<?php echo $paymentId ?>"><i
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

