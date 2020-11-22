<?php

include("config/global.php");
// echo $artistname;

// echo $artistid;
// echo $contenttag;
include("uploadscripts/artistupload.php");



?>



<!doctype html>
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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="icon" href="../assets/images/musiclogo.png" type="image/png">

    <link rel="stylesheet" href="mwonyacreate.css">
    <script src="mwonyacreate.js"></script>

    <title>Mwonya Artist Creation</title>

</head>

<body>
    <nav class="navbar navbar-inverse bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Mwonya Admin</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav">
                    <li><a href="index.php">Home</a></li>
                    <li class="active">
                        <a class="nav-link" href="create_artist.php">Create Artist</a>

                    </li>

                    <?php
                    if ($contenttag == "music") {
                        echo " <li><a class='nav-link' href='create_album.php'>Create Music Album</a></li> 
                        <li><a class='nav-link' href='create_album.php'>My Albums</a></li>
                        <li><a class='nav-link' href='create_album.php'>Statistics</a></li>


                        
                        ";
                    } elseif ($contenttag == "podcast") {
                        echo " <li> <a class='nav-link' href='create_podcast.php'>Create Podcast </a> </li> ";
                    } elseif ($contenttag == "dj") {
                        echo "<li> <a class='nav-link' href='create_Dj.php'>Create DJ</a></li>";
                    } elseif ($contenttag == "poem") {

                        echo " <li><a class='nav-link' href='create_poems.php'>Create Poem Album</a></li>";
                    } else {
                        echo "sign in please";
                    }

                    ?>


                </ul>
                <ul class="nav navbar-nav navbar-right">

                    <?php
                    if (isset($_SESSION["name"])) {

                        echo "
<li><a href='logout.php' tite='Logout'><span class='glyphicon glyphicon-log-out'></span> Logout</a>
</li> ";
                    } else {
                        echo "
<li><a href='contentcreator.php'><span class='glyphicon glyphicon-user'></span> Sign Up</a></li>
<li><a href='login.php' tite='Login'><span class='glyphicon glyphicon-log-in'></span> Login</a>

</li>

";
                    }


                    ?>

                </ul>
            </div>
        </div>
    </nav>




    <div class="container mt-5">



        <div class="cards">



        </div>

        <div class="cards">


            <div id="imageholdingdiv" style="position: relative; left: 0; top: 0; width:100%; height:200px">
                <img src="..." id="coverplaceholder" class="coverimage" />
                <img src="..." id="imgPlaceholder" class="artist" />
            </div>

            <p>Use this page to create Artists or Content Creators for Music, Podcasts, Poems and Dj Mixes</p>

        </div>


    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            $('#imageholdingdiv').css('display', 'block');
            reader.onload = function(e) {
                $('#imgPlaceholder').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    function readCoverURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            $('#imageholdingdiv').css('display', 'block');
            reader.onload = function(e) {
                $('#coverplaceholder').attr('src', e.target.result);

            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("form").on("change", ".file-upload-field", function() {
        $(this).parent(".file-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, ''));
    });

    $("#chooseFile").change(function() {
        readURL(this);
    });

    $("#chooseCoverFile").change(function() {
        readCoverURL(this);
    });
    </script>






</body>

</html>