<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 17/03/2019
 * Time: 16:13
 */
?>
<?php

if (!isset($_SESSION['admin_email'])) {
    ?>
    <script>window.open("login.php", "_self")</script>
    <?php
} else {
    ?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle Navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="index.php?dashboard" class="navbar-brand">Admin Panel</a>
    </div>
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fas fa-user"></i>&nbsp;
                <?php  echo $adminName?>
               &nbsp;<b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="index.php?userProfile=<?php echo $adminId ?>" >
                        <i class="fas fa-fw fa-user-alt"></i>&nbsp;User Profile
                    </a>
                </li>
                <li>
                    <a href="index.php?viewProducts">
                        <i class="fas fa-fw fa-envelope"></i>&nbsp;Products
                        <span class="badge"><?php echo $countProducts?></span>
                    </a>
                </li>
                <li>
                    <a href="index.php?viewCustomers">
                        <i class="fas fa-fw fa-user-cog"></i>&nbsp;Customers
                        <span class="badge"><?php echo $countCustomers?></span>
                    </a>
                </li>
                <li>
                    <a href="index.php?viewProductCat">
                        <i class="fas fa-fw fa-cog"></i>&nbsp;Product Categories
                        <span class="badge"><?php echo $countProductCat?></span>
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="logout.php">
                        <i class="fas fa-fw fa-power-off"></i>&nbsp;Log Out
                    </a>
                </li>

            </ul>
        </li>
    </ul>
    <div class="collapse navbar-collapse navbar-ex1-collapse">
        <ul class="nav navbar-nav side-nav">
            <li>
                <a href="index.php?dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>&nbsp;Dashboard
                </a>
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#products">
                    <i class="fas fa-fw fa-table"></i>&nbsp;Products
                    <i class="fas fa-fw fa-caret-down"></i>
                </a>
                <ul id="products" class="collapse">
                    <li><a href="index.php?insertProduct">Insert Product</a></li>
                    <li><a href="index.php?viewProducts">View Products</a></li>
                </ul>
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#productCat">
                    <i class="fas fa-fw fa-tablets"></i>&nbsp;Product Categories
                    <i class="fas fa-fw fa-caret-down"></i>
                </a>
                <ul id="productCat" class="collapse">
                    <li><a href="index.php?insertProductCat">Insert Product Category</a></li>
                    <li><a href="index.php?viewProductCat">View Product Categories</a></li>
                </ul>
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#categories">
                    <i class="fas fa-fw fa-arrows-alt-v"></i>&nbsp;Categories
                    <i class="fas fa-fw fa-caret-down"></i>
                </a>
                <ul id="categories" class="collapse">
                    <li><a href="index.php?insertCategory">Insert Category</a></li>
                    <li><a href="index.php?viewCategories">View Categories</a></li>
                </ul>
            </li>
             <li>
                <a href="#" data-toggle="collapse" data-target="#boxes">
                    <i class="fas fa-fw fa-arrows-alt"></i>&nbsp;Boxes Section
                    <i class="fas fa-fw fa-caret-down"></i>
                </a>
                <ul id="boxes" class="collapse">
                    <li><a href="index.php?insertBox">Insert Box</a></li>
                    <li><a href="index.php?viewBoxes">View Boxes</a></li>
                </ul>
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#slides">
                    <i class="fas fa-fw fa-arrows-alt-h"></i>&nbsp;Slides
                    <i class="fas fa-fw fa-caret-down"></i>
                </a>
                <ul id="slides" class="collapse">
                    <li><a href="index.php?insertSlide">Insert Slide</a></li>
                    <li><a href="index.php?viewSlides">View Slides</a></li>
                </ul>
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#terms">
                    <i class="fas fa-fw fa-arrows-alt-h"></i>&nbsp;Terms & Conditions
                    <i class="fas fa-fw fa-caret-down"></i>
                </a>
                <ul id="terms" class="collapse">
                    <li><a href="index.php?insertTerm">Insert Terms</a></li>
                    <li><a href="index.php?viewTerms">View Terms</a></li>
                </ul>
            </li>
            <li>
                <a href="index.php?viewCustomers">
                    <i class="fas fa-fw fa-users-cog"></i>&nbsp;View Customers
                </a>
            </li>
            <li>
                <a href="index.php?viewOrders">
                    <i class="fas fa-fw fa-list"></i>&nbsp;View Orders
                </a>
            </li>
            <li>
                <a href="index.php?viewPayments">
                    <i class="fas fa-fw fa-money-bill-wave-alt"></i>&nbsp;View Payments
                </a>
            </li>
            <li>
                <a href="#" data-toggle="collapse" data-target="#users">
                    <i class="fas fa-fw fa-user-cog"></i>&nbsp;Users
                    <i class="fas fa-fw fa-caret-down"></i>
                </a>
                <ul id="users" class="collapse">
                    <li><a href="index.php?insertUser">Insert User</a></li>
                    <li><a href="index.php?viewUsers">View Users</a></li>
                    <li><a href="index.php?userProfile=<?php echo $adminId?>">Edit Profile</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<?php }