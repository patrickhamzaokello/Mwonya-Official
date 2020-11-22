<?php

include("config/database.php");

include("uploadscripts/podcastupload.php");


//Our select statement. This will retrieve the data that we want.
$sqlartist = "SELECT id, name FROM artists WHERE tag='dj'";
$sqlgenre = "SELECT id, name FROM genres";

//Prepare the select statement.
$stmtartist = $conn->prepare($sqlartist);
$stmtgrenre = $conn->prepare($sqlgenre);

//Execute the statement.
$stmtartist->execute();
$stmtgrenre->execute();

//Retrieve the rows using fetchAll.
$artists = $stmtartist->fetchAll();
$genres = $stmtgrenre->fetchAll();



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
    <title>Create DJ</title>

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
                    <li>
                        <a class="nav-link" href="create_artist.php">Create Artist</a>

                    </li>
                    <li> <a class="nav-link" href="create_podcast.php">Create Podcast </a> </li>
                    <li><a class="nav-link" href="create_album.php">Create Music Album</a></li>
                    <li><a class="nav-link" href="create_poems.php">Create Poem Album</a></li>
                    <li class="active"> <a class="nav-link" href="create_Dj.php">Create DJ</a></li>
                </ul>
                <!-- <ul class="nav navbar-nav navbar-right">
                    <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                </ul> -->
            </div>
        </div>
    </nav>

    <div class="container mt-5">

        <div class="cards">

            <!-- Display response messages -->
            <?php if (!empty($resMessage)) { ?>
                <div class="alert <?php echo $resMessage['status'] ?>">
                    <?php echo $resMessage['message'] ?>
                </div>
            <?php } ?>
            <form action="" method="post" enctype="multipart/form-data" class="mb-3">
                <h3 class="text-center mb-5">New Mwonya DJ Mixtape</h3>



                <div class="tagname">
                    <input name="tagname" value="dj">Tag: <Span style="background: #7b4888;    padding: 5px;    color: white;">DJ</Span></p>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Mixtape Name</label>
                    <input type="text" name="AlbumTitle" class="form-control" id="exampleInputEmail1" aria-describedby="nameHelp" placeholder="Enter Mixtape Name">
                </div>
                <div class="form-group">
                    <label for="inputState">DJ Creator</label>
                    <select name="artistselect" id="inputState" class="form-control">
                        <option selected>Choose Creator</option>
                        <?php foreach ($artists as $artist) : ?>
                            <option value="<?= $artist['id']; ?>"><?= $artist['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="inputState">Mixtape Genre</label>
                    <select name="genreselect" id="inputState" class="form-control">
                        <option selected>Choose Genre</option>
                        <?php foreach ($genres as $genre) : ?>
                            <option value="<?= $genre['id']; ?>"><?= $genre['name']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputdescription">Mixtape Description</label>
                    <textarea type="textarea" name="description" class="form-control" id="exampleInputdescription" aria-describedby="descriptionHelp" placeholder="DJ Description"></textarea>
                </div>

                <div class="form-group">

                    <div class="custom-file">
                        <label class="custom-file-label" for="chooseFile">Select Mixtape Cover</label>

                        <input type="file" name="fileUpload" class="custom-file-input" id="chooseFile">
                    </div>
                </div>



                <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                    Create Mixtape
                </button>
            </form>

        </div>


        <div class="cards">
            <div id="imageholdingdiv" class="user-image mb-3 text-center">
                <div class="imageholder">
                    <img src="..." class="figure-img img-fluid rounded contentimage" id="imgPlaceholder" alt="">
                </div>
            </div>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Voluptatem et incidunt totam quaerat, dolorum
                sequi consectetur non in animi. Quod qui pariatur suscipit necessitatibus voluptates ab esse dolores ex
                rem!</p>
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

        $("form").on("change", ".file-upload-field", function() {
            $(this).parent(".file-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, ''));
        });

        $("#chooseFile").change(function() {
            readURL(this);
        });
    </script>

</body>

</html>