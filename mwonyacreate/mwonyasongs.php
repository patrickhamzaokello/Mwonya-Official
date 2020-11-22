<?php

include("config/database.php");
include("config/global.php");
include("config/errorhandler.php");



//Our select statement. This will retrieve the data that we want.
$sqlgenre = "SELECT id, name FROM genres";
$sqlalbum = "SELECT id, title From albums WHERE tag='music' AND artist='$artistid'";
//ordeer


//Prepare the select statement.
$stmtgrenre = $conn->prepare($sqlgenre);
$stmtalbum = $conn->prepare($sqlalbum);




//Execute the statement.
$stmtgrenre->execute();
$stmtalbum->execute();


//Retrieve the rows using fetchAll.
$genres = $stmtgrenre->fetchAll();
$albums = $stmtalbum->fetchAll();



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
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="icon" href="../assets/images/musiclogo.png" type="image/png">


    <link rel="stylesheet" href="vanillaupload.css">

    <title>File Upload</title>
</head>

<script>
function _(id) {
    return document.getElementById(id);
}

function uploadFiles() {
    $('#progressBar').css('display', 'block');
    var formdata = new FormData();
    var ufiles = _("userfiles").files;
    for (var i = 0; i < ufiles.length; i++) {
        formdata.append("file_" + i, ufiles[i]);
        // ufiles.name (name /size / type)
    }

    // var songtitle = _("songtitle").value;
    var songtag = "music";
    var songartist = _("songartist").value;
    var songAlbum = _("songAlbum").value;
    var songGenre = _("songGenre").value;


    formdata.append("username", "Patrick");

    // formdata.append("songtile", songtitle);
    formdata.append("songtag", songtag);
    formdata.append("songartist", songartist);
    formdata.append("songAlbum", songAlbum);
    formdata.append("songGenre", songGenre);



    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.open("POST", "parser.php");
    ajax.send(formdata);

}

function progressHandler(event) {
    _("loaded_n_total").innerHTML = "uploaded " + event.loaded + " bytes of " + event.total;
    var percent = (event.loaded / event.total) * 100;
    _("progressBar").value = Math.round(percent);
    _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
}

function completeHandler(event) {
    _("status").innerHTML = event.target.responseText;
    _("progressBar").value = 0;
    _("upload_form").reset();
    $('#progressBar').css('display', 'none');

}
</script>

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
                        <li  class='active'><a class='nav-link' href='mwonyasongs.php'>Add Songs</a></li>

                        <li><a class='nav-link' href='artistalbums.php'>My Albums</a></li>
                        <li><a class='nav-link' href='artiststats.php'>Statistics</a></li>


                        
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
    <div class="container mt-5">
        <!-- Display response messages -->
        <?php if (!empty($resMessage)) { ?>
        <div class="alert <?php echo $resMessage['status'] ?>">
            <?php echo $resMessage['message'] ?>
        </div>
        <?php } ?>
        <h2>Mwonya Song Upload</h2>
        <form enctype="multipart/form-data" method="post" id="upload_form">



            <div class="form-group">
                <label for="songartist">Song Creator</label>
                <select name="artistselect" id="songartist" class="form-control">
                    <option selected value="<?= $artistid; ?>"><?= $artistname ?></option>
                </select>
            </div>

            <div class="form-group">
                <label for="songAlbum">Song Album</label>
                <select name="albumselect" id="songAlbum" required class="form-control">
                    <option selected>Choose Album</option>
                    <?php foreach ($albums as $album) : ?>
                    <option value="<?= $album['id']; ?>"><?= $album['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="songGenre">Song Genre</label>
                <select id="songGenre" required class="form-control">
                    <option selected>Choose Genre</option>
                    <?php foreach ($genres as $genre) : ?>
                    <option value="<?= $genre['id']; ?>"><?= $genre['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>


            <input id="userfiles" class="upload-box" multiple type="file">

            <input type="button" value="Upload Files" onclick="uploadFiles()">

            <progress id="progressBar" value="0" max="100"></progress>

            <h6 id="status"></h6>
            <p id="loaded_n_total"></p>

        </form>
    </div>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
    </script>

</body>

</html>