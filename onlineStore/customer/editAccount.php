<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 05/12/2018
 * Time: 18:36
 */
?>

<?php

$customerSession = $_SESSION['customer_email'];

if (isset($customerSession)){
    $customerInfo = "SELECT * FROM onlinestore.customers where customer_email = '$customerSession'";

    $customerQuery = mysqli_query($connection, $customerInfo);

    $rowCustomer = mysqli_fetch_array($customerQuery);

    $customerId = $rowCustomer['customer_id'];
    $customerName = $rowCustomer['customer_name'];
    $customerEmail = $rowCustomer['customer_email'];
    $customerCountry = $rowCustomer['customer_country'];
    $customerCity = $rowCustomer['customer_city'];
    $customerContact = $rowCustomer['customer_contact'];
    $customerAd = $rowCustomer['customer_address'];
    $customerImage = $rowCustomer['customer_image'];
}

?>


<div class="text-center">
    <h1>Edit Account</h1>
</div>

<form action="" method="post" enctype="multipart/form-data"><!-- form -->
    <div class="form-group"><!-- form-group -->
        <label for=""> Customer Name</label>
        <input type="text" class="form-control" name="c_name" value="<?php echo $customerName ?>" required>
    </div><!-- /form-group -->
    <div class="form-group"><!-- form-group -->
        <label for="">Email</label>
        <input type="email" class="form-control" name="c_email" value="<?php echo $customerEmail ?>" required>
    </div><!-- /form-group -->
    <div class="form-group"><!-- form-group -->
        <label for="">Password</label>
        <input type="password" class="form-control" name="c_password" disabled>
    </div><!-- /form-group -->
    <div class="form-group"><!-- form-group -->
        <label for="">Country</label>
        <input type="text" class="form-control" name="c_country" value="<?php echo $customerCountry ?>" required>
    </div><!-- /form-group -->
    <div class="form-group"><!-- form-group -->
        <label for="">City</label>
        <input type="text" class="form-control" name="c_city" value="<?php echo $customerCity ?>" required>
    </div><!-- /form-group -->
    <div class="form-group"><!-- form-group -->
        <label for="">Contact</label>
        <input type="text" class="form-control" name="c_contact" value="<?php echo $customerContact ?>" required>
    </div><!-- /form-group -->
    <div class="form-group"><!-- form-group -->
        <label for="">Address</label>
        <input type="text" class="form-control" name="c_address" value="<?php echo $customerAd ?>" required>
    </div><!-- /form-group -->
    <div class="form-group"><!-- form-group -->
        <label for="">Image Profile</label>
        <img src="customer_images/<?php echo $customerImage ?>" alt="ProfileIMG" width="100" height="100" class="img-responsive">
        <input type="file" class="form-control" name="c_image">
    </div><!-- /form-group -->
    <div class="text-center"><!-- text-center -->
        <button type="submit" name="update" class="btn btn-primary">
            <i class="fas fa-user-md"></i> Update Profile
        </button>
    </div><!-- /text-center -->
</form><!-- /form -->

<?php


if (isset($_POST['update'])){

    $upCustomer = $customerId;

    $customerName = $_POST['c_name'];
    $customerEmail = $_POST['c_email'];
    $customerCountry = $_POST['c_country'];
    $customerCity = $_POST['c_city'];
    $customerContact = $_POST['c_contact'];
    $customerAddress = $_POST['c_address'];

    $customerImg = $_FILES['c_image']['name'];
    $customerImgTemp = $_FILES['c_image']['temp_name'];
    move_uploaded_file($customerImgTemp,"customer_images/$customerImg");

    $updateCustomer = "UPDATE onlinestore.customers set customer_name = '$customerName', customer_email = '$customerEmail', customer_country = '$customerCountry', customer_city = '$customerCity', customer_contact = '$customerContact', customer_address = '$customerAddress', customer_image = '$customerImg' where customer_id = $upCustomer";

    $customerQuery = mysqli_query($connection,$updateCustomer);

    if ($customerQuery){
        echo "<script>alert('Your account has been updated ;), the effects will be shown on the next login')</script>";
        echo "<script>window.open('logout.php','_self')</script>";
    }else{

        die("Something Went Wrong".mysqli_error($connection));

    }


}
