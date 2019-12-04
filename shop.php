<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 17/11/2018
 * Time: 00:05
 */
session_start();
include_once 'includes/db.php';
include 'functions/functions.php';

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
                <li>Shop</li>
            </ul><!-- /breadcrumb -->
        </div><!-- /col-md-12 -->

        <div class="col-md-3"><!-- col-md-3 -->
            <?php include "includes/sidebar.php" ?>
        </div><!-- /col-md-3 -->

        <div class="col-md-9"><!-- col-md-9 -->


            <div class="box"><!-- box -->
                <h1>Shop</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                    commodo
                    consequat.
                </p>
            </div><!-- /box -->

            <div class="row flex-wrap" id="Products">
                <?php getProducts() ?>
            </div><!-- /row -->
            <div class="text-center">
                <ul class="pagination"><!-- pagination -->
                    <?php getPagination() ?>
                </ul><!-- /pagination -->
            </div>
            <div class="row">
            </div>
        </div><!-- /col-md-9 -->
        <div id="wait" style="position:absolute; top: 40%; left: 45%; padding: 100px; padding-top: 200px;">

        </div>

    </div><!-- /container -->
</div><!-- /content -->

<?php include "includes/footer.php" ?>
<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
    $(document).ready(function () {
        $('.nav-toggle').click(function () {
            $(".panel-collapse,.collapse-data").slideToggle(700, function () {
                if ($(this).css('display') == 'none') {
                    $(".hide-show").html('Show');
                } else {
                    $(".hide-show").html('Hide');
                }
            });
        });
    });
    $(function () {
        $.fn.extend({
            filterTable: function () {
                return this.each(function () {
                    $(this).on('keyup', function () {
                        var $this = $(this),
                            search = $this.val().toLowerCase(),
                            target = $this.attr('data-filters'),
                            handle = $(target),
                            rows = handle.find('li a');

                        if (search == '') {
                            rows.show();
                        } else {
                            rows.each(function () {
                                var $this = $(this);
                                $this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
                            });
                        }
                    });
                });
            }
        });
        $('[data-action="filter"][id="dev-table-filter"]').filterTable();
    });
</script>

<script>
    $(document).ready(function(){

        // getProducts Function Code Starts

        function getProducts(){

            // Manufacturers Code Starts

            var sPath = '';

            var aInputs = $('li').find('.getManufacturer');

            var aKeys = Array();

            var aValues = Array();

            iKey = 0;

            $.each(aInputs,function(key,oInput){

                if(oInput.checked){

                    aKeys[iKey] =  oInput.value

                };

                iKey++;

            });

            if(aKeys.length>0){

                var sPath = '';

                for(var i = 0; i < aKeys.length; i++){

                    sPath = sPath + 'man[]=' + aKeys[i]+'&';

                }

            }

// Manufacturers Code ENDS

// Products Categories Code Starts

            var aInputs = Array();

            var aInputs = $('li').find('.get_p_cat');

            var aKeys = Array();

            var aValues = Array();

            iKey = 0;

            $.each(aInputs,function(key,oInput){

                if(oInput.checked){

                    aKeys[iKey] =  oInput.value

                };

                iKey++;

            });

            if(aKeys.length>0){

                for(var i = 0; i < aKeys.length; i++){

                    sPath = sPath + 'p_cat[]=' + aKeys[i]+'&';

                }

            }

// Products Categories Code ENDS

            // Categories Code Starts

            var aInputs = Array();

            var aInputs = $('li').find('.get_cat');

            var aKeys  = Array();

            var aValues = Array();

            iKey = 0;

            $.each(aInputs,function(key,oInput){

                if(oInput.checked){

                    aKeys[iKey] =  oInput.value

                };

                iKey++;

            });

            if(aKeys.length>0){

                for(var i = 0; i < aKeys.length; i++){

                    sPath = sPath + 'cat[]=' + aKeys[i]+'&';

                }

            }

            // Categories Code ENDS

            // Loader Code Starts

            $('#wait').html('<img src="images/load.gif">');

// Loader Code ENDS

// ajax Code Starts

            $.ajax({

                url:"load.php",

                method:"POST",

                data: sPath+'sAction=getProducts',

                success:function(data){

                    $('#Products').html('');

                    $('#Products').html(data);

                    $("#wait").empty();

                }

            });

            $.ajax({
                url:"load.php",
                method:"POST",
                data: sPath+'sAction=getPagination',
                success:function(data){
                    $('.pagination').html('');
                    $('.pagination').html(data);
                }

            });

// ajax Code Ends

        }

        // getProducts Function Code Ends

        $('.getManufacturer').click(function(){

            getProducts();

        });


        $('.get_p_cat').click(function(){

            getProducts();

        });

        $('.get_cat').click(function(){

            getProducts();

        });


    });
</script>

</body>
</html>