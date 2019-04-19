<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 20/01/2019
 * Time: 01:41
 */
?>

<div class="box text-center"><!-- box -->
    <div class="box-header"><!-- box-header -->
        <div class="text-center">
            <h1>Login</h1>
            <p class="lead">Already our Customer?</p>
        </div>
        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
            Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
        </p>
    </div><!-- /box-header -->
    <form action="" method="post"><!-- form -->
        <div class="form-group"><!-- form-group -->
            <label for="email">Email:</label>
            <input type="text" class="form-control" name="customerEmail" required>
        </div><!-- /form-group -->
        <div class="form-group"><!-- form-group -->
            <label for="passw">Password:</label>
            <input type="password" class="form-control" name="customerPassw" required>
        </div><!-- /form-group -->
        <div class="form-group"><!-- form-group -->
            <button name="login" class="btn btn-primary form-control">
                <i class="fas fa-sign-in-alt"></i>&nbsp;Login
            </button>
        </div><!-- /form-group -->
    </form><!-- /form -->
    <h5>New customer?<br><h4>&dArr;</h4></h5><a href="customerRegister.php"><h5>Register Here</h5></a>
</div><!-- /box -->

<?php

if (isset($_POST['login'])){
    $customerEmail = $_POST['customerEmail'];
    $customerPassw = $_POST['customerPassw'];

    $customer = "select * from onlinestore.customers where customer_email = '$customerEmail'and customer_pass = '$customerPassw'";

    $query = mysqli_query($connection, $customer);

    $ipAdd = getUserIpAddress();

    $checkCustomer = mysqli_num_rows($query);

    $cart = "select * from onlinestore.cart where ip_add = '$ipAdd'";

    $query = mysqli_query($connection,$cart);

    $checkCart = mysqli_num_rows($query);

    if ($checkCustomer == 0){
        echo "<script>alert('Password or Email are wrong or missSpelled')</script>";
        exit();
    }

    if ($checkCustomer == 1 AND $checkCart == 0){
        $_SESSION['customer_email'] = $customerEmail;
        echo "<script>alert('You are Logged in')</script>";
        echo "<script>window.open('customer/myAccount.php','_self')</script>";
    }else{
        $_SESSION['customer_email'] = $customerEmail;
        echo "<script>alert('You are Logged in')</script>";
        echo "<script>window.open('checkout.php','_self')</script>";
    }


}