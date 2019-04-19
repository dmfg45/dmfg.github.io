<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 15/11/2018
 * Time: 18:07
 */
?>

<div id="footer"><!-- footer -->
    <div class="container"><!-- container -->
        <div class="row"><!-- row -->
            <div class="col-md-3 col-sm-6"><!-- col-md-3 sol-sm-6 -->
                <h4>Pages</h4>
                <ul>
                    <li><a href="cart.php">Shopping Cart</a></li>
                    <li><a href="contact.php">Contact Us</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="checkout.php">My Account</a></li>
                </ul>
                <hr>
                <h4>User Section</h4>
                <ul>
                    <li><?php
                            if (!isset($_SESSION['customer_email'])){
                                echo "<a href='checkout.php'>Login</a>"."<br>"."
                    <li><a href=\"customerRegister.php\">Register</a></li>";
                            }else{
                                echo "<a href='myAccount.php?myOrders'>My Account</a>";
                            }

                        ?></li>
                    <li><a href="terms.php">Terms & Conditions</a></li>
                </ul>
                <hr class="hidden-md hidden-lg hidden-sm">
            </div><!-- /col-md3-col-sm-6 -->
            <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 -->
                <h4>Top Product Categories</h4>
                <ul>
                <?php

                $productCategories = "SELECT * FROM onlinestore.product_categories";
                $query = mysqli_query($connection,$productCategories);
                while($row =mysqli_fetch_array($query)){

                    $productCategoryId = $row['p_cat_id'];
                    $productCategoryTitle = $row['p_cat_title'];

                    ?>

                    <li><a href="shop.php?productCategory=<?php echo $productCategoryId ?>"><?php echo $productCategoryTitle?></a></li>

                    <?php
                }


                ?>
                </ul>
                <hr class="hidden-md hidden-lg">
            </div><!-- /col-md-3 col-sm-6 -->
            <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 -->
                <h4>Where to find us</h4>
                <p>
                    <strong>Online Store LTD</strong>
                        <br>Seed Park
                        <br>Lahore
                        <br>9871265214522
                        <br>example@examplemail.com
                        <br>
                    <strong>André Graça</strong>
                </p>
                <a href="contact.php">Go to Contact us Page</a>
                <hr class="hidden-md hidden-lg">
            </div><!-- /col-md-3 col-sm-6 -->
            <div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 -->
                <h4>Get the news</h4>
                <p class="text-muted">
                    A motorcycle, often called a bike, motorbike, or cycle, is a two- or three-wheeled motor vehicle.
                </p>
                <form action="" method="post"><!-- form -->
                    <div class="input-group"><!-- input-group -->
                        <input type="text" class="form-control" name="email">
                        <span class="input-group-btn"><!-- input-group-btn -->
                            <input type="submit" value="subscribe" class="btn btn-default">
                        </span><!-- /input-group-btn -->
                    </div><!-- /input-group -->
                </form><!-- /form -->
                <hr>
                <h4>Stay in touch</h4>
                <p class="social">
                    <a href="#"><i class="fab fa-facebook-square"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-google-plus"></i></a>
                    <a href="#"><i class="fab fa-linkedin"></i></a>
                    <a href="#"><i class="fa fa-envelope"></i></a>
                </p>
            </div><!-- /col-md-3 col-sm-6 -->
        </div><!-- /row -->
    </div><!-- /container -->
</div><!-- /footer -->

<div id="copyright"><!-- copyright -->
    <div class="container"><!-- container -->
        <div class="col-md-6"><!-- col-md-6 -->
            <p class="pull-left">
                &copy; 2018 Andre Graca
            </p>
        </div><!-- /col-md-6 -->
        <div class="col-md-6"><!-- col-md-6 -->
            <p class="pull-right">
                Template by <a href="#">AndreGraca</a>
            </p>
        </div><!-- /col-md-6 -->
    </div><!-- /container -->
</div><!-- /copyright -->

