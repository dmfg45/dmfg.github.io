<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 23/12/2018
 * Time: 03:31
 */

require "db.php";


function confirmResult($result)
{
    global $connection;
    if (!$result) {
        die("<h4><b class='text-danger'>Query failed:</b> &nbsp;</h4>" . mysqli_error($connection));
    } else {
        echo "<script>alert('Product Added')</script>";
    }
}

function getDbCountInfo($table)
{
    global $connection;

    $query = "select * from '$table'";
    $runQuery = mysqli_query($connection, $query);
    $count = mysqli_num_rows($runQuery);

    return $count;
}

function getDbConditionInfo($table, $cond1, $cond2)
{
    global $connection;

    $query = "select * from '$table' WHERE '$cond1' = '$cond2'";
    $runQuery = mysqli_query($connection, $query);
    $row = mysqli_fetch_array($runQuery);

    return $row;
}
