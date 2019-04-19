<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 04/12/2018
 * Time: 17:55
 */

include_once 'includes/db.php';
include 'functions/functions.php';
session_start();

?>

<!doctype html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Online Store</title>
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="font-awesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="styles/styles.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css"
          integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

</head>
<body>

<?php include 'includes/top.php' ?>

<?php include "includes/navbar.php"; ?>

<div id="content"><!-- content -->
    <div class="container"><!-- container -->
        <div class="col-md-12"><!-- col-md-12 -->
            <ul class="breadcrumb"><!-- breadcrumb -->
                <li><a href="index.php">Home</a></li>
                <li>Contact Us</li>
            </ul><!-- /breadcrumb -->
        </div><!-- /col-md-12 -->

        <div class="col-md-3"><!-- col-md-3 -->
            <?php include "includes/sidebar.php" ?>
        </div><!-- /col-md-3 -->

        <div class="col-md-9"><!-- col-md-9 -->
            <div class="box"><!-- box -->
                <div class="box-header"><!-- box-header -->
                    <div class="text-center">
                        <h2>Contact Us</h2>
                        <p class="text-muted">
                            If you have any questions feel free to contact us, our customer service center is working
                            for you 24/7
                        </p>
                    </div>
                </div><!-- /box-header -->
                <form action="contact.php" method="post"><!-- form -->
                    <div class="form-group"><!-- form-group -->
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div><!-- /form-group -->
                    <div class="form-group"><!-- form-group -->
                        <label for="">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div><!-- /form-group -->
                    <div class="form-group"><!-- form-group -->
                        <label for="">Subject</label>
                        <input type="text" class="form-control" name="subject" required>
                    </div><!-- /form-group -->
                    <div class="form-group"><!-- form-group -->
                        <label for="">Message</label>
                        <textarea name="message" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div><!-- /form-group -->
                    <div class="text-center"><!-- text-center -->
                        <button type="submit" name="submit" class="btn btn-primary">
                            <i class="fas fa-user-md"></i> Send Message
                        </button>
                    </div><!-- /text-center -->
                </form><!-- /form -->

                <?php
                    if (isset($_POST['submit'])){
                        $senderName = $_POST['name'];
                        $senderEmail = $_POST['email'];
                        $senderSubject = $_POST['subject'];
                        $senderMessage = $_POST['message'];

                        $receiverEmail = "twiterhatch@gmail.com";

                        mail($receiverEmail,$senderSubject,$senderMessage,"From:$senderEmail");

                        $email = $_POST['email'];

                        $subject = "Welcome to the Online Store";

                        $msg = "I shall get you soon, thanks for sending us the email";

                        $from = "twiterhatch@gmail.com";

                        mail($email,$subject,$msg,"From:$from");

                        ?>

                        <script>alert("Your message has been sent successfully)</script>

                <?php

                    }
                ?>


            </div><!-- /box -->
        </div><!-- /col-md-9 -->

    </div><!-- /container -->
</div><!-- /content -->

<?php include "includes/footer.php" ?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
