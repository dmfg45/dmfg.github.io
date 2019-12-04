<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 04/12/2018
 * Time: 18:24
 */
session_start();
include_once 'includes/db.php';
include 'functions/functions.php';

if (isset($_SESSION['customer_email'])){ ?>
    <script>window.open("index.php","_self")</script>
<?php }

?>


    <!doctype html>
    <html lang="pt">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Online Store</title>
        <link rel="stylesheet" href="styles/bootstrap.min.css">
        <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
        <link rel="stylesheet" href="styles/styles.css">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
              integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU"
              crossorigin="anonymous">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>


    </head>
    <body>

    <?php include 'includes/top.php' ?>

    <?php include "includes/navbar.php"; ?>

    <div id="content"><!-- content -->
        <div class="container"><!-- container -->
            <div class="col-md-12"><!-- col-md-12 -->
                <ul class="breadcrumb"><!-- breadcrumb -->
                    <li><a href="index.php">Home</a></li>
                    <li>Register</li>
                </ul><!-- /breadcrumb -->
            </div><!-- /col-md-12 -->

            <div class="col-md-12"><!-- col-md-12 -->
                <div class="box"><!-- box -->
                    <div class="box-header"><!-- box-header -->
                        <div class="text-center">
                            <h2>Register New Account</h2>
                            <p class="text-muted">
                                If you have any questions feel free to contact us, our customer service center is
                                working for you 24/7
                            </p>
                        </div>
                    </div><!-- /box-header -->
                    <form action="customerRegister.php" method="post" enctype="multipart/form-data"><!-- form -->
                        <div class="form-group"><!-- form-group -->
                            <label for=""> Customer Name</label>
                            <input type="text" class="form-control" name="c_name" required>
                        </div><!-- /form-group -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">Email</label>
                            <input type="email" class="form-control" name="c_email" required>
                        </div><!-- /form-group -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">Password</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-check tick1"></i>
                                    <i class="fas fa-times cross1"></i>
                                </span>
                                <input type="password" class="form-control" name="c_password" id="pass" required>
                                <span class="input-group-addon">
                                    <div id="meter_wrapper">
                                        <span id="pass_type">
                                        </span>
                                        <div id="meter"></div>
                                    </div>
                                </span>
                            </div>
                        </div><!-- /form-group -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fas fa-check tick2"></i>
                                    <i class="fas fa-times cross2"></i>
                                </span>
                                <input type="password" class="form-control confirm" id="con_pass" required>
                            </div>
                        </div><!-- /form-group -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">Country</label>
                            <input type="text" class="form-control" name="c_country" required>
                        </div><!-- /form-group -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">City</label>
                            <input type="text" class="form-control" name="c_city" required>
                        </div><!-- /form-group -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">Contact</label>
                            <input type="text" class="form-control" name="c_contact" required>
                        </div><!-- /form-group -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">Address</label>
                            <input type="text" class="form-control" name="c_address" required>
                        </div><!-- /form-group -->
                        <div class="form-group"><!-- form-group -->
                            <label for="">Image Profile</label>
                            <input type="file" class="form-control" name="c_image" required>
                        </div><!-- /form-group -->

                        <div class="form-group text-center"><!-- form-group -->
                            <label for=""></label>
                            <div align="center" class="g-recaptcha"
                                 data-sitekey="6LcNCaUUAAAAAA4z1ti69IGV4fK1lLrho4ZNu2qb  "></div>
                        </div><!-- /form-group -->

                        <div class="text-center"><!-- text-center -->
                            <button type="submit" name="register" class="btn btn-primary">
                                <i class="fas fa-user-md"></i> Register
                            </button>
                        </div><!-- /text-center -->
                    </form><!-- /form -->
                </div><!-- /box -->
            </div><!-- /col-md-12 -->

        </div><!-- /container -->
    </div><!-- /content -->

    <?php include "includes/footer.php" ?>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(() => (
            $('.tick1').hide(),
                $('.tick2').hide(),
                $('.cross1').hide(),
                $('.cross2').hide(),

                $('.confirm').focusout(function () {
                    var password = $('#pass').val();
                    var confirmPass = $('#con_pass').val();

                    if (password == confirmPass) {

                        $('.tick1').fadeIn();
                        $('.tick2').fadeIn();
                        $('.cross1').hide();
                        $('.cross2').hide();

                    } else {
                        $('.tick1').fadeOut();
                        $('.tick2').fadeOut();
                        $('.cross1').fadeIn();
                        $('.cross2').fadeIn()
                    }
                })
        ))
    </script>
    <script>
        $(document).ready(function () {

            $("#pass").keyup(function () {

                check_pass();

            });

        });

        function check_pass() {
            var val = document.getElementById("pass").value;
            var meter = document.getElementById("meter");
            var no = 0;
            if (val != "") {
// If the password length is less than or equal to 6
                if (val.length <= 6) no = 1;

                // If the password length is greater than 6 and contain any lowercase alphabet or any number or any special character
                if (val.length > 6 && (val.match(/[a-z]/) || val.match(/\d+/) || val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))) no = 2;

                // If the password length is greater than 6 and contain alphabet,number,special character respectively
                if (val.length > 6 && ((val.match(/[a-z]/) && val.match(/\d+/)) || (val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (val.match(/[a-z]/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))) no = 3;

                // If the password length is greater than 6 and must contain alphabets,numbers and special characters
                if (val.length > 6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) no = 4;

                if (no == 1) {
                    $("#meter").animate({width: '50px'}, 300);
                    meter.style.backgroundColor = "red";
                    document.getElementById("pass_type").innerHTML = "Very Weak";
                }

                if (no == 2) {
                    $("#meter").animate({width: '100px'}, 300);
                    meter.style.backgroundColor = "#F5BCA9";
                    document.getElementById("pass_type").innerHTML = "Weak";
                }

                if (no == 3) {
                    $("#meter").animate({width: '150px'}, 300);
                    meter.style.backgroundColor = "#FF8000";
                    document.getElementById("pass_type").innerHTML = "Good";
                }

                if (no == 4) {
                    $("#meter").animate({width: '200px'}, 300);
                    meter.style.backgroundColor = "#00FF40";
                    document.getElementById("pass_type").innerHTML = "Strong";
                }
            } else {
                meter.style.backgroundColor = "";
                document.getElementById("pass_type").innerHTML = "";
            }
        }

    </script>
    </body>
    </html>

<?php

global $connection;

if (isset($_POST['register'])) {
    $secret = "6LcNCaUUAAAAABwEbLdHVwLXaDC54Tdpp3V5R_vC";
    $response = $_POST['g-recaptcha-response'];
    $remoteIp = $_SERVER['REMOTE_ADDR'];
    $url = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip$remoteIp");
    $result = json_decode($url, TRUE);

    if ($result['success'] == 1) {
        $customerName = $_POST['c_name'];
        $customerEmail = $_POST['c_email'];
        $customerPassw = $_POST['c_password'];
        $encryptPass = password_hash($customerPassw, PASSWORD_DEFAULT);
        $customerCountry = $_POST['c_country'];
        $customerCity = $_POST['c_city'];
        $customerContact = $_POST['c_contact'];
        $customerAdd = $_POST['c_address'];
        $customerIp = getUserIpAddress();

        $customerImage = $_FILES['c_image']['name'];
        $temp_name = $_FILES['c_image']['temp_name'];

        move_uploaded_file($temp_name, "customer/customer_images/$customerImage");
        $getEmail = "select * from onlinestore.customers where customer_email = $customerEmail";
        $runQuery = mysqli_query($connection, $getEmail);
        $checkEmail = mysqli_num_rows($runQuery);

        if ($checkEmail == 1) {
            ?>
            <script>alert("This email is already registered")</script>
            <?php
            exit();
        }
        $customerConfCode = mt_rand();

        $subject = "Email Confirmation Message";
        $from = "andre.graca.45@gmail.com";
        $message = "
                        <h2>Account Register Confirmation By OnlineStore.com $customerName</h2>
                        <a href='localhost/onlinestore/customer/myAccount.php?$customerConfCode'>Click Here to confirm the Email registration</a>
                    ";
        $headers = "From: $from \r\n";
        $headers .= "Content-type: text/html\r\n";

        mail($customerEmail,$subject,$message,$headers);

        $insertCustomer = "INSERT INTO onlinestore.customers
  (customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, customer_address, customer_image, customer_ip, customer_confirm_code)
   VALUES ('$customerName','$customerEmail','$encryptPass','$customerCountry','$customerCity','$customerContact','$customerAdd','$customerImage','$customerIp','$customerConfCode')";

        $query = mysqli_query($connection, $insertCustomer);
        $lastInsertedCustomer = mysqli_insert_id($connection);

        $insertLastCustomer = "insert into onlinestore.customers_addresses (customer_id) values ($lastInsertedCustomer)";

        $selectCart = "select * from onlinestore.cart where ip_add = '$customerIp'";

        $cartQuery = mysqli_query($connection, $selectCart);

        $checkCart = mysqli_num_rows($cartQuery);

        if ($checkCart > 0) {
            $_SESSION['customer_email'] = $customerEmail;
            $_SESSION['customer_name'] = $customerName;

            ?>

            <script>alert("You have been Registered Successfully")</script>
            <script>window.open("checkout.php", "_self")</script>


            <?php

        } else {
            $_SESSION['customer_email'] = $customerEmail;
            $_SESSION['customer_name'] = $customerName;
            ?>

            <script>alert("You have been Registered Successfully")</script>
            <script>window.open("index.php", "_self")</script>


            <?php

        }

    } else {
        ?>
        <script>alert("Please Select Captcha try again")</script>
        <?php
    }

}