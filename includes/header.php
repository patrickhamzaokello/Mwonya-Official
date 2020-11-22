<?php
include("includes/config.php");
include("includes/classes/User.php");
include("includes/classes/Artist.php");
include("includes/classes/Album.php");
include("includes/classes/Song.php");



if (isset($_SESSION['userLoggedIn'])) {
  $userLoggedIn = new User($con,  $_SESSION['userLoggedIn']);
  $username = $userLoggedIn->getUsername();
  echo "<script>userLoggedIn = '$username';</script>";
} else {
  header("Location: register.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YNG3P75VXH"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-YNG3P75VXH');
    </script>


    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>Mwonya Music</title>
    <link rel="icon" href="assets/images/musiclogo.png" type="image/png">
    <link
        href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900italic,900'
        rel='stylesheet' type='text/css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css'>
    <link rel='stylesheet' href='https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/8.3.0/nouislider.min.css'>

    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <script src="assets/signup/js/jquery-3.1.1.min.js"></script>

    <!-- <script src="assets/js/jquery.js"></script> -->
    <script src="assets/js/MainScript.js"></script>

</head>

<body>


    <?php

  include("includes/headingContainer.php");

  ?>

    <section class="content">

        <?php

    include("includes/navBarContainer.php");

    ?>

        <div class="content__middle">

            <div class="artist is-verified" id="mainContent">