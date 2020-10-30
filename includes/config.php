<?php
ob_start();

session_start();

// $timezone = date_default_timezone_set("Europe/London");

$con = mysqli_connect("localhost", "mwonyaAdmin", "UpjYTaZ8Lg#g", "mwonya");
// $con = mysqli_connect("localhost", "pkasemer", "hH!oQ5amzeas412", "kede");

// $con = mysqli_connect("localhost","root","","mwonya",3306);



if (mysqli_connect_errno()) {
    echo "Failed to connect" . mysqli_connect_errno();
}