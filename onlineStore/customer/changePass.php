<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 05/12/2018
 * Time: 18:50
 */
?>

<h1 align="center">Change Password</h1>

<form action="" method="post"><!-- form -->

    <div class="form-group"><!-- form-group -->
        <label for="">Enter Your Current Password</label>
        <input type="password" name="currentPass" class="form-control" required>
    </div><!-- /fom-group -->

 <div class="form-group"><!-- form-group -->
        <label for="">Enter Your New Password</label>
        <input type="password" name="newPass" class="form-control" required>
    </div><!-- /fom-group -->

    <div class="form-group"><!-- form-group -->
        <label for="">Enter Your Current Password</label>
        <input type="password" name="newPassConfirm" class="form-control" required>
    </div><!-- /fom-group -->
    <div class="text-center">
        <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-user-secret"></i>&nbsp;Change Password</button>
    </div>
</form><!-- /form -->

<?php



if (isset($_SESSION['customer_email'])){

    $customerEmail = $_SESSION['customer_email'];

    if (isset($_POST['submit'])){


        $oldPass = $_POST['currentPass'];
        $newPass =  $_POST['newPass'];
        $newPassConfirm =  $_POST['newPassConfirm'];

        $query = "SELECT onlinestore.customers.customer_pass FROM onlinestore.customers WHERE customer_email = '$customerEmail'";
        $passQuery = mysqli_query($connection,$query);
        $rowPass = mysqli_fetch_array($passQuery);
        $currentPassw = $rowPass['customer_pass'];


        if ($oldPass == $currentPassw && $newPass == $newPassConfirm){

            $updatePass = "UPDATE onlinestore.customers SET customer_pass = '$newPass' WHERE customer_email = '$customerEmail'";

            $upquery = mysqli_query($connection,$updatePass);

            if ($upquery){
                echo "<script>alert('Your password has been updated ;), the effects will take effect on the next login')</script>";
                echo "<script>window.open('logout.php','_self')</script>";
            }else{

                die("Something Went Wrong".mysqli_error($connection));

            }

        }elseif($oldPass != $currentPassw && $newPass != $newPassConfirm){ ?>
            <script>alert("Your current password is not valid\n And \n Your new passwords do not match each other")</script>

            <?php
        }

        elseif ($oldPass != $currentPassw ){
            ?>

            <script>alert("Your current password is not valid")</script>

<?php
        }elseif ($newPass != $newPassConfirm) {
            ?>

            <script>alert("Your new passwords do not match each other")</script>

            <?php
        }

    }


}