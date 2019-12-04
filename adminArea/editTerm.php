<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

    <?php

    if (isset($_GET['editTerm'])) {
        $termId = $_GET['editTerm'];

        $editQuery = "select * from onlinestore.terms where term_id = $termId";
        $runQuery = mysqli_query($connection, $editQuery);

        $row = mysqli_fetch_array($runQuery);
        $termTitle = $row['term_title'];
        $termDesc = $row['term_desc'];
    }

    ?>


    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({selector: 'textarea'});</script>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active"><i class="fas fa-tachometer-alt"></i> Dashboard / Edit Terms</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fas fa-money-bill-alt fa-fw"></i> Edit Terms</h3>
                </div>
                <div class="panel-body">
                    <form action="" class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Term Title:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="termTitle"
                                       value="<?php echo $termTitle ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Term Description:</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="termDesc" rows="6"
                                          cols="19"><?php echo $termDesc ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Term Title:</label>
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-primary form-control" value="Update Term"
                                       name="update">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['update'])) {
        $term_title = $_POST['termTitle'];
        $term_desc = $_POST['termDesc'];

        $insertQuery = "update onlinestore.terms set term_title = '$term_title', term_desc = '$term_desc' where term_id = $termId";
        $queryRun = mysqli_query($connection, $insertQuery);

        if ($queryRun) {
            ?>
            <script>alert("Term has been Updated")</script>
            <script>window.open("index.php?viewTerms", "_self")</script>
            <?php
        } else {
            die("Something went Wrong: -> " . mysqli_error($connection));
        }
    }

    ?>

    <?php
}