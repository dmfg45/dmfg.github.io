<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 28/03/2019
 * Time: 07:13
 */

?>

<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>tinymce.init({selector: 'textarea'});</script>

    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active"><i class="fas fa-tachometer-alt"></i> Dashboard / Insert Terms</li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fas fa-money-bill-alt fa-fw"></i> Insert Terms</h3>
                </div>
                <div class="panel-body">
                    <form action="" class="form-horizontal" method="post">
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Term Title:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="termTitle">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Term Link:</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="termLink">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Term Description:</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="termDesc" rows="6" cols="19"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-md-3 control-label">Term Title:</label>
                            <div class="col-md-6">
                                <input type="submit" class="btn btn-primary form-control" value="Insert Term"
                                       name="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_POST['submit'])) {
        $term_title = $_POST['termTitle'];
        $term_desc = $_POST['termDesc'];
        $term_link = $_POST['termLink'];

        $insertQuery = "insert into onlinestore.terms(term_title, term_link, term_desc) values ('$term_title','$term_link','$term_desc')";
        $runQuery = mysqli_query($connection, $insertQuery);

        if ($runQuery) {
            ?>

            <script>alert("New Term Has been added")</script>
            <script>window.open("index.php?viewTerms", "_self")</script>

            <?php
        } else {
            die("Error -> " . mysqli_error($connection));
        }
    }

    ?>


    <?php

}
