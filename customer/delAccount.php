<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 06/12/2018
 * Time: 01:51
 */
?>

    <div class="text-center">
        <h1>Deleting Account</h1>
        <hr>
        <form action="" method="post">
            <input type="submit" class="btn btn-danger" name="yes" value="Yes I want to delete">
        </form>
    </div>


<?php

if (isset($_SESSION['customer_email'])) {
    $customerEmail = $_SESSION['customer_email'];

    if (isset($_POST['yes'])) {

        $query = "DELETE FROM onlinestore.customers WHERE customer_email = '$customerEmail'";
        $deleteAcc = mysqli_query($connection, $query);

        if ($deleteAcc) {
            ?>
            <script>alert("Yor Account has been successfully deleted")</script>
            <script>window.open("logout.php", "_self")</script>

            <?php
        } else {
            die("error : " . mysqli_error($connection));
        }
    }
}