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
                <li class="active"><i class="fas fa-tachometer-alt"></i> Dashboard / View Term</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fas fa-money-bill-alt fa-fw"></i> View Terms
                    </h3>
                </div>
                <div class="panel-body">
                    <?php

                    $getTerms = "select * from onlinestore.terms";
                    $runQuery = mysqli_query($connection, $getTerms);

                    while ($row = mysqli_fetch_array($runQuery)) {
                        $termId = $row['term_id'];
                        $termTitle = $row['term_title'];
                        $termDesc = $row['term_desc'];
                        ?>

                        <div class="col-lg-4 col-md-4">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-center">
                                        <?php echo $termTitle ?>
                                    </h3>
                                </div>
                                <div class="panel-body">
                                    <p><?php echo $termDesc ?></p>
                                </div>
                                <div class="panel-footer clearfix">
                                    <a href="index.php?deleteTerm=<?php echo $termId ?>"><i
                                                class="fas fa-times-circle fa-2x pull-left"></i></a>
                                    <a href="index.php?editTerm=<?php echo $termId ?>"><i
                                                class="fas fa-edit fa-2x pull-right"></i></a>
                                </div>
                            </div>
                        </div>


                        <?php

                    }

                    ?>
                </div>
            </div>
        </div>
    </div>


    <?php

}