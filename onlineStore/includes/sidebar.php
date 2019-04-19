<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 20/11/2018
 * Time: 17:19
 */
?>

<div class="panel panel-default sidebar-menu"><!-- panel panel-default sidebar-menu -->
    <div class="panel-heading"><!-- panel-heading -->
        <h3 class="panel-title">Products Categories</h3>
    </div><!-- /panel-heading -->
    <div class="panel body"><!-- panel-body -->
        <ul class="nav nav-pills nav-stacked category-menu"><!-- category-menu-->
            <?php getProductCategories(); ?>
        </ul><!-- /category-menu -->
    </div><!-- /panel-body -->
</div><!-- /panel panel-default sidebar-menu -->

<div class="panel panel-default sidebar-menu"><!-- panel panel-default sidebar-menu -->
    <div class="panel-heading"><!-- panel-heading -->
        <h3 class="panel-title">Products Categories</h3>
    </div><!-- /panel-heading -->
    <div class="panel body"><!-- panel-body -->
        <ul class="nav nav-pills nav-stacked category-menu"><!-- category-menu-->
            <?php getCategories(); ?>
        </ul><!-- /category-menu -->
    </div><!-- /panel-body -->
</div><!-- /panel panel-default sidebar-menu -->
