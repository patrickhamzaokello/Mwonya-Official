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

    <script src="mwonyacreate.js"></script>


    <link rel="stylesheet" href="mwonyacreate.css">

    <title>Mwonya Creation Tool</title>

</head>

<body>
    <nav class="navbar navbar-inverse bg-dark navbar-fixed-top">
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
                    <li class="active"><a href="#">Home</a></li>

                    <?php
                    if ($contenttag == "music") {
                        echo " <li><a class='nav-link' href='create_album.php'>Create Music Album</a></li> 
                        <li><a class='nav-link' href='mwonyasongs.php'>Add Songs</a></li>

                        <li><a class='nav-link' href='create_album.php'>My Albums</a></li>
                        <li><a class='nav-link' href='create_album.php'>Statistics</a></li>


                        
                        ";
                    } else if ($contenttag == "podcast") {
                        echo " <li> <a class='nav-link' href='create_podcast.php'>Create Podcast </a> </li> ";
                    } else if ($contenttag == "dj") {
                        echo "<li> <a class='nav-link' href='create_Dj.php'>Create DJ</a></li>";
                    } else if ($contenttag == "poem") {

                        echo " <li><a class='nav-link' href='create_poems.php'>Create Poem Album</a></li>";
                    } else {
                        echo " ";
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

    <div class="intropge">
        <div class="parent">
            <div class="div1"> </div>
            <div class="div2"> </div>
            <div class="div3"> </div>
            <div class="div4"> </div>
            <div class="div5"> </div>
            <div class="div6"> </div>
        </div>
        <div class="content">
            <h3>CREATE NEW ARTIST</h3>
            <p>Mwonya Music Stream</p>

            <button class="newartistbutton"><a href="contentcreator.php">Add New Artist</a></button>
            <button class="enjoymusicbutton"><a href="../browse.php">Enjoy Music</a></button>

        </div>
    </div>

    <div class="mycontainer">

        <div class="quote">
            <p>Be Able to add a song to a particular album for an Artist. All Songs should be within the required size
                and format </p>

            <span><a href="mwonyasongs.php">Add Song</a></span>
        </div>

        <div class="quote">
            <p>Add Podcast Episode to the Already Created Podcast Album. Add Podcast Episode Descescription to Enable
                users to be more interested in your work </p>
            <span><a href="mwonyapodcasts.php">Add Podcast</a></span>
        </div>
        <div class="quote">
            <p>Add your Poems with this tool and make sure to include elaborate Details to help users understand your
                work. </p>
            <span><a href="mwonyapoems.php">Add Poem</a></span>
        </div>
        <div class="quote">
            <p>All Dj Mixtapes and Nonstops are added through this button and please check the input fields carefully.

            </p>
            <span> <a href="mwonyadjmixtape.php">Add Dj Mix</a></span>
        </div>


    </div>


</body>

</html>