<?php
include("config/global.php");


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
    <title>Create Music Album</title>

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


                    <?php
                    if ($contenttag == "music") {
                        echo " <li><a class='nav-link' href='create_album.php'>Create Music Album</a></li> 
                        <li><a class='nav-link' href='mwonyasongs.php'>Add Songs</a></li>

                  
                        <li><a class='nav-link' href='artistalbums.php'>My Albums</a></li>
                        <li  class='active'><a class='nav-link' href='artiststats.php'>Statistics</a></li>


                        
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
<li><a href='#'><span class='glyphicon glyphicon-user'></span> $artistname</a></li>

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

</body>

</html>