<?php
/**
 * Created by PhpStorm.
 * User: Andre
 * Date: 06/12/2018
 * Time: 02:09
 */

$db["host"] = "localhost";
$db["user"] = "root";
$db["pass"] = "Server45Server7AGCD";
$db["database"] = "onlinestore";

foreach ($db as $key => $value) {
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(HOST, USER, PASS, DATABASE);
