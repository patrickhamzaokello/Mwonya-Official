<?php

include("config/database.php");
include("config/errorhandler.php");



//Our select statement. This will retrieve the data that we want.
$sqlartist = "SELECT id, name FROM artists WHERE tag='podcast'";
$sqlgenre = "SELECT id, name FROM genres";
$sqlalbum = "SELECT id, title From albums WHERE tag='podcast'";
//ordeer


//Prepare the select statement.
$stmtartist = $conn->prepare($sqlartist);
$stmtgrenre = $conn->prepare($sqlgenre);
$stmtalbum = $conn->prepare($sqlalbum);




//Execute the statement.
$stmtartist->execute();
$stmtgrenre->execute();
$stmtalbum->execute();


//Retrieve the rows using fetchAll.
$artists = $stmtartist->fetchAll();
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
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
    var songtag = "podcast";
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

    <nav class="navbar  navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Mwonya Admin</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>

                <li class="nav-item ">
                    <a class="nav-link active" href="">Song </a>
                </li>


            </ul>

        </div>
    </nav>
    <div class="container mt-5">
        <!-- Display response messages -->
        <?php if (!empty($resMessage)) { ?>
        <div class="alert <?php echo $resMessage['status'] ?>">
            <?php echo $resMessage['message'] ?>
        </div>
        <?php } ?>
        <h2>Mwonya Podcast Upload</h2>
        <form enctype="multipart/form-data" method="post" id="upload_form">

            <div class="form-group">
                <label for="songartist">Podcast Creator</label>
                <select name="artistselect" id="songartist" class="form-control">
                    <option selected>Choose Podcast Creator</option>
                    <?php foreach ($artists as $artist) : ?>
                    <option value="<?= $artist['id']; ?>"><?= $artist['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="songAlbum">Podcast Group</label>
                <select name="albumselect" id="songAlbum" required class="form-control">
                    <option selected>Choose Group</option>
                    <?php foreach ($albums as $album) : ?>
                    <option value="<?= $album['id']; ?>"><?= $album['title']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label for="songGenre">Podcast Genre</label>
                <select id="songGenre" required class="form-control">
                    <option selected>Choose Podcast Genre</option>
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
</body>

</html>